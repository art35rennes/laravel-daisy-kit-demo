# Laravel Daisy Kit Demo

Laravel Daisy Kit Demo is the showcase and validation app for [`art35rennes/laravel-daisy-kit`](https://github.com/art35rennes/laravel-daisy-kit).

It is a real Laravel host application used to:

- publish and review the package documentation
- render demo pages and integration examples
- validate package behavior in an application context
- run feature and browser tests against the docs and demo UX

The reusable package itself lives in a separate repository. This repository owns the host app, not the UI kit source code.

## Repository Scope

Use this repository when you need to work on:

- docs pages
- demo pages
- host app routes and controllers
- inventory and docs generation tooling
- integration and browser coverage

Use the package repository when you need to work on:

- reusable Blade components
- package templates
- translations shipped by the package
- package service providers and package internals

## Requirements

- PHP 8.2+
- Composer
- Node.js and npm
- SQLite for local development

## Local Development

Clone both repositories side by side:

- `laravel-daisy-kit`
- `laravel-daisy-kit-demo`

This demo app uses a Composer `path` repository pointing to `../laravel-daisy-kit` during local package development.

```bash
composer install
npm install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
npm run dev
```

The application is expected to run on a local `.test` domain through Laravel Herd or Valet.

### Laravel Herd / Valet

1. Set `APP_URL` in `.env` to your local domain, for example `http://laravel-daisy-kit-demo.test`.
2. Link or register the site with your local web server.
3. Run migrations before loading the app.

This step is mandatory because the demo uses database-backed session, cache, and queue drivers. If you skip migrations, pages may fail with `no such table: sessions`.

## Usage

Once the app is running:

- `/` redirects to `/docs` when `docs.enabled` is enabled in `config/daisy-kit.php`
- `/docs` is the documentation entry point
- `/demo` is the UI demo hub

## Testing

Run the app test suite with:

```bash
composer test
```

Browser tests stay in this repository because they validate the documentation and demo experience, not the internal package implementation.

## Versioning

This project follows **Semantic Versioning (SemVer)** for releases: `MAJOR.MINOR.PATCH`.

- `MAJOR`: breaking changes
- `MINOR`: backward-compatible features and enhancements
- `PATCH`: backward-compatible fixes and documentation corrections

During day-to-day development, this demo application may point to `dev-main` of `art35rennes/laravel-daisy-kit` through a local Composer path repository. Published releases and tags should still follow SemVer so compatibility expectations remain explicit for GitHub and Packagist consumers.

## Release Notes

If a change affects public usage, installation flow, configuration, or documented behavior, it should be reflected in the changelog or release notes associated with the tagged version.

## License

This project is distributed under the MIT license.
