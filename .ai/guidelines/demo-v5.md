# Laravel Daisy Kit demo v5

- Target Laravel 13 and PHP 8.4; keep all documentation and UI copy in English.
- This is executable documentation only: no authentication, no persistent database, and no
  network-backed fixtures. Keep the six module pages deterministic: Forms, Table, Tree,
  Blueprint, File Preview, and Map.
- Use native DaisyUI/Tailwind for standard shell controls. Do not revive v4 contracts,
  wrappers, catalogue pages, CRUD/auth templates, charts, calendars, or inventory tooling.
- Laravel Daisy Kit is locked from its Git VCS repository at `v5.0.0-alpha.3`.
  Use only its public Blade contracts and the official `@daisy-kit` Vite alias to
  `vendor/art35rennes/laravel-daisy-kit/dist`; do not add v4 compatibility code, local copies,
  stubs, or unverified APIs.
- Use Pest 5 TIA for fast feedback (`composer run test:tia`), but use
  `composer run test:release` as the full non-TIA gate. Preserve Browser coverage for all six
  pages, responsive widths, keyboard/focus behavior, accessibility, and console errors.
