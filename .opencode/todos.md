# Eigentum Fix List (audit 2026-10-24)

## Critical security
- [x] Remove client-controlled `role` from agent signup (2026-10-24: hardcoded 'agent'; admin-created agents also get 'agent' not 'developer')
- [x] Add `auth` middleware to `/pages` order/subscription routes and verify payment in `updateSub` (2026-10-24: auth middleware + paid-order verification — subscription only granted when Midtrans callback marked an order paid)
- [x] Fix IDOR on `detailorder/{order}` and `addtoorder/{subsId}` (2026-10-24: auth middleware + user_id ownership check + null-developer guard)
- [x] Add mimes whitelist to license uploads (2026-10-24: pdf,jpg,jpeg,png in both store and storeFront)
- [x] Secure `/pdf-preview/{file}` (2026-10-24: auth middleware + traversal rejection + 404 on missing)
- [x] Stop hashing nullable passwords in profile updates (2026-10-24: password/company_password only updated when filled, all 4 update methods)
- [x] Add ownership checks to agent property/unit update+destroy (2026-10-24: `Property::isOwnedBy()` guards edit/update/destroy/store on Property + Unit controllers; agent↔property pivot keys fixed so the check works)
- [x] Purge `public/ktp/` and `public/license/` personal documents from repo (2026-10-24: untracked + gitignored, files kept on disk) — **git history still contains them; needs `git filter-repo` + force push (user decision)**
- [x] Add `throttle` to login/register routes (2026-10-24: throttle:5,1 on all 7 auth POST routes; session regenerated on login/register/OAuth callback)
- [x] Convert state-changing GET routes to POST/DELETE (2026-10-24: logout/favorite-remove/removeall → POST, 4 destroy routes → DELETE, 6 views converted to real POST forms)
- [x] Move `/admin/notifications` inside admin middleware group (2026-10-24)
- [x] Set `APP_DEBUG=false` in .env.example (2026-10-24) — note: local .env unchanged
- [x] Validate OAuth provider name + handle duplicate-email conflict (2026-10-24: google-only whitelist, existing-email accounts get provider linked instead of 500)

## Broken functionality
- [x] Fix `npm run build` — add `@` alias to vite-plugin-stylex options in vite.config.js (2026-10-24; note: plugin warns @stylexjs/stylex 0.19 > expected ^0.9.3 — upgrade plugin later)
- [x] Implement or re-route missing `signinAgent`/`postSigninAgent` methods (2026-10-24: signinAgent added returning generic auth.signin; POST now uses AuthController::login)
- [x] Define `afterorder` route or change redirect (2026-10-24: finish() now resolves order by order_id → detailorder, falls back to beranda)
- [x] Fix view name case: `notfound` → `notFound` (routes/web.php) (2026-10-24)
- [x] Fix Home.tsx field bindings `unit.address`/`unit.name` → `unit.properties?.address` / `unit.title` (2026-10-24)
- [x] Fix `$$imageNames` typo so property image saves (PropertyController.php:103) (2026-10-24)
- [x] Fix UnitController::update looking up Specification/Image by unit id + `jpg.jpg` filename bug (2026-10-24: firstOrNew by unit_id + hashName + old-file cleanup + sync guard + agent fallback redirect)
- [x] Guard `Auth::user()` before role access on public pages (2026-10-24: PropertyController::show, AgentController::show/edit null-safe; OrderController still pending via security middleware)
- [x] Rewrite FavoriteController (2026-10-24: toggle logic fixed, detach scoped to current user, destroyall uses pivot detach, guest redirects; + favorites pivot keys fixed in User/Unit models + unique→composite migration)
- [x] Fix `redirect(back())` TypeError in AuthController::register (2026-10-24: register rewritten, session regenerated, login has error flash)
- [x] Return user signin view instead of developer's (SessionController.php:27-30) (2026-10-24)
- [x] Remove `Auth::login()` after admin creates agent/developer (2026-10-24: admin store() redirects with success; also admin-created agents now get role 'agent' not 'developer')
- [x] Fix `DeveloperController::show` using one id for Developer and User tables (2026-10-24: uses $developer->users relation)
- [x] Harden Midtrans callback (2026-10-24: 404 on unknown order, signature built from notification gross_amount instead of DB total)

## Data model
- [ ] Fix swapped belongsToMany keys on agent↔property pivot (Agent.php:44, Property.php:49) — favorites side fixed 2026-10-24
- [x] Fix `User::favorites()` returning `HasFactory()` instead of a relation (2026-10-24: now hasMany)
- [ ] Fix Unit region pivots joining `property_id` (Unit.php:70-80)
- [ ] Fix `Developer::scopefilter` columns `comipany`/`email` (Developer.php)
- [ ] Fix `$guaded` typo unguarding Subscribe model (Subscribe.php:14)
- [x] Migrate `favorites.user_id` from unique to composite key (2026-10-24: migration 2026_10_24_000001)
- [ ] Add FK constraints + indexes to migrations; fix `units.price` decimal(7,2) and ENUM payment_status
- [ ] Remove/repair decorative pivot models with wrong `$table` names

## Docker / infra
- [ ] Remove `migrate:fresh --seed` from entrypoint.sh (wipes DB on every restart)
- [ ] Replace `npm run dev` + `artisan serve` with proper fpm/nginx production setup
- [ ] Fix MySQL config: drop `MYSQL_ALLOW_EMPTY_PASSWORD`, remove password from healthcheck args
- [ ] Plan Laravel 10 → 11/12 upgrade (L10 past security EOL)

## Code quality / cleanup
- [ ] Remove ~135MB legacy assets (5 jQuery copies, 4 Bootstrap copies, `css/Lib/fix` template incl. demo media, 9MB images, duplicate admin app.js/apps.js)
- [ ] Delete dead Blade views (~400KB: old home, numbered iteration copies) and unused npm deps (firebase, pdfjs-dist, toastr)
- [ ] Deduplicate admin/front controller pairs (store vs storeFront etc.) into shared form requests + services
- [ ] Clean Kernel middleware aliases: remove Spatie/Passport aliases for uninstalled packages, drop duplicate `$routeMiddleware`/`$middlewareAliases` arrays, consolidate 5 role middlewares
- [ ] Fix or delete MyTest.php (non-existent factories, impossible assertion); add real tests for signup/search/payment
- [ ] Fix relative asset paths in layout/main.blade.php (currently papered over with authenticated proxy routes)
- [ ] Decide Inertia migration scope: either continue migrating routes off Blade or freeze and stabilize both shells
