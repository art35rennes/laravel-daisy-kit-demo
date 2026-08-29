<?php

it('renders the published file preview with a local deterministic source', function (): void {
    $this->get('/file-preview')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="file-preview"', false)
        ->assertSee('sandbox="allow-scripts"', false)
        ->assertSee('quarterly-report.txt')
        ->assertSee('preview.wav')
        ->assertSee('data-file-preview-open-external="customer-handoff"', false)
        ->assertDontSee('src="/fixtures/quarterly-report.txt"', false)
        ->assertSee('@daisy-kit/file-preview.js');
});

it('renders the complete published map contract with deterministic sources', function (): void {
    $this->get('/map')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="map"', false)
        ->assertSeeInOrder([
            'Markers, popups and clustering',
            'OSM styles and business layers',
            'Drawing, measurement and form export',
            'Persistence, errors and external controls',
        ])
        ->assertSee('data-doc-map-action="view"', false)
        ->assertSee('name="maintenance_geometry"', false)
        ->assertSee('"type":"wms"', false)
        ->assertSee('"type":"xyz"', false)
        ->assertSee('"type":"geojson"', false)
        ->assertSee('data-daisy-kit-map-canvas', false)
        ->assertSee('48.1173')
        ->assertSee('@daisy-kit/map.js');
});
