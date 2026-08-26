# Laravel Daisy Kit Demo v5 reconstruction

## Objective

Replace the legacy v4 demo with a small Laravel 13 documentation application for
Laravel Daisy Kit v5. It serves English, copyable, executable documentation for
Forms, Table, Tree, Blueprint, File Preview, and Map. The host application owns
Tailwind CSS and DaisyUI; Laravel Daisy Kit owns only its documented modules.

The v4 release is preserved at `legacy/4.x`. This branch (`next/v5`) is not a
release branch and must never update `main` or `dev` until a validated v5 package
prerelease is available.

## Tech stack

- Laravel 13 and PHP ^8.4. Pest 5, TIA, local development, and CI use PHP 8.4;
  the v5 demo deliberately does not support PHP 8.3.
- Blade, Vite, Tailwind CSS, and DaisyUI. No authentication or persistent
  database is needed.
- Deterministic PHP fixtures and lightweight controllers only.
- Livewire 4 is installed to demonstrate the optional Forms builder. The Forms
  viewer example remains independent of Livewire.

Official framework and UI references:

- https://laravel.com/docs/13.x/installation
- https://laravel.com/docs/13.x/routing
- https://daisyui.com/docs/
- https://daisyui.com/components/

## Public package contract

The only package contracts documented by the demo are:

- `x-daisy-kit::forms.viewer` and `x-daisy-kit::forms.builder`
- `x-daisy-kit::table`, `x-daisy-kit::tree`, `x-daisy-kit::blueprint`,
  `x-daisy-kit::file-preview`, and `x-daisy-kit::map`
- VCS Composer package `art35rennes/laravel-daisy-kit` locked at
  `v5.0.0-alpha.2` (`c59f67375173c364b193dbcf309cca0891d02672`), with Vite's
  `@daisy-kit` alias resolving to its `dist` directory
- `@daisy-kit/{forms-viewer,forms-builder,table,tree,blueprint,file-preview,map}.{js,css}`
- ESM `mount`, `mountAll`, and `unmount`; DOM events named
  `daisy-kit:{module}:*`; no global object.

The package resolves from its Git VCS repository. This demo must not fabricate a
replacement component or asset: each page mounts only the published package module
and imports its matching CSS and ESM entry through the documented Vite alias.

## Commands

```sh
composer install
npm install
composer run test:release
composer run test:tia
vendor/bin/pint --test
npm run build
composer audit
npm audit
```

## Structure

- `app/Http/Controllers` — one small documentation controller.
- `app/Support` — deterministic module metadata and fixtures.
- `resources/views/layouts` — native DaisyUI shell.
- `resources/views/docs` — overview, installation, and one page per module.
- `resources/js` / `resources/css` — shell-only client behavior and styles.
- `tests/Feature` — routes and copyable documentation contracts.
- `tests/Browser` — one browser flow per module page.

## Style and boundaries

Use Blade auto-escaping, semantic HTML, native form controls, a logical keyboard
order, and DaisyUI classes directly. Use no wrappers for standard buttons, cards,
drawers, or modals. All content is deterministic and local; no user input is sent
to a database or external service.

- Always: test each increment, keep generated assets untracked, run audits before
  publishing `next/v5`.
- Ask first: add a service, persistence, authentication, a new public package API,
  or publish to `dev`, `main`, or a release.
- Never: restore legacy docs into v5, add ECharts/Calendar/Cally/chart.js or auth,
  CRUD, communication, inventory, or generator features; fake missing package APIs.

## Acceptance criteria for this independent phase

1. A fresh Laravel 13 application is reduced to the v5 documentation scope.
2. Overview, installation, and all six module pages load with searchable,
   responsive native-DaisyUI navigation.
3. Every module page documents usage, CSS/ESM imports, public contract, a
   deterministic fixture and empty/loading/error state, plus a DaisyUI reference.
4. Feature and browser tests cover the pages; the shell is keyboard accessible and
   has no console errors at 320, 768, 1024, and 1440 pixels.
5. Composer/npm locks are current and audited. `next/v5` is the only branch pushed
   by this phase; package integration remains an explicit checkpoint.
6. `composer run test:release` runs every test without TIA. `composer run test:tia`
   first records the full suite, then replays unaffected results as fast, non-release
   feedback; its graph and cached results live in ignored `.pest/tia`.
