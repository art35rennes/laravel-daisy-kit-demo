<?php

dataset('fixture-endpoints', [
    'forms' => ['/fixtures/forms', 'schema.fields.0.fields.0.name', 'name'],
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
    $this->getJson('/fixtures/table?filter=Grace&columnFilters[status]=active&sort=name&direction=asc&page=1&pageSize=2')
        ->assertOk()
        ->assertJsonPath('rows.0.name', 'Grace Hopper')
        ->assertJsonPath('total', 1);
});

it('returns 422 when a table fixture filter is invalid', function (): void {
    $this->getJson('/fixtures/table?sort=unsafe')
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('sort');
});

it('serves an explicit deterministic Table failure without a missing route', function (): void {
    $this->getJson('/fixtures/table-unavailable')
        ->assertServiceUnavailable()
        ->assertJsonPath('message', 'The deterministic table source is unavailable.');
});

it('serves the published Tree lazy and search response shapes', function (): void {
    $this->getJson('/fixtures/tree?parent=media')
        ->assertOk()
        ->assertJsonPath('items.0.id', 'office-plan');

    $this->getJson('/fixtures/tree?query=workspace')
        ->assertOk()
        ->assertJsonPath('items.0.id', 'workspace');
});

dataset('fixture-scenarios', [
    'forms' => ['/fixtures/forms', 'Contributor profile', 'error'],
    'table' => ['/fixtures/table', 'Contributor directory', 'error'],
    'tree' => ['/fixtures/tree', 'Workspace navigation', 'variant'],
    'blueprint' => ['/fixtures/blueprint', 'Editorial workflow', 'variant'],
    'file preview' => ['/fixtures/file-preview', 'Text report', 'error'],
    'map' => ['/fixtures/map', 'Office workspace', 'variant'],
]);

it('exposes named representative scenarios with every module fixture', function (string $uri, string $title, string $state): void {
    $this->getJson($uri)
        ->assertOk()
        ->assertJsonPath('scenarios.0.title', $title)
        ->assertJsonPath('scenarios.2.state', $state);
})->with('fixture-scenarios');
