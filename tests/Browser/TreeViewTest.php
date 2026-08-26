<?php

it('expands a tree node without errors', function () {
    $page = visit('/demo');

    $page->assertSee('TreeView')
        ->assertNoJavascriptErrors();

    $page->click('#demoTreeSingle li[data-id="a"] [data-tree-toggle]');

    $page->assertNoConsoleLogs();
});
