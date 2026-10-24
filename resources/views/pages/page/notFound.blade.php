@extends('layout.market')

@section('title', 'Halaman tidak ditemukan')

@section('content')
<div class="k-container" style="display: grid; place-items: center; min-height: 60vh; text-align: center;">
    <div style="padding-block: var(--s-7);">
        <p class="k-mono" style="font-size: 4rem; font-weight: 600; color: var(--green); margin: 0;">404</p>
        <h1 style="font-size: clamp(1.5rem, 3vw, 2.2rem); margin-bottom: 0.5rem;">Halaman tidak ditemukan</h1>
        <p style="color: var(--muted); max-width: 44ch; margin: 0 auto 1.5rem;">
            Alamat yang kamu buka tidak ada atau sudah dipindahkan. Coba kembali ke beranda atau lanjutkan pencarian.
        </p>
        <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
            <a class="k-btn k-btn--solid" href="{{ route('beranda') }}">Ke beranda</a>
            <a class="k-btn k-btn--outline" href="{{ route('unit.search.user') }}">Cari properti</a>
        </div>
    </div>
</div>
@endsection
