<?php

it('operates the real tree with the keyboard', function (): void {
    visit('/tree')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->keys('[data-daisy-kit-tree-node="documentation"]', ['ArrowRight', 'ArrowRight'])
        ->assertScript("document.activeElement?.dataset.daisyKitTreeNode === 'readme'", true)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');

it('operates the real blueprint with the keyboard', function (): void {
    visit('/blueprint')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("window.__blueprintSelection = null; document.querySelector('[data-daisy-kit-module=blueprint]').addEventListener('daisy-kit:blueprint:select', (event) => { window.__blueprintSelection = event.detail.id; }); true", true)
        ->keys('[data-daisy-kit-blueprint-node-control][data-node-id="draft"]', 'ArrowRight')
        ->assertScript("document.activeElement?.dataset.nodeId === 'editorial-review'", true)
        ->keys('[data-daisy-kit-blueprint-node-control][data-node-id="editorial-review"]', 'Enter')
        ->assertScript("document.activeElement?.getAttribute('aria-pressed') === 'true'", true)
        ->assertScript("window.__blueprintSelection === 'editorial-review'", true)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');
