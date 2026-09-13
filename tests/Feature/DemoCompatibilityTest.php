<?php

it('redirects the legacy demo entry point to the v6 overview', function (): void {
    $this->get('/demo')
        ->assertRedirectToRoute('docs.overview');
});
