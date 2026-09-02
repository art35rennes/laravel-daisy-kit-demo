<?php

use App\Http\Controllers\DocumentationController;
use Composer\InstalledVersions;

dataset('documentation-pages', [
    ['/', 'Laravel Daisy Kit'],
    ['/installation', 'Installation'],
    ['/copyable', 'Copyable'],
    ['/combobox', 'Combobox'],
    ['/signature', 'Signature'],
    ['/truncate', 'Truncate'],
    ['/scrollspy', 'Scrollspy'],
    ['/transfer-list', 'Transfer List'],
    ['/table', 'Table'],
    ['/tree', 'Tree'],
    ['/blueprint', 'Blueprint'],
    ['/file-preview', 'File Preview'],
    ['/map', 'Map'],
]);

it('serves every documented module page', function (string $uri, string $heading): void {
    $styleAttributes = in_array($uri, ['/signature', '/transfer-list'], true) ? "'unsafe-inline'" : "'none'";

    $this->get($uri)
        ->assertOk()
        ->assertSee($heading)
        ->assertHeader('Content-Security-Policy', "default-src 'none'; base-uri 'none'; object-src 'none'; script-src 'self'; style-src 'self'; style-src-attr {$styleAttributes}; img-src 'self' data: blob:; connect-src 'self'; worker-src 'self' blob:; frame-src 'self'; form-action 'self'");
})->with('documentation-pages');

it('documents the corrective VCS checkpoint and official Vite alias', function (): void {
    $this->get('/installation')
        ->assertOk()
        ->assertSee('dev-dev')
        ->assertSee(InstalledVersions::getReference('art35rennes/laravel-daisy-kit'))
        ->assertSee('Do not use this development page as compatibility guidance for v5.0.0')
        ->assertSee('https://github.com/art35rennes/laravel-daisy-kit')
        ->assertSee('@daisy-kit')
        ->assertSee('copyable');
});

it('documents the optional Copyable icon and transient visual feedback', function (): void {
    $this->get('/copyable')
        ->assertOk()
        ->assertSee('data-daisy-kit-copyable-icon', false)
        ->assertSee('data-daisy-kit-copyable-feedback', false)
        ->assertSee('Invoice reference copied.')
        ->assertSee('showIcon=false')
        ->assertSee('showFeedback=true');
});

it('exposes exactly the eleven v5 modules without the retired Forms page', function (): void {
    expect(array_keys(DocumentationController::modules()))->toEqualCanonicalizing([
        'table', 'tree', 'blueprint', 'file-preview', 'map', 'copyable', 'combobox',
        'signature', 'truncate', 'scrollspy', 'transfer-list',
    ]);

    $this->get('/forms')->assertNotFound();
});
