# AGENTS.md — Astryx Design System

Dokumen ini memberi konteks kepada AI coding agent (Claude Code, Cursor, Copilot, Codex, dll.) tentang cara bekerja dengan benar di proyek ini, yang menggunakan **Astryx** — design system open source dari Meta, dibangun di atas React dan StyleX, dan dirancang agent-ready.

Referensi resmi: https://astryx.atmeta.com/

---

## 1. Prinsip Utama & Aturan UI (Dilarang Melanggar)

- **Astryx adalah satu-satunya sumber kebenaran** untuk komponen UI, token desain, tipografi, warna, spacing, dan tema.
- **Dilarang Menggunakan Tag HTML Mentah untuk Layout:** Jangan membuat komponen UI dari nol menggunakan `<div>`, `<span>`, atau CSS kustom (termasuk class utilitas Tailwind/Bootstrap) jika komponen setara sudah tersedia di Astryx. Biarkan komponen Astryx yang menangani layout dan spacing.
- **Dilarang Menebak:** Jangan menebak nama prop, path import, atau perilaku komponen. Selalu verifikasi lewat CLI (`npx astryx …`) sebelum menulis kode.
- **Dilarang Memakai "Magic Values":** Jangan menggunakan `style={{ ... }}` inline atau nilai statis yang di-hardcode. Semua styling mengikuti sistem token Astryx (`var(--spacing-*)`, `var(--color-*)`), bukan nilai mentah.

---

## 2. Setup Awal

```bash
npm install -D @astryxdesign/cli
npx astryx init --features agents
```

Perintah `init --features agents` akan menyiapkan theming dan agent docs. Jalankan ulang perintah ini setiap kali versi `@astryxdesign/core` naik.

### Alias npm (disarankan)
Di `package.json`:
```json
"scripts": {
  "astryx": "node node_modules/@astryxdesign/cli/bin/astryx.mjs"
}
```

---

## 3. Alur Kerja Pembuatan UI

Sebelum menulis halaman atau komponen baru, ikuti urutan ini:

1. **Cari pola halaman yang relevan** sebagai referensi:
   ```bash
   npx astryx template --list
   ```
2. **Pelajari struktur layout** template tersebut (skeleton):
   ```bash
   npx astryx template <nama-template> --skeleton
   ```
3. **Pahami Props komponen** yang akan dipakai:
   ```bash
   npx astryx component <NamaKomponen>
   ```

*Tip Pencarian Khusus:* Jika kebingungan mencari nama komponen, jalankan `npx astryx search "<kata-kunci>"`.

---

## 4. Aturan Desain & Pemilihan Komponen (UI Guidelines)

- **Kerangka Utama (Frame First):** Selalu tentukan kerangka luar halaman terlebih dahulu menggunakan `AppShell` (untuk halaman penuh) atau `Layout` + `LayoutPanel`. Jangan gunakan div polos.
- **Data Padat (Dense Data):** Tampilkan data padat dalam baris (*edge-to-edge*) menggunakan `Table` atau `List` + `Item`.
- **Penggunaan Card:** Komponen `Card` **hanya** untuk *dashboard widgets*, *galleries*, atau *settings groups*. **Dilarang** membungkus item *list* individu di dalam `Card`.
- **Status & Badge:** Gunakan `StatusDot` atau `Token` untuk status data. `Badge` **hanya** untuk indikator angka (notifikasi) dan status terhitung, bukan untuk dekorasi visual.

---

## 5. Referensi Cepat Perintah CLI

| Perintah      | Fungsi |
| ------------- | ------ |
| `init`        | Inisialisasi design system di proyek |
| `component`   | List komponen atau cetak dokumentasi detail |
| `search`      | Cari komponen, hook, docs, dan template |
| `docs`        | Cetak dokumentasi referensi (tokens, theme, dll.) |
| `template`    | Sisipkan template halaman/blok ke proyek |
| `swizzle`     | Salin source komponen ke proyek untuk kustomisasi |
| `doctor`      | Diagnosis setup Astryx dan laporkan masalah |

Gunakan flag global seperti `--json` atau `--dense` saat menempelkan output ke AI berbasis web untuk format ringkas hemat token.

---

## 6. Diagnostik Setup & MCP Server

