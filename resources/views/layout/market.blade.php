<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Eigentum') · Eigentum</title>
    <meta name="description" content="@yield('meta_description', 'Marketplace properti Eigentum — cari rumah, apartemen, dan tanah dari developer terverifikasi.')">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400..800&family=IBM+Plex+Mono:wght@400;500;600&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/market/market.css') }}">
    <link rel="icon" href="{{ asset('assets/skins/logo.svg') }}">
</head>
<body>

    @include('layout.partial.nav-market')

    <main id="k-main">
        @yield('content')
    </main>

    @include('layout.partial.footer-market')

    <script>
        // Favorite toggle: posts to the existing endpoints and flips the heart in place.
        document.addEventListener('click', async (e) => {
            const fav = e.target.closest('[data-fav]');
            if (!fav) return;
            e.preventDefault();
            const unitId = fav.dataset.fav;
            const active = fav.classList.contains('is-active');
            const url = active ? '/favorite-remove/' + unitId : '/favorite-add/' + unitId;
            try {
                const res = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: new FormData()
                });
                if (res.ok) {
                    fav.classList.toggle('is-active', !active);
                    fav.setAttribute('aria-pressed', String(!active));
                }
            } catch (err) {
                window.location.href = '/login';
            }
        });
    </script>

</body>
</html>
