## Quick context for AI coding agents

This repository is a Laravel (v12) application with standard Laravel structure adapted to a small clinic/vet system. Keep suggestions minimal, targeted, and consistent with the project's conventions.

Key facts at-a-glance
- Framework: Laravel (PHP 8.2+). PSR-4 App\ -> `app/`.
- Frontend: Vite + Tailwind/Bootstrap. Node scripts in `package.json` (`dev`, `build`).
- Tests: PHPUnit configured to run with in-memory SQLite (see `phpunit.xml`).

Where to look first (examples)
- Routes: `routes/web.php` — registers `Auth::routes()` and middleware groups `isAdministrator`, `isResepsionis`.
- Auth flow: `app/Http/Controllers/Auth/LoginController.php` — custom session keys set here (e.g. `user_id`, `user_role_name`) and non-standard DB column names like `iduser`/`idrole`/`nama_role`.
- Models: `app/` (look for `User.php`, `Role.php`, `Roleuser.php` — note the pivot/relationship naming).
- Service providers: `app/Providers/AppServiceProvider.php` (bootstrap hooks).
- Migrations/factories: `database/migrations/` and `database/factories/`.

Important project-specific conventions
- Non-standard column and attribute names: many models use `iduser`, `idrole`, `nama`, `nama_role`. Do not assume default `id`, `name` fields; read the model definitions first.
- Role relationships: code frequently accesses `$user->roleUser[0]->idrole` — controllers assume a `roleUser` relation exists and may index into it. Handle missing indexes defensively.
- Session keys: controllers store user data in session under keys like `user_id`, `user_name`, `user_email`, `user_role`, `user_role_name`. When modifying auth flows, preserve these keys unless intentionally changing all usages.
- Route and view naming: route names and URLs are sometimes unusual (e.g. route names like `resepsionis.dashboard` and URL path `/resepsionis/resepsionis.dashboard-resepsionis`). Check both route name and path when linking or redirecting.

Dev / build / test commands (Windows PowerShell)
- Full setup (installs deps, migrates, builds assets):
  - composer run setup
  - (This runs `composer install`, copies `.env`, `php artisan key:generate`, `php artisan migrate --force`, `npm install`, `npm run build`)
- Start development stack (runs server, queue, logs, vite):
  - composer run dev
  - or for a minimal setup: `php artisan serve` and in another shell `npm run dev`.
- Run tests:
  - composer test
  - or `php artisan test` (phpunit uses sqlite :memory:, ensure pdo_sqlite is enabled in PHP)

Integration points & dependencies
- Database: configured via Laravel; migrations in `database/migrations` are authoritative. Tests use SQLite in-memory by default (`phpunit.xml`).
- Frontend build: `vite` via `npm run dev` / `npm run build`. See `vite.config.js` and `resources/js/*`.
- Background workers: composer `dev` script runs `php artisan queue:listen` and `php artisan pail` — check `config/queue.php` for driver defaults.

Common pitfalls to avoid
- Don't assume standard column names (`id`, `name`) — inspect model files (e.g. `app/Models/User.php`) before writing queries or factories.
- Controllers frequently index into relationship arrays (e.g. `$user->roleUser[0]`) — add null/empty checks to avoid PHP notices and broken redirects.
- Variable naming inconsistencies exist (for example `$namarole` vs `$namaRole` in `LoginController.php`) — follow local naming and search for existing usages before renaming.

Where to update if you change a pattern
- Session keys: update all controllers and views that rely on `user_*` session keys (search for `session()->get('user_` or `Request()->session()->get`).
- Middleware names: `isAdministrator` and `isResepsionis` are used in `routes/web.php` — if modifying middleware, update route groups accordingly.

If you need more context
- Read `README.md` for general setup notes.
- Inspect these files next: `routes/web.php`, `app/Http/Controllers/Auth/LoginController.php`, `app/Models/*`, `phpunit.xml`, `composer.json`, `package.json`.

When making changes
- Keep patches small and focused. Run `composer test` and `npm run build` (or `npm run dev`) locally. For PHP changes, prefer adding a unit/feature test that reproduces the behavior.
- Preserve backwards compatibility for session keys, route names, and DB column mappings unless you're prepared to update all call sites.

If anything here is unclear or you want the instructions expanded (examples, common fixes, or a checklist for PR reviews), tell me which sections to improve.
