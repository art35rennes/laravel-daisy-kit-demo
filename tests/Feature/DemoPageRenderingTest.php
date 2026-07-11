<?php

it('renders the UI demo page with section anchors and FAB navigator', function () {
    $response = $this->get('/demo');

    $response->assertSuccessful();
    $response->assertSee('DaisyUI Kit - Demo', false);
    $response->assertSee('id="demo-actions"', false);
    $response->assertSee('href="#demo-actions"', false);
    $response->assertSee('data-demo-use-cases', false);
    $response->assertSee('Parcours de démo réalistes', false);
    $response->assertSee('Dashboard éditable', false);
    $response->assertSee('Form Kit', false);
    $response->assertSee('Table server-side', false);
    $response->assertSee('État vide', false);
    $response->assertSee('Overlays', false);
    $response->assertSee('Pages auth', false);
    $response->assertSee('KPIs', false);
    $response->assertSee('Charts', false);
    $response->assertSee('CRUD Layout', false);
    $response->assertSee('href="#demo-layout"', false);
    $response->assertSee('href="#demo-data-media"', false);
    $response->assertSee('href="#demo-actions"', false);
    $response->assertSee(route('templates.forms.form-kit'), false);
    $response->assertSee(route('templates.auth.login-simple'), false);
    $response->assertSee(route('templates.layouts.crud-layout'), false);
    $response->assertSee('data-section-nav', false);
    $response->assertSee('data-section-nav-button', false);
    $response->assertSee('<svg xmlns=\'http://www.w3.org/2000/svg\'', false);
    $response->assertDontSee('&lt;svg xmlns=&#039;http://www.w3.org/2000/svg&#039;', false);
    $response->assertSee('Package inventory · Manifest cache', false);
    $response->assertSee('data-sync', false);
    $response->assertSee('data-indeterminate="true"', false);
    $response->assertSee('data-module="token-input"', false);
    $response->assertSee('data-module="editable-grid"', false);
    $response->assertSee('data-module="ordered-list"', false);
    $response->assertSee('data-module="multi-select"', false);
    $response->assertSee('daisy-multi-select', false);
    $response->assertSee('name="demo_countries[]"', false);
    $response->assertSee('name="demo_segments[]"', false);
    $response->assertSee('Multiple bordered', false);
    $response->assertSee('Roadmap éditoriale', false);
    $response->assertSee('Charts (ECharts)', false);
    $response->assertSee('Trafic d&#039;acquisition', false);
    $response->assertSee('data-daisy-chart="1"', false);
    $response->assertSee('Mix de revenus', false);
    $response->assertSee('Charge support', false);
    $response->assertSee('Pipeline équipe produit', false);
    $response->assertSee('Annuaire synchronisé avec sélection', false);
    $response->assertSee('Sélection multipage', false);
    $response->assertSee('data-table-selection-feedback', false);
    $response->assertSee('data-table-select-filtered', false);
    $response->assertSee('data-table-bulk-actions', false);
    $response->assertSee('Exporter la sélection', false);
    $response->assertSee('"selection":{"enabled":true,"mode":"multiple","rowKey":"id"}', false);
    $response->assertSee('"selectedIds":["1","8"]', false);
    $response->assertSee('Programmes avec sous-lignes', false);
    $response->assertSee('Planning éditable', false);
    $response->assertSee('data-table-row-detail', false);
    $response->assertSee('data-table-resize="name"', false);
    $response->assertSee('data-table-edit-cell', false);
    $response->assertSee('data-table-filter-type="date"', false);
    $response->assertSee('data-table-filter-type="date-range"', false);
    $response->assertSee('"searchMode":"includes"', false);
    $response->assertSee('"subRowsKey":"children"', false);
    $response->assertSee('"columnResizing":true', false);
    $response->assertSee('"editable":{"enabled":true', false);
    $response->assertSee('demo\\/table\\/api\\/update', false);
    $response->assertSee('Checklist support', false);
    $response->assertSee('Editable Grid', false);
    $response->assertSee('data-transfer-handle', false);
    $response->assertSee('"float":true', false);
    $response->assertSee('Dashboard éditable', false);
    $response->assertSee('"columnWidth":220', false);
    $response->assertSee('data-table-filter="team"', false);
    $response->assertSee('data-table-filter="active_only"', false);
    $response->assertSee('"stateKey":"demo-users-table"', false);
    $response->assertSee('"provider":"cartodb.positron"', false);
    $response->assertSee('SIG - fonds custom et couches', false);
    $response->assertSee('SIG - tournée réseau d’eau potable', false);
    $response->assertSee('Borne incendie', false);
    $response->assertSee('Conduite AEP', false);
    $response->assertSee('Zone de travaux', false);
    $response->assertSee('name="demo_geometry"', false);
    $response->assertSee('"layerControl":{"mode":"multiple"', false);
    $response->assertSee('"lockedOverlays":["readonly-area"]', false);
    $response->assertSee('"measure":{"display":"metric","showTooltip":true,"maxLabels":8,"maxLabelOffsetPx":96}', false);
    $response->assertSee('demo-leaflet-draw-controls', false);
    $response->assertSee('objectTypes', false);
    $response->assertSee('hydrant', false);
    $response->assertSee('water_main', false);
    $response->assertSee('work_zone', false);
    $response->assertSee('markerSvg', false);
    $response->assertSee('groupedToolbar', false);
    $response->assertSee('Détail de la sélection', false);
    $response->assertSee('demo-leaflet-selection-modal', false);
    $response->assertSee('demo-leaflet-selection-json', false);
    $response->assertSee('data-leaflet-selection-demo', false);
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

it('applies date range filters on the demo table endpoint', function () {
    $query = http_build_query([
        'pageIndex' => 0,
        'pageSize' => 10,
        'columnFilters' => json_encode([
            [
                'id' => 'joined_period',
                'value' => [
                    'from' => '2026-03-01',
                    'to' => '2026-03-31',
                ],
            ],
        ]),
    ]);

    $response = $this->getJson("/demo/table/api/get?{$query}");

    $response->assertSuccessful();

    expect($response->json('rowCount'))->toBe(3);
    expect(collect($response->json('rows'))->pluck('joined_at')->all())->toBe([
        '2026-03-07',
        '2026-03-14',
        '2026-03-21',
    ]);
});

it('accepts demo table edit payloads', function () {
    $response = $this->patchJson('/demo/table/api/update', [
        'rowId' => 2,
        'column' => 'status',
        'value' => 'Active',
        'dirty' => [
            'status' => 'Active',
        ],
    ]);

    $response->assertSuccessful();
    $response->assertJsonPath('row.id', 2);
    $response->assertJsonPath('row.status', 'Active');
    $response->assertJsonPath('dirty.status', 'Active');
});

it('accepts demo table creation payloads', function () {
    $response = $this->postJson('/demo/table/api/create', [
        'values' => [
            'name' => 'New demo project',
            'status' => 'Invited',
            'joined_at' => '2026-05-01',
        ],
    ]);

    $response->assertCreated();
    $response->assertJsonPath('row.id', 13);
    $response->assertJsonPath('row.name', 'New demo project');
});

it('paginates demo table rows across multiple pages', function () {
    $response = $this->getJson('/demo/table/api/get?pageIndex=1&pageSize=5');

    $response->assertSuccessful();
    $response->assertJson([
        'rowCount' => 12,
        'pageCount' => 3,
        'state' => [
            'pageIndex' => 1,
            'pageSize' => 5,
        ],
    ]);

    expect($response->json('rows'))->toHaveCount(5);
    expect($response->json('rows.0.id'))->toBe(6);
    expect($response->json('rows.4.id'))->toBe(10);
});

it('returns every expected calendar event without skipping days after long events', function () {
    $response = $this->getJson('/demo/api/calendar-events?start=2026-01-01&end=2026-02-01');

    $response->assertSuccessful();

    $events = collect($response->json());

    expect($events->pluck('title')->all())->toContain(
        'All Day Event',
        'Long Event',
        'Meeting',
        'Birthday Party',
        'Click for Google',
    );
    expect($events->firstWhere('title', 'Long Event'))->toMatchArray([
        'start' => '2026-01-07',
        'end' => '2026-01-14',
    ]);
    expect($events->firstWhere('title', 'Meeting'))->toMatchArray([
        'start' => '2026-01-12 10:30',
        'end' => '2026-01-12 12:30',
    ]);
});

it('returns JSON payloads for the remaining demo interaction endpoints', function () {
    $this->getJson('/demo/datatable/api/get?pageIndex=0&pageSize=3')
        ->assertSuccessful()
        ->assertJsonPath('state.pageSize', 3);

    $this->getJson('/demo/api/tree-children?node=b')
        ->assertSuccessful()
        ->assertJsonFragment(['id' => 'b2']);

    $this->getJson('/demo/api/tree-search?q=b2')
        ->assertSuccessful()
        ->assertJsonStructure(['paths']);

    $this->getJson('/demo/api/select-options?q=@')
        ->assertSuccessful()
        ->assertJsonStructure(['groups', 'meta' => ['more']]);

    $this->getJson('/demo/api/chat/messages/1')
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonStructure(['data' => [['id', 'user_id', 'content']]]);

    $this->postJson('/demo/api/chat/typing')
        ->assertSuccessful()
        ->assertJsonPath('success', true);

    $this->postJson('/demo/api/chat/send', [
        'conversation_id' => 1,
        'content' => 'Message de test',
    ])
        ->assertSuccessful()
        ->assertJsonPath('success', true)
        ->assertJsonPath('message.content', 'Message de test');
});
