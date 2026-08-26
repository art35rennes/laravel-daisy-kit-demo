<?php

it('mounts the real forms viewer and builder without a Livewire dependency in the viewer', function (): void {
    visit('/forms')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('[data-daisy-kit-module=forms-viewer]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('[data-daisy-kit-module=forms-builder]').dataset.daisyKitState === 'ready'", true)
        ->fill('[data-daisy-kit-module=forms-viewer] input[name=name]', 'Ada Byron')
        ->assertScript("document.querySelector('[data-daisy-kit-module=forms-viewer] input[name=name]').value === 'Ada Byron'", true)
        ->click('[data-daisy-kit-module=forms-builder] button')
        ->assertCount('[data-daisy-kit-module=forms-builder] [data-daisy-kit-builder-index]', 4)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');

it('filters the real package table and retains keyboard focus', function (): void {
    visit('/table')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->type('[aria-labelledby="table-example-heading"] [data-daisy-kit-table-filter]', 'Grace')
        ->assertScript("document.activeElement.matches('[aria-labelledby=table-example-heading] [data-daisy-kit-table-filter]')", true)
        ->assertScript("document.querySelector('[data-daisy-kit-module=table]').dataset.daisyKitState === 'ready'", true)
        ->assertCount('[data-daisy-kit-module="table"]', 1)
        ->assertCount('nav[aria-label="Table pagination"]', 1)
        ->assertSee('Grace Hopper')
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');
