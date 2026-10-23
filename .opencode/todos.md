# Eigentum Fix List (audit 2026-10-24)

All four fix batches complete as of 2026-10-24 (commit `Fix audit findings...` on main; history rewritten with git-filter-repo to purge `public/ktp` + `public/license`). Items below remain open.

## Critical security
- [x] ALL 13 items fixed 2026-10-24 (see git history). One follow-up: **force-push to origin required** to propagate the history purge — `git push --force origin main` (also update any clones).

## Broken functionality
- [x] ALL 14 items fixed 2026-10-24.
- [ ] Upgrade vite-plugin-stylex — warns that @stylexjs/stylex 0.19 > expected ^0.9.3 (build works, warning only)

## Data model
- [x] Fixed 2026-10-24: pivot keys (favorites + agent↔property), `User::favorites()`, favorites unique→composite, Developer scopefilter columns, `$guaded` typo, unit region filtering via property, pivot model `$table` names, `units.price` decimal(15,2), FKs + indexes on hot paths.
- [x] `orders.payment_status` stays string ENUM — doctrine/dbal on Laravel 10 can't change tinyInteger columns; harmless (code compares loosely). Revisit during the framework upgrade.
- [ ] `specifications` numeric columns stored as strings; `owners.developer_id` string — needs a dedicated data-cleaning pass
- [ ] Rollback asymmetry in old migrations (pivot tables dropped in unrelated down()s) — cosmetic, fresh installs unaffected

## Docker / infra
- [x] Entrypoint: `migrate --force` (no more DB wipe), retry loop, seed only on first boot (2026-10-24)
- [x] MySQL: `MYSQL_ALLOW_EMPTY_PASSWORD` removed, healthcheck without password on cmdline, app waits for service_healthy (2026-10-24)
- [x] `APP_DEBUG=false` in .env.example (2026-10-24)
- [ ] Real production serving: replace `php artisan serve` + `npm run dev` in the container with php-fpm + nginx and built assets (kept for now because compose exposes VITE for dev; needs testing in your environment)
- [ ] Laravel 10 → 11/12 upgrade (framework is past security EOL; composer reports 52 advisories, mostly this chain). Do after tests grow.

## Code quality / cleanup
- [x] Removed 2026-10-24: 14 dead Blade views, ~60MB dead assets (unreferenced Home images incl. 9MB city photos, `public/js/lib`, `css/Lib/testimoni`, duplicate `apps.js`), unused npm deps (firebase, pdfjs-dist, toastr), byte-dup Kernel middleware arrays with dead Spatie/Passport aliases.
- [x] Tests: sqlite in-memory phpunit config, impossible MyTest deleted, 7 security regression tests (role hardcode, throttle, auth walls) — 9/9 green (2026-10-24)
- [ ] Deduplicate admin/front controller pairs (store vs storeFront etc.) into shared form requests + services — the largest remaining refactor
- [ ] Remaining ~70MB legacy assets (css/Lib template bundles, jQuery×3 local copies) — still referenced by live Blade layouts
- [ ] Relative asset paths in layout/main.blade.php (currently papered over with authenticated proxy routes)
- [ ] N+1 hot spots: `Property::get_price_range` per row, `all.blade.php` regencies pluck per agent row, `Model::all()` companions in filter pages
- [ ] Decide Inertia migration scope: one route migrated; either continue or freeze
