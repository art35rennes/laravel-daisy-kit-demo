@php
    $blade = <<<'BLADE'
<form method="get" action="{{ route('docs.module', 'transfer-list') }}" class="space-y-4">
    <x-daisy-kit::transfer-list name="reviewers" label="Release reviewers" source-label="Available reviewers" target-label="Assigned reviewers" :searchable="true" :max-items="3" :items="[['value' => 'ada', 'label' => 'Ada Lovelace', 'description' => 'Documentation'], ['value' => 'grace', 'label' => 'Grace Hopper', 'description' => 'Runtime'], ['value' => 'margaret', 'label' => 'Margaret Hamilton', 'description' => 'Quality'], ['value' => 'alan', 'label' => 'Alan Turing', 'disabled' => true]]" :value="['grace']" />
    <button type="submit" class="btn btn-primary">Save assignment</button>
</form>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/transfer-list.css';
import { mountAll, getInstance } from '@daisy-kit/transfer-list.js';

mountAll();
const root = document.querySelector('[data-daisy-kit-module="transfer-list"]');
const component = getInstance(root);

component.setTargetValues(['grace', 'ada']);
JS;
@endphp

@extends('layouts.docs', ['title' => 'Transfer List — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Transfer List</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Choose and order an assignment list with keyboard or drag and drop.</p>
        <section class="mt-10 space-y-6" aria-labelledby="transfer-list-examples-heading">
            <h2 id="transfer-list-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="transfer-list-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Assign reviewers</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Select people on either side and transfer them with buttons. Reorder the target with buttons or drag and drop.</p>
                <form method="get" action="{{ route('docs.module', 'transfer-list') }}" class="space-y-4">
                    <x-daisy-kit::transfer-list name="reviewers" label="Release reviewers" source-label="Available reviewers" target-label="Assigned reviewers" :searchable="true" :max-items="3" :items="[['value' => 'ada', 'label' => 'Ada Lovelace', 'description' => 'Documentation'], ['value' => 'grace', 'label' => 'Grace Hopper', 'description' => 'Runtime'], ['value' => 'margaret', 'label' => 'Margaret Hamilton', 'description' => 'Quality'], ['value' => 'alan', 'label' => 'Alan Turing', 'disabled' => true]]" :value="['grace']" />
                    <button type="submit" class="btn btn-primary">Save assignment</button>
                </form>
            </section>
            <section id="transfer-list-example-2" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Fixed membership</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Disabled lists display the assignment without allowing mutations.</p>
                <x-daisy-kit::transfer-list label="Approved reviewers" :disabled="true" :items="[['value' => 'ada', 'label' => 'Ada Lovelace'], ['value' => 'grace', 'label' => 'Grace Hopper']]" :value="['ada']" />
            </section>
        </section>
        <section class="mt-10" aria-labelledby="transfer-list-usage-heading">
            <h2 id="transfer-list-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Transfer List Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="transfer-list-imports-heading">
            <h2 id="transfer-list-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Transfer List ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Integrator API</h2>
            <p class="leading-7">getTargetValues(), setTargetValues(values), move(direction, values), reorder(values), clearSelection().</p>
            <p class="leading-7">mount(root) returns a stable facade or null; getInstance(root) retrieves it. unmount(root) cleans up the instance. Commands return booleans unless documented as asynchronous; getters return values.</p>
            <p class="leading-7">Events use the <code>daisy-kit:transfer-list:</code> prefix: change { values }; reorder { values }; error { code, message }.</p>
            <h3 class="pt-3 text-lg font-semibold">Laravel submission</h3>
            <p class="leading-7">Repeated name[] fields preserve the target order. move uses to-target or to-source.</p>
            <h3 class="pt-3 text-lg font-semibold">CSP and error handling</h3>
            <p class="leading-7">SortableJS writes DOM styles. This page permits style-src-attr 'unsafe-inline'. Buttons and keyboard remain available without dragging.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI styling patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
