<?php

it('renders the published forms viewer and optional builder contracts', function (): void {
    $this->get('/forms')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="forms-viewer"', false)
        ->assertSee('data-daisy-kit-module="forms-builder"', false)
        ->assertSee('forms-viewer.js')
        ->assertSee('forms-builder.js')
        ->assertSee('Ada Lovelace');
});

it('renders the published table contract with deterministic rows', function (): void {
    $this->get('/table')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="table"', false)
        ->assertSee('data-daisy-kit-table-filter', false)
        ->assertSee('Ada Lovelace')
        ->assertSee('Filtered server result')
        ->assertSee('Unavailable source')
        ->assertSee('@daisy-kit/table.js');
});
