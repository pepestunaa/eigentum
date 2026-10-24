import React from 'react';
import { Link } from '@inertiajs/react';

export default function Footer() {
    return (
        <footer className="k-footer">
            <div className="k-container">
                <div className="k-footer__grid">
                    <div>
                        <div className="k-footer__brand">
                            <span className="k-footer__brand-mark">E</span>
                            Eigentum
                        </div>
                        <p>Marketplace properti yang menghubungkan pembeli, penyewa, dan agen dengan developer terverifikasi di seluruh Indonesia.</p>
                    </div>
                    <div>
                        <h4>Jelajahi</h4>
                        <ul>
                            <li><Link href="/pages/unit/search">Semua Properti</Link></li>
                            <li><Link href="/pages/rent">Disewakan</Link></li>
                            <li><Link href="/pages/sell">Jual Properti</Link></li>
                            <li><Link href="/pages/newProperty">Properti Baru</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Layanan</h4>
                        <ul>
                            <li><Link href="/pages/agent">Cari Agen</Link></li>
                            <li><Link href="/pages/kpr">Simulasi KPR</Link></li>
                            <li><Link href="/pages/langganan">Langganan</Link></li>
                            <li><Link href="/pages/guide">Panduan</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h4>Akun</h4>
                        <ul>
                            <li><Link href="/session/auth/user/signin">Masuk</Link></li>
                            <li><Link href="/session/auth/user/signup">Daftar</Link></li>
                            <li><Link href="/pages/profile">Profil Saya</Link></li>
                            <li><Link href="/favorite">Favorit</Link></li>
                        </ul>
                    </div>
                </div>
                <div className="k-footer__base">
                    <span>© {new Date().getFullYear()} Eigentum. Semua hak dilindungi.</span>
                    <span className="k-mono">ID · IDR</span>
                </div>
            </div>
        </footer>
    );
}
