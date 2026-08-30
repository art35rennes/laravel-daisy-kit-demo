<?php

it('filters the real package table and retains keyboard focus', function (): void {
    visit('/table')
        ->waitForEvent('networkidle')
        ->wait(1)
        ->type('#contributor-directory [data-daisy-kit-table-filter]', 'Grace')
        ->assertScript("document.activeElement.matches('#contributor-directory [data-daisy-kit-table-filter]')", true)
        ->assertScript("document.querySelector('#contributor-directory [data-daisy-kit-module=table]').dataset.daisyKitState === 'ready'", true)
        ->assertScript("document.querySelector('#filtered-server-result [data-daisy-kit-module=table]').dataset.daisyKitState === 'ready'", true)
        ->assertCount('[data-daisy-kit-module="table"]', 5)
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

it('changes every advertised client and server page size and reaches the last page', function (): void {
    $page = visit('/table')->waitForEvent('networkidle');

    foreach (['contributor-directory', 'filtered-server-result'] as $example) {
        foreach ([10, 25, 50, 100, 5] as $size) {
            $count = min($size, 60);
            $page->select("#{$example} [data-daisy-kit-table-page-size]", (string) $size)
                ->assertSeeIn("#{$example} [data-daisy-kit-table-results]", __('daisy-kit::table.showing_results', ['from' => 1, 'to' => $count, 'total' => 60]))
                ->assertCount("#{$example} [data-daisy-kit-table-row-select]", $count);
        }

        $page->select("#{$example} [data-daisy-kit-table-page-size]", '50')
            ->click("#{$example} [data-daisy-kit-table-next]")
            ->assertSeeIn("#{$example} [data-daisy-kit-table-results]", __('daisy-kit::table.showing_results', ['from' => 51, 'to' => 60, 'total' => 60]))
            ->assertCount("#{$example} [data-daisy-kit-table-row-select]", 10);
    }

    $page->assertNoSmoke();
})->group('browser');

it('reveals selection feedback only after the first selection and retains off-page counts', function (): void {
    visit('/table')
        ->waitForEvent('networkidle')
        ->assertScript("document.querySelector('#contributor-directory [data-daisy-kit-table-selection-summary]').hidden", true)
        ->assertScript("document.querySelector('#filtered-server-result [data-daisy-kit-table-selection-summary]').hidden", false)
        ->click('#contributor-directory [data-daisy-kit-table-select-page]')
        ->assertSeeIn('#contributor-directory [data-daisy-kit-table-selection-summary]', '5 '.__('daisy-kit::table.rows_selected'))
        ->click('#contributor-directory [data-daisy-kit-table-next]')
        ->assertScript("document.querySelector('#contributor-directory strong[data-daisy-kit-table-selection-off-page-count]').textContent", '5')
        ->assertScript("document.querySelector('#contributor-directory [data-daisy-kit-table-selection-breakdown]').hidden", false)
        ->click('#contributor-directory [data-daisy-kit-table-clear-selection]')
        ->assertSeeIn('#contributor-directory [data-daisy-kit-table-selection-summary]', '0 '.__('daisy-kit::table.rows_selected'))
        ->assertScript("document.querySelector('#contributor-directory [data-daisy-kit-table-selection-summary]').hidden", false)
        ->assertNoSmoke();
})->group('browser');

it('applies cumulative filters to custom Blade cells only when requested', function (): void {
    visit('/table')
        ->waitForEvent('networkidle')
        ->assertSeeIn('#custom-cells tbody', 'London')
        ->select('#custom-cells [data-daisy-kit-table-column-filter="role"]', 'Reviewer')
        ->select('#custom-cells [data-daisy-kit-table-column-filter="status"]', 'active')
        ->assertSeeIn('#custom-cells [data-daisy-kit-table-results]', __('daisy-kit::table.showing_results', ['from' => 1, 'to' => 5, 'total' => 60]))
        ->click('#custom-cells [data-daisy-kit-table-apply-filters]')
        ->assertSeeIn('#custom-cells [data-daisy-kit-table-results]', __('daisy-kit::table.showing_results', ['from' => 1, 'to' => 5, 'total' => 7]))
        ->assertSeeIn('#custom-cells tbody', 'Grace Hopper')
        ->click('#custom-cells [data-daisy-kit-table-next]')
        ->assertCount('#custom-cells tbody tr', 2)
        ->assertNoSmoke();
})->group('browser');

it('keeps inline edits across pages without changing the other examples', function (): void {
    visit('/table')
        ->waitForEvent('networkidle')
        ->click('#inline-editing [data-daisy-kit-table-edit="ada:name"]')
        ->fill('#inline-editing [data-daisy-kit-table-edit-input="ada:name"]', 'Ada Byron')
        ->click('#inline-editing [data-daisy-kit-table-edit-save="ada:name"]')
        ->click('#inline-editing [data-daisy-kit-table-next]')
        ->click('#inline-editing [data-daisy-kit-table-previous]')
        ->assertSeeIn('#inline-editing tbody', 'Ada Byron')
        ->assertSeeIn('#contributor-directory tbody', 'Ada Lovelace')
        ->assertNoSmoke();
})->group('browser');
