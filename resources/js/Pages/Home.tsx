import React from 'react';
import { Link } from '@inertiajs/react';
import { motion } from 'framer-motion';
import MainLayout from '@/Layouts/MainLayout';
import UnitCard from '@/Components/UnitCard';
import type { Unit } from '@/types';

interface HomeProps {
    units: { data: Unit[]; total?: number };
    newunits: Unit[];
    developer: unknown[];
    property: unknown[];
    status: { id: number; name: string }[];
    types: { id: number; name: string }[];
    regencies: Record<number, string>;
}

const fadeUp = {
    initial: { opacity: 0, y: 16 },
    animate: { opacity: 1, y: 0 },
};

export default function Home({
    newunits = [],
    units,
    status = [],
    types = [],
    developer = [],
    regencies = {},
}: HomeProps) {
    const regencyNames = Object.values(regencies).filter(Boolean);
    const featured = newunits.slice(0, 8);

    return (
        <MainLayout title="Beranda">
            {/* hero */}
            <section className="k-container">
                <div className="k-hero">
                    <motion.div {...fadeUp} transition={{ duration: 0.6, ease: [0.16, 1, 0.3, 1] }}>
                        <p className="k-hero__eyebrow">Marketplace Properti Indonesia</p>
                        <h1 className="k-hero__title">
                            Temukan hunian yang <em>benar-benar</em> cocok.
                        </h1>
                        <p className="k-hero__lead">
                            Ribuan unit rumah, apartemen, dan tanah langsung dari developer
                            terverifikasi — lengkap dengan harga, spesifikasi, dan agen yang siap membantu.
                        </p>

                        <form className="k-search-panel" action="/pages/unit/search" method="GET">
                            <div className="k-search-panel__field">
                                <label htmlFor="h-search">Cari</label>
                                <input id="h-search" type="text" name="search" placeholder="Lokasi, nama properti…" />
                            </div>
                            <div className="k-search-panel__field">
                                <label htmlFor="h-type">Tipe</label>
                                <select id="h-type" name="types[]" defaultValue="">
                                    <option value="">Semua tipe</option>
                                    {types.map((t) => (
                                        <option key={t.id} value={t.id}>{t.name}</option>
                                    ))}
                                </select>
                            </div>
                            <div className="k-search-panel__field">
                                <label htmlFor="h-status">Status</label>
                                <select id="h-status" name="status[]" defaultValue="">
                                    <option value="">Semua status</option>
                                    {status.map((s) => (
                                        <option key={s.id} value={s.id}>{s.name}</option>
                                    ))}
                                </select>
                            </div>
                            <button type="submit" className="k-search-panel__submit">
                                Cari
                                <svg className="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2">
                                    <path d="M5 12h14m-6-6 6 6-6 6" />
                                </svg>
                            </button>
                        </form>
                    </motion.div>

                    <div className="k-hero__media">
                        <img src="/assets/pages/Home/kota.jpg" alt="Kawasan properti di Indonesia" />
                        <div className="k-hero__stat">
                            <div>
                                <b className="k-mono">{units?.data?.length ? `${units.total}+` : '—'}</b>
                                <span>Listing aktif</span>
                            </div>
                            <div>
                                <b className="k-mono">{developer.length || '—'}</b>
                                <span>Developer</span>
                            </div>
                            <div>
                                <b className="k-mono">{regencyNames.length || '—'}</b>
                                <span>Kota</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* status chips */}
            <section className="k-container" aria-label="Jelajahi berdasarkan status">
                <div style={{ display: 'flex', gap: '0.6rem', flexWrap: 'wrap', paddingBottom: '1rem' }}>
                    {status.map((s) => (
                        <Link key={s.id} className="k-chip" href={`/pages/unit/search?status[]=${s.id}`}>
                            {s.name}
                        </Link>
                    ))}
                    {types.map((t) => (
                        <Link key={`t-${t.id}`} className="k-chip" href={`/pages/unit/search?types[]=${t.id}`}>
                            {t.name}
                        </Link>
                    ))}
                </div>
            </section>

            {/* featured listings */}
            <section className="k-container k-section" aria-labelledby="k-featured">
                <div className="k-sec-head">
                    <h2 id="k-featured">Listing Terbaru</h2>
                    <Link className="k-sec-head__link" href="/pages/unit/search">
                        Lihat semua
                        <svg className="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.2">
                            <path d="M5 12h14m-6-6 6 6-6 6" />
                        </svg>
                    </Link>
                </div>

                {featured.length > 0 ? (
                    <div className="k-grid">
                        {featured.map((unit) => (
                            <UnitCard key={unit.id} unit={unit} />
                        ))}
                    </div>
                ) : (
                    <div className="k-empty">
                        <h3>Belum ada listing</h3>
                        <p>Listing terbaru akan tampil di sini begitu developer menambahkan unit.</p>
                    </div>
                )}
            </section>

            {/* how it works */}
            <section className="k-container k-section" aria-labelledby="k-steps">
                <div className="k-sec-head">
                    <h2 id="k-steps">Cara kerjanya</h2>
                </div>
                <div className="k-steps">
                    <div className="k-steps__item">
                        <span className="k-steps__num">01</span>
                        <h3>Cari &amp; bandingkan</h3>
                        <p>Saring berdasarkan lokasi, harga, dan spesifikasi. Simpan yang menarik ke favorit.</p>
                    </div>
                    <div className="k-steps__item">
                        <span className="k-steps__num">02</span>
                        <h3>Survey &amp; verifikasi</h3>
                        <p>Hubungi agen atau developer untuk jadwal survey langsung ke lokasi.</p>
                    </div>
                    <div className="k-steps__item">
                        <span className="k-steps__num">03</span>
                        <h3>Negosiasi &amp; KPR</h3>
                        <p>Setujui penawaran, lalu selesaikan pembayaran tunai atau lewat KPR.</p>
                    </div>
                </div>
            </section>
        </MainLayout>
    );
}
