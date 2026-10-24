@extends('layout.market')

@section('title', 'Sewa Properti')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Sewa</span>
    </nav>

    <div class="k-hero" style="grid-template-columns: 1fr;">
        <div>
            <p class="k-hero__eyebrow">Sewa properti</p>
            <h1 class="k-hero__title">Tempat tinggal <em>fleksibel</em>, tanpa komitmen jangka panjang.</h1>
            <p class="k-hero__lead">
                Apartemen, rumah, dan ruko siap hunian dari pemilik terverifikasi.
                Cari berdasarkan lokasi dan spesifikasi, lalu hubungi pemiliknya langsung.
            </p>

            <form class="k-search-panel" action="{{ route('unit.search.user') }}" method="GET" style="max-width: 760px;">
                <div class="k-search-panel__field">
                    <label for="r-search">Cari</label>
                    <input id="r-search" type="text" name="search" placeholder="Lokasi, nama properti…">
                </div>
                <div class="k-search-panel__field">
                    <label for="r-type">Tipe</label>
                    <select id="r-type" name="types[]" defaultValue="">
                        <option value="">Semua tipe</option>
                    </select>
                </div>
                <div class="k-search-panel__field">
                    <label for="r-max">Budget maks</label>
                    <input id="r-max" type="number" name="max_price" placeholder="Rp" step="1000000" min="0">
                </div>
                <button type="submit" class="k-search-panel__submit">
                    Cari
                    <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

    <section class="k-section" aria-labelledby="rent-steps">
        <div class="k-steps">
            <div class="k-steps__item">
                <span class="k-steps__num">01</span>
                <h3>Saring sesuai budget</h3>
                <p>Tetapkan rentang harga bulanan dan tipe hunian yang kamu butuhkan.</p>
            </div>
            <div class="k-steps__item">
                <span class="k-steps__num">02</span>
                <h3>Kunjungan &amp; survei</h3>
                <p>Jadwalkan survei bersama agen atau pemilik properti.</p>
            </div>
            <div class="k-steps__item">
                <span class="k-steps__num">03</span>
                <h3>Kontrak &amp; pindahan</h3>
                <p>Setujui kontrak sewa, lakukan pembayaran, dan pindah dengan tenang.</p>
            </div>
        </div>
    </section>

    <section class="k-section" style="padding-top: 0;">
        <div class="k-sec-head">
            <h2>Siap mulai?</h2>
        </div>
        <div style="display: flex; gap: 0.75rem; flex-wrap: wrap;">
            <a class="k-btn k-btn--solid k-btn--lg" href="{{ route('unit.search.user') }}">Jelajahi listing</a>
            <a class="k-btn k-btn--outline k-btn--lg" href="{{ route('agent.search.user') }}">Cari agen</a>
        </div>
    </section>
</div>
@endsection
