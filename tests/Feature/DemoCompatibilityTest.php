<?php

it('redirects the legacy demo entry point to the v5 overview', function (): void {
    $this->get('/demo')
        ->assertRedirectToRoute('docs.overview');
});
