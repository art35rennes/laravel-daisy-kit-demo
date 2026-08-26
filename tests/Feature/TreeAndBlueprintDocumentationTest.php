<?php

it('documents the tree contract with deterministic fixture data and an explicit package checkpoint', function (): void {
    $this->get('/tree')
        ->assertOk()
        ->assertSee('Tree')
        ->assertSee('Documentation')
        ->assertSee('README.md')
        ->assertSee('x-daisy-kit::tree')
        ->assertSee('mountAll')
        ->assertSee('daisy-kit:tree:*')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertSee('Loading')
        ->assertSee('Error')
        ->assertSee('DaisyUI');
});

it('documents the blueprint contract with a deterministic workflow and an explicit package checkpoint', function (): void {
    $this->get('/blueprint')
        ->assertOk()
        ->assertSee('Blueprint')
        ->assertSee('Draft')
        ->assertSee('Review')
        ->assertSee('Published')
        ->assertSee('x-daisy-kit::blueprint')
        ->assertSee('mountAll')
        ->assertSee('daisy-kit:blueprint:*')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertSee('Loading')
        ->assertSee('Error')
        ->assertSee('DaisyUI');
});
