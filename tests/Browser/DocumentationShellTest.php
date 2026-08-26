<?php

dataset('responsive-module-pages', [
    ['/forms', 'Forms', 320, 800],
    ['/table', 'Table', 768, 900],
    ['/tree', 'Tree', 1024, 900],
    ['/blueprint', 'Blueprint', 1440, 960],
]);

it('keeps every remaining module page accessible at its representative viewport', function (string $uri, string $heading, int $width, int $height): void {
    visit($uri)
        ->resize($width, $height)
        ->assertSee($heading)
        ->assertNoAccessibilityIssues()
        ->assertNoJavaScriptErrors();
})->with('responsive-module-pages')->group('browser');

it('filters the native documentation navigation with keyboard input', function (): void {
    visit('/')
        ->resize(1024, 900)
        ->typeSlowly('[data-doc-search="desktop"]', 'tree', 20)
        ->assertScript('document.activeElement.matches("[data-doc-search=desktop]")', true)
        ->assertScript('document.querySelectorAll("[data-doc-item]:not(.hidden)").length', 1)
        ->assertSee('Tree')
        ->assertNoJavaScriptErrors();
})->group('browser');
