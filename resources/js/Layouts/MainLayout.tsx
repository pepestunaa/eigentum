import React from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';
import * as stylex from '@stylexjs/stylex';
import { colors, typography } from '@/tokens.stylex';

const styles = stylex.create({
  global: {
    backgroundColor: colors.paperLight,
    color: colors.inkDark,
    fontFamily: typography.fontBody,
    minHeight: '100vh',
    margin: 0,
    padding: 0,
    overflowX: 'hidden',
  },
  main: {
    paddingTop: '120px', // For floating navbar
    minHeight: 'calc(100vh - 300px)',
  }
});

interface MainLayoutProps {
  children: React.ReactNode;
  title?: string;
  currentPage?: string;
}

export default function MainLayout({ children, title }: MainLayoutProps) {
  // Apply body background explicitly if needed, but styling a wrapper works for now
  React.useEffect(() => {
    document.body.style.backgroundColor = '#f0ece1';
    document.body.style.margin = '0';
  }, []);

  return (
    <div {...stylex.props(styles.global)}>
      {title && <Head title={title} />}
      <Navbar />
      <main {...stylex.props(styles.main)}>
        {children}
      </main>
      <Footer />
    </div>
  );
}
