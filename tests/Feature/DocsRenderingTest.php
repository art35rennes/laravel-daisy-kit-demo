<?php

use App\Helpers\DocsHelper;
use Illuminate\Support\Facades\Config;

it('renders docs index page', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $res = $this->get('/docs');
    $res->assertSuccessful();
    $res->assertSee('Documentation', false);
});

it('renders a component page (button)', function () {
    Config::set('daisy-kit.docs.enabled', true);
    Config::set('app.locale', 'en');
    $res = $this->get('/docs/inputs/button');
    $res->assertSuccessful();
    $res->assertSee('Button', false);
});

it('renders the datatable documentation with the current component API', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $res = $this->get('/docs/data-display/datatable');

    $res->assertSuccessful();
    $res->assertSee('x-daisy::ui.data-display.datatable', false);
    $res->assertSee('server-side', false);
    $res->assertSee(':ajax=', false);
    $res->assertDontSee('x-daisy::ui.data-display.table', false);
    $res->assertDontSee('x-daisy::ui.advanced.table', false);
});

it('does not return 404 for any component documentation page', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $prefix = config('daisy-kit.docs.prefix', 'docs');

    $navigationItems = DocsHelper::getNavigationItems($prefix);
    $failedComponents = [];

    foreach ($navigationItems as $category) {
        foreach ($category['children'] ?? [] as $component) {
            $href = $component['href'] ?? '';
            if ($href === '') {
                continue;
            }

            // Extraire le chemin depuis l'href (ex: /docs/inputs/button)
            $path = parse_url($href, PHP_URL_PATH);
            if ($path === null) {
                continue;
            }

            $response = $this->get($path);

            if ($response->status() === 404) {
                $failedComponents[] = $path;
            }
        }
    }

    if (! empty($failedComponents)) {
        $message = 'Les pages suivantes retournent 404 : '.implode(', ', $failedComponents);
        expect($failedComponents)->toBeEmpty($message);
    }

    expect($failedComponents)->toBeEmpty();
})->group('docs');
