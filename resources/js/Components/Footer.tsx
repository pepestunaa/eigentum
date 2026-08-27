import React from 'react';
import { Link } from '@inertiajs/react';

export default function Footer() {
  return (
    <footer style={{ 
      backgroundColor: 'var(--color-bg-secondary)', 
      borderTop: '1px solid var(--color-border-subtle)',
      padding: '80px 24px',
      marginTop: '100px'
    }}>
      <div style={{ maxWidth: '1200px', margin: '0 auto', display: 'flex', flexDirection: 'column', alignItems: 'center', textAlign: 'center', gap: '24px' }}>
        <h2 style={{ fontFamily: 'var(--font-display)', fontSize: '2rem', fontWeight: 300, color: 'var(--color-text-primary)', letterSpacing: '0.05em' }}>
          EIGENTUM
        </h2>
        <p style={{ color: 'var(--color-text-secondary)', maxWidth: '400px', fontStyle: 'italic' }}>
          Platform pencarian properti premium di Indonesia dengan standar kelas dunia.
        </p>
        
        <div style={{ display: 'flex', gap: '32px', flexWrap: 'wrap', justifyContent: 'center', marginTop: '16px' }}>
          <Link href="/about" style={{ color: 'var(--color-text-secondary)' }}>Tentang Kami</Link>
          <Link href="/pages/sell" style={{ color: 'var(--color-text-secondary)' }}>Jual Properti</Link>
          <Link href="/pages/rent" style={{ color: 'var(--color-text-secondary)' }}>Sewa Properti</Link>
          <Link href="/pages/kpr" style={{ color: 'var(--color-text-secondary)' }}>KPR</Link>
        </div>
        
        <div style={{ marginTop: '48px', color: 'rgba(255, 255, 255, 0.3)', fontSize: '0.875rem' }}>
          © 2026 Eigentum. All rights reserved.
        </div>
      </div>
    </footer>
  );
}
