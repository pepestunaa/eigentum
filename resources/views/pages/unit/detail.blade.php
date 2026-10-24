@extends('layout.market')

@section('title', $unit->title)

@php
    $galleryImages = [];
    if ($images && $images->etcimg) {
        $galleryImages = array_filter(explode('|', $images->etcimg));
    }
    $spec = $unit->specifications;
    $unitStatus = $unit->statuses->first();
    $statusClass = match(true) {
        $unitStatus && str_contains(strtolower($unitStatus->name ?? ''), 'terjual') => 'k-badge--red',
        $unitStatus && str_contains(strtolower($unitStatus->name ?? ''), 'sewa') => 'k-badge--amber',
        default => 'k-badge--soft',
    };
    $unitPrice = (int) $unit->price;
    $regencyNames = $unit->properties?->regencies ? $unit->properties->regencies()->pluck('name')->toArray() : [];
    $developer = $developer ?? ($unit->properties->developers ?? null);
    $waPhone = $developer?->phone ?? null;
    $waNumber = $waPhone ? preg_replace('/\D/', '', $waPhone) : null;
    if ($waNumber && !str_starts_with($waNumber, '62')) {
        $waNumber = '62' . ltrim($waNumber, '0');
    }
@endphp

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <a href="{{ route('unit.search.user') }}">Properti</a>
        <span>/</span>
        <span class="is-current">{{ $unit->title }}</span>
    </nav>

    <div class="k-detail">

        <div>
            <div class="k-gallery" style="margin-bottom: 1.5rem;">
                <div class="k-gallery__main">
                    @if (count($galleryImages))
                        <img src="{{ asset('storage/' . $galleryImages[0]) }}" alt="{{ $unit->title }}">
                    @else
                        <img src="{{ $unit->image ? asset('storage/' . $unit->image) : asset('assets/pages/Home/unit1.jpg') }}"
                             alt="{{ $unit->title }}">
                    @endif
                </div>
                @foreach (array_slice($galleryImages, 1, 2) as $thumb)
                    <div class="k-gallery__thumb">
                        <img src="{{ asset('storage/' . $thumb) }}" alt="{{ $unit->title }} — foto {{ $loop->iteration + 1 }}">
                    </div>
                @endforeach
            </div>

            <h1 style="font-size: clamp(1.6rem, 3.5vw, 2.4rem); margin-bottom: 0.5rem;">{{ $unit->title }}</h1>
            <p class="k-card__loc" style="font-size: 0.95rem;">
                <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 21s-7-5.5-7-11a7 7 0 1 1 14 0c0 5.5-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/>
                </svg>
                {{ implode(', ', $regencyNames) ?: ($unit->properties->address ?? 'Indonesia') }}
                @if ($unit->properties?->types)
                    · {{ $unit->properties->types->name }}
                @endif
            </p>

            @if ($spec)
                <div class="k-specs" style="margin: 1.5rem 0;">
                    <div class="k-specs__item">
                        <b>{{ $spec->bedroom ?? '—' }}</b>
                        <span>Kamar tidur</span>
                    </div>
                    <div class="k-specs__item">
                        <b>{{ $spec->bathroom ?? '—' }}</b>
                        <span>Kamar mandi</span>
                    </div>
                    <div class="k-specs__item">
                        <b>{{ $spec->building_area ?? '—' }}</b>
                        <span>Luas bangunan (m²)</span>
                    </div>
                    <div class="k-specs__item">
                        <b>{{ $spec->surface_area ?? '—' }}</b>
                        <span>Luas tanah (m²)</span>
                    </div>
                </div>
            @endif

            <section class="k-section" style="padding-block: 1.5rem 0;">
                <h2 style="font-size: 1.25rem; margin-bottom: 0.75rem;">Deskripsi</h2>
                <p style="color: var(--muted); max-width: 65ch;">{{ $unit->description }}</p>
            </section>

            <section style="padding-block: 1.5rem 0;">
                <h2 style="font-size: 1.25rem; margin-bottom: 0.75rem;">Informasi properti</h2>
                <table class="k-table">
                    <tbody>
                        <tr>
                            <th style="width: 40%;">Nomor kavling</th>
                            <td class="k-mono">KVL-{{ str_pad($unit->id, 4, '0', STR_PAD_LEFT) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $unit->statuses->pluck('name')->implode(', ') ?: '—' }}</td>
                        </tr>
                        @if ($unit->properties?->developers)
                            <tr>
                                <th>Developer</th>
                                <td>{{ $unit->properties->developers->company }}</td>
                            </tr>
                        @endif
                        @if ($unit->properties?->types)
                            <tr>
                                <th>Tipe properti</th>
                                <td>{{ $unit->properties->types->name }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ implode(', ', $regencyNames) ?: ($unit->properties->address ?? '—') }}</td>
                        </tr>
                        @if ($spec?->floor)
                            <tr>
                                <th>Lantai</th>
                                <td>{{ $spec->floor }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($unitPrice, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>

        <aside class="k-detail__aside">
            <div class="k-panel k-panel--price">
                <span class="k-panel__price">Rp {{ number_format($unitPrice, 0, ',', '.') }}</span>
                @if ($unitStatus)
                    <div style="margin: 0.5rem 0 1rem;">
                        <span class="k-badge {{ $statusClass }}">{{ $unitStatus->name }}</span>
                    </div>
                @endif
                <p style="font-size: 0.85rem; color: var(--muted); margin: 0 0 1rem;">
                    Estimasi cicilan Rp {{ number_format((int) $pricePerMonth, 0, ',', '.') }}/bulan pada skema 24×.
                </p>

                @auth
                    <button type="button" class="k-btn k-btn--outline k-btn--full {{ $unit->users->contains(Auth::id()) ? 'is-active' : '' }}"
                            data-fav="{{ $unit->id }}" aria-pressed="false" style="margin-bottom: 0.6rem;">
                        <svg class="k-icon" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                            <path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A5.99 5.99 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/>
                        </svg>
                        Simpan ke favorit
                    </button>
                @else
                    <a class="k-btn k-btn--outline k-btn--full" href="{{ route('signin.user') }}" style="margin-bottom: 0.6rem;">
                        Masuk untuk menyimpan
                    </a>
                @endauth

                @if ($waNumber)
                    <a class="k-btn k-btn--solid k-btn--full"
                       href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo, saya tertarik dengan unit ' . $unit->title . ' (KVL-' . str_pad($unit->id, 4, '0', STR_PAD_LEFT) . ')') }}"
                       target="_blank" rel="noopener">
                        Tanya agen
                    </a>
                @else
                    <a class="k-btn k-btn--solid k-btn--full" href="{{ route('agent.search.user') }}">Cari agen</a>
                @endif
            </div>

            @if ($developer)
                <div class="k-panel">
                    <div class="k-agent">
                        <span class="k-avatar" aria-hidden="true">🏢</span>
                        <div style="min-width: 0;">
                            <div class="k-agent__name">{{ $developer->company ?? 'Developer' }}</div>
                            <div class="k-agent__meta">Developer properti terverifikasi</div>
                        </div>
                    </div>
                </div>
            @endif
        </aside>
    </div>

    @php $related = $units->reject(fn ($u) => $u->id === $unit->id)->take(4); @endphp
    @if ($related->count())
        <section class="k-section" aria-labelledby="k-related">
            <div class="k-sec-head">
                <h2 id="k-related">Unit lain yang mungkin cocok</h2>
                <a class="k-sec-head__link" href="{{ route('unit.search.user') }}">
                    Lihat semua
                    <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <path d="M5 12h14m-6-6 6 6-6 6"/>
                    </svg>
                </a>
            </div>
            <div class="k-grid">
                @foreach ($related as $relatedUnit)
                    @include('layout.partial.card-unit', ['unit' => $relatedUnit])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
