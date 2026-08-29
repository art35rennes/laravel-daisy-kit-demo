@php
    $fixture = \App\Support\FileMapFixtures::table();
    $columns = [
        ['id' => 'name', 'label' => 'Contributor', 'filter' => ['type' => 'text']],
        ['id' => 'role', 'label' => 'Role', 'filter' => ['type' => 'select', 'options' => ['Maintainer', 'Reviewer', 'Contributor']]],
        ['id' => 'status', 'label' => 'Status', 'filter' => ['type' => 'select', 'options' => ['active', 'invited', 'paused']]],
    ];
    $blade = <<<'BLADE'
<x-daisy-kit::table
    :columns="$columns"
    mode="server"
    endpoint="/fixtures/table"
    selection="multiple"
    :bulk-actions="[['id' => 'archive', 'label' => 'Archive selected']]"
    :row-actions="[['id' => 'open', 'label' => 'Open']]"
    :row-details="true"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/table.css';
import { mountAll } from '@daisy-kit/table.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Table — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Table</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">The package owns table state and interactions; the demo only supplies deterministic rows and a read-only server endpoint.</p>
        <section class="mt-10 space-y-6" aria-labelledby="table-examples-heading"><h2 id="table-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="contributor-directory" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Contributor directory</h3><p class="mt-2 text-sm text-base-content/70">Client rows with typed filters, sorting, pagination, selection, details, local editing and event-backed actions.</p><x-daisy-kit::table :columns="$columns" :rows="$fixture['rows']" :page-size="2" selection="multiple" :bulk-actions="[['id' => 'archive', 'label' => 'Archive selected']]" :row-actions="[['id' => 'open', 'label' => 'Open']]" :row-details="true" :editable="true" persist-state="url" state-key="contributor-directory" /></section>
            <section id="filtered-server-result" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Filtered server result</h3><p class="mt-2 text-sm text-base-content/70">The component sends its documented filter, sort and page query parameters to a validated deterministic endpoint.</p><x-daisy-kit::table :columns="$columns" mode="server" endpoint="/fixtures/table" :page-size="2" selection="multiple" /></section>
            <section id="unavailable-source" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Unavailable source</h3><p class="mt-2 text-sm text-base-content/70">A real deterministic 503 source demonstrates the package error state instead of a host imitation.</p><x-daisy-kit::table :columns="$columns" mode="server" endpoint="/fixtures/table-unavailable" /></section>
        </section>
        <section class="mt-10" aria-labelledby="table-usage-heading"><h2 id="table-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Table Blade usage"><code>{{ $blade }}</code></pre></section><section class="mt-10" aria-labelledby="table-imports-heading"><h2 id="table-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Table ESM and CSS imports"><code>{{ $imports }}</code></pre></section><section class="mt-10"><h2 class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>columns</code>, <code>rows</code> or <code>mode/endpoint</code>, <code>pageSize</code>, <code>selection</code>, <code>bulkActions</code>, <code>rowActions</code>, <code>rowDetails</code>, <code>editable</code>, <code>persistState/stateKey</code> and <code>initialState</code> are the documented surface. See the package API for uncommon column definitions.</p></section><a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI table documentation <span aria-hidden="true">↗</span></a></article>
@endsection
