<?php

it('renders the complete sandboxed file preview contract at narrow and wide widths', function (): void {
    $page = visit('/file-preview');
    $image = '#media-previews [data-daisy-kit-module="file-preview"][aria-label="Office plan.svg"]';
    $custom = '[data-file-preview-instance="customer-handoff"]';
    $customDialog = "{$custom} [data-daisy-kit-file-preview-modal]";

    $page->resize(320, 800)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('{$image}').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('#media-previews [aria-label=\"Interview excerpt.wav\"]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("!document.querySelector('{$image} [data-daisy-kit-file-preview-frame]').sandbox.contains('allow-same-origin')", true)
        ->click("{$image} [data-daisy-kit-file-preview-open-preview]")
        ->assertScript(<<<JS
            (() => {
                const dialog = document.querySelector('{$image} dialog');
                const box = dialog.querySelector('[data-daisy-kit-file-preview-modal-box]');
                const frame = dialog.querySelector('[data-daisy-kit-file-preview-frame]');

                return dialog.open
                    && box.contains(frame)
                    && box.getBoundingClientRect().right <= window.innerWidth;
            })()
            JS, true)
        ->click("{$image} header [data-daisy-kit-file-preview-close-preview]")
        ->click('[data-file-preview-open-external="customer-handoff"]')
        ->assertScript("document.querySelector('{$customDialog}').open", true)
        ->assertScript("document.querySelector('{$custom}').dataset.daisyKitPreviewOpen === 'true'", true)
        ->keys($customDialog, 'Escape')
        ->assertScript("!document.querySelector('{$customDialog}').open", true)
        ->assertScript("document.activeElement.matches('[data-file-preview-open-external]')", true)
        ->click('#document-previews [aria-label="Editorial brief.docx"] [data-daisy-kit-file-preview-open-preview]')
        ->assertScript("document.querySelector('#document-previews [aria-label=\"Editorial brief.docx\"] dialog').open", true)
        ->click('#document-previews [aria-label="Editorial brief.docx"] [data-daisy-kit-file-preview-zoom="in"]')
        ->assertScript("document.querySelector('#document-previews [aria-label=\"Editorial brief.docx\"]').dataset.daisyKitZoom === '110'", true)
        ->assertScript("document.querySelector('#preview-errors [aria-label=\"Invalid contract.pdf\"]').dataset.daisyKitState === 'error'", true)
        ->assertScript("document.querySelector('#preview-errors [aria-label=\"Oversized report.txt\"]').dataset.daisyKitState === 'error'", true)
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
