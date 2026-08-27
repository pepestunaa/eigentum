/* Hallmark · genre: editorial · macrostructure: 08-photographic · feature: F6 Product card grid */
import React from 'react';
import { Link } from '@inertiajs/react';
import { VStack, HStack } from '@astryxdesign/core/Stack';
import { Text } from '@astryxdesign/core/Text';
import { AspectRatio } from '@astryxdesign/core/AspectRatio';
import { formatPrice } from '@/Helpers/formatPrice';
import type { Unit } from '@/types';

interface UnitCardProps {
  unit: Unit;
}

export default function UnitCard({ unit }: UnitCardProps) {
  return (
    <Link href={`/pages/unit/${unit.id}`} style={{ textDecoration: 'none', color: 'inherit', display: 'block' }}>
      <VStack gap="var(--spacing-3)" style={{ position: 'relative' }}>
        <AspectRatio ratio="4/3" style={{ backgroundColor: 'var(--color-background-surface)', overflow: 'hidden' }}>
          <img
            src={unit.image ? `/storage/${unit.image}` : '/assets/pages/banner/home2.jpg'}
            alt={unit.title}
            style={{
              width: '100%',
              height: '100%',
              objectFit: 'cover',
              display: 'block',
              transition: 'transform 0.4s ease-out',
            }}
            onMouseEnter={(e) => e.currentTarget.style.transform = 'scale(1.02)'}
            onMouseLeave={(e) => e.currentTarget.style.transform = 'scale(1)'}
          />
        </AspectRatio>

        <VStack gap="var(--spacing-1)">
          <HStack justify="space-between" align="center">
            <Text size="small" color="secondary" style={{ fontFamily: 'var(--font-mono, monospace)', textTransform: 'uppercase', letterSpacing: '0.05em' }}>
              {unit.properties?.types?.name || 'Unit'}
            </Text>
            <Text size="small" style={{ fontFamily: 'var(--font-mono, monospace)' }}>
              {formatPrice(unit.price)}
            </Text>
          </HStack>
          
          <Text size="large" style={{ fontFamily: 'var(--font-display, serif)', fontWeight: 400, overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>
            {unit.title}
          </Text>

          <HStack gap="var(--spacing-3)" style={{ color: 'var(--color-text-secondary)', fontSize: '0.875rem' }}>
            {unit.specifications?.bedroom && (
              <Text size="small" color="secondary">{unit.specifications.bedroom} Bed</Text>
            )}
            {unit.specifications?.bathroom && (
              <Text size="small" color="secondary">{unit.specifications.bathroom} Bath</Text>
            )}
            {unit.specifications?.building_area && (
              <Text size="small" color="secondary">{unit.specifications.building_area}m²</Text>
            )}
          </HStack>
        </VStack>
      </VStack>
    </Link>
  );
}
