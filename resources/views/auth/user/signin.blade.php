@extends('layout.market')

@section('title', 'Masuk')

@section('content')
<div class="k-container" style="display: grid; place-items: center; min-height: calc(100vh - 64px - 300px); padding-block: var(--s-7);">
    <div style="width: min(420px, 100%);">
        <div class="k-panel" style="padding: var(--s-6) var(--s-5);">
            <a class="k-header__logo" href="{{ route('beranda') }}" style="margin-bottom: 1.5rem;">
                <span class="k-header__logo-mark">E</span>
                Eigentum
            </a>
            <h1 style="font-size: 1.7rem; margin-bottom: 0.25rem;">Masuk</h1>
            <p style="color: var(--muted); margin: 0 0 1.5rem; font-size: 0.92rem;">
                Belum punya akun? <a href="/session/auth/user/signup/" style="color: var(--green-ink); font-weight: 600;">Daftar</a>
            </p>

            @if ($errors->any())
                <div class="k-alert k-alert--error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/session/auth/user/signin/create" method="POST">
                @csrf
                <div class="k-field">
                    <label class="k-label" for="email">Email</label>
                    <input class="k-input" type="email" id="email" name="email" required
                           value="{{ old('email', Session::get('email')) }}" placeholder="nama@email.com">
                </div>
                <div class="k-field">
                    <label class="k-label" for="password">Kata sandi</label>
                    <input class="k-input" type="password" id="password" name="password" required
                           placeholder="Minimal 6 karakter">
                </div>
                <button type="submit" class="k-btn k-btn--solid k-btn--full k-btn--lg">Masuk</button>
            </form>

            <div style="display: flex; align-items: center; gap: 1rem; margin: 1.25rem 0;">
                <span style="flex: 1; height: 1px; background: var(--line);"></span>
                <span style="font-size: 0.78rem; color: var(--muted);">atau</span>
                <span style="flex: 1; height: 1px; background: var(--line);"></span>
            </div>

            <a class="k-btn k-btn--outline k-btn--full" href="/auth/google/redirect">
                <svg class="k-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <path fill="#4285F4" d="M23.5 12.3c0-.9-.1-1.5-.2-2.2H12v4.2h6.6c-.1 1.1-.8 2.8-2.4 3.9l3.8 2.9c2.2-2.1 3.5-5.1 3.5-8.8Z"/>
                    <path fill="#34A853" d="M12 24c3.2 0 6-1.1 7.9-2.9l-3.8-2.9c-1 .7-2.4 1.2-4.1 1.2-3.1 0-5.8-2.1-6.8-5l-3.9 3C3.2 21.3 7.3 24 12 24Z"/>
                    <path fill="#FBBC05" d="M5.2 14.4c-.2-.7-.4-1.5-.4-2.4 0-.8.1-1.6.4-2.4l-4-3.1C.5 8.2 0 10 0 12s.5 3.8 1.3 5.4l3.9-3Z"/>
                    <path fill="#EA4335" d="M12 4.7c2.2 0 3.7.9 4.5 1.7l3.3-3.2C17.9 1.2 15.2 0 12 0 7.3 0 3.2 2.7 1.3 6.6l4 3.1c1-2.9 3.6-5 6.7-5Z"/>
                </svg>
                Lanjutkan dengan Google
            </a>

            <p style="font-size: 0.78rem; color: var(--muted); margin: 1.25rem 0 0; line-height: 1.5;">
                Dengan masuk, kamu menyetujui Ketentuan Layanan dan Kebijakan Privasi Eigentum.
            </p>
        </div>
    </div>
</div>
@endsection
