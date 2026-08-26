<?php

dataset('documentation-pages', [
    ['/', 'Laravel Daisy Kit'],
    ['/installation', 'Installation'],
    ['/forms', 'Forms'],
    ['/table', 'Table'],
    ['/tree', 'Tree'],
    ['/blueprint', 'Blueprint'],
    ['/file-preview', 'File Preview'],
    ['/map', 'Map'],
]);

it('serves every documented module page', function (string $uri, string $heading): void {
    $this->get($uri)
        ->assertOk()
        ->assertSee($heading)
        ->assertHeader('Content-Security-Policy', "default-src 'none'; base-uri 'none'; object-src 'none'; script-src 'self'; style-src 'self'; style-src-attr 'none'; img-src 'self' data: blob:; connect-src 'self'; worker-src 'self' blob:; frame-src 'self'; form-action 'self'");
})->with('documentation-pages');

it('documents the stable VCS release and official Vite alias', function (): void {
    $this->get('/installation')
        ->assertOk()
        ->assertSee('v5.0.0')
        ->assertDontSee('alpha.')
        ->assertSee('https://github.com/art35rennes/laravel-daisy-kit')
        ->assertSee('@daisy-kit')
        ->assertSee('forms-viewer');
});
