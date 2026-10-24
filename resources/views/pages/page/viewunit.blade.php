@extends('layout.market')

@section('title', 'Cari Properti')

@section('content')
<div class="k-container">

    <nav class="k-breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('beranda') }}">Beranda</a>
        <span>/</span>
        <span class="is-current">Properti</span>
    </nav>

    <div class="k-catalog">

        <label class="k-btn k-btn--outline k-toggle-filter" for="k-filter-open">
            <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M4 6h16M7 12h10m-7 6h4"/>
            </svg>
            Filter
        </label>
        <input type="checkbox" id="k-filter-open" class="k-toggle-filter" hidden>

        <form class="k-filter" action="{{ route('unit.search.user') }}" method="GET" role="search">
            <div class="k-field">
                <label class="k-label" for="f-search">Kata kunci</label>
                <input class="k-input" type="text" id="f-search" name="search"
                       placeholder="Nama, lokasi…" value="{{ request('search') }}">
            </div>

            <fieldset>
                <legend>Lokasi</legend>
                <select class="k-select" name="regency_id" aria-label="Pilih kota">
                    <option value="">Semua kota</option>
                    @foreach ($regencies as $regencyId => $regencyName)
                        <option value="{{ $regencyId }}" {{ request('regency_id') == $regencyId ? 'selected' : '' }}>
                            {{ $regencyName }}
                        </option>
                    @endforeach
                </select>
            </fieldset>

            <fieldset>
                <legend>Status</legend>
                @foreach ($statuses as $status)
                    <label class="k-check">
                        <input type="checkbox" name="status[]" value="{{ $status->id }}"
                               {{ in_array($status->id, request('status', [])) ? 'checked' : '' }}>
                        {{ $status->name }}
                    </label>
                @endforeach
            </fieldset>

            <fieldset>
                <legend>Tipe</legend>
                @foreach ($types as $type)
                    <label class="k-check">
                        <input type="checkbox" name="types[]" value="{{ $type->id }}"
                               {{ in_array($type->id, request('types', [])) ? 'checked' : '' }}>
                        {{ $type->name }}
                    </label>
                @endforeach
            </fieldset>

            <fieldset>
                <legend>Harga</legend>
                <div class="k-filter__range">
                    <input class="k-input" type="number" name="min_price" placeholder="Min"
                           min="0" step="1000000" value="{{ request('min_price') }}" aria-label="Harga minimum">
                    <span>—</span>
                    <input class="k-input" type="number" name="max_price" placeholder="Maks"
                           min="0" step="1000000" value="{{ request('max_price') }}" aria-label="Harga maksimum">
                </div>
            </fieldset>

            <button type="submit" class="k-btn k-btn--solid k-btn--full">Terapkan filter</button>
        </form>

        <div>
            <div class="k-catalog__head">
                <h1 style="font-size: clamp(1.4rem, 3vw, 2rem);">Properti</h1>
                <span class="k-catalog__count">{{ $filteredUnits->total() }} hasil</span>
            </div>

            @if ($filteredUnits->count())
                <div class="k-grid">
                    @foreach ($filteredUnits as $unit)
                        @include('layout.partial.card-unit', ['unit' => $unit])
                    @endforeach
                </div>
            @else
                <div class="k-empty">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>
                    </svg>
                    <h3>Tidak ada hasil</h3>
                    <p>Coba longgarkan filter — kurangi rentang harga atau hapus beberapa kriteria.</p>
                </div>
            @endif

            @if ($filteredUnits->lastPage() > 1)
                <nav class="k-pager" aria-label="Halaman">
                    @if (! $filteredUnits->onFirstPage())
                        <a href="{{ $filteredUnits->previousPageUrl() }}" rel="prev">‹</a>
                    @endif

                    @php
                        $numPagesToShow = 5;
                        $half = floor($numPagesToShow / 2);
                        $start = max($filteredUnits->currentPage() - $half, 1);
                        $end = min($start + $numPagesToShow - 1, $filteredUnits->lastPage());
                    @endphp

                    @for ($page = $start; $page <= $end; $page++)
                        @if ($page == $filteredUnits->currentPage())
                            <span class="is-current" aria-current="page">{{ $page }}</span>
                        @else
                            <a href="{{ $filteredUnits->url($page) }}">{{ $page }}</a>
                        @endif
                    @endfor

                    @if ($filteredUnits->hasMorePages())
                        <a href="{{ $filteredUnits->nextPageUrl() }}" rel="next">›</a>
                    @endif
                </nav>
            @endif
        </div>
    </div>
</div>

<script>
    // Auto-submit the filter form when a checkbox or select changes.
    const filterForm = document.querySelector('.k-filter');
    filterForm?.querySelectorAll('input[type="checkbox"], select').forEach((el) => {
        el.addEventListener('change', () => filterForm.submit());
    });
</script>
@endsection
