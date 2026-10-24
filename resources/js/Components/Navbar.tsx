import React, { useState } from 'react';
import { Link, usePage, router } from '@inertiajs/react';

interface AuthUser {
    id: number;
    name: string;
    role: string;
}

const links = [
    { href: '/', label: 'Beranda', active: (url: string) => url === '/' },
    { href: '/pages/unit/search', label: 'Properti', active: (url: string) => url.startsWith('/pages/unit') },
    { href: '/pages/agent', label: 'Cari Agen', active: (url: string) => url.startsWith('/pages/agent') },
    { href: '/pages/guide', label: 'Panduan', active: (url: string) => url.startsWith('/pages/guide') },
    { href: '/pages/kpr', label: 'KPR', active: (url: string) => url.startsWith('/pages/kpr') },
];

export default function Navbar() {
    const { url, props } = usePage();
    const auth = (props as { auth?: { user?: AuthUser | null } }).auth;
    const user = auth?.user ?? null;
    const [open, setOpen] = useState(false);

    const logout = (e: React.FormEvent) => {
        e.preventDefault();
        router.post('/logout');
    };

    return (
        <header className="k-header">
            <div className="k-container k-header__bar">
                <Link className="k-header__logo" href="/">
                    <span className="k-header__logo-mark">E</span>
                    Eigentum
                </Link>

                <nav className="k-header__nav" aria-label="Navigasi utama">
                    {links.map((l) => (
                        <Link
                            key={l.href}
                            href={l.href}
                            className={`k-header__link${l.active(url) ? ' is-active' : ''}`}
                        >
                            {l.label}
                        </Link>
                    ))}
                </nav>

                <form
                    className="k-header__search"
                    action="/pages/unit/search"
                    method="GET"
                    role="search"
                >
                    <input type="text" name="search" placeholder="Cari properti, lokasi…" aria-label="Cari properti" />
                    <button type="submit" aria-label="Cari">
                        <svg className="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2">
                            <circle cx="11" cy="11" r="7" />
                            <path d="m20 20-3.5-3.5" />
                        </svg>
                    </button>
                </form>

                <div className="k-header__actions">
                    {user ? (
                        <>
                            {user.role === 'user' && (
                                <Link className="k-btn k-btn--ghost k-btn--sm" href="/favorite">Favorit</Link>
                            )}
                            {['developer', 'agent', 'admin'].includes(user.role) && (
                                <Link className="k-btn k-btn--outline k-btn--sm" href={`/${user.role}/dashboard`}>Dashboard</Link>
                            )}
                            <form onSubmit={logout}>
                                <button type="submit" className="k-btn k-btn--outline k-btn--sm">Keluar</button>
                            </form>
                            <Link className="k-btn k-btn--solid k-btn--sm" href="/pages/profile">Profil</Link>
                        </>
                    ) : (
                        <>
                            <Link className="k-btn k-btn--ghost k-btn--sm" href="/session/auth/user/signin">Masuk</Link>
                            <Link className="k-btn k-btn--solid k-btn--sm" href="/session/auth/user/signup">Daftar</Link>
                        </>
                    )}
                    <button
                        type="button"
                        className="k-header__burger"
                        aria-label="Buka menu"
                        aria-expanded={open}
                        onClick={() => setOpen(!open)}
                    >
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2">
                            <path d="M4 7h16M4 12h16M4 17h16" />
                        </svg>
                    </button>
                </div>
            </div>

            {open && (
                <div className="k-mobile-panel">
                    {links.map((l) => (
                        <Link key={l.href} href={l.href} onClick={() => setOpen(false)}>{l.label}</Link>
                    ))}
                    {user ? (
                        <>
                            <Link href="/favorite" onClick={() => setOpen(false)}>Favorit</Link>
                            <Link href="/pages/profile" onClick={() => setOpen(false)}>Profil</Link>
                        </>
                    ) : (
                        <>
                            <Link href="/session/auth/user/signin" onClick={() => setOpen(false)}>Masuk</Link>
                            <Link href="/session/auth/user/signup" onClick={() => setOpen(false)}>Daftar</Link>
                        </>
                    )}
                </div>
            )}
        </header>
    );
}
