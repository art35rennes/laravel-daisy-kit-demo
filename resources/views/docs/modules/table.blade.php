@php
    $fixture = \App\Support\FileMapFixtures::table();
    $blade = <<<'BLADE'
<x-daisy-kit::table :columns="$columns" :rows="$rows" :page-size="10" />
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/table.css';
import { mountAll } from '@daisy-kit/table.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Table — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Table</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Filter, sort, and paginate a deterministic set of contributors with the real package table.</p>
        <section class="mt-10" aria-labelledby="table-example-heading"><h2 id="table-example-heading" class="text-2xl font-semibold">Interactive example</h2><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::table :columns="$fixture['columns']" :rows="$fixture['rows']" :page-size="2" /></div></section>
        <section class="mt-10" aria-labelledby="table-usage-heading"><h2 id="table-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Table Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="table-imports-heading"><h2 id="table-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Table ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="table-contract-heading"><h2 id="table-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300"><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::table</code>; <code>columns</code>, <code>rows</code>, <code>pageSize</code>.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Lifecycle</dt><dd class="sm:col-span-2"><code>mount</code>, <code>mountAll</code>, <code>unmount</code>; <code>daisy-kit:table:*</code>.</dd></div></dl></section>
        <section class="mt-10" aria-labelledby="table-states-heading"><h2 id="table-states-heading" class="text-2xl font-semibold">States</h2><p class="mt-3 leading-7 text-base-content/75">The component transitions from loading to ready, shows an accessible empty status when no rows match, and emits an error for invalid configuration or missing required markup. Type an unmatched value in the interactive table filter to inspect its real empty state.</p></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI table documentation <span aria-hidden="true">↗</span></a>
    </article>
@endsection
