import React from 'react';
import { ClickableCard } from '@astryxdesign/core/ClickableCard';
import { VStack } from '@astryxdesign/core/Stack';
import { Text } from '@astryxdesign/core/Text';
import { Heading } from '@astryxdesign/core/Heading';
import { AspectRatio } from '@astryxdesign/core/AspectRatio';
import type { Property } from '@/types';

interface PropertyCardProps {
  property: Property;
}

export default function PropertyCard({ property }: PropertyCardProps) {
  return (
    <ClickableCard
      label={property.title || 'Properti'}
      href={`/pages/property/${property.id}`}
      elevation="low"
      padding={0}
    >
      <VStack gap="0">
        <AspectRatio ratio="16/9">
          <img
            src={property.image ? `/storage/${property.image}` : '/assets/pages/banner/home2.jpg'}
            alt={property.title || 'Properti'}
            style={{
              width: '100%',
              height: '100%',
              objectFit: 'cover',
              display: 'block',
            }}
          />
        </AspectRatio>
        <VStack gap="var(--spacing-2)" style={{ padding: 'var(--spacing-4)' }}>
          <Text size="small" color="secondary">{property.types?.name || 'Tipe'}</Text>
          <Heading level={3} size="medium" style={{ overflow: 'hidden', textOverflow: 'ellipsis', whiteSpace: 'nowrap' }}>
            {property.title}
          </Heading>
          <Text weight="bold" color="primary">{property.price_range}</Text>
        </VStack>
      </VStack>
    </ClickableCard>
  );
}
