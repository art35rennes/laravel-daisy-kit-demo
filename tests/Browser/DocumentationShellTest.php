<?php

dataset('responsive-module-pages', [
    ...array_map(static fn (int $width): array => ['/forms', 'forms-viewer', $width, 900, 3], [320, 768, 1024, 1440]),
    ...array_map(static fn (int $width): array => ['/table', 'table', $width, 900, 3], [320, 768, 1024, 1440]),
    ...array_map(static fn (int $width): array => ['/tree', 'tree', $width, 900, 3], [320, 768, 1024, 1440]),
    ...array_map(static fn (int $width): array => ['/blueprint', 'blueprint', $width, 900, 3], [320, 768, 1024, 1440]),
    ...array_map(static fn (int $width): array => ['/file-preview', 'file-preview', $width, 900, 4], [320, 390, 768, 1024, 1440]),
    ...array_map(static fn (int $width): array => ['/map', 'map', $width, 900, 3], [320, 768, 1024, 1440]),
]);

it('mounts every published module accessibly at every supported viewport', function (string $uri, string $module, int $width, int $height, int $scenarioCount): void {
    visit($uri)
        ->resize($width, $height)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('[data-daisy-kit-module={$module}]').dataset.daisyKitState === 'ready'", true)
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth', true)
        ->assertCount('main article section[id]', $scenarioCount)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->with('responsive-module-pages')->group('browser');

it('filters the native documentation navigation with keyboard input', function (): void {
    visit('/')
        ->resize(1024, 900)
        ->typeSlowly('[data-doc-search="desktop"]', 'tree', 20)
        ->assertScript('document.activeElement.matches("[data-doc-search=desktop]")', true)
        ->assertScript('document.querySelectorAll("[data-doc-item]:not(.hidden)").length', 1)
        ->assertSee('Tree')
        ->assertNoSmoke();
})->group('browser');
