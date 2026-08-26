<?php

dataset('module-scenarios', [
    'forms' => ['/forms', ['Contributor profile', 'Preference variant', 'Invalid submission']],
    'table' => ['/table', ['Contributor directory', 'Filtered server result', 'Unavailable source']],
    'tree' => ['/tree', ['Workspace navigation', 'Lazy media branch', 'Search result']],
    'blueprint' => ['/blueprint', ['Editorial workflow', 'Inspector selection', 'Read-only review']],
    'file preview' => ['/file-preview', ['Text report', 'Document gallery', 'Rejected file']],
    'map' => ['/map', ['Office workspace', 'Layers and markers', 'Draw and measure']],
]);

it('renders visible representative scenarios for each module', function (string $uri, array $scenarioTitles): void {
    $response = $this->get($uri);

    $response->assertOk();

    foreach ($scenarioTitles as $scenarioTitle) {
        $response->assertSee($scenarioTitle);
    }
})->with('module-scenarios');
