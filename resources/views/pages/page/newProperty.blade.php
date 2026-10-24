@extends('layout.market')

@section('title', 'Properti Baru')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Properti Baru</span>
    </nav>

    <div class="k-hero" style="grid-template-columns: 1fr;">
        <div>
            <p class="k-hero__eyebrow">Properti baru</p>
            <h1 class="k-hero__title">Proyek terbaru, <em>harga terbaik</em> dari developer.</h1>
            <p class="k-hero__lead">
                Unit-unit yang baru terdaftar di Eigentum — rumah, apartemen, dan kavling
                langsung dari developer resmi.
            </p>

            <form class="k-search-panel" action="{{ route('unit.search.user') }}" method="GET" style="max-width: 760px;">
                <div class="k-search-panel__field">
                    <label for="np-search">Cari</label>
                    <input id="np-search" type="text" name="search" placeholder="Lokasi, nama properti…">
                </div>
                <div class="k-search-panel__field">
                    <label for="np-min">Harga min</label>
                    <input id="np-min" type="number" name="min_price" placeholder="Rp" step="1000000" min="0">
                </div>
                <div class="k-search-panel__field">
                    <label for="np-max">Harga maks</label>
                    <input id="np-max" type="number" name="max_price" placeholder="Rp" step="1000000" min="0">
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

    <section class="k-section" style="padding-top: 0;">
        <div class="k-sec-head">
            <h2>Temukan listing terbaru</h2>
        </div>
        <a class="k-btn k-btn--solid k-btn--lg" href="{{ route('unit.search.user') }}">Lihat semua properti</a>
    </section>
</div>
@endsection
