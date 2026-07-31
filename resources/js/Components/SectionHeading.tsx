import React from 'react';
import { VStack } from '@astryxdesign/core/Stack';
import { HStack } from '@astryxdesign/core/Stack';
import { Heading } from '@astryxdesign/core/Heading';
import { Text } from '@astryxdesign/core/Text';
import { Link } from '@astryxdesign/core/Link';

interface SectionHeadingProps {
  title: string;
  subtitle: string;
  actionText?: string;
  actionHref?: string;
}

export default function SectionHeading({ title, subtitle, actionText, actionHref }: SectionHeadingProps) {
  if (actionText) {
    return (
      <HStack justify="space-between" align="end">
        <VStack gap="var(--spacing-2)">
          <Heading level={2} size="large">{title}</Heading>
          <Text color="secondary" weight="semibold">{subtitle}</Text>
        </VStack>
        {actionHref ? (
          <Link href={actionHref}>
            <Text color="primary" weight="semibold" style={{ cursor: 'pointer' }}>{actionText}</Text>
          </Link>
        ) : (
          <Text color="primary" weight="semibold" style={{ cursor: 'pointer' }}>{actionText}</Text>
        )}
      </HStack>
    );
  }

  return (
    <VStack gap="var(--spacing-2)">
      <Heading level={2} size="large">{title}</Heading>
      <Text color="secondary" weight="semibold">{subtitle}</Text>
    </VStack>
  );
}
