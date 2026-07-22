# AGENTS.md — Astryx Design System

Dokumen ini memberi konteks kepada AI coding agent (Claude Code, Cursor, Copilot, Codex, dll.) tentang cara bekerja dengan benar di proyek ini, yang menggunakan **Astryx** — design system open source dari Meta, dibangun di atas React dan StyleX, dan dirancang agent-ready.

Referensi resmi: https://astryx.atmeta.com/

---

## 1. Prinsip Utama

- Astryx adalah **satu-satunya** sumber kebenaran untuk komponen UI, token desain, tipografi, warna, spacing, dan tema di proyek ini.
- **Jangan** membuat komponen UI dari nol menggunakan `<div>` mentah atau CSS custom jika komponen setara sudah tersedia di Astryx.
- **Jangan** menebak nama prop, path import, atau perilaku komponen. Selalu verifikasi lewat CLI (`npx astryx …`) atau MCP server sebelum menulis kode.
- **Jangan** menggunakan `style={{ ... }}` inline atau nilai "ajaib" (magic values) untuk warna/spacing/ukuran. Gunakan design token yang disediakan Astryx.
- Semua styling mengikuti sistem token Astryx (lihat `npx astryx docs tokens`), bukan nilai hardcoded.

Jika tidak yakin terhadap ketiga hal ini sebelum menulis kode:
1. Path import yang benar untuk sebuah komponen,
2. Cara mengatur perilaku non-trivial suatu komponen (misalnya membuat dialog non-dismissible),
3. Prop apa yang dipakai komponen tertentu untuk data/items —

maka **jalankan dulu perintah CLI di bawah**, jangan menebak.

---

## 2. Setup Awal

```bash
npm install -D @astryxdesign/cli
npx astryx init --features agents
```

Perintah `init --features agents` akan:
- Memasang paket yang diperlukan dan menyiapkan theming.
- Menghasilkan/menyegarkan file konteks AI (file ini) berdasarkan versi Astryx yang terpasang.

Jalankan ulang perintah ini setiap kali versi `@astryxdesign/core` naik, agar dokumentasi konteks tetap sinkron.

Jika ingin menargetkan format tertentu:

```bash
npx astryx init --features agents --agent claude    # CLAUDE.md
npx astryx init --features agents --agent cursor    # .cursorrules
npx astryx init --features agents --agent codex     # AGENTS.md (Copilot, Codex, dll.)
```

### Alias npm (disarankan)

Agar CLI selalu dipanggil dengan path binari yang benar (agent sering menebak path yang salah), tambahkan di `package.json`:

```json
"scripts": {
  "astryx": "node node_modules/@astryxdesign/cli/bin/astryx.mjs"
}
```

---

## 3. Alur Kerja Wajib Sebelum Menulis Kode UI

Sebelum menulis halaman atau komponen baru, ikuti 3 langkah ini secara berurutan:

1. **Cari pola halaman yang relevan sebagai referensi**
   ```bash
   npx astryx template --list
   ```
2. **Pelajari struktur layout template tersebut**
   ```bash
   npx astryx template <nama-template> --skeleton
   ```
3. **Baca props dan contoh penggunaan untuk setiap komponen yang akan dipakai**
   ```bash
   npx astryx component <NamaKomponen>
   ```

Kalau belum yakin apakah yang dibutuhkan itu komponen, hook, template, atau topik docs, gunakan pencarian lintas-domain:

```bash
npx astryx search <kata-kunci>
```

---

## 4. Referensi Cepat Perintah CLI

| Perintah      | Fungsi |
| ------------- | ------ |
| `init`        | Inisialisasi design system di proyek: install paket, setup theming, tambah agent docs |
| `component`   | List komponen atau cetak dokumentasi detail, props, contoh, source |
| `search`      | Cari komponen, hook, docs, dan template sekaligus (hasil diranking) |
| `docs`        | Cetak dokumentasi referensi (tokens, theme, color, typography, spacing, dll.) |
| `template`    | Sisipkan template halaman/blok ke proyek |
| `hook`        | List hook dan cetak dokumentasi hook |
| `swizzle`     | Salin source komponen ke proyek untuk kustomisasi mendalam |
| `upgrade`     | Jalankan codemod untuk migrasi antar versi |
| `theme build` | Compile file `defineTheme` menjadi CSS/JS produksi |
| `discover`    | Temukan paket dan komponen eksternal |
| `doctor`      | Diagnosis setup Astryx dan laporkan masalah beserta perbaikannya |

