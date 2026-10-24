@extends('layout.market')

@section('title', 'Favorit')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Favorit</span>
    </nav>

    <div class="k-sec-head">
        <h1 style="font-size: clamp(1.5rem, 3.5vw, 2.2rem);">Favorit saya</h1>
        <span class="k-catalog__count">{{ $favorites->count() }} unit tersimpan</span>
    </div>

    @if ($favorites->count())
        <div class="k-grid" style="padding-bottom: var(--s-7);">
            @foreach ($favorites as $unit)
                @include('layout.partial.card-unit', ['unit' => $unit, 'isFav' => true])
            @endforeach
        </div>
    @else
        <div class="k-empty" style="margin-bottom: var(--s-7);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A5.99 5.99 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/>
            </svg>
            <h3>Belum ada favorit</h3>
            <p>Simpan properti yang menarik dengan menekan ikon hati, lalu bandingkan di sini.</p>
            <a class="k-btn k-btn--solid" href="{{ route('unit.search.user') }}" style="margin-top: 1rem;">Jelajahi properti</a>
        </div>
    @endif
</div>
@endsection
