@extends('layout.market')

@section('title', 'Daftar')

@section('content')
<div class="k-container" style="display: grid; place-items: center; min-height: calc(100vh - 64px - 300px); padding-block: var(--s-7);">
    <div style="width: min(420px, 100%);">
        <div class="k-panel" style="padding: var(--s-6) var(--s-5);">
            <a class="k-header__logo" href="{{ route('beranda') }}" style="margin-bottom: 1.5rem;">
                <span class="k-header__logo-mark">E</span>
                Eigentum
            </a>
            <h1 style="font-size: 1.7rem; margin-bottom: 0.25rem;">Buat akun</h1>
            <p style="color: var(--muted); margin: 0 0 1.5rem; font-size: 0.92rem;">
                Sudah punya akun? <a href="/session/auth/user/signin/" style="color: var(--green-ink); font-weight: 600;">Masuk</a>
            </p>

            @if ($errors->any())
                <div class="k-alert k-alert--error">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="/session/auth/user/signup/create" method="POST">
                @csrf
                <input type="hidden" name="role_id" value="2">
                <div class="k-field">
                    <label class="k-label" for="name">Nama lengkap</label>
                    <input class="k-input" type="text" id="name" name="name" required
                           value="{{ old('name') }}" placeholder="Nama kamu">
                </div>
                <div class="k-field">
                    <label class="k-label" for="email">Email</label>
                    <input class="k-input" type="email" id="email" name="email" required
                           value="{{ old('email') }}" placeholder="nama@email.com">
                </div>
                <div class="k-field">
                    <label class="k-label" for="password">Kata sandi</label>
                    <input class="k-input" type="password" id="password" name="password" required
                           placeholder="Minimal 6 karakter">
                </div>
                <button type="submit" class="k-btn k-btn--solid k-btn--full k-btn--lg">Daftar</button>
            </form>

            <p style="font-size: 0.78rem; color: var(--muted); margin: 1.25rem 0 0; line-height: 1.5;">
                Dengan mendaftar, kamu menyetujui Ketentuan Layanan dan Kebijakan Privasi Eigentum.
            </p>
        </div>
    </div>
</div>
@endsection
