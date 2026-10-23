import React from 'react';
import { Head } from '@inertiajs/react';
import { motion } from 'framer-motion';
import * as stylex from '@stylexjs/stylex';
import MainLayout from '@/Layouts/MainLayout';
import Card from '@/Components/Card';
import { colors, typography, spacing, layout } from '@/tokens.stylex';
import type { Unit } from '@/types';

const styles = stylex.create({
  hero: {
    paddingTop: '10vh',
    paddingBottom: spacing.xl,
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    textAlign: 'center',
    borderBottom: `1px solid ${colors.lineLight}`,
  },
  marquee: {
    fontFamily: typography.fontDisplay,
    fontSize: 'clamp(3rem, 8vw, 8rem)',
    fontWeight: typography.weightBold,
    lineHeight: 0.9,
    letterSpacing: '-0.04em',
    color: colors.inkDark,
    margin: 0,
    maxWidth: '1200px',
  },
  marqueeAccent: {
    color: colors.accentLight,
    fontStyle: 'italic',
    fontWeight: typography.weightMedium,
  },
  subtitle: {
    fontFamily: typography.fontMono,
    fontSize: '0.875rem',
    color: colors.inkDark,
    opacity: 0.6,
    textTransform: 'uppercase',
    letterSpacing: '0.08em',
    marginTop: spacing.md,
  },
  section: {
    padding: `${spacing.xl} ${spacing.md}`,
    maxWidth: layout.maxWidth,
    margin: '0 auto',
  },
  sectionHeader: {
    display: 'flex',
    alignItems: 'baseline',
    gap: spacing.sm,
    borderBottom: `1px solid ${colors.lineLight}`,
    paddingBottom: spacing.sm,
    marginBottom: spacing.lg,
  },
  sectionIndex: {
    fontFamily: typography.fontMono,
    fontSize: typography.step1,
    color: colors.accentLight,
    fontWeight: typography.weightBold,
  },
  sectionTitle: {
    fontFamily: typography.fontDisplay,
    fontSize: typography.step3,
    fontWeight: typography.weightMedium,
    color: colors.inkDark,
    margin: 0,
  },
  grid: {
    display: 'grid',
    gridTemplateColumns: 'repeat(auto-fit, minmax(300px, 1fr))',
    gap: spacing.lg,
  }
});

interface HomeProps {
  newunits: Unit[];
}

export default function Home({ newunits }: HomeProps) {
  // Motion variants
  const stagger = {
    animate: { transition: { staggerChildren: 0.1 } }
  };
  const fadeInUp = {
    initial: { opacity: 0, y: 20 },
    animate: { opacity: 1, y: 0, transition: { duration: 0.8, ease: [0.16, 1, 0.3, 1] } }
  };

  const sampleProjects = newunits?.length > 0 ? newunits : [
    { id: 1, name: 'Villa Azure', address: 'Seminyak, ID', description: 'Hunian eksklusif dengan sentuhan tropis modern.' },
    { id: 2, name: 'The Horizon', address: 'Jakarta Selatan', description: 'Apartemen premium di pusat kawasan bisnis.' },
    { id: 3, name: 'Oasis Residence', address: 'Bandung', description: 'Ketelatenan arsitektur di tengah sejuknya alam.' },
  ];

  return (
    <MainLayout title="Beranda" currentPage="beranda">
      {/* HERO SECTION */}
      <motion.section 
        variants={stagger} initial="initial" animate="animate"
        {...stylex.props(styles.hero)}
      >
        <motion.p variants={fadeInUp} {...stylex.props(styles.subtitle)}>
          Listing Eksklusif 2026
        </motion.p>
        <motion.h1 variants={fadeInUp} {...stylex.props(styles.marquee)}>
          Temukan Hunian <br/>
          <span {...stylex.props(styles.marqueeAccent)}>Ideal Anda.</span>
        </motion.h1>
      </motion.section>

      {/* PROJECTS SECTION */}
      <section {...stylex.props(styles.section)}>
        <motion.div 
          initial={{ opacity: 0 }} 
          whileInView={{ opacity: 1 }} 
          viewport={{ once: true }}
          transition={{ duration: 1 }}
          {...stylex.props(styles.sectionHeader)}
        >
          <span {...stylex.props(styles.sectionIndex)}>01</span>
          <h2 {...stylex.props(styles.sectionTitle)}>Properti Pilihan</h2>
        </motion.div>

        <div {...stylex.props(styles.grid)}>
          {sampleProjects.map((unit, index) => (
            <Card
              key={unit.id}
              index={`No. 0${index + 1}`}
              axis={unit.properties?.address}
              title={unit.title}
              description={unit.description || 'Properti premium dengan spesifikasi terbaik di kelasnya.'}
            />
          ))}
        </div>
      </section>
    </MainLayout>
  );
}
