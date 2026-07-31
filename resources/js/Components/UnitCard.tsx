import React from 'react';
import { ClickableCard } from '@astryxdesign/core/ClickableCard';
import { VStack } from '@astryxdesign/core/Stack';
import { HStack } from '@astryxdesign/core/Stack';
import { Text } from '@astryxdesign/core/Text';
import { Heading } from '@astryxdesign/core/Heading';
import { Button } from '@astryxdesign/core/Button';
import { AspectRatio } from '@astryxdesign/core/AspectRatio';
import { formatPrice } from '@/Helpers/formatPrice';
import type { Unit } from '@/types';

interface UnitCardProps {
  unit: Unit;
}

export default function UnitCard({ unit }: UnitCardProps) {
  return (
    <ClickableCard
      label={unit.title}
      href={`/pages/unit/${unit.id}`}
      elevation="low"
      padding={0}
    >
      <VStack gap="0">
        <AspectRatio ratio="16/9" style={{ position: 'relative' }}>
          <img
            src={unit.image ? `/storage/${unit.image}` : '/assets/pages/banner/home2.jpg'}
            alt={unit.title}
            style={{
              width: '100%',
              height: '100%',
              objectFit: 'cover',
              display: 'block',
            }}
          />
          <HStack
            gap="var(--spacing-2)"
            style={{ position: 'absolute', bottom: 'var(--spacing-2)', right: 'var(--spacing-2)' }}
          >
            <Button variant="secondary" size="small">❤️</Button>
            <Button variant="secondary" size="small">👁️</Button>
          </HStack>
        </AspectRatio>

        <VStack gap="var(--spacing-2)" style={{ padding: 'var(--spacing-4)' }}>
          <Text size="small" color="secondary">
            {unit.properties?.types?.name || 'Tipe'}
          </Text>
          <Heading
            level={3}
            size="medium"
            style={{ overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}
          >
            {unit.title}
          </Heading>

          <HStack gap="var(--spacing-3)" style={{ color: 'var(--color-text-secondary)', fontSize: '0.875rem', marginTop: 'var(--spacing-1)' }}>
            {unit.specifications?.bedroom && (
              <HStack gap="var(--spacing-1)" align="center">
                <Text size="small">🛏️</Text>
                <Text size="small" color="secondary">{unit.specifications.bedroom}</Text>
              </HStack>
            )}
            {unit.specifications?.bathroom && (
              <HStack gap="var(--spacing-1)" align="center">
                <Text size="small">🛁</Text>
                <Text size="small" color="secondary">{unit.specifications.bathroom}</Text>
              </HStack>
            )}
            {unit.specifications?.building_area && (
              <HStack gap="var(--spacing-1)" align="center">
                <Text size="small">📐</Text>
                <Text size="small" color="secondary">{unit.specifications.building_area} m²</Text>
              </HStack>
            )}
          </HStack>

          <Text weight="bold" color="primary" style={{ marginTop: 'var(--spacing-2)', fontSize: '1.125rem' }}>
            {formatPrice(unit.price)}
          </Text>
        </VStack>
      </VStack>
    </ClickableCard>
  );
}
