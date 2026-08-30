<?php

it('filters the real package table and retains keyboard focus', function (): void {
    visit('/table')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->type('#contributor-directory [data-daisy-kit-table-filter]', 'Grace')
        ->assertScript("document.activeElement.matches('#contributor-directory [data-daisy-kit-table-filter]')", true)
        ->assertScript("document.querySelector('#contributor-directory [data-daisy-kit-module=table]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('#filtered-server-result [data-daisy-kit-module=table]').dataset.daisyKitState === 'ready'", true)
        ->assertCount('[data-daisy-kit-module="table"]', 3)
        ->assertCount('#contributor-directory .daisy-kit-table__pagination', 1)
        ->assertSee('Grace Hopper')
        ->assertSeeIn('#filtered-server-result', 'Ada Lovelace')
        ->click('#contributor-directory [data-daisy-kit-table-row-select="grace"]')
        ->assertScript("document.querySelector('#contributor-directory [data-daisy-kit-table-row-select=grace]').checked", true)
        ->click('#contributor-directory [data-daisy-kit-table-detail-toggle="grace"]')
        ->assertScript("!document.querySelector('#contributor-directory [data-daisy-kit-table-detail=grace]').hidden", true)
        ->click('#contributor-directory [data-daisy-kit-table-edit="grace:name"]')
        ->fill('#contributor-directory [data-daisy-kit-table-edit-input="grace:name"]', 'Grace Murray Hopper')
        ->click('#contributor-directory [data-daisy-kit-table-edit-save="grace:name"]')
        ->assertSee('Grace Murray Hopper')
        ->assertNoAccessibilityIssues(1)
        ->assertNoSmoke();
})->group('browser');
