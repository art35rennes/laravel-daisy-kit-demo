<?php

use App\Helpers\ComponentScanner;
use App\Helpers\DocsHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

beforeEach(function () {
    Config::set('daisy-kit.docs.enabled', true);
    $this->prefix = config('daisy-kit.docs.prefix', 'docs');

    // Générer le cache des composants si nécessaire
    if (! ComponentScanner::isCacheValid()) {
        ComponentScanner::rebuildCache();
    }
});

it('loads the docs index page without errors', function () {
    $response = $this->get("/{$this->prefix}");

    $response->assertSuccessful();
    $response->assertSee('Documentation', false);
    $response->assertDontSee('syntax error', false);
    $response->assertDontSee('unexpected identifier', false);
    $response->assertDontSee('Parse error', false);
});

it('loads the templates index page without errors', function () {
    $response = $this->get("/{$this->prefix}/templates");

    $response->assertSuccessful();
    $response->assertSee('Templates', false);
    $response->assertDontSee('syntax error', false);
    $response->assertDontSee('unexpected identifier', false);
    $response->assertDontSee('Parse error', false);
});

it('loads all component documentation pages without errors', function () {
    $componentsByCategory = DocsHelper::getComponentsByCategory($this->prefix);
    $pages = [];

    foreach ($componentsByCategory as $category) {
        foreach ($category['components'] ?? [] as $component) {
            $href = $component['href'] ?? '';
            if (empty($href)) {
                continue;
            }

            $path = parse_url($href, PHP_URL_PATH);
            if ($path === null) {
                continue;
            }

            $pages[] = $path;
        }
    }

    expect($pages)->not->toBeEmpty();

    foreach ($pages as $path) {
        $response = $this->get($path);

        $response->assertSuccessful();

        $content = $response->getContent();

        // Verify there are no PHP errors shown in the rendered HTML.
        expect($content)
            ->not->toContain('syntax error', false)
            ->not->toContain('unexpected identifier', false)
            ->not->toContain('Parse error', false)
            ->not->toContain('Fatal error', false)
            ->not->toContain('Call to undefined', false);
    }
})->group('docs');

it('loads all template documentation pages without errors', function () {
    $navItems = DocsHelper::getTemplateNavigationItems($this->prefix);
    $pages = [];

    foreach ($navItems as $category) {
        foreach ($category['children'] ?? [] as $template) {
            $href = $template['href'] ?? '';
            if (empty($href)) {
                continue;
            }

            $path = parse_url($href, PHP_URL_PATH);
            if ($path === null) {
                continue;
            }

            $pages[] = $path;
        }
    }

    expect($pages)->not->toBeEmpty();

    foreach ($pages as $path) {
        $response = $this->get($path);

        $response->assertSuccessful();

        $content = $response->getContent();

        // Verify there are no PHP errors shown in the rendered HTML.
        expect($content)
            ->not->toContain('syntax error', false)
            ->not->toContain('unexpected identifier', false)
            ->not->toContain('Parse error', false)
            ->not->toContain('Fatal error', false)
            ->not->toContain('Call to undefined', false);
    }
})->group('docs');

it('loads all template preview routes without errors', function () {
    $routes = collect(Route::getRoutes())
        ->filter(fn ($route) => str_starts_with((string) $route->getName(), 'templates.'))
        ->filter(fn ($route) => in_array('GET', $route->methods(), true))
        ->filter(fn ($route) => ! str_contains($route->uri(), '{'))
        ->sortBy(fn ($route) => $route->getName())
        ->values();

    expect($routes)->not->toBeEmpty();

    foreach ($routes as $route) {
        $response = $this->get(route($route->getName()));

        $response->assertSuccessful();

        $content = $response->getContent();

        expect($content)
            ->not->toContain('syntax error', false)
            ->not->toContain('unexpected identifier', false)
            ->not->toContain('Parse error', false)
            ->not->toContain('Fatal error', false)
            ->not->toContain('Call to undefined', false)
            ->not->toContain('Internal Server Error', false);
    }
})->group('docs');

it('keeps the published Daisy Kit Vite manifest aligned with existing assets', function () {
    $buildDirectory = trim((string) config('daisy-kit.vite_build_directory'), '/');
    $manifestPath = public_path("{$buildDirectory}/manifest.json");

    expect($manifestPath)->toBeFile();

    $manifest = json_decode((string) file_get_contents($manifestPath), true);

    expect($manifest)->toBeArray()->not->toBeEmpty();

    $missingAssets = [];
    $assetReferences = [];

    foreach ($manifest as $entryName => $entry) {
        if (! is_array($entry)) {
            continue;
        }

        foreach (['file', 'css'] as $key) {
            $references = $key === 'css'
                ? ($entry[$key] ?? [])
                : array_filter([$entry[$key] ?? null]);

            foreach ($references as $assetPath) {
                $relativeAssetPath = "{$buildDirectory}/{$assetPath}";
                $assetReferences[] = "{$entryName}:{$relativeAssetPath}";

                if (! file_exists(public_path($relativeAssetPath))) {
                    $missingAssets[] = $relativeAssetPath;
                }
            }
        }
    }

    expect($assetReferences)->not->toBeEmpty();
    expect($missingAssets)->toBeEmpty('Missing published Daisy Kit assets: '.implode(', ', $missingAssets));
})->group('docs');
