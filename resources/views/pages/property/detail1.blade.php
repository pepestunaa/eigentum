@extends('layout.market')

@section('title', $property->title)

@php
    $regencyNames = $property->regencies ? $property->regencies()->pluck('name')->toArray() : [];
    $isOwner = Auth::check()
        && Auth::user()->role === 'developer'
        && Auth::user()->id == $property->developers->users->pluck('id')->first();
@endphp

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <a href="{{ route('unit.search.user') }}">Properti</a>
        <span>/</span>
        <span class="is-current">{{ $property->title }}</span>
    </nav>

    <div class="k-detail">

        <div>
            <div class="k-hero__media" style="max-width: 640px; margin-bottom: 1.5rem;">
                <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('assets/pages/Home/kota.jpg') }}"
                     alt="{{ $property->title }}">
            </div>

            <h1 style="font-size: clamp(1.6rem, 3.5vw, 2.4rem); margin-bottom: 0.5rem;">{{ $property->title }}</h1>
            <p class="k-card__loc" style="font-size: 0.95rem;">
                <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 21s-7-5.5-7-11a7 7 0 1 1 14 0c0 5.5-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/>
                </svg>
                {{ implode(', ', $regencyNames) ?: ($property->address ?? 'Indonesia') }}
                @if ($property->types)
                    · {{ $property->types->name }}
                @endif
            </p>

            <section style="padding-block: 1.5rem 0;">
                <h2 style="font-size: 1.25rem; margin-bottom: 0.75rem;">Tentang properti ini</h2>
                <p style="color: var(--muted); max-width: 65ch;">{{ $property->description }}</p>
            </section>

            <section style="padding-block: 1.5rem 0;">
                <h2 style="font-size: 1.25rem; margin-bottom: 0.75rem;">Informasi</h2>
                <table class="k-table">
                    <tbody>
                        @if ($property->developers)
                            <tr>
                                <th style="width: 40%;">Developer</th>
                                <td>{{ $property->developers->company }}</td>
                            </tr>
                        @endif
                        @if ($property->types)
                            <tr>
                                <th>Tipe</th>
                                <td>{{ $property->types->name }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ implode(', ', $regencyNames) ?: ($property->address ?? '—') }}</td>
                        </tr>
                        <tr>
                            <th>Unit tersedia</th>
                            <td>{{ $units->count() }}</td>
                        </tr>
                        <tr>
                            <th>Kisaran harga</th>
                            <td>{{ $property->price_range ?: '—' }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>

        <aside class="k-detail__aside">
            <div class="k-panel k-panel--price">
                <span class="k-panel__price">{{ $property->price_range ?: 'Hubungi developer' }}</span>
                <p style="font-size: 0.85rem; color: var(--muted); margin: 0.5rem 0 1rem;">
                    Kisaran harga unit pada proyek ini.
                </p>
                <a class="k-btn k-btn--solid k-btn--full" href="{{ route('agent.search.user') }}">Tanya agen</a>
            </div>

            @if ($isOwner)
                <div class="k-panel">
                    <a class="k-btn k-btn--outline k-btn--full" href="{{ route('unit.create.developer', $property->id) }}">
                        + Tambah unit
                    </a>
                </div>
            @endif
        </aside>
    </div>

    <section class="k-section" aria-labelledby="k-units">
        <div class="k-sec-head">
            <h2 id="k-units">Unit pada {{ $property->title }}</h2>
        </div>
        @if ($units->count())
            <div class="k-grid">
                @foreach ($units as $unit)
                    @include('layout.partial.card-unit', ['unit' => $unit])
                @endforeach
            </div>
        @else
            <div class="k-empty">
                <h3>Belum ada unit</h3>
                <p>Unit pada proyek ini belum didaftarkan.</p>
            </div>
        @endif
    </section>
</div>
@endsection
