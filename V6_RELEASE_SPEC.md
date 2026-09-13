# Laravel Daisy Kit demo v6

## Delivery

A public Laravel 13 / PHP 8.4+ repository with executable English documentation
for the exact `v6.0.1` Composer/VCS release. No hosted deployment, authentication,
persistence, package copies, proxy routes or replacement components are included.

## Contract

Exactly eleven pages: Table, Tree, Blueprint, File Preview, Map, Copyable,
Combobox, Signature, Truncate, Scrollspy and Transfer List. Forms and the package
Livewire integration from v5 are removed without aliases or compatibility glue.
The package owns behavior; the host owns deterministic read-only fixtures,
DaisyUI/Tailwind styling, routes and native forms. Use independent JS/CSS imports
through `@daisy-kit` pointing to the installed package `dist` directory.

## Acceptance

Each page documents usage, imports, facade methods, events, submission shape and
applicable loading/empty/error states with working examples. Test observable
outcomes, not just successful mounting. Exercise keyboard and focus, CSP,
accessibility and 320/768/1024/1440 px widths in light and dark themes.
Signature and Transfer List alone need the style-attribute CSP exception.
File Preview remains sandboxed and its assets are emitted by Vite automatically.

Run `composer run test:release` without TIA, Pint, Vite build, Composer validation
and both dependency audits on the exact package tag. TIA remains supplementary.
Keep generated application assets untracked. Preserve historical tags and
`legacy/4.x`; integrate through `dev`, promote validated commits to `main`, then
publish the matching demo tag. Future fixes use new immutable tags.

## Reproduction

Follow README setup from a fresh checkout. `composer.lock` identifies the exact
package source commit and Installation displays the actual installed version.
Do not edit vendor or copy assets into public/vendor. Consumer installation needs
neither the package source build nor its development npm dependencies.
