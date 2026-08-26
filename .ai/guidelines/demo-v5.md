# Laravel Daisy Kit demo v5

- Target Laravel 13 and PHP 8.4; keep all documentation and UI copy in English.
- This is executable documentation only: no authentication, no persistent database, and no
  network-backed fixtures. Keep the six module pages deterministic: Forms, Table, Tree,
  Blueprint, File Preview, and Map.
- Use native DaisyUI/Tailwind for standard shell controls. Do not revive v4 contracts,
  wrappers, catalogue pages, CRUD/auth templates, charts, calendars, or inventory tooling.
- Laravel Daisy Kit is declared from its Git VCS repository for the corrective v5
  development contract. Do not treat a prior v5 lock, alpha, or stable release as
  a compatibility target or final documentation source. Use only the verified
  public Blade contracts and the official `@daisy-kit` Vite alias to
  `vendor/art35rennes/laravel-daisy-kit/dist`; do not add v4 compatibility code, local copies,
  stubs, or unverified APIs.
- Use Pest 5 TIA for fast feedback (`composer run test:tia`), but use
  `composer run test:release` as the full non-TIA gate. Preserve Browser coverage for all six
  pages, responsive widths, keyboard/focus behavior, accessibility, and console errors.
- Product parity is defined by `V5_REBUILD_SPEC.md`: preserve the v4 user needs through the
  six v5 public modules, but never revive v4 aliases or implement a missing package capability
  in the host. Keep `/fixtures/*` read-only, deterministic and validated.
- Browser acceptance must prove visible outcomes, styles, focus, accessibility, console and
  network behavior rather than only an internal mount state. Forms Viewer and File Preview also
  need trusted-HTTPS or no-Web-Crypto-origin coverage; never bypass a Herd certificate warning.
- A package prerelease must be locked from Git VCS and verified from a fresh install before its
  contract is documented or the corrective branch is considered promotable.
