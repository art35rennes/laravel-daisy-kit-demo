@php
    $map = \App\Support\FileMapFixtures::mapParity();
    $mapProvider = config('services.openstreetmap.tiles_enabled') ? 'osm.standard' : false;
    $osmBasemaps = $mapProvider === false ? [] : $map['basemaps'];
    $blade = <<<'BLADE'
<x-daisy-kit::map
    :markers="$markers"
    :cluster="['maxClusterRadius' => 72]"
    :basemaps="$basemaps"
    :layers="$layers"
    :drawing="true"
    :measure="true"
    :spatial-selection="['mode' => 'both']"
    name="maintenance_geometry"
    label="Maintenance map"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/map.css';
import { getInstance, mountAll } from '@daisy-kit/map.js';

mountAll();

const map = getInstance(document.querySelector('#maintenance-map'));
map?.setView([48.1173, -1.6778], 14);
JS;
@endphp

@extends('layouts.docs', ['title' => 'Map — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Map</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">
            Compose production map workflows with Leaflet rendering, business layers, clustering,
            Terra Draw editing and Turf measurements. OpenStreetMap provides every basemap mode;
            automated tests disable remote tiles and validate the component with deterministic business data.
        </p>

        <section class="mt-10 space-y-8" aria-labelledby="map-examples-heading">
            <h2 id="map-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>

            <section id="marker-clustering" class="rounded-box border border-base-300 bg-base-100 p-4 sm:p-5">
                <h3 class="font-semibold">Markers, popups and clustering</h3>
                <p class="mt-2 text-sm text-base-content/70">Eight nearby operations sites are grouped as the view changes. Select a marker to open its safe popup.</p>
                <div class="mt-4">
                    <x-daisy-kit::map
                        id="cluster-map"
                        label="Operations sites"
                        :provider="$mapProvider"
                        :fit-bounds="false"
                        :center="[48.1173, -1.6778]"
                        :zoom="12"
                        :cluster="['maxClusterRadius' => 72]"
                        :markers="$map['markers']"
                    />
                </div>
            </section>

            <section id="osm-and-business-layers" class="rounded-box border border-base-300 bg-base-100 p-4 sm:p-5">
                <h3 class="font-semibold">OSM styles and business layers</h3>
                <p class="mt-2 text-sm text-base-content/70">Choose an OSM visual mode, then combine service districts, scheduled works and planning constraints. GeoJSON, XYZ and WMS are delivery formats; the menu presents the operational meaning first.</p>
                <div class="mt-4">
                    <x-daisy-kit::map
                        id="layer-map"
                        label="Service network layers"
                        :provider="false"
                        :center="[48.1173, -1.6778]"
                        :zoom="12"
                        :scale="true"
                        :basemaps="$osmBasemaps"
                        :layers="$map['layers']"
                    />
                </div>
            </section>

            <section id="drawing-and-export" class="rounded-box border border-base-300 bg-base-100 p-4 sm:p-5">
                <h3 class="font-semibold">Drawing, measurement and form export</h3>
                <p class="mt-2 text-sm text-base-content/70">Choose a business object and layer, then draw, edit, select, measure, undo, redo or export the synchronized GeoJSON value.</p>
                <form class="mt-4" aria-label="Maintenance geometry example">
                    <x-daisy-kit::map
                        id="maintenance-map"
                        label="Maintenance drawing"
                        :provider="$mapProvider"
                        name="maintenance_geometry"
                        :center="[48.1173, -1.6778]"
                        :zoom="12"
                        :value="$map['editableGeojson']"
                        :drawing="true"
                        :measure="true"
                        :spatial-selection="['mode' => 'both']"
                        :object-types="$map['objectTypes']"
                        :draw-layers="$map['drawLayers']"
                        draw-layer-selection="multiple"
                    />
                </form>
            </section>

            <section id="facade-and-persistence" class="rounded-box border border-base-300 bg-base-100 p-4 sm:p-5">
                <h3 class="font-semibold">Persistence, errors and external controls</h3>
                <p class="mt-2 text-sm text-base-content/70">The host controls view and layout through the documented facade. A local unavailable layer demonstrates the contextual error and retry state.</p>
                <div class="mt-4">
                    <x-daisy-kit::map
                        id="controlled-map"
                        label="Externally controlled map"
                        :provider="$mapProvider"
                        :center="[48.1173, -1.6778]"
                        :zoom="12"
                        :fullscreen="true"
                        :gesture-handling="true"
                        :geolocation="true"
                        :persist-state="true"
                        state-key="docs-controlled-map"
                        :markers="[['id' => 'center', 'label' => 'Initial center', 'position' => [48.1173, -1.6778]]]"
                        :layers="[['id' => 'unavailable', 'label' => 'Unavailable local layer', 'type' => 'geojson', 'url' => '/fixtures/map/unavailable.geojson']]"
                    >
                        <x-slot:controls>
                            <div class="flex flex-wrap gap-2" aria-label="Host map controls">
                                <button class="btn btn-outline btn-sm" data-doc-map-action="view" type="button">Focus the depot</button>
                                <button class="btn btn-outline btn-sm" data-doc-map-action="invalidate" type="button">Refresh layout</button>
                            </div>
                            <p class="text-sm text-base-content/70">These controls call <code>getInstance()</code>; they do not access private Map state or a global Leaflet object.</p>
                        </x-slot:controls>
                    </x-daisy-kit::map>
                </div>
            </section>
        </section>

        <section class="mt-10" aria-labelledby="map-usage-heading">
            <h2 id="map-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Map Blade usage"><code>{{ $blade }}</code></pre>
        </section>

        <section class="mt-10" aria-labelledby="map-imports-heading">
            <h2 id="map-imports-heading" class="text-2xl font-semibold">ESM, CSS and facade</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Map ESM, CSS and facade usage"><code>{{ $imports }}</code></pre>
        </section>

        <section class="mt-10" aria-labelledby="map-options-heading">
            <h2 id="map-options-heading" class="text-2xl font-semibold">Configuration and extension</h2>
            <p class="mt-3 leading-7 text-base-content/75">
                Configure the view with <code>center</code>, <code>zoom</code> and <code>fitBounds</code>; data with
                <code>geojson</code>, <code>markers</code>, <code>basemaps</code> and typed <code>layers</code>; and workflows with
                <code>cluster</code>, <code>drawing</code>, <code>measure</code>, <code>spatialSelection</code>,
                <code>geolocation</code> and <code>persistState</code>. A WMS source is a <code>layers</code> entry with
                <code>type: 'wms'</code>, not a separate prop.
            </p>
            <p class="mt-3 leading-7 text-base-content/75">
                Organize the in-map menu with <code>controls.sections</code>. Drawing layers use radio-style visibility by default,
                or cumulative visibility with <code>drawLayerSelection="multiple"</code>. The facade methods
                <code>getVisibleDrawLayers()</code> and <code>setVisibleDrawLayers()</code> let host filters drive the same state.
            </p>
            <p class="mt-3 leading-7 text-base-content/75">
                Use the stable facade for external filters or controls. <code>getLeafletMap()</code> is the single documented
                escape hatch for an integrator-owned Leaflet plugin. Listen for <code>daisy-kit:map:*</code> events on the map root
                to keep multiple instances isolated.
            </p>
        </section>

        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI alert patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
