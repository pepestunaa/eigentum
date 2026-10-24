import React from 'react';
import { Head } from '@inertiajs/react';
import Navbar from '@/Components/Navbar';
import Footer from '@/Components/Footer';

interface MainLayoutProps {
    children: React.ReactNode;
    title?: string;
}

export default function MainLayout({ children, title }: MainLayoutProps) {
    return (
        <>
            {title && <Head title={`${title} · Eigentum`} />}
            <Navbar />
            <main>{children}</main>
            <Footer />
        </>
    );
}
