<?php

test('file preview documentation keeps its public contract usable at narrow and wide widths', function (): void {
    $page = visit('/file-preview');

    $page->resize(320, 800)
        ->assertSee('File Preview')
        ->assertSee('quarterly-report.pdf')
        ->assertSee('Empty')
        ->assertNoSmoke()
        ->assertNoAccessibilityIssues();

    $page->resize(1440, 960)
        ->assertSee('Public contract')
        ->assertSee('Package prerelease checkpoint');
})->group('browser');

test('map documentation keeps its public contract usable at tablet and desktop widths', function (): void {
    $page = visit('/map');

    $page->resize(768, 900)
        ->assertSee('Map')
        ->assertSee('48.1173')
        ->assertSee('Loading')
        ->assertNoSmoke()
        ->assertNoAccessibilityIssues();

    $page->resize(1024, 900)
        ->assertSee('Public contract')
        ->assertSee('Package prerelease checkpoint');
})->group('browser');
