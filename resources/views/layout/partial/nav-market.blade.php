<header class="k-header">
    <div class="k-container k-header__bar">

        <a class="k-header__logo" href="{{ route('beranda') }}">
            <span class="k-header__logo-mark">E</span>
            Eigentum
        </a>

        <nav class="k-header__nav" aria-label="Navigasi utama">
            <a class="k-header__link @if(request()->routeIs('beranda')) is-active @endif" href="{{ route('beranda') }}">Beranda</a>
            <a class="k-header__link @if(request()->routeIs('unit.search.user')) is-active @endif" href="{{ route('unit.search.user') }}">Properti</a>
            <a class="k-header__link @if(request()->routeIs('agent.search.user')) is-active @endif" href="{{ route('agent.search.user') }}">Cari Agen</a>
            <a class="k-header__link" href="/pages/guide">Panduan</a>
            <a class="k-header__link" href="/pages/kpr">KPR</a>
        </nav>

        <form class="k-header__search" action="{{ route('unit.search.user') }}" method="GET" role="search">
            <input type="text" name="search" placeholder="Cari properti, lokasi…" aria-label="Cari properti">
            <button type="submit" aria-label="Cari">
                <svg class="k-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            </button>
        </form>

        <div class="k-header__actions">
            @auth
                @if (Auth::user()->role === 'user')
                    <a class="k-btn k-btn--ghost k-btn--sm" href="{{ route('favorite.index') }}">Favorit</a>
                @endif
                @if (in_array(Auth::user()->role, ['developer', 'agent', 'admin']))
                    <a class="k-btn k-btn--outline k-btn--sm" href="/{{ Auth::user()->role }}/dashboard">Dashboard</a>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="k-btn k-btn--outline k-btn--sm">Keluar</button>
                </form>
                <a class="k-btn k-btn--solid k-btn--sm" href="/pages/profile">Profil</a>
            @else
                <a class="k-btn k-btn--ghost k-btn--sm" href="{{ route('signin.user') }}">Masuk</a>
                <a class="k-btn k-btn--solid k-btn--sm" href="{{ route('signup.user') }}">Daftar</a>
            @endauth

            <label class="k-header__burger" for="k-mobile-nav" aria-label="Buka menu">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
            </label>
        </div>
    </div>

    <input type="checkbox" id="k-mobile-nav" class="k-toggle-nav" hidden>
    <div class="k-mobile-panel">
        <a href="{{ route('beranda') }}">Beranda</a>
        <a href="{{ route('unit.search.user') }}">Properti</a>
        <a href="{{ route('agent.search.user') }}">Cari Agen</a>
        <a href="/pages/guide">Panduan</a>
        <a href="/pages/kpr">KPR</a>
        @auth
            <a href="{{ route('favorite.index') }}">Favorit</a>
            <a href="/pages/profile">Profil</a>
        @else
            <a href="{{ route('signin.user') }}">Masuk</a>
            <a href="{{ route('signup.user') }}">Daftar</a>
        @endauth
    </div>
</header>
