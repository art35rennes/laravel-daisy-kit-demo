<?php

it('renders the UI demo page with section anchors and FAB navigator', function () {
    $response = $this->get('/demo');

    $response->assertSuccessful();
    $response->assertSee('DaisyUI Kit - Demo', false);
    $response->assertSee('id="demo-actions"', false);
    $response->assertSee('href="#demo-actions"', false);
    $response->assertSee('id="sectionNav"', false);
    $response->assertSee('fixed bottom-6 right-6', false);
    $response->assertSee('Package inventory · Manifest cache', false);
});

it('returns DataTables JSON from the demo datatable endpoint', function () {
    $response = $this->getJson('/demo/datatable/api/get?draw=3&start=0&length=5&search[value]=hart&columns[0][data]=name&columns[1][data]=email&columns[2][data]=status&order[0][column]=0&order[0][dir]=asc');

    $response->assertSuccessful();
    $response->assertJson([
        'draw' => 3,
        'recordsTotal' => 12,
        'recordsFiltered' => 1,
    ]);

    expect($response->json('data'))->toHaveCount(1);
    expect($response->json('data.0.name'))->toBe('Hart Hagerty');
});
