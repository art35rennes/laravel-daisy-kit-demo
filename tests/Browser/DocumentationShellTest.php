<?php

dataset('responsive-module-pages', [
    ['/forms', 'forms-viewer', 320, 800],
    ['/table', 'table', 768, 900],
    ['/tree', 'tree', 1024, 900],
    ['/blueprint', 'blueprint', 1440, 960],
]);

it('mounts the published module accessibly at its representative viewport', function (string $uri, string $module, int $width, int $height): void {
    visit($uri)
        ->resize($width, $height)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('[data-daisy-kit-module={$module}]').dataset.daisyKitState === 'ready'", true)
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
