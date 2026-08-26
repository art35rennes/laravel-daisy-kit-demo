<?php

dataset('fixture-endpoints', [
    'forms' => ['/fixtures/forms', 'schema.fields.0.name', 'name'],
    'tree' => ['/fixtures/tree', 'items.0.id', 'workspace'],
    'blueprint' => ['/fixtures/blueprint', 'nodes.4.id', 'published'],
    'file preview' => ['/fixtures/file-preview', 'files.0.name', 'quarterly-report.txt'],
    'map' => ['/fixtures/map', 'geojson.type', 'FeatureCollection'],
]);

it('serves deterministic documentation fixtures without a database', function (string $uri, string $path, string $expected): void {
    $this->getJson($uri)
        ->assertOk()
        ->assertHeader('Content-Security-Policy', "default-src 'none'; base-uri 'none'; object-src 'none'; script-src 'self'; style-src 'self'; style-src-attr 'none'; img-src 'self' data: blob:; connect-src 'self'; worker-src 'self' blob:; frame-src 'self'; form-action 'self'")
        ->assertJsonPath($path, $expected);
})->with('fixture-endpoints');

it('filters and pages deterministic table records on the server', function (): void {
    $this->getJson('/fixtures/table?q=Grace&status=active&sort=name&direction=asc&page=1&per_page=2')
        ->assertOk()
        ->assertJsonPath('data.0.name', 'Grace Hopper')
        ->assertJsonPath('meta.total', 1)
        ->assertJsonPath('meta.current_page', 1)
        ->assertJsonPath('meta.per_page', 2);
});

it('returns 422 when a table fixture filter is invalid', function (): void {
    $this->getJson('/fixtures/table?sort=unsafe')
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('sort');
});
