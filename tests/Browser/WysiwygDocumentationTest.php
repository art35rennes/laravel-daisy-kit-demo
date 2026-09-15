<?php

it('edits and resets the Trix draft with an independent read-only preview', function (): void {
    $page = visit('/wysiwyg')->waitForEvent('networkidle');

    $page->assertCount('[data-daisy-kit-module=wysiwyg] trix-editor', 2)
        ->click('[data-daisy-kit-module=wysiwyg] trix-editor:not([aria-readonly])')
        ->keys('[data-daisy-kit-module=wysiwyg] trix-editor:not([aria-readonly])', 'Control+End')
        ->typeSlowly('[data-daisy-kit-module=wysiwyg] trix-editor:not([aria-readonly])', 'Ready for review.', 10)
        ->assertScript("new FormData(document.querySelector('main form')).get('article_body').includes('Ready for review.')")
        ->assertScript("document.querySelector('[data-theme=dark] trix-editor').getAttribute('contenteditable') === 'false'")
        ->click('button[type=reset]')
        ->assertScript("!new FormData(document.querySelector('main form')).get('article_body').includes('Ready for review.')")
        ->select('[data-theme-select]', 'dark')
        ->resize(390, 844)
        ->assertScript('document.documentElement.scrollWidth <= window.innerWidth')
        ->assertNoJavaScriptErrors()
        ->assertNoSmoke();
})->group('browser');
