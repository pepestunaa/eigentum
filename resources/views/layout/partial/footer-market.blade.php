<footer class="k-footer">
    <div class="k-container">
        <div class="k-footer__grid">
            <div>
                <div class="k-footer__brand">
                    <span class="k-footer__brand-mark">E</span>
                    Eigentum
                </div>
                <p>Marketplace properti yang menghubungkan pembeli, penyewa, dan agen dengan developer terverifikasi di seluruh Indonesia.</p>
            </div>
            <div>
                <h4>Jelajahi</h4>
                <ul>
                    <li><a href="{{ route('unit.search.user') }}">Semua Properti</a></li>
                    <li><a href="/pages/rent">Disewakan</a></li>
                    <li><a href="/pages/sell">Jual Properti</a></li>
                    <li><a href="/pages/newProperty">Properti Baru</a></li>
                </ul>
            </div>
            <div>
                <h4>Layanan</h4>
                <ul>
                    <li><a href="{{ route('agent.search.user') }}">Cari Agen</a></li>
                    <li><a href="/pages/kpr">Simulasi KPR</a></li>
                    <li><a href="/pages/langganan">Langganan</a></li>
                    <li><a href="/pages/guide">Panduan</a></li>
                </ul>
            </div>
            <div>
                <h4>Akun</h4>
                <ul>
                    <li><a href="{{ route('signin.user') }}">Masuk</a></li>
                    <li><a href="{{ route('signup.user') }}">Daftar</a></li>
                    @auth
                        <li><a href="/pages/profile">Profil Saya</a></li>
                        <li><a href="{{ route('favorite.index') }}">Favorit</a></li>
                    @endauth
                </ul>
            </div>
        </div>
        <div class="k-footer__base">
            <span>© {{ date('Y') }} Eigentum. Semua hak dilindungi.</span>
            <span class="k-mono">ID · IDR</span>
        </div>
    </div>
</footer>
