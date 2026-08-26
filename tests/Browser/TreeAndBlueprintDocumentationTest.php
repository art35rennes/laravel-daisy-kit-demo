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
        ->keys('[data-node-id="draft"]', 'ArrowRight')
        ->assertScript("document.activeElement?.dataset.nodeId === 'review'", true)
        ->keys('[data-node-id="review"]', 'Enter')
        ->assertScript("document.activeElement?.getAttribute('aria-pressed') === 'true'", true)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');
