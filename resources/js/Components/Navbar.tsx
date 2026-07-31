import React from 'react';
import { Link } from '@inertiajs/react';
import {
  TopNav,
  TopNavHeading,
  TopNavItem,
} from '@astryxdesign/core/TopNav';
import { Button } from '@astryxdesign/core/Button';
import { HStack } from '@astryxdesign/core/Stack';

interface NavbarProps {
  currentPage?: string;
}

export default function Navbar({ currentPage = 'beranda' }: NavbarProps) {
  return (
    <TopNav
      heading={
        <TopNavHeading href="/">Eigentum</TopNavHeading>
      }
      endContent={
        <HStack gap="var(--spacing-3)" align="center">
          <Button variant="primary" href="/login">Masuk</Button>
        </HStack>
      }
    >
      <TopNavItem label="Beranda" href="/" isSelected={currentPage === 'beranda'} />
      <TopNavItem label="Properti" href="/pages/unit/search" isSelected={currentPage === 'properti'} />
      <TopNavItem label="Tentang Kami" href="/about" isSelected={currentPage === 'tentang'} />
    </TopNav>
  );
}
