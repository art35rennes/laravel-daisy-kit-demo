<?php

it('opens lightbox and navigates without console errors', function () {
    $page = visit('/demo');

    $page->assertSee('Lightbox')
        ->assertNoJavascriptErrors();

    // Ouvre la première image de la lightbox
    $page->click('[data-lightbox="1"] [data-item]');

    // Navigue ensuite (bouton next), puis ferme
    $page->click('[data-lightbox="1"] [data-next]');
    $page->click('[data-lightbox="1"] [data-close]');

    $page->assertNoConsoleLogs();
});
