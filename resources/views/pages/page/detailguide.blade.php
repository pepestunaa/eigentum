@extends('layout.market')

@section('title', 'Panduan SP3K')

@section('content')
<div class="k-container" style="max-width: 820px;">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <a href="/pages/guide">Panduan</a>
        <span>/</span>
        <span class="is-current">SP3K</span>
    </nav>

    <div style="padding-block: var(--s-4) var(--s-7);">
        <span class="k-badge k-badge--soft">SP3K</span>
        <h1 style="font-size: clamp(1.7rem, 4vw, 2.6rem); margin: 0.75rem 0 1rem;">Panduan SP3K: syarat pengajuan KPR</h1>
        <p style="color: var(--muted);">Panduan singkat untuk memahami dan mengurus SP3K sebelum pengajuan KPR.</p>

        <section style="margin-top: 2rem;">
            <h2 style="font-size: 1.3rem; margin-bottom: 0.75rem;">Apa itu SP3K?</h2>
            <p style="color: var(--muted); max-width: 65ch;">
                SP3K (Surat Persetujuan Penyediaan Kredit Kepemilikan) adalah surat persetujuan dari bank
                bahwa kredit kepemilikan rumahmu telah disetujui. Memegang SP3K berarti proses pencairan
                KPR-mu berada di jalur yang benar.
            </p>
        </section>

        <section style="margin-top: 2rem;">
            <h2 style="font-size: 1.3rem; margin-bottom: 0.75rem;">Cara mengurus SP3K</h2>
            <div class="k-steps" style="grid-template-columns: 1fr; gap: 1rem;">
                <div class="k-steps__item">
                    <span class="k-steps__num">01</span>
                    <h3>Siapkan dokumen</h3>
                    <p>KTP, slip gaji atau bukti penghasilan, NPWP, dan dokumen properti yang akan dibeli.</p>
                </div>
                <div class="k-steps__item">
                    <span class="k-steps__num">02</span>
                    <h3>Ajukan ke bank</h3>
                    <p>Sertakan dokumen ke bank pilihanmu. Bank akan melakukan analisis kelayakan kredit.</p>
                </div>
                <div class="k-steps__item">
                    <span class="k-steps__num">03</span>
                    <h3>Terima SP3K</h3>
                    <p>Setelah disetujui, bank menerbitkan SP3K dan proses akad kredit dapat dijadwalkan.</p>
                </div>
            </div>
        </section>

        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 2.5rem;">
            <a class="k-btn k-btn--solid" href="/pages/kpr">Coba simulasi KPR</a>
            <a class="k-btn k-btn--outline" href="/pages/guide">Kembali ke panduan</a>
        </div>
    </div>
</div>
@endsection
