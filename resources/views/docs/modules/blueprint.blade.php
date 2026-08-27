@php
    $fixture = \App\Support\FileMapFixtures::blueprint();
    $blade = <<<'BLADE'
<x-daisy-kit::blueprint
    :nodes="$nodes"
    :edges="$edges"
    label="Publication workflow"
    :editable="true"
    name="workflow_blueprint"
    :value="$workflow"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/blueprint.css';
import { mountAll } from '@daisy-kit/blueprint.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Blueprint — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Blueprint</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">The graph canvas stays presentational; package-owned semantic controls provide authoring, inspection and keyboard interaction.</p>
        <section class="mt-10 space-y-6" aria-labelledby="blueprint-examples-heading"><h2 id="blueprint-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="editorial-workflow" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Editorial workflow</h3><p class="mt-2 text-sm text-base-content/70">Create, connect, arrange and undo changes in a five-node publication workflow.</p><x-daisy-kit::blueprint :nodes="$fixture['nodes']" :edges="$fixture['edges']" label="Editorial workflow" :editable="true" name="editorial_workflow" :value="$fixture" /></section>
            <section id="inspector-selection" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Inspector selection</h3><p class="mt-2 text-sm text-base-content/70">Select a node to edit its typed details while the hidden JSON field remains synchronized.</p><x-daisy-kit::blueprint :nodes="$fixture['nodes']" :edges="$fixture['edges']" label="Inspector selection" :editable="true" name="inspected_workflow" :value="$fixture" /></section>
            <section id="read-only-review" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Read-only review</h3><p class="mt-2 text-sm text-base-content/70">The same workflow remains inspectable without exposing mutation controls.</p><x-daisy-kit::blueprint :nodes="$fixture['nodes']" :edges="$fixture['edges']" label="Read-only review" /></section>
        </section>
        <section class="mt-10" aria-labelledby="blueprint-usage-heading"><h2 id="blueprint-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blueprint Blade usage"><code>{{ $blade }}</code></pre></section><section class="mt-10" aria-labelledby="blueprint-imports-heading"><h2 id="blueprint-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blueprint ESM and CSS imports"><code>{{ $imports }}</code></pre></section><section class="mt-10"><h2 class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>nodes</code>, <code>edges</code>, <code>label</code>, <code>editable</code>, <code>name</code> and <code>value</code> are the public contract. Listen for <code>daisy-kit:blueprint:*</code> events; API details cover node values and transitions.</p></section><a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI status patterns <span aria-hidden="true">↗</span></a></article>
@endsection
