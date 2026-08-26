<?php

it('selects table rows without errors', function () {
    $page = visit('/demo');

    $page->assertSee('Table')
        ->assertNoJavascriptErrors();

    // Le tri de la table locale est immédiatement disponible et garde le
    // scénario indépendant de l’endpoint de pagination distante.
    $page->click('#demo-local-table [data-table-sort="name"]');

    $page->assertNoConsoleLogs();
});
