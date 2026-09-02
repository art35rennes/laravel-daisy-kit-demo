<?php

it('announces a refused clipboard request accessibly', function (): void {
    $page = visit('/copyable')->waitForEvent('networkidle');
    $page->script(<<<'JS'
        Object.defineProperty(navigator, 'clipboard', { configurable: true, value: {
            writeText: async () => { throw new DOMException('Denied', 'NotAllowedError'); },
        } });
        document.querySelector('#copyable-example-1').addEventListener('daisy-kit:copyable:error', (event) => {
            const status = event.currentTarget.querySelector('[role=status]');
            window.copyFailure = { code: event.detail.code, message: status.textContent, announced: !status.hidden };
        });
        JS);

    $page
        ->assertCount('#copyable-example-1 [data-daisy-kit-copyable-icon]', 1)
        ->click('#copyable-example-1 [data-daisy-kit-copyable-button]')
        ->assertScript("window.copyFailure.code === 'clipboard-rejected' && window.copyFailure.announced && window.copyFailure.message === 'Copying failed.' && document.querySelector('#copyable-example-1 [data-daisy-kit-status]').classList.contains('badge-error')")
        ->assertNoSmoke();
})->group('browser');

it('shows and automatically hides successful Copyable feedback', function (): void {
    $page = visit('/copyable')->waitForEvent('networkidle');
    $page->script(<<<'JS'
        Object.defineProperty(navigator, 'clipboard', { configurable: true, value: {
            writeText: async () => undefined,
        } });
        JS);

    $page
        ->click('#copyable-example-1 [data-daisy-kit-copyable-button]')
        ->assertScript("(() => { const status = document.querySelector('#copyable-example-1 [data-daisy-kit-status]'); return !status.hidden && status.textContent === 'Invoice reference copied.' && status.classList.contains('badge-success'); })()")
        ->assertScript("document.querySelector('#copyable-example-1 [data-daisy-kit-status]').hidden")
        ->assertNoSmoke();
})->group('browser');

it('selects a reviewer with the keyboard and submits its Laravel value', function (): void {
    visit('/combobox')->waitForEvent('networkidle')
        ->fill('#combobox-example-1 [role=combobox]', 'Grace')
        ->keys('#combobox-example-1 [role=combobox]', ['ArrowDown', 'Enter'])
        ->assertScript("new FormData(document.querySelector('#combobox-example-1 form')).get('reviewer') === 'grace'")
        ->keys('#combobox-example-1 [role=combobox]', 'Escape')
        ->click('#combobox-example-1 button[type=submit]')
        ->assertQueryStringHas('reviewer', 'grace')
        ->assertNoSmoke();
})->group('browser');

it('transfers and reorders assigned reviewers without dragging', function (): void {
    visit('/transfer-list')->waitForEvent('networkidle')
        ->keys('#transfer-list-example-1 [data-daisy-kit-transfer-source] [data-value=ada]', ['ArrowRight'])
        ->keys('#transfer-list-example-1 [data-daisy-kit-transfer-target] [data-value=ada]', 'Alt+ArrowUp')
        ->assertScript("JSON.stringify(new FormData(document.querySelector('#transfer-list-example-1 form')).getAll('reviewers[]')) === JSON.stringify(['ada', 'grace'])")
        ->assertScript("document.activeElement.dataset.value === 'ada'")
        ->assertNoSmoke();
})->group('browser');

it('reveals selectable overflow text but keeps short text compact', function (): void {
    visit('/truncate')->waitForEvent('networkidle')
        ->click('Read full release notes')
        ->assertScript("document.querySelector('#truncate-example-1 [popover]').matches(':popover-open')")
        ->assertSee('without introducing a form engine')
        ->assertScript("document.querySelector('#truncate-example-2 [data-daisy-kit-truncate-reveal]').hidden")
        ->assertNoSmoke();
})->group('browser');

it('follows document headings through the native navigation', function (): void {
    visit('/scrollspy')->waitForEvent('networkidle')
        ->click('[data-daisy-kit-module=scrollspy] a[href="#guide-review"]')
        ->assertScript("document.querySelector('[data-daisy-kit-module=scrollspy] [aria-current=location]').hash === '#guide-review'")
        ->assertNoSmoke();
})->group('browser');
