@extends('layout.market')

@section('title', 'Konfirmasi Pembayaran')

@php
    $paymentLabel = match ((string) $order->payment_status) {
        '1' => ['Menunggu pembayaran', 'k-badge--amber'],
        '2' => ['Sudah dibayar', 'k-badge--soft'],
        '3' => ['Kadaluarsa', 'k-badge--neutral'],
        '4' => ['Batal', 'k-badge--red'],
        default => ['Tidak diketahui', 'k-badge--neutral'],
    };
@endphp

@section('content')
<div class="k-container" style="padding-block: var(--s-6) var(--s-7);">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('langganan.index') }}">Langganan</a>
        <span>/</span>
        <span class="is-current">Konfirmasi pembayaran</span>
    </nav>

    @if ((string) $order->payment_status === '1')
        <div class="k-alert k-alert--ok">
            Terima kasih telah membeli langganan. Selesaikan pembayaran untuk mengaktifkan paketmu.
        </div>
    @else
        <div class="k-alert k-alert--ok">
            Pembayaran berhasil — paket langgananmu aktif.
        </div>
    @endif

    <div class="k-detail">

        <div>
            <h1 style="font-size: clamp(1.5rem, 3vw, 2rem); margin-bottom: 1rem;">Detail pembayaran</h1>
            <table class="k-table" style="max-width: 640px;">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Status</th>
                        <th style="text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="k-mono">{{ $order->invoice }}</td>
                        <td><span class="k-badge {{ $paymentLabel[1] }}">{{ $paymentLabel[0] }}</span></td>
                        <td style="text-align: right;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th><b>Total</b></th>
                        <td></td>
                        <td style="text-align: right;"><b>Rp {{ number_format($order->total_price, 0, ',', '.') }}</b></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <aside class="k-detail__aside">
            <div class="k-panel k-panel--price">
                <h2 style="font-size: 1.05rem; margin-bottom: 0.75rem;">Info pembayaran</h2>
                <p style="margin: 0 0 0.35rem; font-size: 0.92rem;">
                    <span style="color: var(--muted);">Nama</span><br>{{ auth()->user()->name }}
                </p>
                <p style="margin: 0 0 0.35rem; font-size: 0.92rem;">
                    <span style="color: var(--muted);">Tanggal</span><br>{{ $order->created_at->toDatestring() }}
                </p>
                <p style="margin: 0 0 1.25rem; font-size: 0.92rem;">
                    <span style="color: var(--muted);">Total</span><br>
                    <span class="k-mono">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                </p>

                @if ((string) $order->payment_status === '1')
                    <button type="button" class="k-btn k-btn--solid k-btn--full" id="pay-button">Bayar sekarang</button>
                @else
                    <form action="{{ route('sub.already', $developer->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="k-btn k-btn--solid k-btn--full">Ke dashboard</button>
                    </form>
                @endif
            </div>
        </aside>
    </div>
</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.getElementById('pay-button')?.addEventListener('click', (e) => {
        e.preventDefault();
        snap.pay('{{ $snapToken }}', {
            onSuccess: (result) => window.location.reload(),
            onPending: (result) => window.location.reload(),
            onError: (result) => window.location.reload(),
        });
    });
</script>
@endsection
