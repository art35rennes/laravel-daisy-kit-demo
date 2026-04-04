# Laravel Daisy Kit Demo

Laravel Daisy Kit Demo is a standalone Laravel application that documents and validates the `art35rennes/laravel-daisy-kit` package in a real host app.

## Responsibilities

This repository owns:

- documentation pages
- demo pages
- app routes and controllers
- inventory and docs generation tooling
- browser and integration tests

The reusable UI kit itself lives in a separate repository: `laravel-daisy-kit`.

## Local Development

Clone the two repositories side by side:

- `laravel-daisy-kit`
- `laravel-daisy-kit-demo`

The demo app uses a Composer `path` repository pointed at `../laravel-daisy-kit` during local development.

```bash
composer install
npm install
cp .env.example .env
touch database/database.sqlite
php artisan key:generate
php artisan migrate
npm run dev
php artisan serve
```

### Valet / Laravel Herd (`.test`)

1. Point `APP_URL` in `.env` to your local domain, for example `http://laravel-daisy-kit-demo.test`, so redirects and generated URLs stay on that host.
2. Link the project so the hostname resolves (example with Valet from the demo directory):

   ```bash
   valet link laravel-daisy-kit-demo
   ```

   With Herd, add the site in the UI or use the equivalent link command.

3. **Migrations are required**: this app uses `SESSION_DRIVER=database` (and database cache/queue). If you skip `php artisan migrate`, every page can return **500** with `no such table: sessions`.

### Quick checks

- Docs home: `/` redirects to `/docs` when `docs.enabled` is true in `config/daisy-kit.php`.
- Demo UI hub: `/demo`

## Testing

```bash
composer test
```

Browser tests stay in this repository because they validate the docs/demo experience, not the package internals.