**Diagnostik:**
Jalankan sebelum mulai bekerja (read-only):
```bash
npx astryx doctor
```

**MCP Server:**
Astryx menyediakan MCP server agar AI tool bisa mencari docs langsung:
```json
{
  "mcpServers": {
    "xds": {
      "type": "url",
      "url": "https://astryx.atmeta.com/mcp"
    }
  }
}
```

---

## 7. Pemeriksaan Mandiri (Self-Check) Akhir & Aturan Kode

**Lakukan (Pemeriksaan Akhir):**
- [ ] Import komponen dari `@astryxdesign/core` sesuai path dari CLI.
- [ ] CSS global Astryx (`reset.css` & `astryx.css`) ter-import di *entry-point*.
- [ ] Styling menggunakan token resmi Astryx (warna, margin, padding).
- [ ] Gunakan template resmi Astryx sebagai titik awal halaman.
- [ ] Jalankan `npx astryx doctor` setelah ada perubahan besar.

**Jangan:**
- Jangan menulis `<div>` / `<span>` polos untuk membungkus layout interaktif.
- Jangan gunakan kode Hex (`#000000`) atau ukuran mentah (`16px`).
- Jangan mencampur utilitas eksternal (Tailwind/xstyle) dengan Astryx.
- Jangan menebak nama prop tanpa memverifikasi.

---

## 8. Tautan Berguna

- Getting Started: https://astryx.atmeta.com/docs/getting-started
- Prinsip Desain: https://astryx.atmeta.com/docs/principles
- Semua Token: https://astryx.atmeta.com/docs/tokens
- Styling Components: https://astryx.atmeta.com/docs/styling
- Theme System: https://astryx.atmeta.com/docs/theme
- Working with AI: https://astryx.atmeta.com/docs/working-with-ai
- Repo GitHub: https://github.com/facebook/astryx

---

*File ini adalah AGENTS.md kustom yang dibuat manual mengikuti dokumentasi resmi Astryx per Juli 2026 dan telah dipadukan dengan pedoman antarmuka pengguna proyek.*

<!-- ASTRYX:START -->
Astryx v0.1.7 · 90+ components
CLI: run every command as `npx astryx <cmd>` (shown below as `astryx ...`).

SETUP (once, in your app entry e.g. main.tsx) — without these, components render unstyled:
  import "@astryxdesign/core/reset.css";
  import "@astryxdesign/core/astryx.css";

WORKFLOW — discover, don't guess. Before writing UI:
1. `astryx build "<idea>"` — START HERE: returns a kit (closest [page] + [block]s + [component]s). No args = full playbook.
2. `astryx template <name> [--skeleton]` — scaffold the [page]/[block]s it named, or study their layout. Templates are reference code.
3. `astryx component <Name>` — props + examples for every component you use.

RULES:
- No <div> — components do all layout/spacing. Full page → AppShell; sidebar nav → SideNav.
- Frame first: pick the shell (AppShell / Layout+LayoutPanel) and budget regions in px BEFORE writing content (`astryx docs layout`).
- Dense data = rows (Table, List/Item) edge-to-edge — never Card-wrapped list items. Card = dashboard widgets, galleries, settings groups only.
- Status → StatusDot/Token; Badge only for counts and enumerated states, never decoration.
- Custom styling: component props first; else style/className with tokens — var(--color-*|--spacing-*|--radius-*). No raw hex/px. (No StyleX/Tailwind compiler here — don't use xstyle/utility classes.)
- Tokens for every value (`astryx docs tokens`). Brand/accent via `astryx theme` — never override --color-* in :root.
- SELF-CHECK before you finish: re-read the file and replace any raw <div>/<span> layout, imported .css/@apply, or hardcoded value (#hex, 16px) with the component or a token (var(--color-*|--spacing-*|…)). If unsure a component/prop exists, run `astryx component <Name>` / `astryx search "<thing>"`; don't hand-roll CSS.

MORE CLI:
  search "<query>"   find any component / hook / doc / template / block
  component --list   90+ components by category
  template --list    page + block recipes
  docs <topic>       color, elevation, icons, illustrations, internationalization, layout, migration, motion, principles, shape, spacing, styling, theme, tokens, typography
  swizzle <Name>     eject component source for deep customization
  upgrade --apply    run after any @astryxdesign/core bump
<!-- ASTRYX:END -->
