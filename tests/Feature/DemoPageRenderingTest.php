<?php

it('renders the UI demo page with section anchors and FAB navigator', function () {
    $response = $this->get('/demo');

    $response->assertSuccessful();
    $response->assertSee('DaisyUI Kit - Demo', false);
    $response->assertSee('id="demo-actions"', false);
    $response->assertSee('href="#demo-actions"', false);
    $response->assertSee('data-section-nav', false);
    $response->assertSee('data-section-nav-button', false);
    $response->assertSee('Package inventory · Manifest cache', false);
    $response->assertSee('data-sync', false);
    $response->assertSee('data-indeterminate="true"', false);
    $response->assertSee('data-module="token-input"', false);
    $response->assertSee('Pipeline équipe produit', false);
    $response->assertSee('Annuaire synchronisé', false);
    $response->assertSee('Checklist support', false);
    $response->assertSee('data-table-filter="team"', false);
    $response->assertSee('data-table-filter="active_only"', false);
    $response->assertSee('"stateKey":"demo-users-table"', false);
});

it('returns table JSON from the demo table endpoint', function () {
    $response = $this->getJson('/demo/table/api/get?pageIndex=0&pageSize=5&globalFilter=hart&sorting=%5B%7B%22id%22%3A%22name%22,%22desc%22%3Afalse%7D%5D');

    $response->assertSuccessful();
    $response->assertJson([
        'rowCount' => 1,
        'pageCount' => 1,
        'state' => [
            'pageIndex' => 0,
            'pageSize' => 5,
        ],
    ]);

    expect($response->json('rows'))->toHaveCount(1);
    expect($response->json('rows.0.name'))->toBe('Hart Hagerty');
});

it('applies column filters on the demo table endpoint', function () {
    $response = $this->getJson('/demo/table/api/get?pageIndex=0&pageSize=10&columnFilters=%5B%7B%22id%22%3A%22status%22,%22value%22%3A%22Archived%22%7D,%7B%22id%22%3A%22active_only%22,%22value%22%3Afalse%7D%5D');

    $response->assertSuccessful();

    expect($response->json('rowCount'))->toBe(3);
    expect(collect($response->json('rows'))->pluck('status')->unique()->all())->toBe(['Archived']);
});
