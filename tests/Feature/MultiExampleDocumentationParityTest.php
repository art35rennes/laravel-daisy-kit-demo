<?php

dataset('module-scenarios', [
    'forms' => ['/forms', ['Contributor profile', 'Preference variant', 'Invalid submission']],
    'table' => ['/table', ['Contributor directory', 'Filtered server result', 'Unavailable source']],
    'tree' => ['/tree', ['Workspace navigation', 'Lazy media branch', 'Search result']],
    'blueprint' => ['/blueprint', ['Editorial workflow', 'Inspector selection', 'Read-only review']],
    'file preview' => ['/file-preview', ['Media previews', 'Document previews', 'Custom actions and public API', 'Errors and limits']],
    'map' => ['/map', ['Markers, popups and clustering', 'OSM styles and business layers', 'Drawing, measurement and form export', 'Persistence, errors and external controls']],
]);

it('renders visible representative scenarios for each module', function (string $uri, array $scenarioTitles): void {
    $response = $this->get($uri);

    $response->assertOk();

    foreach ($scenarioTitles as $scenarioTitle) {
        $response->assertSee($scenarioTitle);
    }
})->with('module-scenarios');
