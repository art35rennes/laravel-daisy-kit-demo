<?php

it('renders the complete sandboxed file preview contract at narrow and wide widths', function (): void {
    $page = visit('/file-preview');
    $image = '#media-previews [data-daisy-kit-module="file-preview"][aria-label="Office plan.svg"]';
    $video = '#media-previews [data-daisy-kit-module="file-preview"][aria-label="Preview walkthrough.mp4"]';
    $pdf = '#document-previews [data-daisy-kit-module="file-preview"][aria-label="Release notes.pdf"]';
    $pdfDialog = "{$pdf} [data-daisy-kit-file-preview-modal]";
    $docx = '#document-previews [data-daisy-kit-module="file-preview"][aria-label="Editorial brief.docx"]';
    $docxDialog = "{$docx} [data-daisy-kit-file-preview-modal]";
    $custom = '[data-file-preview-instance="customer-handoff"]';
    $customDialog = "{$custom} [data-daisy-kit-file-preview-modal]";

    $page->resize(320, 800)
        ->waitForEvent('networkidle')
        ->wait(1)
        ->assertScript("document.querySelector('{$image}').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('#media-previews [aria-label=\"Interview excerpt.wav\"]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('{$video}').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('{$pdf}').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('{$docx}').dataset.daisyKitState === 'ready'", true)
        ->click("{$video} [data-daisy-kit-file-preview-open-preview]")
        ->withinFrame("{$video} [data-daisy-kit-file-preview-frame]", function ($frame): void {
            $frame->assertScript("document.querySelector('video')?.src.startsWith('blob:')", true);
        })
        ->click("{$video} header [data-daisy-kit-file-preview-close-preview]")
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
        ->click("{$docx} [data-daisy-kit-file-preview-open-preview]")
        ->assertScript("document.querySelector('{$docxDialog}').open", true)
        ->assertScript("document.querySelector('{$docxDialog} [data-daisy-kit-file-preview-modal-download]').download === 'Editorial brief.docx'", true)
        ->withinFrame("{$docxDialog} [data-daisy-kit-file-preview-frame]", function ($frame): void {
            $frame->assertScript(<<<'JS'
                (() => {
                    const pages = [...document.querySelectorAll('.docx-wrapper > section.docx')];
                    const scrollingElement = document.scrollingElement;

                    document.documentElement.dataset.initialDocxWidth = String(pages[0]?.getBoundingClientRect().width ?? 0);

                    return pages.length >= 3
                        && scrollingElement.scrollHeight > scrollingElement.clientHeight;
                })()
                JS, true);
        })
        ->click("{$docxDialog} [data-daisy-kit-file-preview-zoom=\"fit\"]")
        ->withinFrame("{$docxDialog} [data-daisy-kit-file-preview-frame]", function ($frame): void {
            $frame->assertScript(<<<'JS'
                (() => {
                    const page = document.querySelector('.docx-wrapper > section.docx');
                    const bounds = page?.getBoundingClientRect();

                    return bounds
                        && bounds.left >= 0
                        && bounds.right <= document.documentElement.clientWidth + 1
                        && document.documentElement.scrollWidth <= document.documentElement.clientWidth + 1;
                })()
                JS, true);
        })
        ->assertScript("(() => { const root = document.querySelector('{$docx}'); root.dataset.fitZoom = root.dataset.daisyKitZoom; return Number(root.dataset.fitZoom) >= 25; })()", true)
        ->click("{$docxDialog} [data-daisy-kit-file-preview-zoom=\"in\"]")
        ->assertScript("(() => { const root = document.querySelector('{$docx}'); return Number(root.dataset.daisyKitZoom) === Number(root.dataset.fitZoom) + 10; })()", true)
        ->withinFrame("{$docxDialog} [data-daisy-kit-file-preview-frame]", function ($frame): void {
            $frame->assertScript(<<<'JS'
                (() => {
                    const initialWidth = Number(document.documentElement.dataset.initialDocxWidth);
                    const currentWidth = document.querySelector('.docx-wrapper > section.docx')?.getBoundingClientRect().width ?? 0;

                    return initialWidth > 0 && currentWidth > initialWidth * 1.05;
                })()
                JS, true);
        })
        ->click("{$docxDialog} header [data-daisy-kit-file-preview-close-preview]")
        ->click("{$pdf} [data-daisy-kit-file-preview-open-preview]")
        ->assertScript("document.querySelector('{$pdfDialog}').open", true)
        ->assertScript("document.querySelector('{$pdfDialog} [data-daisy-kit-file-preview-modal-download]').download === 'Release notes.pdf'", true)
        ->withinFrame("{$pdfDialog} [data-daisy-kit-file-preview-frame]", function ($frame): void {
            $frame->assertScript(<<<'JS'
                (() => {
                    const pages = [...document.querySelectorAll('[data-daisy-kit-pdf-page]')];
                    const scrollingElement = document.scrollingElement;

                    return pages.length === 3
                        && pages.every((page) => page instanceof HTMLCanvasElement && page.width > 0 && page.height > 0)
                        && scrollingElement.scrollHeight > scrollingElement.clientHeight;
                })()
                JS, true);
        })
        ->click("{$pdfDialog} header [data-daisy-kit-file-preview-close-preview]")
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
        ->assertCount('#marker-clustering .marker-cluster', 1)
        ->assertNoSmoke()
        ->click('#osm-and-business-layers [data-daisy-kit-map-menu="layers"] > summary')
        ->click('#osm-and-business-layers [data-daisy-kit-map-layer="districts"]')
        ->assertScript("!document.querySelector('#osm-and-business-layers [data-daisy-kit-map-layer=districts]').checked", true)
        ->click('#osm-and-business-layers [data-daisy-kit-map-layer="districts"]')
        ->assertScript("document.querySelector('#osm-and-business-layers [data-daisy-kit-map-layer=districts]').checked", true)
        ->assertNoSmoke()
        ->click('#drawing-and-export [data-daisy-kit-map-menu="layers"] > summary')
        ->assertScript("document.querySelector('#drawing-and-export [data-daisy-kit-map-draw-layer-visibility][value=water]').checked", true)
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-draw-layer-visibility][value=electricity]').checked", true)
        ->click('#drawing-and-export [data-daisy-kit-map-draw-layer-visibility][value="electricity"]')
        ->assertScript("Array.from(document.querySelectorAll('#drawing-and-export [data-daisy-kit-map-draw-layer-visibility]')).every((control) => control.checked)", true)
        ->click('#drawing-and-export [data-daisy-kit-map-draw-layer-visibility][value="water"]')
        ->assertScript("document.querySelector('#drawing-and-export [data-daisy-kit-map-draw-layer]').value === 'electricity'", true)
        ->click('#drawing-and-export [data-daisy-kit-map-menu="drawing"] > summary')
        ->click('#drawing-and-export [data-daisy-kit-map-menu="geometry"] > summary')
        ->click('#drawing-and-export [data-daisy-kit-map-mode="point"]')
        ->assertScript("document.querySelector('#drawing-and-export [data-daisy-kit-map-mode=point]').getAttribute('aria-pressed') === 'true'", true)
        ->click('#drawing-and-export .leaflet-container')
        ->assertNoSmoke()
        ->click('#drawing-and-export [data-daisy-kit-map-menu="history"] > summary')
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-history=undo]').disabled", true)
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-export]').disabled", true)
        ->assertScript("JSON.parse(document.querySelector('#drawing-and-export [name=maintenance_geometry]').value).features.length === 5", true)
        ->click('#drawing-and-export [data-daisy-kit-map-history="undo"]')
        ->assertScript("!document.querySelector('#drawing-and-export [data-daisy-kit-map-history=redo]').disabled", true)
        ->click('#facade-and-persistence [data-daisy-kit-map-action="focus-depot"]')
        ->assertScript("document.querySelector('#controlled-map').dataset.docsMapFacade === 'view-updated'", true)
        ->wait(1)
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();

    $page->resize(1440, 1000)
        ->assertSee('Configuration and extension');
})->group('browser');
