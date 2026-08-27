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

it('documents the corrective VCS checkpoint and official Vite alias', function (): void {
    $this->get('/installation')
        ->assertOk()
        ->assertSee('v5.1.0-alpha.1')
        ->assertSee('d906021a82d3b86059551ba8f6042c7823df3dfd')
        ->assertSee('Do not use this development page as compatibility guidance for v5.0.0')
        ->assertSee('https://github.com/art35rennes/laravel-daisy-kit')
        ->assertSee('@daisy-kit')
        ->assertSee('forms-viewer');
});
