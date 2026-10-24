@extends('layout.market')

@section('title', 'Profil Agen')

@php
    $agentUser = $agent->users->first();
    $agentAreas = $agent->regencies()->pluck('name')->toArray();
    $dijual = $agent->properties->flatMap->units->flatMap->statuses->where('name', 'Dijual')->count();
    $disewa = $agent->properties->flatMap->units->flatMap->statuses->where('name', 'Disewa')->count();
    $waNumber = $agent->telp ? preg_replace('/\D/', '', $agent->telp) : null;
    if ($waNumber && !str_starts_with($waNumber, '62')) {
        $waNumber = '62' . ltrim($waNumber, '0');
    }
@endphp

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <a href="{{ route('agent.search.user') }}">Agen</a>
        <span>/</span>
        <span class="is-current">{{ $agentUser?->name ?? 'Agen' }}</span>
    </nav>

    <div class="k-detail">

        <div>
            <div class="k-panel" style="display: flex; align-items: center; gap: 1.25rem; margin-bottom: 1.5rem; flex-wrap: wrap;">
                <img class="k-avatar" style="width: 84px; height: 84px;"
                     src="{{ $agent->face ? asset('storage/' . $agent->face) : asset('assets/pages/Home/agent1.jpg') }}"
                     alt="{{ $agentUser?->name ?? 'Agen' }}">
                <div style="flex: 1; min-width: 220px;">
                    <h1 style="font-size: 1.5rem; margin-bottom: 0.15rem;">{{ $agentUser?->name ?? 'Agen Eigentum' }}</h1>
                    <p style="color: var(--muted); margin: 0; font-size: 0.92rem;">
                        {{ implode(', ', $agentAreas) ?: ($agent->address ?? 'Indonesia') }}
                    </p>
                </div>
                @if ($waNumber)
                    <a class="k-btn k-btn--solid"
                       href="https://wa.me/{{ $waNumber }}?text={{ urlencode('Halo, saya menemukan profil Anda di Eigentum.') }}"
                       target="_blank" rel="noopener">
                        Hubungi
                    </a>
                @endif
            </div>

            <div class="k-specs" style="grid-template-columns: repeat(3, minmax(0, 1fr)); margin-bottom: 1.5rem;">
                <div class="k-specs__item">
                    <b>{{ $dijual }}</b>
                    <span>Unit dijual</span>
                </div>
                <div class="k-specs__item">
                    <b>{{ $disewa }}</b>
                    <span>Unit disewa</span>
                </div>
                <div class="k-specs__item">
                    <b>{{ $agent->properties->count() }}</b>
                    <span>Proyek dikelola</span>
                </div>
            </div>

            <section style="padding-block: 0.5rem 1.5rem;">
                <h2 style="font-size: 1.25rem; margin-bottom: 0.75rem;">Kontak</h2>
                <table class="k-table">
                    <tbody>
                        @if ($agentUser?->email)
                            <tr>
                                <th style="width: 40%;">Email</th>
                                <td>{{ $agentUser->email }}</td>
                            </tr>
                        @endif
                        @if ($agent->telp)
                            <tr>
                                <th>Telepon</th>
                                <td class="k-mono">{{ $agent->telp }}</td>
                            </tr>
                        @endif
                        @if ($agent->address)
                            <tr>
                                <th>Alamat</th>
                                <td>{{ $agent->address }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </section>
        </div>

        <aside class="k-detail__aside">
            <div class="k-panel">
                <h2 style="font-size: 1.05rem; margin-bottom: 0.5rem;">Proyek dikelola</h2>
                @forelse ($agent->properties as $property)
                    <a href="{{ route('property.show.user', $property->id) }}"
                       style="display: flex; gap: 0.75rem; align-items: center; padding: 0.6rem 0; border-bottom: 1px solid var(--line);">
                        <img src="{{ $property->image ? asset('storage/' . $property->image) : asset('assets/pages/Home/unit1.jpg') }}"
                             alt="" style="width: 56px; height: 44px; object-fit: cover; border-radius: 8px;">
                        <div style="min-width: 0;">
                            <div style="font-weight: 600; font-size: 0.9rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $property->title }}
                            </div>
                            <div style="font-size: 0.8rem; color: var(--muted);">
                                {{ implode(', ', $property->regencies()->pluck('name')->toArray()) ?: 'Indonesia' }}
                            </div>
                        </div>
                    </a>
                @empty
                    <p style="color: var(--muted); font-size: 0.9rem; margin: 0;">Belum ada proyek.</p>
                @endforelse
            </div>
        </aside>
    </div>
</div>
@endsection
