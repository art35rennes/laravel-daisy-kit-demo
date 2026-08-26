# Laravel Daisy Kit Demo v5

Executable English documentation for the six Laravel Daisy Kit v5 modules. This
branch is a reconstruction in progress and intentionally does not publish to
`main`, `dev`, or a release until the exact v5 package prerelease is available.

## Requirements

- PHP 8.4.1+
- Composer 2
- Node.js LTS and npm

The application has no authentication, database migrations, or persistent data.
All examples use deterministic local fixtures.

## Setup

```sh
composer install
npm ci
npx playwright install chromium
php artisan key:generate
npm run build
```

The package prerelease is an explicit checkpoint. Once the package supplies its
published v5 tag, require it from its Git VCS repository and update the Composer
lock; this demo does not substitute a local fake implementation.

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

## AI guidance

Laravel Boost 2 is installed as a development dependency. Keep project-specific
agent context in `.ai/guidelines` (and `.ai/skills` only when a project-specific
skill is genuinely needed); Boost synchronizes generated skills to
`.agents/skills` and composes `AGENTS.md`. Refresh generated guidance with:

```sh
php artisan boost:update --discover
```

The local MCP settings for Codex and Cursor remain ignored because their working
directory is machine-specific. Do not add a package-v5 stand-in while refreshing
agent guidance.

## Sources

- [Laravel 13 installation](https://laravel.com/docs/13.x/installation)
- [Laravel Boost](https://laravel.com/docs/boost)
- [Laravel routing](https://laravel.com/docs/13.x/routing)
- [DaisyUI documentation](https://daisyui.com/docs/)
- [Pest 5 TIA](https://pestphp.com/docs/tia)
- [Pest Browser testing](https://pestphp.com/docs/browser-testing)
