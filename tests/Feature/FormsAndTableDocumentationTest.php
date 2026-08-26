<?php

it('documents the forms contract without requiring a package component to render', function (): void {
    $this->get('/forms')
        ->assertOk()
        ->assertSee('Forms')
        ->assertSee('x-daisy-kit::forms.viewer')
        ->assertSee('x-daisy-kit::forms.builder')
        ->assertSee('Viewer does not require Livewire')
        ->assertSee('Livewire 4 is optional for the builder')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertSee('Loading')
        ->assertSee('Error')
        ->assertSee('daisy-kit:forms:*');
});

it('documents the table contract with deterministic records and package checkpoint', function (): void {
    $this->get('/table')
        ->assertOk()
        ->assertSee('Table')
        ->assertSee('x-daisy-kit::table')
        ->assertSee('Ada Lovelace')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertSee('Loading')
        ->assertSee('Error')
        ->assertSee('daisy-kit:table:*');
});
