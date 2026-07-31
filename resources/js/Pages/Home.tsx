import React, { useState } from 'react';
import { Head } from '@inertiajs/react';
import {
  Section,
  Heading,
  Text,
  Button,
  VStack,
  HStack,
  Grid,
  Carousel,
} from '@astryxdesign/core';

// Components
import MainLayout from '@/Layouts/MainLayout';
import HeroCarousel from '@/Components/HeroCarousel';
import ServiceCard from '@/Components/ServiceCard';
import SectionHeading from '@/Components/SectionHeading';
import UnitCard from '@/Components/UnitCard';
import PropertyCard from '@/Components/PropertyCard';

// Types & Helpers
import type { Unit, Property, HeroSlide, ServiceItem } from '@/types';
import { formatPrice } from '@/Helpers/formatPrice';

interface HomeProps {
  units: {
    data: Unit[];
    links: { url: string | null; label: string; active: boolean }[];
  };
  newunits: Unit[];
  developer: any[];
  property: Property[];
  status: any[];
  types: { name: string }[];
  regencies: any;
}

// Static data
const heroSlides: HeroSlide[] = [
  {
    title: 'Properti Impian Anda',
    subtitle: 'Eksplorasi Properti Berkualitas',
    text: 'Jelajahi Pilihan Luas Properti di Lokasi Premium untuk Gaya Hidup Modern Anda',
  },
  {
    title: 'Agen Properti',
    subtitle: 'Agen Terpercaya dalam Mencari Properti Ideal',
    text: 'Dapatkan panduan dan nasihat terbaik dari tim agen properti kami yang berpengalaman.',
  },
  {
    title: 'Panduan Properti',
    subtitle: 'Jelajahi Panduan tentang Properti',
    text: 'Dengan panduan kami, Anda akan memahami bagaimana mencari dan menilai properti yang sesuai dengan kebutuhan.',
  },
];

const services: ServiceItem[] = [
  {
    icon: '🔍',
    title: 'Kemudahan Pencarian properti',
    description: 'Pengguna bisa dengan mudah mencari properti yang diinginkan dengan fitur pencarian yang lengkap',
  },
  {
    icon: '📊',
    title: 'Lebih Banyak Pilihan',
    description: 'Lebih banyak pilihan properti yang bisa dipilih, mulai dari rumah, apartemen, hingga properti komersial.',
  },
  {
    icon: '📖',
    title: 'Informasi Lengkap',
    description: 'Informasi lengkap tentang properti yang dijual, mulai dari harga, lokasi, ukuran, fasilitas, dan lain sebagainya.',
  },
];

