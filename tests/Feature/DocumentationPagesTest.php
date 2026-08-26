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
        ->assertSee($heading);
})->with('documentation-pages');
