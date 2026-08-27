@php
    $tree = \App\Support\FileMapFixtures::treeParity();
    $blade = <<<'BLADE'
<x-daisy-kit::tree
    :items="$items"
    label="Project areas"
    :multiple="true"
    name="areas"
    persistence-key="project-areas"
    :searchable="true"
    search-source="/fixtures/tree"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/tree.css';
import { mountAll } from '@daisy-kit/tree.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Tree — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Tree</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Each instance owns its selections, search and persistence while the demo provides small, validated local responses.</p>
        <section class="mt-10 space-y-6" aria-labelledby="tree-examples-heading"><h2 id="tree-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="workspace-navigation" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Workspace navigation</h3><p class="mt-2 text-sm text-base-content/70">Use arrow keys, Space or Enter to explore and select multiple project areas.</p><x-daisy-kit::tree :items="$tree['items']" label="Workspace navigation" :multiple="true" name="workspace_areas" persistence-key="workspace-navigation" /></section>
            <section id="lazy-media-branch" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Lazy media branch</h3><p class="mt-2 text-sm text-base-content/70">Expand Media with the keyboard to fetch its deterministic branch on demand.</p><x-daisy-kit::tree :items="$tree['items']" label="Lazy media branch" :multiple="true" /></section>
            <section id="search-result" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Search result</h3><p class="mt-2 text-sm text-base-content/70">Search uses the public remote-search option and preserves the semantic no-match outcome.</p><x-daisy-kit::tree :items="$tree['items']" label="Search result" :searchable="true" search-source="/fixtures/tree" /></section>
        </section>
        <section class="mt-10" aria-labelledby="tree-usage-heading"><h2 id="tree-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Tree Blade usage"><code>{{ $blade }}</code></pre></section><section class="mt-10" aria-labelledby="tree-imports-heading"><h2 id="tree-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Tree ESM and CSS imports"><code>{{ $imports }}</code></pre></section><section class="mt-10"><h2 class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>items</code>, <code>label</code>, <code>multiple</code>, <code>name</code>, <code>persistenceKey</code>, <code>searchable</code> and <code>searchSource</code> define the public surface. A lazy item sets its own <code>source</code>; see the API for item shapes and events.</p></section><a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI navigation patterns <span aria-hidden="true">↗</span></a></article>
@endsection
