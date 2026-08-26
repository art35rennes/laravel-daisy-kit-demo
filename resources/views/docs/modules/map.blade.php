@extends('layouts.docs', ['title' => 'Map — Laravel Daisy Kit'])

@php($location = \App\Support\FileMapFixtures::map())

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Map</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Mount a map module from stable host data. Laravel Daisy Kit renders the map itself; the host remains responsible for page structure, DaisyUI controls, and the data lifecycle.</p>

        <section class="mt-10" aria-labelledby="map-example-heading">
            <div class="flex flex-wrap items-end justify-between gap-4"><div><h2 id="map-example-heading" class="text-2xl font-semibold">Deterministic coordinate fixture</h2><p class="mt-2 leading-7 text-base-content/75">This fixed location avoids geocoding, user tracking, and network-dependent examples.</p></div><a class="btn btn-outline btn-sm" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI alert patterns <span aria-hidden="true">↗</span></a></div>
            <figure class="mt-5 border border-base-300 bg-base-100 p-5" data-map-fixture><div class="grid min-h-48 place-items-center bg-base-200 p-6 text-center"><div><p class="font-semibold">{{ $location['name'] }}</p><p class="mt-2 font-mono text-sm">{{ $location['latitude'] }}, {{ $location['longitude'] }}</p><p class="mt-3 max-w-md text-sm leading-6 text-base-content/70">The map canvas is intentionally not imitated before the package prerelease is available.</p></div></div><figcaption class="mt-4 text-sm text-base-content/70">{{ $location['description'] }}</figcaption></figure>
        </section>

        <section class="mt-12" aria-labelledby="map-blade-heading"><h2 id="map-blade-heading" class="text-2xl font-semibold">Blade usage</h2><p class="mt-2 leading-7 text-base-content/75">Copy the fixed entry point. The prerelease will define its attribute contract.</p><pre class="code-sample mt-4" tabindex="0" aria-label="Map Blade usage"><code>&lt;x-daisy-kit::map /&gt;</code></pre></section>

        <section class="mt-12" aria-labelledby="map-assets-heading"><h2 id="map-assets-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4" tabindex="0" aria-label="Map ESM and CSS imports"><code>import 'vendor/art35rennes/laravel-daisy-kit/dist/map.css';
import { mountAll } from 'vendor/art35rennes/laravel-daisy-kit/dist/map.js';

mountAll();</code></pre></section>

        <section class="mt-12" aria-labelledby="map-contract-heading"><h2 id="map-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300 text-sm"><div class="grid gap-1 py-4 sm:grid-cols-[11rem_1fr]"><dt class="font-medium">Blade component</dt><dd><code>x-daisy-kit::map</code></dd></div><div class="grid gap-1 py-4 sm:grid-cols-[11rem_1fr]"><dt class="font-medium">JavaScript</dt><dd><code>mount</code>, <code>mountAll</code>, <code>unmount</code></dd></div><div class="grid gap-1 py-4 sm:grid-cols-[11rem_1fr]"><dt class="font-medium">Events</dt><dd><code>daisy-kit:map:*</code>; no global object is exposed.</dd></div></dl></section>

        <section class="mt-12" aria-labelledby="map-states-heading"><h2 id="map-states-heading" class="text-2xl font-semibold">State references</h2><div class="mt-4 grid gap-4 md:grid-cols-3"><section class="border border-base-300 p-4"><h3 class="font-semibold">Empty</h3><p class="mt-2 text-sm leading-6 text-base-content/70">No coordinate fixture has been selected.</p></section><section class="border border-base-300 p-4"><h3 class="font-semibold">Loading</h3><p class="mt-2 text-sm leading-6 text-base-content/70">The host is preparing the coordinate data.</p></section><section class="border border-base-300 p-4"><h3 class="font-semibold">Error</h3><p class="mt-2 text-sm leading-6 text-base-content/70">The location cannot be rendered. Keep retry actions in the host.</p></section></div></section>

        <section class="mt-12 border-t border-base-300 pt-8" aria-labelledby="map-checkpoint-heading"><h2 id="map-checkpoint-heading" class="text-2xl font-semibold">Package prerelease checkpoint</h2><p class="mt-3 leading-7 text-base-content/75">The v5 package prerelease is not published or Composer-resolved in this branch. This documentation records the fixed entry points without simulating a map renderer.</p></section>
    </article>
@endsection
