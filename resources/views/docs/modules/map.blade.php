@php
    $location = \App\Support\FileMapFixtures::map();
    $layers = [['id' => 'route', 'label' => 'Office route', 'geojson' => $location['geojson']]];
    $markers = [['id' => 'office', 'label' => 'Rennes office', 'position' => [48.1173, -1.6778]]];
    $blade = <<<'BLADE'
<x-daisy-kit::map
    :geojson="$geojson"
    :markers="$markers"
    :layers="$layers"
    :drawing="true"
    :spatial-selection="true"
    label="Project map"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/map.css';
import { mountAll } from '@daisy-kit/map.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Map — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Map</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">These deterministic GeoJSON examples avoid a network tile dependency while exercising the real Leaflet, drawing and Turf controls.</p>
        <section class="mt-10 space-y-6" aria-labelledby="map-examples-heading"><h2 id="map-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="office-workspace" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Office workspace</h3><p class="mt-2 text-sm text-base-content/70">A local office route and marker in the package map runtime.</p><x-daisy-kit::map :geojson="$location['geojson']" :markers="$markers" :center="[48.1173, -1.6778]" :zoom="13" label="Office workspace" /></section>
            <section id="layers-and-markers" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Layers and markers</h3><p class="mt-2 text-sm text-base-content/70">Toggle a deterministic GeoJSON layer and select its marker.</p><x-daisy-kit::map :layers="$layers" :markers="$markers" :center="[48.1173, -1.6778]" :zoom="13" label="Layers and markers" /></section>
            <section id="draw-and-measure" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Draw and measure</h3><p class="mt-2 text-sm text-base-content/70">Draw, select, undo, redo and export geometry with package-provided controls.</p><x-daisy-kit::map :geojson="$location['geojson']" :drawing="true" :spatial-selection="true" :center="[48.1173, -1.6778]" :zoom="13" label="Draw and measure" /></section>
        </section>
        <section class="mt-10" aria-labelledby="map-usage-heading"><h2 id="map-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Map Blade usage"><code>{{ $blade }}</code></pre></section><section class="mt-10" aria-labelledby="map-imports-heading"><h2 id="map-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Map ESM and CSS imports"><code>{{ $imports }}</code></pre></section><section class="mt-10"><h2 class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>geojson</code>, <code>center</code>, <code>zoom</code>, <code>layers</code>, <code>markers</code>, <code>basemaps</code>, <code>wms</code>, <code>drawing</code>, <code>spatialSelection</code> and <code>geolocation</code> are supported. Use host-authorized HTTPS providers only when a tile or WMS source is required.</p></section><a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI alert patterns <span aria-hidden="true">↗</span></a></article>
@endsection
