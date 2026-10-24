@extends('layout.market')

@section('title', 'Simulasi KPR')

@section('content')
<div class="k-container" style="padding-block: var(--s-5) var(--s-7);">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Simulasi KPR</span>
    </nav>

    <div class="k-sec-head">
        <h1 style="font-size: clamp(1.5rem, 3.5vw, 2.2rem);">Simulasi Kalkulator KPR</h1>
        <span class="k-catalog__count">estimasi — bukan penawaran resmi</span>
    </div>

    <div class="k-detail">

        <div>
            <form class="k-panel" action="#" onsubmit="return false;" style="display: grid; gap: 1rem; margin-bottom: 1.5rem;">
                <div class="k-field" style="margin: 0;">
                    <label class="k-label" for="kpr-amount">Pinjaman (Rp)</label>
                    <input class="k-input loan-amount" id="kpr-amount" type="text" value="300.000.000">
                </div>
                <div class="k-field" style="margin: 0;">
                    <label class="k-label" for="kpr-rate">Tingkat bunga / %</label>
                    <input class="k-input interest-rate" id="kpr-rate" type="text" value="8.5">
                </div>
                <div class="k-field" style="margin: 0;">
                    <label class="k-label" for="kpr-tenure">Waktu (bulan)</label>
                    <input class="k-input loan-tenure" id="kpr-tenure" type="text" value="120">
                </div>
                <button type="button" class="k-btn k-btn--solid k-btn--lg calculate-btn">Hitung</button>
            </form>

            <div id="overlay" style="display:none"></div>
            <div id="alertBox" style="display:none"></div>
        </div>

        <aside class="k-detail__aside">
            <div class="k-panel k-panel--price">
                <div class="loan-emi" style="margin-bottom: 1rem;">
                    <h3 style="font-size: 0.8rem; font-family: var(--font-mono); text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted);">Cicilan / bulan</h3>
                    <div class="value k-mono" style="font-size: 1.6rem; font-weight: 600; color: var(--green-ink);">—</div>
                </div>
                <div class="total-interest" style="margin-bottom: 1rem;">
                    <h3 style="font-size: 0.8rem; font-family: var(--font-mono); text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted);">Bunga yang dibayar</h3>
                    <div class="value k-mono" style="font-size: 1.2rem; font-weight: 600;">—</div>
                </div>
                <div class="total-amount" style="margin-bottom: 1.5rem;">
                    <h3 style="font-size: 0.8rem; font-family: var(--font-mono); text-transform: uppercase; letter-spacing: 0.08em; color: var(--muted);">Total jumlah</h3>
                    <div class="value k-mono" style="font-size: 1.2rem; font-weight: 600;">—</div>
                </div>
                <canvas id="myChart" width="200" height="200"></canvas>
            </div>
        </aside>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.2/dist/chart.min.js"></script>
<script src="/js/pages/kpr.js"></script>
@endsection
