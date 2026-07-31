import React from 'react';
import { Carousel } from '@astryxdesign/core/Carousel';
import { VStack } from '@astryxdesign/core/Stack';
import { Text } from '@astryxdesign/core/Text';
import { Heading } from '@astryxdesign/core/Heading';
import { Button } from '@astryxdesign/core/Button';
import type { HeroSlide } from '@/types';

interface HeroCarouselProps {
  slides: HeroSlide[];
}

export default function HeroCarousel({ slides }: HeroCarouselProps) {
  return (
    <Carousel hideScrollbar style={{ width: '100%', height: '500px' }}>
      {slides.map((slide, i) => (
        <VStack
          key={i}
          gap="var(--spacing-6)"
          align="center"
          style={{
            width: '100vw',
            height: '100%',
            flexShrink: 0,
            background: 'linear-gradient(135deg, var(--color-background-subtle) 0%, var(--color-background-surface) 100%)',
            display: 'flex',
            alignItems: 'center',
            justifyContent: 'center',
            borderBottom: '1px solid var(--color-border-subtle)',
            textAlign: 'center',
            padding: 'var(--spacing-8)',
          }}
        >
          <Text color="secondary" weight="bold">{slide.title}</Text>
          <Heading level={1} size="display" style={{ maxWidth: '800px', lineHeight: '1.1' }}>
            {slide.subtitle}
          </Heading>
          <Text size="large" color="secondary" style={{ maxWidth: '600px', fontSize: '1.25rem' }}>
            {slide.text}
          </Text>
          <Button variant="primary" size="large" style={{ marginTop: 'var(--spacing-4)' }}>
            Lihat Sekarang
          </Button>
        </VStack>
      ))}
    </Carousel>
  );
}
