<?php

it('renders the tree documentation with a keyboard-operable host fixture and no JavaScript errors', function (): void {
    $page = visit('/tree');

    $page->assertSee('Tree')
        ->assertSee('Package prerelease checkpoint')
        ->keys('#tree-fixture > summary', 'Enter')
        ->assertScript('document.querySelector("#tree-fixture").open', false)
        ->assertNoJavascriptErrors();
})->group('browser');

it('renders the blueprint documentation without JavaScript errors', function (): void {
    $page = visit('/blueprint');

    $page->assertSee('Blueprint')
        ->assertSee('Package prerelease checkpoint')
        ->assertNoJavascriptErrors();
})->group('browser');
