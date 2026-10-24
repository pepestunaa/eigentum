@extends('layout.market')

@section('title', 'Jual Properti')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Jual</span>
    </nav>

    <div class="k-hero" style="grid-template-columns: 1fr;">
        <div>
            <p class="k-hero__eyebrow">Jual properti</p>
            <h1 class="k-hero__title">Propertimu dilihat <em>pembeli yang tepat</em>.</h1>
            <p class="k-hero__lead">
                Daftarkan properti sebagai developer atau serahkan ke agen terverifikasi.
                Listing aktif tampil di beranda dan halaman pencarian Eigentum.
            </p>
            <div style="display: flex; gap: 0.75rem; flex-wrap: wrap; margin-top: 1rem;">
                <a class="k-btn k-btn--solid k-btn--lg" href="{{ route('agent.search.user') }}">Ceritakan ke agen</a>
                <a class="k-btn k-btn--outline k-btn--lg" href="/pages/langganan">Lihat paket langganan</a>
            </div>
        </div>
    </div>

    <section class="k-section" aria-labelledby="sell-steps">
        <div class="k-steps">
            <div class="k-steps__item">
                <span class="k-steps__num">01</span>
                <h3>Daftar sebagai mitra</h3>
                <p>Buat akun developer atau agen, lalu lengkapi profil usaha propertimu.</p>
            </div>
            <div class="k-steps__item">
                <span class="k-steps__num">02</span>
                <h3>Unggah listing</h3>
                <p>Masukkan data unit: foto, spesifikasi, harga, dan lokasi.</p>
            </div>
            <div class="k-steps__item">
                <span class="k-steps__num">03</span>
                <h3>Terima calon pembeli</h3>
                <p>Pembeli menghubungimu langsung lewat halaman listing — tanpa perantara tersembunyi.</p>
            </div>
        </div>
    </section>
</div>
@endsection
