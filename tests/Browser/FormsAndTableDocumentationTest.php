<?php

it('renders the forms documentation without a package mount', function (): void {
    visit('/forms')
        ->assertSee('Forms')
        ->assertSee('Viewer does not require Livewire')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Empty')
        ->assertNoJavaScriptErrors();
})->group('browser');

it('renders the table documentation fixture without a package mount', function (): void {
    visit('/table')
        ->assertSee('Table')
        ->assertSee('Ada Lovelace')
        ->assertSee('Package prerelease checkpoint')
        ->assertSee('Error')
        ->assertNoJavaScriptErrors();
})->group('browser');
