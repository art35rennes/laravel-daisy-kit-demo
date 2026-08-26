<?php

it('renders the published tree contract with deterministic items', function (): void {
    $this->get('/tree')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="tree"', false)
        ->assertSee('Documentation')
        ->assertSee('README.md')
        ->assertSee('@daisy-kit/tree.js');
});

it('renders the published blueprint contract with a deterministic workflow', function (): void {
    $this->get('/blueprint')
        ->assertOk()
        ->assertSee('data-daisy-kit-module="blueprint"', false)
        ->assertSee('Draft')
        ->assertSee('Review')
        ->assertSee('Published')
        ->assertSee('@daisy-kit/blueprint.js');
});
