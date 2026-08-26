@php
    $fixture = \App\Support\FileMapFixtures::blueprint();
    $blade = <<<'BLADE'
<x-daisy-kit::blueprint :nodes="$nodes" :edges="$edges" label="Publication workflow" />
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/blueprint.css';
import { mountAll } from '@daisy-kit/blueprint.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Blueprint — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Blueprint</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Inspect the deterministic publication workflow and move between its nodes with the keyboard.</p>
        <section class="mt-10" aria-labelledby="blueprint-example-heading"><h2 id="blueprint-example-heading" class="text-2xl font-semibold">Interactive example</h2><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::blueprint :nodes="$fixture['nodes']" :edges="$fixture['edges']" label="Publication workflow" /></div></section>
        <section class="mt-10" aria-labelledby="blueprint-usage-heading"><h2 id="blueprint-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blueprint Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="blueprint-imports-heading"><h2 id="blueprint-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blueprint ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="blueprint-contract-heading"><h2 id="blueprint-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300"><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::blueprint</code>; <code>nodes</code>, <code>edges</code>, <code>label</code>.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Lifecycle</dt><dd class="sm:col-span-2"><code>mount</code>, <code>mountAll</code>, <code>unmount</code>; <code>daisy-kit:blueprint:*</code>.</dd></div></dl></section>
        <section class="mt-10" aria-labelledby="blueprint-states-heading"><h2 id="blueprint-states-heading" class="text-2xl font-semibold">States</h2><p class="mt-3 leading-7 text-base-content/75">The component mounts into loading, renders ready graph nodes, exposes the empty state for no nodes, and reports invalid configuration as an error event.</p><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::blueprint :nodes="[]" :edges="[]" /></div></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI status patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
