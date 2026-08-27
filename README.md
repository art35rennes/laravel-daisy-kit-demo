# Laravel Daisy Kit Demo v5

Executable English documentation for the six Laravel Daisy Kit v5 modules. This
branch is product-development work. It locks the corrective package prerelease
`v5.1.0-alpha.1` at commit `d906021a82d3b86059551ba8f6042c7823df3dfd`; owner
browser validation remains pending. It does not provide a compatibility mode for
v5.0.0 or an earlier alpha.

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

Composer locks the prerelease directly from that GitHub VCS source. In `vite.config.js`, the official `@daisy-kit`
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

## AI guidance

Laravel Boost 2 is installed as a development dependency. Keep project-specific
agent context in `.ai/guidelines` (and `.ai/skills` only when a project-specific
skill is genuinely needed); Boost synchronizes generated skills to
`.agents/skills` and composes `AGENTS.md`. Refresh generated guidance with:

```sh
php artisan boost:update --discover
```

The package’s v5 Boost guidance and `laravel-daisy-kit-development` skill are
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
