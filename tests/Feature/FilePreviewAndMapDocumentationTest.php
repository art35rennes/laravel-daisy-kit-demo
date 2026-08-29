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

it('renders the published map contract with deterministic GeoJSON', function (): void {
    $this->get('/map')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="map"', false)
        ->assertSee('data-daisy-kit-map-canvas', false)
        ->assertSee('48.1173')
        ->assertSee('@daisy-kit/map.js');
});
