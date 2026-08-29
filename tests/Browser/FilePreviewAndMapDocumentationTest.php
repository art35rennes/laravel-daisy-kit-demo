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

it('exercises typed layers, drawing and the public map facade', function (): void {
    $page = visit('/map');

    $page->resize(390, 844)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("Array.from(document.querySelectorAll('[data-daisy-kit-module=map]')).filter((root) => root.dataset.daisyKitState === 'ready').length === 3", true)
        ->assertScript("document.querySelector('#controlled-map').dataset.daisyKitState === 'error'", true)
        ->assertScript("!document.querySelector('#controlled-map [data-daisy-kit-map-error]').hidden", true)
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth', true)
        ->assertScript("document.querySelectorAll('#marker-clustering .leaflet-tile').length > 0 && Array.from(document.querySelectorAll('#marker-clustering .leaflet-tile')).every((tile) => tile.src.includes('/fixtures/map/tiles/light/'))", true)
        ->assertCount('#marker-clustering .marker-cluster', 1)
        ->click('#basemaps-and-layers [data-daisy-kit-map-layer-menu] summary')
        ->click('#basemaps-and-layers [data-daisy-kit-map-layer="districts"]')
        ->assertScript("!document.querySelector('#basemaps-and-layers [data-daisy-kit-map-layer=districts]').checked", true)
        ->click('#basemaps-and-layers [data-daisy-kit-map-layer="districts"]')
        ->assertScript("document.querySelector('#basemaps-and-layers [data-daisy-kit-map-layer=districts]').checked", true)
        ->click('#drawing-and-export [data-daisy-kit-map-mode="point"]')
        ->assertScript("document.querySelector('#drawing-and-export [data-daisy-kit-map-mode=point]').getAttribute('aria-pressed') === 'true'", true)
        ->click('#drawing-and-export .leaflet-container')
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-history=undo]').disabled", true)
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-export]').disabled", true)
        ->assertScript("JSON.parse(document.querySelector('#drawing-and-export [name=maintenance_geometry]').value).features.length === 1", true)
        ->click('#drawing-and-export [data-daisy-kit-map-history="undo"]')
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-history=redo]').disabled", true)
        ->click('#facade-and-persistence [data-doc-map-action="view"]')
        ->assertScript("document.querySelector('#controlled-map').dataset.docsMapFacade === 'view-updated'", true)
        ->wait(1)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();

    $page->resize(1440, 1000)
        ->assertSee('Configuration and extension');
})->group('browser');
