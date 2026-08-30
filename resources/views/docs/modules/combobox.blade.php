@php
    $blade = <<<'BLADE'
<form method="get" action="{{ route('docs.module', 'combobox') }}" class="space-y-4">
    <x-daisy-kit::combobox name="reviewer" label="Reviewer" :options="[['value' => 'ada', 'label' => 'Ada Lovelace'], ['value' => 'grace', 'label' => 'Grace Hopper'], ['value' => 'margaret', 'label' => 'Margaret Hamilton']]" placeholder="Search reviewers" />
    <button type="submit" class="btn btn-primary">Choose reviewer</button>
</form>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/combobox.css';
import { mountAll, getInstance } from '@daisy-kit/combobox.js';

mountAll();
const root = document.querySelector('[data-daisy-kit-module="combobox"]');
const component = getInstance(root);

component.setValue('ada');
JS;
@endphp

@extends('layouts.docs', ['title' => 'Combobox — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Combobox</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Search options, select several values or create tags.</p>
        <section class="mt-10 space-y-6" aria-labelledby="combobox-examples-heading">
            <h2 id="combobox-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="combobox-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Choose a reviewer</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Type to rank local options. Arrow keys and Enter select; Escape closes the list.</p>
                <form method="get" action="{{ route('docs.module', 'combobox') }}" class="space-y-4">
                    <x-daisy-kit::combobox name="reviewer" label="Reviewer" :options="[['value' => 'ada', 'label' => 'Ada Lovelace'], ['value' => 'grace', 'label' => 'Grace Hopper'], ['value' => 'margaret', 'label' => 'Margaret Hamilton']]" placeholder="Search reviewers" />
                    <button type="submit" class="btn btn-primary">Choose reviewer</button>
                </form>
            </section>
            <section id="combobox-example-2" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Create release tags</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Add known labels or create your own. Paste comma-separated tags; duplicates are ignored.</p>
                <x-daisy-kit::combobox name="tags" label="Release tags" :multiple="true" :allow-custom="true" :max-items="5" :token-separators="[',', ';']" :options="[['value' => 'docs', 'label' => 'Documentation'], ['value' => 'fix', 'label' => 'Bug fix']]" :value="['docs']" placeholder="Add a tag" />
            </section>
        </section>
        <section class="mt-10" aria-labelledby="combobox-usage-heading">
            <h2 id="combobox-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Combobox Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="combobox-imports-heading">
            <h2 id="combobox-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Combobox ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Integrator API</h2>
            <p class="leading-7">getValue(), setValue(value), clear(), open(), close(); refresh(): Promise&lt;boolean&gt;.</p>
            <p class="leading-7">mount(root) returns a stable facade or null; getInstance(root) retrieves it. unmount(root) cleans up the instance. Commands return booleans unless documented as asynchronous; getters return values.</p>
            <p class="leading-7">Events use the <code>daisy-kit:combobox:</code> prefix: change { value, values }; query { query }; loading { loading, query }; error { code, message }.</p>
            <h3 class="pt-3 text-lg font-semibold">Laravel submission</h3>
            <p class="leading-7">Single selection submits name; multiple selection submits repeated name[] values.</p>
            <h3 class="pt-3 text-lg font-semibold">CSP and error handling</h3>
            <p class="leading-7">Remote GET sources return { items, nextCursor? }. Superseded requests are cancelled; invalid responses emit an error.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI styling patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
