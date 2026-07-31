import React from 'react';
import { Card } from '@astryxdesign/core/Card';
import { VStack } from '@astryxdesign/core/Stack';
import { Heading } from '@astryxdesign/core/Heading';
import { Text } from '@astryxdesign/core/Text';
import type { ServiceItem } from '@/types';

interface ServiceCardProps {
  item: ServiceItem;
}

export default function ServiceCard({ item }: ServiceCardProps) {
  return (
    <Card>
      <VStack gap="var(--spacing-4)" align="center" style={{ padding: 'var(--spacing-6)', textAlign: 'center' }}>
        <Text style={{ fontSize: '3rem' }}>{item.icon}</Text>
        <Heading level={3}>{item.title}</Heading>
        <Text color="secondary">{item.description}</Text>
      </VStack>
    </Card>
  );
}
