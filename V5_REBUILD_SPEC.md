# Laravel Daisy Kit Demo v5 reconstruction

## Objective

Replace the legacy v4 demo with a small Laravel 13 documentation application for
Laravel Daisy Kit v5. It serves English, copyable, executable documentation for
Forms, Table, Tree, Blueprint, File Preview, and Map. The host application owns
Tailwind CSS and DaisyUI; Laravel Daisy Kit owns only its documented modules.

The v4 release is preserved at `legacy/4.x`. The stable v5 release is promoted
from `next/v5` to `dev` and then `main` only after the complete validation gate.

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
- VCS Composer package `art35rennes/laravel-daisy-kit` declared at `^5.0` and
  locked at `v5.0.0` (`6d7f28ffc17cc2e91cd5be3e4598986da7ac75d4`), with Vite's
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
5. Composer/npm locks are current and audited. Stable validation promotes matching
   `next/v5`, `dev`, and `main` branches while preserving `legacy/4.x`.
6. `composer run test:release` runs every test without TIA. `composer run test:tia`
   first records the full suite, then replays unaffected results as fast, non-release
   feedback; its graph and cached results live in ignored `.pest/tia`.

## Corrective product-parity phase

### Objective

Restore the differentiated product journeys that the v4 demo proved, while keeping
the v5 boundary intact: the package owns module behavior and presentation; this
application owns deterministic documentation data, thin read-only endpoints,
native DaisyUI shell controls, and executable acceptance coverage. This phase
starts from the published `v5.0.0` baseline and is integrated only after a package
prerelease exposes the verified public contracts. It must not simulate a missing
package feature in Blade, JavaScript, a proxy, or a copied vendor asset.

### Delivery plan

1. Keep a comparison baseline: `legacy/4.x` supplies the user needs; current v5
   supplies the public-boundary baseline. Record retained, retired, and ported
   needs below before changing a page.
2. Add host-owned deterministic fixture data and safe read-only endpoints with
   Feature coverage. Restore `/demo` as a documented redirect to the v5 overview.
3. Add RED Feature and Browser tests for observable package behavior. They assert
   visible outcomes, network activity, keyboard/focus, computed presentation,
   console cleanliness, CSP, accessibility, and responsive widths; they do not
   assert an internal `ready` flag as the sole outcome.
4. When the package prerelease tag is supplied, install it from the configured
   VCS repository, read its released contract, and make only the smallest
   configuration/data changes needed to exercise it.
5. Run the complete non-TIA release suite, then a fresh and controlled TIA run,
   Vite build, Pint, Composer/npm validation and audits. Only a green result may
   be proposed for promotion.

### v4 to v5 product matrix

| Module | Retained in v5 | Retired intentionally | Ported acceptance need |
| --- | --- | --- | --- |
| Forms | Viewer and optional Livewire builder | v4 Form Kit aliases and generic wrappers | Rich schema validation/errors, visible and computed JSONata values, steps/submission; builder add/remove/reorder, options/rules, JSON/preview, undo/redo and synchronization |
| Table | Published table module and host DaisyUI shell | v4 table wrapper namespace | Deterministic server data; typed filter, sort/page, column controls, persistent bulk selection, details/actions and editing |
| Tree | Published tree module | v4 tree-view alias | Real hierarchy; multiple and indeterminate selection, lazy and remote/local search, persistence and keyboard navigation |
| Blueprint | Published blueprint module | v4 template route | Editorial workflow of five or more nodes/edges, inspector, edit/create/link, undo/redo, organization, synchronized JSON and read-only view |
| File Preview | Sandboxed published file-preview module | v4 document wrapper | Local text/image/PDF/DOCX and proportionate video fixtures; preview/open/download/modal; deterministic MIME, size and authorization failures under CSP |
| Map | Published map module | Leaflet demo route and unsupported providers | Deterministic test provider; markers/layers/GeoJSON, draw/edit/select/measure, undo/redo and export |
| Documentation | Native DaisyUI host navigation and six focused pages | v4 catalogue, auth, CRUD, charts and calendar | Every page exposes success, empty, loading and error states, copyable usage/imports/API/events, and standard-control links to DaisyUI |

### Browser and deployment parity gate

- Test all six pages at 320, 768, 1024 and 1440 pixels. Each flow asserts an
  observable user result plus `assertNoJavaScriptErrors()`, console/network
  cleanliness, keyboard/focus behavior, CSP and accessibility.
- Keep loopback Browser coverage, and add a trusted-HTTPS smoke environment (or a
  no-Web-Crypto origin fixture) for the Forms Viewer and File Preview. The current
  defect is specifically that an HTTP `.test` origin lacks `crypto.randomUUID()`;
  a `127.0.0.1` pass alone is not release evidence. Do not bypass an invalid Herd
  certificate.
- Maintain a reproducible legacy-versus-v5 comparison checklist for the matrix.
  It is a product gate, not a request to restore generic DaisyUI wrappers.

### Boundaries for the corrective phase

- Always: use published package Blade/ESM/CSS contracts only; keep fixtures local,
  deterministic and escaped; test invalid fixture states without weakening CSP.
- Ask first: introduce a package API not present in the prerelease, persistence,
  authentication, an external map provider, or promotion to `dev`, `main` or a
  release.
- Never: copy or patch vendor assets, add a local component/proxy/compatibility
  layer, skip/exclude a quality gate, or treat an internal mount state as proof of
  user-visible behavior.
