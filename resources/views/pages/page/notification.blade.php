@extends('layout.market')

@section('title', 'Notifikasi')

@section('content')
<div class="k-container" style="max-width: 760px; padding-block: var(--s-5) var(--s-7);">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Notifikasi</span>
    </nav>

    <div class="k-sec-head">
        <h1 style="font-size: clamp(1.5rem, 3vw, 2rem);">Notifikasi</h1>
        <button type="button" class="k-btn k-btn--outline k-btn--sm" onclick="document.querySelectorAll('.k-notif').forEach(n => n.dataset.unseen = 'false'); this.closest('.k-sec-head').querySelector('.k-catalog__count').textContent = '0 belum dibaca';">
            Tandai semua telah dibaca
        </button>
    </div>

    <div style="display: grid; gap: 0.75rem; margin-bottom: var(--s-7);">
        @foreach ([
            ['name' => 'Nama', 'text' => 'membalas pertanyaanmu pada listing', 'link' => 'properti', 'time' => '1 jam yang lalu', 'unseen' => true],
            ['name' => 'Nama', 'text' => 'menambahkan listing baru', 'link' => '', 'time' => '2 jam yang lalu', 'unseen' => true],
            ['name' => 'Nama', 'text' => 'mengirim pesan kepadamu', 'link' => '', 'time' => '5 jam yang lalu', 'unseen' => true],
            ['name' => 'Nama', 'text' => 'memperbarui harga listing', 'link' => 'properti', 'time' => '1 hari yang lalu', 'unseen' => true],
            ['name' => 'Nama', 'text' => 'menyukai listingmu', 'link' => '', 'time' => '2 hari yang lalu', 'unseen' => false],
        ] as $notif)
            <div class="k-panel k-notif" data-unseen="{{ $notif['unseen'] ? 'true' : 'false' }}"
                 style="display: flex; align-items: center; gap: 1rem; padding: 1rem 1.25rem; {{ $notif['unseen'] ? 'border-left: 3px solid var(--green);' : '' }}">
                <div style="flex: 1; min-width: 0;">
                    <p style="margin: 0; font-size: 0.92rem;">
                        <b>{{ $notif['name'] }}</b> {{ $notif['text'] }}
                        @if ($notif['link'])
                            <a href="{{ route('unit.search.user') }}" style="color: var(--green-ink); font-weight: 600;">{{ $notif['link'] }}</a>
                        @endif
                    </p>
                    <p style="margin: 0.15rem 0 0; font-size: 0.8rem; color: var(--muted);">{{ $notif['time'] }}</p>
                </div>
                <span class="k-badge {{ $notif['unseen'] ? 'k-badge--soft' : 'k-badge--neutral' }}">
                    {{ $notif['unseen'] ? 'Baru' : 'Dibaca' }}
                </span>
            </div>
        @endforeach
    </div>
</div>
@endsection
