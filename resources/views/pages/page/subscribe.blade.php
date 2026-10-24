@extends('layout.market')

@section('title', 'Langganan')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Langganan</span>
    </nav>

    <div class="k-sec-head">
        <h1 style="font-size: clamp(1.5rem, 3.5vw, 2.2rem);">Paket langganan</h1>
        <span class="k-catalog__count">untuk developer &amp; agen</span>
    </div>

    <p style="color: var(--muted); max-width: 60ch; margin-top: -1rem; margin-bottom: 2rem;">
        Tampilkan propertimu ke lebih banyak calon pembeli. Pilih paket, bayar, dan listing langsung aktif.
    </p>

    <div class="k-grid" style="grid-template-columns: repeat(auto-fill, minmax(0, 320px)); padding-bottom: var(--s-7);">
        @forelse ($subscribes as $subscribe)
            <article class="k-card" style="padding: var(--s-5); gap: 0.75rem;">
                <h2 style="font-size: 1.3rem;">{{ $subscribe->title }}</h2>
                <p style="color: var(--muted); font-size: 0.92rem; margin: 0;">{{ $subscribe->description }}</p>
                <div style="display: flex; align-items: baseline; gap: 0.35rem; margin: 0.5rem 0;">
                    <span class="k-mono" style="font-size: 1.8rem; font-weight: 600; color: var(--green-ink);">
                        Rp {{ number_format($subscribe->price, 0, ',', '.') }}
                    </span>
                    <span style="color: var(--muted); font-size: 0.85rem;">/bulan</span>
                </div>
                <ul style="list-style: none; padding: 0; margin: 0 0 1rem; display: grid; gap: 0.5rem; font-size: 0.9rem;">
                    <li style="display: flex; gap: 0.5rem;">
                        <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="color: var(--green); margin-top: 3px;">
                            <path d="m5 13 4 4L19 7"/>
                        </svg>
                        <span><b>Visibilitas luas:</b> {{ $subscribe->feature_1 }}</span>
                    </li>
                    <li style="display: flex; gap: 0.5rem;">
                        <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="color: var(--green); margin-top: 3px;">
                            <path d="m5 13 4 4L19 7"/>
                        </svg>
                        <span><b>Pemasaran efektif:</b> {{ $subscribe->feature_2 }}</span>
                    </li>
                    <li style="display: flex; gap: 0.5rem;">
                        <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="color: var(--green); margin-top: 3px;">
                            <path d="m5 13 4 4L19 7"/>
                        </svg>
                        <span><b>Kemudahan kelola:</b> {{ $subscribe->feature_4 }}</span>
                    </li>
                    <li style="display: flex; gap: 0.5rem;">
                        <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" style="color: var(--green); margin-top: 3px;">
                            <path d="m5 13 4 4L19 7"/>
                        </svg>
                        <span><b>Tampilan menarik:</b> {{ $subscribe->feature_3 }}</span>
                    </li>
                </ul>
                <form action="{{ route('subscribeid.store', $subscribe->id) }}" method="POST" style="margin-top: auto;">
                    @csrf
                    <button type="submit" class="k-btn k-btn--solid k-btn--full">Pilih paket</button>
                </form>
            </article>
        @empty
            <div class="k-empty" style="grid-column: 1 / -1;">
                <h3>Belum ada paket</h3>
                <p>Paket langganan akan tampil di sini.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
