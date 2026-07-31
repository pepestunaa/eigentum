import React from 'react';
import { Head } from '@inertiajs/react';
import { AppShell } from '@astryxdesign/core/AppShell';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

interface MainLayoutProps {
  children: React.ReactNode;
  title?: string;
  currentPage?: string;
}

export default function MainLayout({ children, title, currentPage = 'beranda' }: MainLayoutProps) {
  return (
    <AppShell
      topNav={<Navbar currentPage={currentPage} />}
    >
      {title && <Head title={title} />}
      {children}
      <Footer />
    </AppShell>
  );
}