Contoh pemakaian umum:

```bash
npx astryx --help
npx astryx search button
npx astryx component Button
npx astryx docs tokens
npx astryx docs migration
npx astryx template --list
```

### Flag global yang berguna untuk agent

- `--json` — output berupa amplop JSON bertipe: `{ type, data }` (untuk error: `{ error, code, suggestions? }`). Selalu branch pada field `code`, jangan pada string `error` (bisa berubah kapan saja).
- `--dense` — format ringkas hemat token, khusus dirancang untuk konteks AI. Gunakan ini saat menempelkan output CLI ke percakapan AI berbasis web.
- `--detail <level>` — `brief` < `compact` < `full`.
- `--lang <locale>` — `en`, `zh`, `dense`.

Contoh output dense yang efisien untuk konteks AI:

```bash
npx astryx component Dialog --dense
npx astryx docs styling --dense
npx astryx docs tokens --dense
```

---

## 5. Diagnostik Setup

Jalankan sebelum mulai bekerja (aman dijalankan di mana saja, termasuk CI — read-only):

```bash
npx astryx doctor
```

Exit code `0` = tidak ada kegagalan (warning tetap boleh), `1` = ada kegagalan. Bisa dipakai langsung sebagai CI gate.

---

## 6. MCP Server (opsional, untuk tool yang mendukung MCP)

Astryx menyediakan MCP server sehingga AI tool bisa mencari dan membaca dokumentasi komponen secara langsung tanpa menempel output CLI secara manual.

Tambahkan ke file konfigurasi MCP (format sama untuk Claude Desktop, Cursor, Windsurf, Cline, dll.):

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

Server ini mengekspos dua tool:
- `search(query)` — menemukan komponen, topik docs, dan template lewat bahasa natural (mis. "dropdown menu", "pesan sukses").
- `get(name)` — mengambil dokumentasi lengkap: props, usage, dan contoh.

---

## 7. Aturan Kode (Do / Don't)

**Lakukan:**
- Import komponen dari `@astryxdesign/core` sesuai path yang dikonfirmasi lewat `npx astryx component <Nama>`.
- Gunakan design token untuk warna, spacing, typography, shape, elevation, motion (`npx astryx docs tokens`).
- Ikuti pola styling resmi Astryx (StyleX) — lihat `npx astryx docs styling`.
- Gunakan template resmi (`npx astryx template <nama>`) sebagai titik awal halaman, lalu sesuaikan kontennya.
- Cek ulang dengan `npx astryx doctor` setelah perubahan besar pada dependencies/tema.

**Jangan:**
- Jangan menulis `<div>` polos untuk elemen interaktif yang punya padanan komponen Astryx (Button, Dialog, Selector, dll).
- Jangan gunakan `style={{ ... }}` inline atau warna/ukuran hardcoded.
- Jangan menebak nama prop atau perilaku komponen — verifikasi dulu.
- Jangan mengedit source komponen `@astryxdesign/core` langsung; gunakan `swizzle` jika perlu kustomisasi mendalam.

---

## 8. Tautan Berguna

- Getting Started: https://astryx.atmeta.com/docs/getting-started
- Prinsip Desain: https://astryx.atmeta.com/docs/principles
- Semua Token: https://astryx.atmeta.com/docs/tokens
- Styling Components: https://astryx.atmeta.com/docs/styling
- Theme System: https://astryx.atmeta.com/docs/theme
- Working with AI (panduan resmi): https://astryx.atmeta.com/docs/working-with-ai
- Daftar Komponen: https://astryx.atmeta.com/components
- Template: https://astryx.atmeta.com/templates
- Repo GitHub: https://github.com/facebook/astryx

---

*File ini adalah AGENTS.md kustom yang dibuat manual mengikuti dokumentasi resmi Astryx per Juli 2026. Untuk versi yang selalu sinkron dengan versi paket yang terpasang di proyek Anda, jalankan `npx astryx init --features agents` dan biarkan CLI men-generate/memperbarui file ini secara otomatis.*

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
