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

it('ships genuine preview files for every supported renderer', function (): void {
    $fixtures = public_path('fixtures');
    $contentTypes = [
        'editorial-brief.docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'office-plan.svg' => 'image/svg+xml',
        'preview-walkthrough.mp4' => 'video/mp4',
        'preview.wav' => 'audio/wav',
        'quarterly-report.txt' => 'text/plain; charset=UTF-8',
        'release-notes.pdf' => 'application/pdf',
    ];

    foreach ($contentTypes as $fixture => $contentType) {
        $this->get("/fixtures/file-preview/{$fixture}")
            ->assertOk()
            ->assertHeader('Content-Type', $contentType);
    }

    expect(file_get_contents("{$fixtures}/quarterly-report.txt"))
        ->toContain('Daisy Kit File Preview')
        ->and(file_get_contents("{$fixtures}/office-plan.svg"))
        ->toStartWith('<svg')
        ->and(file_get_contents("{$fixtures}/preview.wav", false, null, 0, 12))
        ->toStartWith('RIFF')
        ->toEndWith('WAVE')
        ->and(file_get_contents("{$fixtures}/preview-walkthrough.mp4", false, null, 4, 4))
        ->toBe('ftyp')
        ->and(file_get_contents("{$fixtures}/release-notes.pdf", false, null, 0, 5))
        ->toBe('%PDF-');

    $pdf = file_get_contents("{$fixtures}/release-notes.pdf");
    preg_match_all('/\/Type\s*\/Page(?!s)/', $pdf, $pdfPages);
    expect($pdfPages[0])->toHaveCount(3);

    $docx = new ZipArchive;
    expect($docx->open("{$fixtures}/editorial-brief.docx"))->toBeTrue();
    $documentXml = $docx->getFromName('word/document.xml');
    $docx->close();

    expect($documentXml)
        ->toContain('Product preview brief')
        ->and(substr_count($documentXml, 'w:type="page"'))->toBeGreaterThanOrEqual(2);
});

it('serves deterministic local map layers and tiles', function (): void {
    $this->getJson('/fixtures/map/districts.geojson')
        ->assertOk()
        ->assertHeader('Content-Type', 'application/geo+json')
        ->assertJsonPath('features.0.id', 'district-center');

    $this->get('/fixtures/map/tiles/light/12/2028/1420.svg')
        ->assertOk()
        ->assertHeader('Content-Type', 'image/svg+xml; charset=UTF-8')
        ->assertSee('Local demo map', false)
        ->assertSee('12 / 2028 / 1420', false);

    $this->get('/fixtures/map/tiles/unknown/12/2028/1420.svg')
        ->assertNotFound();

    $this->get('/fixtures/map/wms?service=WMS&request=GetMap&layers=demo%3Azoning&format=image%2Fpng&transparent=true&version=1.1.1&srs=EPSG%3A3857&bbox=-1,48,0,49&width=256&height=256')
        ->assertOk()
        ->assertHeader('Content-Type', 'image/png');

    $this->getJson('/fixtures/map/unavailable.geojson')
        ->assertServiceUnavailable()
        ->assertJsonPath('message', 'The deterministic map layer is unavailable.');
});

it('rejects invalid deterministic WMS query parameters', function (): void {
    $this->getJson('/fixtures/map/wms?request=DeleteLayer')
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('request');
});

it('filters and pages deterministic table records on the server', function (): void {
    $this->getJson('/fixtures/table?filter=Grace&columnFilters[status]=active&sort=name&direction=asc&page=1&pageSize=2')
        ->assertOk()
        ->assertJsonPath('rows.0.name', 'Grace Hopper')
        ->assertJsonPath('total', 1);
});

it('accepts the serialized state sent by the published table module', function (): void {
    $query = http_build_query([
        'filter' => '',
        'columnFilters' => json_encode([['id' => 'status', 'value' => 'active']], JSON_THROW_ON_ERROR),
        'columnPinning' => json_encode(['start' => ['name'], 'end' => []], JSON_THROW_ON_ERROR),
        'columnVisibility' => json_encode(['status' => true], JSON_THROW_ON_ERROR),
        'page' => 1,
        'pageSize' => 2,
    ]);

    $this->getJson("/fixtures/table?{$query}")
        ->assertOk()
        ->assertJsonCount(2, 'rows')
        ->assertJsonPath('total', 4);
});

it('returns 422 when a table fixture filter is invalid', function (): void {
    $this->getJson('/fixtures/table?sort=unsafe')
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('sort');
});

it('returns 422 when serialized table state is malformed', function (): void {
    $this->getJson('/fixtures/table?columnFilters=not-json')
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('columnFilters');
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

    $this->getJson('/fixtures/tree?query=Forms')
        ->assertOk()
        ->assertJsonPath('items.0.id', 'forms');

    $this->getJson('/fixtures/tree?query=guide')
        ->assertOk()
        ->assertJsonPath('items.0.id', 'guide');

    $this->getJson('/fixtures/tree?query=office')
        ->assertOk()
        ->assertJsonPath('items.0.id', 'office-plan');
});

it('applies Tree query validation only to the Tree fixture endpoint', function (): void {
    $this->getJson('/fixtures/forms?parent=unexpected')
        ->assertOk()
        ->assertJsonPath('value.name', 'Ada Lovelace');

    $this->getJson('/fixtures/tree?parent=unexpected')
        ->assertUnprocessable()
        ->assertJsonValidationErrorFor('parent');
});

dataset('fixture-scenarios', [
    'forms' => ['/fixtures/forms', 'Contributor profile', 'scenarios.2.state', 'error'],
    'table' => ['/fixtures/table', 'Contributor directory', 'scenarios.2.state', 'error'],
    'tree' => ['/fixtures/tree', 'Workspace navigation', 'scenarios.2.state', 'variant'],
    'blueprint' => ['/fixtures/blueprint', 'Editorial workflow', 'scenarios.2.state', 'variant'],
    'file preview' => ['/fixtures/file-preview', 'Text report', 'scenarios.2.state', 'error'],
    'map' => ['/fixtures/map', 'Markers, popups and clustering', 'scenarios.3.state', 'error'],
]);

it('exposes named representative scenarios with every module fixture', function (string $uri, string $title, string $statePath, string $state): void {
    $this->getJson($uri)
        ->assertOk()
        ->assertJsonPath('scenarios.0.title', $title)
        ->assertJsonPath($statePath, $state);
})->with('fixture-scenarios');