export default function Home(props: HomeProps) {
  const { units, newunits, property, types } = props;
  const [activeFilter, setActiveFilter] = useState('ALL');

  const filteredUnits = activeFilter === 'ALL' 
    ? units?.data 
    : units?.data?.filter((u) => u.properties?.types?.name === activeFilter);

  return (
    <MainLayout title="Beranda" currentPage="beranda">
      {/* Hero Carousel */}
      <HeroCarousel slides={heroSlides} />

      {/* Services Section */}
      <Section padding="var(--spacing-10) var(--spacing-4)" style={{ backgroundColor: 'var(--color-background-default)' }}>
        <Grid columns={{ base: 1, md: 3 }} gap="var(--spacing-6)">
          {services.map((srv, i) => (
            <ServiceCard key={i} item={srv} />
          ))}
        </Grid>
      </Section>

      {/* Produk Kami (Collage) */}
      <Section padding="var(--spacing-10) var(--spacing-4)" style={{ backgroundColor: 'var(--color-background-surface)' }}>
        <VStack gap="var(--spacing-6)">
          <SectionHeading title="PRODUK KAMI" subtitle="PROPERTI YANG KAMI TAWARKAN" />
          
          <Grid columns={{ base: 1, md: 12 }} gap="var(--spacing-4)">
            <VStack style={{ gridColumn: 'span 5', height: '300px', borderRadius: 'var(--radius-element)', overflow: 'hidden' }}>
              <img src="/assets/pages/banner/apartemen1.jpg" alt="Apartemen" style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
            </VStack>
            <VStack style={{ gridColumn: 'span 7', height: '300px', borderRadius: 'var(--radius-element)', overflow: 'hidden' }}>
              <img src="/assets/pages/banner/home2.jpg" alt="Rumah" style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
            </VStack>
            <VStack style={{ gridColumn: 'span 7', height: '300px', borderRadius: 'var(--radius-element)', overflow: 'hidden' }}>
              <img src="/assets/pages/banner/ruko1.jpg" alt="Ruko" style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
            </VStack>
            <VStack style={{ gridColumn: 'span 5', height: '300px', borderRadius: 'var(--radius-element)', overflow: 'hidden' }}>
              <img src="/assets/pages/banner/villa1.jpg" alt="Villa" style={{ width: '100%', height: '100%', objectFit: 'cover' }} />
            </VStack>
          </Grid>
        </VStack>
      </Section>

      {/* Properti Teratas (Grid with Filters) */}
      <Section padding="var(--spacing-10) var(--spacing-4)" style={{ backgroundColor: 'var(--color-background-default)' }}>
        <VStack gap="var(--spacing-6)">
          <SectionHeading title="PROPERTI TERATAS" subtitle="PILIH PROPERTI" />
          
          <HStack gap="var(--spacing-2)" wrap="wrap">
            <Button variant={activeFilter === 'ALL' ? 'primary' : 'secondary'} onClick={() => setActiveFilter('ALL')}>ALL</Button>
            {types && types.map((type) => (
              <Button key={type.name} variant={activeFilter === type.name ? 'primary' : 'secondary'} onClick={() => setActiveFilter(type.name)}>{type.name}</Button>
            ))}
          </HStack>

          <Grid columns={{ base: 1, sm: 2, md: 3, lg: 4 }} gap="var(--spacing-4)">
            {filteredUnits && filteredUnits.map((unit) => (
              <UnitCard key={unit.id} unit={unit} />
            ))}
          </Grid>
        </VStack>
      </Section>

      {/* Properti Terbaru (Carousel of `property`) */}
      <Section padding="var(--spacing-10) var(--spacing-4)" style={{ backgroundColor: 'var(--color-background-surface)' }}>
        <VStack gap="var(--spacing-6)">
          <SectionHeading title="PROPERTI TERBARU" subtitle="PILIH PROPERTI TERBARU KAMI" actionText="Lihat Semua" />
          
          <Carousel gap="var(--spacing-4)">
            {property && property.map((prop) => (
              <VStack key={prop.id} style={{ width: '300px', flexShrink: 0 }}>
                <PropertyCard property={prop} />
              </VStack>
            ))}
          </Carousel>
        </VStack>
      </Section>

      {/* Developer Banner */}
      <Section 
        padding="var(--spacing-12) var(--spacing-4)" 
        style={{ 
          background: 'linear-gradient(135deg, var(--color-background-interactive) 0%, var(--color-background-brand-default, #2563eb) 100%)', 
          color: 'white',
          textAlign: 'center' 
        }}
      >
        <VStack gap="var(--spacing-6)" align="center">
          <Heading level={1} size="display" style={{ color: 'white' }}>Jadilah Developer</Heading>
          <Text size="large" style={{ color: 'rgba(255,255,255,0.9)', maxWidth: '600px' }}>
            Kami Memiliki Diskon Terbaik Untuk Anda! Merencanakan strategi pemasaran untuk properti yang akan dijual.
          </Text>
          <Button variant="secondary" size="large" style={{ marginTop: 'var(--spacing-4)', color: 'var(--color-text-primary)' }}>Daftar Sekarang</Button>
        </VStack>
      </Section>

      {/* Properti Lainnya (Carousel of `newunits`) */}
      <Section padding="var(--spacing-10) var(--spacing-4)" style={{ backgroundColor: 'var(--color-background-default)' }}>
        <VStack gap="var(--spacing-6)">
          <SectionHeading title="PROPERTI LAINNYA" subtitle="TEMUKAN PROPERTI YANG ANDA BUTUHKAN" actionText="Lihat Semua" />
          
          <Carousel gap="var(--spacing-4)">
            {newunits && newunits.map((unit) => (
              <VStack key={unit.id} style={{ width: '300px', flexShrink: 0 }}>
                <UnitCard unit={unit} />
              </VStack>
            ))}
          </Carousel>
        </VStack>
      </Section>
    </MainLayout>
  );
}
