import React from 'react';
import { Section } from '@astryxdesign/core/Section';
import { Grid } from '@astryxdesign/core/Grid';
import { VStack, HStack } from '@astryxdesign/core/Stack';
import { Text } from '@astryxdesign/core/Text';
import { Heading } from '@astryxdesign/core/Heading';
import { Divider } from '@astryxdesign/core/Divider';
import { Link } from '@astryxdesign/core/Link';

export default function Footer() {
  return (
    <Section
      padding="var(--spacing-10) var(--spacing-4)"
      style={{
        backgroundColor: 'var(--color-background-inverse)',
        color: 'var(--color-text-inverse)',
      }}
    >
      <VStack gap="var(--spacing-8)">
        <Grid columns={{ base: 1, md: 4 }} gap="var(--spacing-6)">
          {/* Column 1: Brand */}
          <VStack gap="var(--spacing-3)">
            <Heading level={3} style={{ color: 'var(--color-text-inverse)' }}>Eigentum</Heading>
            <Text size="small" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>
              Platform properti terpercaya di Indonesia. Temukan rumah, apartemen, dan properti komersial impian Anda.
            </Text>
          </VStack>

          {/* Column 2: Navigation */}
          <VStack gap="var(--spacing-3)">
            <Heading level={4} style={{ color: 'var(--color-text-inverse)' }}>Navigasi</Heading>
            <VStack gap="var(--spacing-2)">
              <Link href="/" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Beranda</Link>
              <Link href="/pages/unit/search" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Properti</Link>
              <Link href="/about" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Tentang Kami</Link>
              <Link href="/pages/guide" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Panduan</Link>
            </VStack>
          </VStack>

          {/* Column 3: Services */}
          <VStack gap="var(--spacing-3)">
            <Heading level={4} style={{ color: 'var(--color-text-inverse)' }}>Layanan</Heading>
            <VStack gap="var(--spacing-2)">
              <Link href="/pages/sell" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Jual Properti</Link>
              <Link href="/pages/rent" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Sewa Properti</Link>
              <Link href="/pages/kpr" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>KPR</Link>
              <Link href="/pages/agent" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>Agen Properti</Link>
            </VStack>
          </VStack>

          {/* Column 4: Contact */}
          <VStack gap="var(--spacing-3)">
            <Heading level={4} style={{ color: 'var(--color-text-inverse)' }}>Kontak</Heading>
            <VStack gap="var(--spacing-2)">
              <Text size="small" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>📧 info@eigentum.id</Text>
              <Text size="small" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>📞 +62 21 1234 5678</Text>
              <Text size="small" style={{ color: 'var(--color-text-inverse)', opacity: 0.7 }}>📍 Jakarta, Indonesia</Text>
            </VStack>
          </VStack>
        </Grid>

        <Divider style={{ borderColor: 'var(--color-border-inverse)', opacity: 0.3 }} />

        <Text size="small" style={{ color: 'var(--color-text-inverse)', opacity: 0.5, textAlign: 'center' }}>
          © 2026 Eigentum. All rights reserved.
        </Text>
      </VStack>
    </Section>
  );
}
