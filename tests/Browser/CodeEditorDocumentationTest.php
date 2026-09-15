<?php

it('keeps the expanded title inside the editor and pairs JavaScript delimiters', function (): void {
    $page = visit('/code-editor')->resize(1280, 900)->waitForEvent('networkidle');

    $page->assertCount('[data-daisy-kit-module=code-editor] .cm-content', 3)
        ->assertSee('settings.json')
        ->assertSee('projects.js')
        ->assertSee('ReleaseSummary.php')
        ->assertSee('Expand editor')
        ->click('[data-daisy-kit-module=code-editor]:has(textarea[name=configuration]) [data-code-editor-action=expand]')
        ->assertSee('Collapse editor')
        ->assertScript(<<<'JS'
            (() => {
                const root = document.querySelector('.daisy-kit-code-editor--expanded');
                const bounds = root.getBoundingClientRect();
                const title = root.querySelector('legend').getBoundingClientRect();
                return title.top >= bounds.top && title.bottom <= bounds.bottom
                    && title.left >= bounds.left && title.right <= bounds.right;
            })()
            JS)
        ->screenshot(false, 'code-editor-demo-expanded')
        ->click('.daisy-kit-code-editor--expanded [data-code-editor-minimize]')
        ->assertCount('.daisy-kit-code-editor--expanded', 0)
        ->fill('[data-daisy-kit-module=code-editor]:has(textarea[name=project_summary]) .cm-content', '')
        ->keys('[data-daisy-kit-module=code-editor]:has(textarea[name=project_summary]) .cm-content', '(')
        ->assertScript('document.querySelector("textarea[name=project_summary]").value === "()"')
        ->assertScript('document.querySelector("textarea[readonly]").value.includes("final class ReleaseSummary")')
        ->assertNoJavaScriptErrors()
        ->assertNoSmoke();
})->group('browser');
