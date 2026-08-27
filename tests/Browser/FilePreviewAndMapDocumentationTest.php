<?php

it('renders the sandboxed local file preview at narrow and wide widths', function (): void {
    $page = visit('/file-preview');

    $page->resize(320, 800)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('[data-daisy-kit-module=file-preview]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("!document.querySelector('[data-daisy-kit-file-preview-frame]').sandbox.contains('allow-same-origin')", true)
        ->assertScript("document.querySelector('[data-daisy-kit-file-preview-frame]').srcdoc.includes('file-preview-frame')", true)
        ->click('#text-report [data-daisy-kit-file-preview-open-preview]')
        ->assertScript("document.querySelector('#text-report dialog').open", true)
        ->assertScript("document.querySelector('#text-report [data-daisy-kit-module=file-preview]').dataset.daisyKitPreviewOpen === 'true'", true)
        ->assertScript("document.activeElement.matches('#text-report [data-daisy-kit-file-preview-close-preview]')", true)
        ->keys('#text-report dialog', 'Escape')
        ->assertScript("!document.querySelector('#text-report dialog').open", true)
        ->assertScript("document.activeElement.matches('#text-report [data-daisy-kit-file-preview-open-preview]')", true)
        ->click('#document-gallery [aria-label="Editorial brief"] [data-daisy-kit-file-preview-open-preview]')
        ->assertScript("document.querySelector('#document-gallery [aria-label=\"Editorial brief\"] dialog').open", true)
        ->assertScript("document.querySelector('#rejected-file [data-daisy-kit-module=file-preview]').dataset.daisyKitState === 'error'", true)
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
        ->click('#layers-and-markers [data-daisy-kit-map-layer="route"]')
        ->assertScript("!document.querySelector('#layers-and-markers [data-daisy-kit-map-layer=route]').checked", true)
        ->click('#layers-and-markers [data-daisy-kit-map-layer="route"]')
        ->assertScript("document.querySelector('#layers-and-markers [data-daisy-kit-map-layer=route]').checked", true)
        ->click('#draw-and-measure [data-daisy-kit-map-mode="point"]')
        ->click('#draw-and-measure .leaflet-container')
        ->assertScript("!document.querySelector('#draw-and-measure [data-daisy-kit-map-history=undo]').disabled", true)
        ->assertScript("!document.querySelector('#draw-and-measure [data-daisy-kit-map-export]').disabled", true)
        ->click('#draw-and-measure [data-daisy-kit-map-history="undo"]')
        ->assertScript("!document.querySelector('#draw-and-measure [data-daisy-kit-map-history=redo]').disabled", true)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();

    $page->resize(1024, 900)
        ->assertSee('Common options');
})->group('browser');
