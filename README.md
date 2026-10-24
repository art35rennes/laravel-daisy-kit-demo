# Laravel Daisy Kit Demo v6

Executable English documentation for thirteen independent Laravel Daisy Kit v6 modules:
Table, Tree, Blueprint, File Preview, Map, Copyable, Combobox, Signature, Truncate,
Scrollspy, Transfer List, Code Editor, and WYSIWYG. The package is installed from Git VCS at
`v6.1.4`; `composer.lock` records the exact reference, also shown on Installation.
Forms Viewer/Builder and Livewire are removed without compatibility aliases.

Every module page includes working examples, explicit imports, facade methods,
events and Laravel submission shapes. Signature, Transfer List and WYSIWYG permit
`style-src-attr 'unsafe-inline'`; the other pages retain the strict policy. Code Editor
and WYSIWYG also document their response nonce requirements.

## Requirements

- PHP 8.4.27+ (PHP 8.5 requires 8.5.12+)
- Composer 2
- Node.js 24.22.1+ within Node 24 (see `.nvmrc`) and npm

The application has no authentication, database migrations, or persistent data.
All examples use deterministic local fixtures.

## Setup

```sh
cp .env.example .env
composer install
npm ci
npx playwright install chromium
php artisan key:generate
npm run build
```

Composer locks the stable release directly from that GitHub VCS source. In `vite.config.js`, the official `@daisy-kit`
alias resolves to
`vendor/art35rennes/laravel-daisy-kit/dist`; import only the required
`@daisy-kit/{stem}.js` and `.css` entries. This demo has no local package copy,
stub, or compatibility layer.

## Quality commands

```sh
# Release reference: every test, including Browser tests, with TIA disabled.
composer run test:release

# Fast development / dedicated CI feedback: Pest records a dependency graph then
# replays unaffected tests. Never use this command as a release gate.
composer run test:tia

vendor/bin/pint --test
npm run build
composer audit
npm audit
```

Pest 5’s TIA engine needs PCOV or Xdebug. Its first run records the full suite;
subsequent runs replay unaffected results from ignored `.pest/tia`. The release
command always executes the complete suite without TIA, so browser, responsive,
accessibility, and module coverage cannot be masked.

## Dependency checkpoint

The locks were renewed on 24 October 2026 after the functional browser baseline.
Compatible updates were applied and both security audits were empty. Major
migrations are planned separately in the package maintenance report.

| Area | Locked direct versions | Official release notes |
| --- | --- | --- |
| Application | Laravel 13.38.0 | [Laravel](https://github.com/laravel/framework/releases) |
| PHP quality | Boost 2.10.3; Pint 1.32.1; Pest 5.3.3; Pest Browser 5.1.2 | [Boost](https://github.com/laravel/boost/releases), [Pint](https://github.com/laravel/pint/releases), [Pest](https://github.com/pestphp/pest/releases), [Pest Browser](https://github.com/pestphp/pest-plugin-browser/releases) |
| Frontend | Tailwind CSS and its Vite plugin 4.3.3; DaisyUI 5.7.50; Vite 8.3.5; Laravel Vite plugin 3.2.0; Playwright 1.64.1 | [Tailwind CSS](https://github.com/tailwindlabs/tailwindcss/releases), [DaisyUI](https://github.com/saadeghi/daisyui/releases), [Vite](https://github.com/vitejs/vite/releases), [Laravel Vite plugin](https://github.com/laravel/vite-plugin/releases), [Playwright](https://github.com/microsoft/playwright/releases) |

The Composer and npm manifests retain compatible major ranges while the lock
files preserve this verified application snapshot.

## AI guidance

Laravel Boost 2 is installed as a development dependency. Keep project-specific
agent context in `.ai/guidelines` (and `.ai/skills` only when a project-specific
skill is genuinely needed); Boost synchronizes generated skills to
`.agents/skills` and composes `AGENTS.md`. Refresh generated guidance with:

```sh
php artisan boost:update --discover
```

The package’s v6 Boost guidance and `laravel-daisy-kit-development` skill are
included through Boost after a static SkillSpector review (SAFE; no LLM analysis).
The local MCP settings for Codex and Cursor remain ignored because their working
directory is machine-specific.

## Sources

- [Laravel 13 installation](https://laravel.com/docs/13.x/installation)
- [Laravel Boost](https://laravel.com/docs/boost)
- [Laravel routing](https://laravel.com/docs/13.x/routing)
- [DaisyUI documentation](https://daisyui.com/docs/)
- [Pest 5 TIA](https://pestphp.com/docs/tia)
- [Pest Browser testing](https://pestphp.com/docs/browser-testing)

## Security maintenance

PHP must be 8.4.27+ or 8.5.12+; Node builds require patched Node 24.22.1+.
CI rejects eMudhra and the affected AAA Certificate Services cross-signing path
before checkout, covers PHP 8.4/8.5 and audits dependency locks weekly.
The immutable VCS lock consumes kit v6.1.4. There is no deployment workflow.
