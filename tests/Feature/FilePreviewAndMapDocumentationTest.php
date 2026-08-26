<?php

it('documents the file preview contract with a deterministic descriptor and package checkpoint', function (): void {
    $this->get('/file-preview')
        ->assertOk()
        ->assertSee('File Preview')
        ->assertSee('x-daisy-kit::file-preview')
        ->assertSee('quarterly-report.pdf')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertSee('Loading')
        ->assertSee('Error')
        ->assertSee('daisy-kit:file-preview:*');
});

it('documents the map contract with deterministic coordinates and package checkpoint', function (): void {
    $this->get('/map')
        ->assertOk()
        ->assertSee('Map')
        ->assertSee('x-daisy-kit::map')
        ->assertSee('48.1173')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertSee('Loading')
        ->assertSee('Error')
        ->assertSee('daisy-kit:map:*');
});
