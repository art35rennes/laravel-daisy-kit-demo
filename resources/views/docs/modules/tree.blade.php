@php
    $items = \App\Support\FileMapFixtures::tree();
    $blade = <<<'BLADE'
<x-daisy-kit::tree :items="$items" label="Documentation" />
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/tree.css';
import { mountAll } from '@daisy-kit/tree.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Tree — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Tree</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Explore a small deterministic documentation tree with keyboard navigation and selection supplied by the package.</p>
        <section class="mt-10" aria-labelledby="tree-example-heading"><h2 id="tree-example-heading" class="text-2xl font-semibold">Interactive example</h2><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::tree :items="$items" label="Documentation" /></div></section>
        <section class="mt-10" aria-labelledby="tree-usage-heading"><h2 id="tree-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Tree Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="tree-imports-heading"><h2 id="tree-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Tree ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="tree-contract-heading"><h2 id="tree-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300"><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::tree</code>; <code>items</code> and <code>label</code>.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Lifecycle</dt><dd class="sm:col-span-2"><code>mount</code>, <code>mountAll</code>, <code>unmount</code>; <code>daisy-kit:tree:*</code>.</dd></div></dl></section>
        <section class="mt-10" aria-labelledby="tree-states-heading"><h2 id="tree-states-heading" class="text-2xl font-semibold">States</h2><p class="mt-3 leading-7 text-base-content/75">Mounting starts in loading, an empty item list produces the semantic empty tree, and malformed configuration is surfaced as an accessible error event.</p><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::tree :items="[]" /></div></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI navigation patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
