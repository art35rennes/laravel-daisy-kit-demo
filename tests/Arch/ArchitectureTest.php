<?php

arch()->preset()->php();

arch()->expect('App')
    ->not->toUse(['dd', 'die', 'dump', 'eval']);

it('does not ship copied package assets outside the host Vite build', function (): void {
    expect(is_dir(dirname(__DIR__, 2).'/public/vendor/art35rennes/laravel-daisy-kit'))->toBeFalse();
});
