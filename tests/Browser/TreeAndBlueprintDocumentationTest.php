<?php

it('operates the real tree with the keyboard', function (): void {
    visit('/tree')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->keys('#workspace-navigation [data-daisy-kit-tree-node="workspace"]', 'ArrowRight')
        ->assertScript("document.activeElement?.dataset.daisyKitTreeNode === 'forms'", true)
        ->click('#workspace-navigation [data-daisy-kit-tree-node="table"]')
        ->assertScript("document.querySelector('#workspace-navigation [data-daisy-kit-tree-node=table]').getAttribute('aria-checked') === 'true'", true)
        ->assertScript("document.querySelector('#workspace-navigation input[type=hidden]').value.includes('table')", true)
        ->keys('#lazy-media-branch [data-daisy-kit-tree-node="media"]', 'ArrowRight')
        ->wait(1)
        ->assertSeeIn('#lazy-media-branch', 'office-plan.png')
        ->typeSlowly('#search-result [data-daisy-kit-tree-search]', 'Forms', 20)
        ->wait(1)
        ->assertSeeIn('#search-result', 'Forms')
        ->assertScript("performance.getEntriesByType('resource').some((entry) => entry.name.includes('/fixtures/tree?query=Forms'))", true)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');

it('returns deterministic remote tree search results', function (string $query, string $expected): void {
    $requestFragment = json_encode("/fixtures/tree?query={$query}", JSON_THROW_ON_ERROR);

    visit('/tree')
        ->waitForEvent('networkidle')
        ->typeSlowly('#search-result [data-daisy-kit-tree-search]', $query, 20)
        ->wait(1)
        ->assertSeeIn('#search-result', $expected)
        ->assertScript("performance.getEntriesByType('resource').some((entry) => entry.name.includes({$requestFragment}))", true)
        ->assertNoSmoke();
})->with([
    'nested module' => ['Forms', 'Forms'],
    'guide' => ['guide', 'Developer guide'],
    'lazy media item' => ['office', 'office-plan.png'],
])->group('browser');

it('operates the real blueprint with the keyboard', function (): void {
    visit('/blueprint')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("window.__blueprintSelection = null; document.querySelector('#editorial-workflow [data-daisy-kit-module=blueprint]').addEventListener('daisy-kit:blueprint:select', (event) => { window.__blueprintSelection = event.detail.id; }); true", true)
        ->keys('#editorial-workflow [data-daisy-kit-blueprint-node-control][data-node-id="draft"]', 'ArrowRight')
        ->assertScript("document.activeElement?.dataset.nodeId === 'editorial-review'", true)
        ->keys('#editorial-workflow [data-daisy-kit-blueprint-node-control][data-node-id="editorial-review"]', 'Enter')
        ->assertScript("document.activeElement?.getAttribute('aria-pressed') === 'true'", true)
        ->assertScript("window.__blueprintSelection === 'editorial-review'", true)
        ->click('#editorial-workflow [data-daisy-kit-blueprint-editor]')
        ->keys('#editorial-workflow [data-daisy-kit-blueprint-editor]', 'Meta+A')
        ->typeSlowly('#editorial-workflow [data-daisy-kit-blueprint-editor]', 'EditorialApproval', 20)
        ->keys('#editorial-workflow [data-daisy-kit-blueprint-editor]', 'Tab')
        ->assertScript("JSON.parse(document.querySelector('#editorial-workflow [data-daisy-kit-blueprint-value]').value).nodes.find((node) => node.id === 'editorial-review').label", 'EditorialApproval')
        ->assertScript("document.querySelectorAll('#editorial-workflow [data-daisy-kit-blueprint-node-control]').length", 5)
        ->click('#editorial-workflow [data-daisy-kit-blueprint-structure="add-node"]')
        ->assertScript("document.querySelectorAll('#editorial-workflow [data-daisy-kit-blueprint-node-control]').length", 6)
        ->assertScript("JSON.parse(document.querySelector('#editorial-workflow [data-daisy-kit-blueprint-value]').value).nodes.some((node) => node.id === 'node-6')", true)
        ->click('#editorial-workflow [data-daisy-kit-blueprint-history="undo"]')
        ->assertScript("document.querySelectorAll('#editorial-workflow [data-daisy-kit-blueprint-node-control]').length", 5)
        ->click('#editorial-workflow [data-daisy-kit-blueprint-history="redo"]')
        ->assertScript("document.querySelectorAll('#editorial-workflow [data-daisy-kit-blueprint-node-control]').length", 6)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');
