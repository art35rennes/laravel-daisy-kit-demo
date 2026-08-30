@php
    $fixture = \App\Support\FileMapFixtures::table();
    $columns = [
        ['id' => 'name', 'label' => 'Contributor', 'filter' => ['type' => 'text']],
        ['id' => 'role', 'label' => 'Role', 'filter' => ['type' => 'select', 'options' => ['Maintainer', 'Reviewer', 'Contributor']]],
        ['id' => 'status', 'label' => 'Status', 'filter' => ['type' => 'select', 'options' => ['active', 'invited', 'paused']]],
    ];
    $directoryColumns = [
        ...$columns,
        ['id' => 'location', 'label' => 'Location', 'filter' => ['type' => 'text']],
        ['id' => 'updatedAt', 'label' => 'Updated', 'filter' => ['type' => 'date']],
    ];
    $customColumns = [
        ['id' => 'name', 'label' => 'Contributor', 'cell' => ['renderer' => 'blade', 'view' => 'docs.partials.table-contributor']],
        ['id' => 'role', 'label' => 'Role', 'filter' => ['type' => 'select', 'options' => ['Maintainer', 'Reviewer', 'Contributor']]],
        ['id' => 'status', 'label' => 'Status', 'filter' => ['type' => 'select', 'options' => ['active', 'invited', 'paused']]],
    ];
    $selection = ['mode' => 'multiple', 'summaryVisibility' => 'after-first-selection'];
    $pageSizes = [5, 10, 25, 50, 100];
    $blade = <<<'BLADE'
<x-daisy-kit::table
    :columns="$columns"
    mode="server"
    endpoint="/fixtures/table"
    :page-size="5"
    :page-size-options="[5, 10, 25, 50, 100]"
    :selection="['mode' => 'multiple', 'summaryVisibility' => 'after-first-selection']"
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
            <section id="contributor-directory" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Contributor directory</h3>
                <p class="mt-2 mb-4 text-sm text-base-content/70">60 client rows with a cumulative filter for every column. Change the page size, select rows across pages and open row details. The selection counter appears after your first selection and remains visible after clearing it. Filters and pagination are kept in this page's URL.</p>
                <x-daisy-kit::table :columns="$directoryColumns" :rows="$fixture['rows']" :page-size="5" :page-size-options="$pageSizes" :selection="$selection" :bulk-actions="[['id' => 'archive', 'label' => 'Archive selected']]" :row-actions="[['id' => 'open', 'label' => 'Open']]" :row-details="true" :editable="true" persist-state="url" state-key="contributor-directory" caption="Contributors — client-side" />
                <p class="mt-3 text-xs text-base-content/60">Open and Archive selected emit package events for a host application to handle. This read-only demo does not persist or archive records.</p>
            </section>
            <section id="filtered-server-result" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Filtered server result</h3>
                <p class="mt-2 mb-4 text-sm text-base-content/70">The same 60 records, filtered, sorted and paged by a read-only endpoint. All page sizes work here too. Combine Contributor, Role and Status; select all matching results and exclude individual rows on other pages. This example keeps its selection counter visible from the start.</p>
                <x-daisy-kit::table :columns="$columns" mode="server" endpoint="/fixtures/table" :page-size="5" :page-size-options="$pageSizes" selection="multiple" caption="Contributors — server-side" />
            </section>
            <section id="inline-editing" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Inline editing</h3>
                <p class="mt-2 mb-4 text-sm text-base-content/70">Edit a contributor's name or location, save or cancel, then change pages to verify the result. All 60 records remain local to this table; reloading resets changes and the other examples stay untouched.</p>
                <x-daisy-kit::table :columns="[
                    ['id' => 'name', 'label' => 'Contributor'],
                    ['id' => 'location', 'label' => 'Location'],
                    ['id' => 'role', 'label' => 'Role'],
                ]" :rows="$fixture['rows']" :page-size="5" :page-size-options="$pageSizes" :editable="['columns' => ['name', 'location']]" caption="Editable contributor profiles" />
            </section>
            <section id="custom-cells" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Custom cells and applied filters</h3>
                <p class="mt-2 mb-4 text-sm text-base-content/70">A private Blade view lays out each contributor's name and location. Choose a Role and Status, then press Apply filters to apply them together. Search remains immediate. The component owns filtering and pagination; the host only supplies cell markup and data.</p>
                <x-daisy-kit::table :columns="$customColumns" :rows="$fixture['rows']" :page-size="5" :page-size-options="$pageSizes" filter-mode="manual" caption="Custom Blade cells" />
            </section>
            <section id="unavailable-source" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Unavailable source</h3><p class="mt-2 text-sm text-base-content/70">A real deterministic 503 source demonstrates the package error state instead of a host imitation.</p><x-daisy-kit::table :columns="$columns" mode="server" endpoint="/fixtures/table-unavailable" /></section>
        </section>
        <section class="mt-10" aria-labelledby="table-usage-heading"><h2 id="table-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Table Blade usage"><code>{{ $blade }}</code></pre></section><section class="mt-10" aria-labelledby="table-imports-heading"><h2 id="table-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Table ESM and CSS imports"><code>{{ $imports }}</code></pre></section><section class="mt-10"><h2 class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>columns</code>, <code>rows</code> or <code>mode/endpoint</code>, <code>pageSize/pageSizeOptions</code>, <code>selection</code>, <code>bulkActions</code>, <code>rowActions</code>, <code>rowDetails</code>, <code>editable</code>, <code>persistState/stateKey</code> and <code>initialState</code> are the documented surface. Use <code>selection.summaryVisibility = 'after-first-selection'</code> to defer the initial counter, or omit it for the default <code>always</code> mode. Selection controls remain available in either case. See the package API for uncommon column definitions.</p></section><a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI table documentation <span aria-hidden="true">↗</span></a></article>
@endsection
