@extends('layout.market')

@section('title', 'Panduan')

@php
    $guides = [
        ['img' => '/assets/pages/Panduan/kpr.jpg', 'cat' => 'SP3K', 'title' => 'Cara Melakukan SP3K dengan benar', 'date' => '12 Mei 2023'],
        ['img' => '/assets/pages/Panduan/eksplore.jpg', 'cat' => 'Properti', 'title' => 'Pahami Kebutuhan dan Kemampuan Keuangan Anda', 'date' => '12 Mei 2023'],
        ['img' => '/assets/pages/Panduan/panduan6.jpg', 'cat' => 'Properti', 'title' => 'Cari Informasi Tentang Bank atau Lembaga Keuangan', 'date' => '12 Mei 2023'],
        ['img' => '/assets/pages/Panduan/panduan5.jpg', 'cat' => 'Terbaru', 'title' => 'Siapkan Dokumen Penting', 'date' => '12 Mei 2023'],
        ['img' => '/assets/pages/Panduan/panduan4.jpg', 'cat' => 'KPR', 'title' => 'Hitung Besar Cicilan yang Dapat Dibayar', 'date' => '12 Mei 2023'],
    ];
@endphp

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Panduan</span>
    </nav>

    <div class="k-hero" style="grid-template-columns: 1fr; padding-block: var(--s-5);">
        <div>
            <p class="k-hero__eyebrow">Panduan Eigentum</p>
            <h1 class="k-hero__title">Semua yang perlu kamu tahu <em>sebelum membeli</em>.</h1>
            <p class="k-hero__lead">
                Dari SP3K sampai hitungan cicilan — baca panduan singkat ini supaya
                proses KPR dan pembelian propertimu berjalan mulus.
            </p>
        </div>
    </div>

    <section class="k-section" style="padding-top: 0;">
        <div class="k-sec-head">
            <h2>Panduan teratas</h2>
        </div>
        <div class="k-grid" style="padding-bottom: var(--s-7);">
            @foreach ($guides as $guide)
                <article class="k-card">
                    <a href="{{ route('detailpanduan') }}" class="k-card__media" aria-label="{{ $guide['title'] }}">
                        <img src="{{ asset($guide['img']) }}" alt="{{ $guide['title'] }}" loading="lazy">
                    </a>
                    <div class="k-card__body">
                        <span class="k-badge k-badge--soft" style="align-self: flex-start;">{{ $guide['cat'] }}</span>
                        <a href="{{ route('detailpanduan') }}" class="k-card__title">{{ $guide['title'] }}</a>
                        <span class="k-catalog__count">{{ $guide['date'] }}</span>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</div>
@endsection
