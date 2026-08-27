# DESIGN.md — UI & Aesthetics Guidelines

Dokumen ini berisi panduan untuk AI coding agent tentang cara membangun UI di proyek ini.

---

## 1. Prinsip Utama: Fokus pada Estetika & Animasi (WOW Factor)
- **Desain Premium:** Tampilan UI harus terasa premium, modern, dan sangat responsif.
- **Warna & Tema:** Gunakan palet warna yang harmonis (misalnya warna HSL yang disesuaikan, mode gelap/terang, *glassmorphism*). Hindari warna *default* yang membosankan.
- **Tipografi:** Gunakan font modern (misalnya Inter, Roboto, Outfit) dengan hierarki yang jelas.
- **Animasi & Interaksi:** *Micro-animations* (animasi saat hover/klik), *smooth gradients*, dan transisi halus sangat diwajibkan untuk meningkatkan pengalaman pengguna. 

## 2. Fleksibilitas Komponen & Styling
Aturan Astryx yang ketat sebelumnya telah **dicabut**.
- **Diizinkan Menggunakan HTML Mentah:** Penggunaan `<div>`, `<span>`, dan elemen HTML semantik lainnya sepenuhnya diizinkan untuk membangun layout yang kustom dan fleksibel.
- **Styling:** Gunakan Vanilla CSS (atau sistem styling yang telah disepakati) untuk fleksibilitas maksimal. Tailwind CSS hanya digunakan jika disetujui pengguna.
- **Custom Animations:** Sangat didorong untuk membuat animasi kustom, baik menggunakan CSS Animations, transisi, maupun library animasi spesifik jika diperlukan.

## 3. Alur Kerja Pembuatan UI
1. **Perencanaan Visual:** Pahami kebutuhan pengguna, lalu rancang UI dengan fokus pada keindahan visual dan kemudahan penggunaan.
2. **Gunakan Skill AI:** Jika perlu, manfaatkan *agent skills* (misalnya `ui-animation`) untuk mendapatkan referensi pola interaksi dan animasi terbaik.
3. **Implementasi Komponen:** Buat komponen yang rapi, *reusable*, dan jangan lupa menyematkan efek hover atau animasi transisi.
4. **Optimalisasi:** Pastikan UI tidak hanya cantik, tapi juga ringan dan cepat saat dirender.

---
*Aturan di file ini menggantikan aturan ketat Astryx sebelumnya, dengan tujuan utama memberikan kebebasan untuk menciptakan antarmuka (UI) yang jauh lebih memukau dan interaktif.*
