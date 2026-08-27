<?php

it('renders the sandboxed local file preview at narrow and wide widths', function (): void {
    $page = visit('/file-preview');

    $page->resize(320, 800)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('[data-daisy-kit-module=file-preview]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("!document.querySelector('[data-daisy-kit-file-preview-frame]').sandbox.contains('allow-same-origin')", true)
        ->assertScript("document.querySelector('[data-daisy-kit-file-preview-frame]').srcdoc.includes('file-preview-frame')", true)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();

    $page->resize(1440, 960)
        ->assertSee('Common options');
})->group('browser');

it('mounts the map with drawing controls at tablet and desktop widths', function (): void {
    $page = visit('/map');

    $page->resize(768, 900)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('[data-daisy-kit-module=map]').dataset.daisyKitState === 'ready'", true)
        ->click('[data-daisy-kit-map-mode="linestring"]')
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();

    $page->resize(1024, 900)
        ->assertSee('Common options');
})->group('browser');
