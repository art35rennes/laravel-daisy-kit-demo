@php
    $location = \App\Support\FileMapFixtures::map();
    $blade = <<<'BLADE'
<x-daisy-kit::map :geojson="$geojson" :center="[48.1173, -1.6778]" :zoom="13" drawing />
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/map.css';
import { mountAll } from '@daisy-kit/map.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Map — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Map</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Mount a local GeoJSON line around the Rennes office, with optional drawing controls supplied by the package.</p>
        <section class="mt-10" aria-labelledby="map-example-heading"><h2 id="map-example-heading" class="text-2xl font-semibold">Interactive example</h2><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::map :geojson="$location['geojson']" :center="[48.1173, -1.6778]" :zoom="13" :drawing="true" label="Rennes office" /><p class="mt-4 text-sm text-base-content/70">{{ $location['name'] }} · {{ $location['latitude'] }}, {{ $location['longitude'] }}</p></div></section>
        <section class="mt-10" aria-labelledby="map-usage-heading"><h2 id="map-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Map Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="map-imports-heading"><h2 id="map-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Map ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="map-contract-heading"><h2 id="map-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300"><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::map</code>; <code>geojson</code>, <code>center</code>, <code>zoom</code>, <code>drawing</code>, <code>label</code>.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Lifecycle</dt><dd class="sm:col-span-2"><code>mount</code>, <code>mountAll</code>, <code>unmount</code>; <code>daisy-kit:map:*</code>.</dd></div></dl></section>
        <section class="mt-10" aria-labelledby="map-states-heading"><h2 id="map-states-heading" class="text-2xl font-semibold">States</h2><p class="mt-3 leading-7 text-base-content/75">A map with data becomes ready, an instance with no GeoJSON and no drawing mode displays its semantic empty state, and invalid configuration produces the package error event.</p><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::map /></div></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI alert patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
