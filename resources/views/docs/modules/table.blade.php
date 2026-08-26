@extends('layouts.docs', ['title' => 'Table — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Table</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Present deterministic records through the package table while DaisyUI remains responsible for the host interface around it.</p>

        <section class="mt-12" aria-labelledby="table-contract">
            <h2 id="table-contract" class="text-2xl font-semibold">Public contract</h2>
            <div class="mt-4 border border-base-300 bg-base-100 p-5"><code class="font-semibold">x-daisy-kit::table</code><p class="mt-2 text-sm leading-6 text-base-content/75">The package owns the table module. The browser module exposes <code>mount</code>, <code>mountAll</code>, and <code>unmount</code>, and emits <code>daisy-kit:table:*</code> events without registering a global object.</p></div>
        </section>

        <section class="mt-12" aria-labelledby="table-usage">
            <h2 id="table-usage" class="text-2xl font-semibold">Blade usage</h2>
            <p class="mt-3 leading-7 text-base-content/75">Copy the component entry point. Add only attributes documented by the published v5 prerelease.</p>
            <pre class="code-sample mt-4" tabindex="0" aria-label="Table Blade usage"><code>@verbatim&lt;x-daisy-kit::table /&gt;@endverbatim</code></pre>
        </section>

        <section class="mt-12" aria-labelledby="table-assets">
            <h2 id="table-assets" class="text-2xl font-semibold">CSS and ESM imports</h2>
            <pre class="code-sample mt-4" tabindex="0" aria-label="Table ESM and CSS imports"><code>import 'vendor/art35rennes/laravel-daisy-kit/dist/table.css';
import { mountAll } from 'vendor/art35rennes/laravel-daisy-kit/dist/table.js';

mountAll();</code></pre>
        </section>

        <section class="mt-12" aria-labelledby="table-fixture">
            <h2 id="table-fixture" class="text-2xl font-semibold">Deterministic fixture</h2>
            <p class="mt-3 leading-7 text-base-content/75">This host-side fixture documents the records that the real package example will receive. It is a plain DaisyUI table, not a substitute package mount.</p>
            <div class="mt-4 overflow-x-auto border border-base-300">
                <table class="table table-zebra" aria-label="Table fixture">
                    <thead><tr><th>Contributor</th><th>Role</th><th>Status</th></tr></thead>
                    <tbody><tr><td>Ada Lovelace</td><td>Maintainer</td><td><span class="badge badge-success badge-sm">Active</span></td></tr><tr><td>Grace Hopper</td><td>Reviewer</td><td><span class="badge badge-success badge-sm">Active</span></td></tr><tr><td>Alan Turing</td><td>Contributor</td><td><span class="badge badge-ghost badge-sm">Invited</span></td></tr></tbody>
                </table>
            </div>
        </section>

        <section class="mt-12" aria-labelledby="table-states">
            <h2 id="table-states" class="text-2xl font-semibold">Empty, loading, and error states</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <div class="border border-base-300 p-4"><h3 class="font-semibold">Empty</h3><p class="mt-2 text-sm text-base-content/75">No records match the current host query.</p></div>
                <div class="border border-base-300 p-4"><h3 class="font-semibold">Loading</h3><p class="mt-2 text-sm text-base-content/75">The host is preparing a record set.</p></div>
                <div class="border border-error/40 p-4"><h3 class="font-semibold">Error</h3><p class="mt-2 text-sm text-base-content/75">The host can report an unavailable record source.</p></div>
            </div>
        </section>

        <section class="mt-12 border-t border-base-300 pt-8" aria-labelledby="table-checkpoint">
            <h2 id="table-checkpoint" class="text-2xl font-semibold">Package prerelease checkpoint</h2>
            <p class="mt-3 leading-7 text-base-content/75">The v5 prerelease is not published or Composer-resolved in this branch. This documentation intentionally keeps the fixture separate from the package component; the interactive table mount follows validation of the exact package tag.</p>
            <a class="btn btn-outline btn-sm mt-4" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI table documentation <span aria-hidden="true">↗</span></a>
        </section>
    </article>
@endsection
