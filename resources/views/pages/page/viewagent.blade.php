@extends('layout.market')

@section('title', 'Cari Agen')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Cari Agen</span>
    </nav>

    <div class="k-sec-head">
        <h1 style="font-size: clamp(1.5rem, 3.5vw, 2.2rem);">Agen properti terverifikasi</h1>
        <span class="k-catalog__count">{{ $agents->count() }} agen aktif</span>
    </div>

    @if ($agents->count())
        <div class="k-grid" style="padding-bottom: var(--s-7);">
            @foreach ($agents as $agent)
                @php
                    $agentUser = $agent->users->first();
                    $agentAreas = $agent->regencies()->pluck('name')->toArray();
                    $agentCount = $agent->properties->flatMap->units->count();
                @endphp
                <article class="k-card">
                    <a href="{{ route('agent.show.user', $agent->id) }}" class="k-card__media" aria-label="{{ $agentUser?->name }}">
                        <img src="{{ $agent->face ? asset('storage/' . $agent->face) : asset('assets/pages/Home/agent1.jpg') }}"
                             alt="{{ $agentUser?->name ?? 'Agen' }}" loading="lazy" style="object-position: top;">
                    </a>
                    <div class="k-card__body">
                        <span class="k-lot" style="align-self: flex-start; background: var(--sand); color: var(--muted);">
                            {{ $agentCount }} listing
                        </span>
                        <a href="{{ route('agent.show.user', $agent->id) }}" class="k-card__title">
                            {{ $agentUser?->name ?? 'Agen Eigentum' }}
                        </a>
                        <span class="k-card__loc">
                            <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 21s-7-5.5-7-11a7 7 0 1 1 14 0c0 5.5-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/>
                            </svg>
                            {{ implode(', ', $agentAreas) ?: Str::limit($agent->address, 40) }}
                        </span>
                    </div>
                </article>
            @endforeach
        </div>
    @else
        <div class="k-empty">
            <h3>Belum ada agen</h3>
            <p>Agen terverifikasi akan tampil di sini setelah disetujui admin.</p>
        </div>
    @endif
</div>
@endsection
