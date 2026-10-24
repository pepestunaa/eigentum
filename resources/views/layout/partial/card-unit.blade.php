@php
    $unitStatus = $unit->statuses->first();
    $statusClass = match(true) {
        $unitStatus && str_contains(strtolower($unitStatus->name ?? ''), 'terjual') => 'k-badge--red',
        $unitStatus && str_contains(strtolower($unitStatus->name ?? ''), 'sewa') => 'k-badge--amber',
        default => 'k-badge--soft',
    };
    $spec = $unit->specifications;
    $unitPrice = (int) $unit->price;
    $isFav = isset($isFav) && $isFav;
@endphp
<article class="k-card">
    <a href="{{ route('unit.show.user', $unit->id) }}" class="k-card__media" aria-label="{{ $unit->title }}">
        <img src="{{ $unit->image ? asset('storage/' . $unit->image) : asset('assets/pages/Home/unit1.jpg') }}"
             alt="{{ $unit->title }}" loading="lazy">
        <div class="k-card__media-tags">
            <span class="k-lot">KVL-{{ str_pad($unit->id, 4, '0', STR_PAD_LEFT) }}</span>
            <span style="display:flex;gap:.4rem;align-items:center">
                @if ($unitStatus)
                    <span class="k-badge {{ $statusClass }}">{{ $unitStatus->name }}</span>
                @endif
                @auth
                    <button type="button" class="k-card__fav {{ $isFav ? 'is-active' : '' }}"
                            data-fav="{{ $unit->id }}" aria-pressed="{{ $isFav ? 'true' : 'false' }}"
                            aria-label="Tambahkan ke favorit">
                        <svg class="k-icon" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                            <path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A5.99 5.99 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/>
                        </svg>
                    </button>
                @endauth
            </span>
        </div>
    </a>
    <div class="k-card__body">
        <span class="k-card__price">Rp {{ number_format($unitPrice, 0, ',', '.') }}</span>
        <a href="{{ route('unit.show.user', $unit->id) }}" class="k-card__title">{{ $unit->title }}</a>
        <span class="k-card__loc">
            <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 21s-7-5.5-7-11a7 7 0 1 1 14 0c0 5.5-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/>
            </svg>
            {{ $unit->properties->regencies?->name ?? $unit->properties->address ?? $unit->properties->title ?? 'Indonesia' }}
        </span>
        <div class="k-card__specs">
            @if ($spec?->bedroom)<span>{{ $spec->bedroom }} Kamar</span>@endif
            @if ($spec?->bathroom)<span>{{ $spec->bathroom }} Mandi</span>@endif
            @if ($spec?->building_area)<span>{{ $spec->building_area }} m²</span>@endif
        </div>
    </div>
</article>
