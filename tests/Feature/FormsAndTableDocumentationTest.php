<?php

it('renders the published table contract with deterministic rows', function (): void {
    $this->get('/table')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="table"', false)
        ->assertSee('data-daisy-kit-table-filter', false)
        ->assertSee('Ada Lovelace')
        ->assertSee('Filtered server result')
        ->assertSee('Unavailable source')
        ->assertSee('Inline editing')
        ->assertSee('Custom cells and applied filters')
        ->assertSee('@daisy-kit/table.js');
});

it('renders four populated multi-page examples with custom cells and complete directory filters', function (): void {
    $html = $this->get('/table')->assertOk()->getContent();
    preg_match_all('/<script data-daisy-kit-config type="application\/json">(.*?)<\/script>/s', $html, $matches);
    $tables = array_values(array_filter(
        array_map(fn (string $json): array => json_decode($json, true, flags: JSON_THROW_ON_ERROR), $matches[1]),
        fn (array $config): bool => isset($config['columns']),
    ));

    expect($tables)->toHaveCount(5);

    foreach ([0, 2, 3] as $index) {
        expect($tables[$index]['rows'])->toHaveCount(60);
        expect($tables[$index]['pageSize'])->toBe(5);
        expect($tables[$index]['pageSizeOptions'])->toBe([5, 10, 25, 50, 100]);
    }

    foreach ($tables[0]['columns'] as $column) {
        expect($column['filter']['type'])->not->toBeEmpty();
    }

    expect($tables[0]['selection']['summaryVisibility'])->toBe('after-first-selection');
    expect($tables[1]['mode'])->toBe('server');
    expect($tables[3]['rows'][0]['name'])->toContain('Ada Lovelace', 'London', 'text-base-content/60');
    expect($tables[3]['filterMode'])->toBe('manual');
});

it('returns a distinct last server page and rejects unsupported page sizes', function (): void {
    $firstPage = $this->getJson('/fixtures/table?pageSize=50')->assertOk()->json('rows');
    $lastPage = $this->getJson('/fixtures/table?pageSize=50&page=2')
        ->assertOk()->assertJsonCount(10, 'rows')->assertJsonPath('total', 60)->json('rows');

    expect(array_intersect(array_column($firstPage, 'id'), array_column($lastPage, 'id')))->toBeEmpty();
    $this->getJson('/fixtures/table?pageSize=500')->assertUnprocessable()->assertJsonValidationErrors('pageSize');
});

it('accepts every advertised page size and returns enough rows to exercise pagination', function (int $size): void {
    $this->getJson("/fixtures/table?pageSize={$size}")
        ->assertOk()
        ->assertJsonCount(min($size, 60), 'rows')
        ->assertJsonPath('total', 60);
})->with([5, 10, 25, 50, 100]);

it('combines the contributor text filter with role and status filters on the server', function (): void {
    $query = http_build_query([
        'columnFilters' => json_encode([
            ['id' => 'name', 'value' => 'Ada'],
            ['id' => 'role', 'value' => 'Reviewer'],
            ['id' => 'status', 'value' => 'active'],
        ]),
    ]);

    $this->getJson("/fixtures/table?{$query}")
        ->assertOk()
        ->assertJsonPath('total', 0)
        ->assertJsonCount(0, 'rows');
});
