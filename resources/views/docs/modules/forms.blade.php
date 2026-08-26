@php
    $fixture = \App\Support\FileMapFixtures::forms();
    $viewerBlade = <<<'BLADE'
<x-daisy-kit::forms.viewer :schema="$schema" :value="$value" />
BLADE;
    $builderBlade = <<<'BLADE'
<x-daisy-kit::forms.builder :schema="$schema" />
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/forms-viewer.css';
import { mountAll } from '@daisy-kit/forms-viewer.js';

import '@daisy-kit/forms-builder.css';
import { mountAll as mountAllBuilders } from '@daisy-kit/forms-builder.js';

mountAll();
mountAllBuilders();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Forms — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Forms</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">The viewer renders a schema without Livewire. This demo also installs Livewire 4 and mounts the optional builder through its published Blade component.</p>

        <section class="mt-10" aria-labelledby="forms-example-heading">
            <h2 id="forms-example-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <div class="mt-4 grid gap-6 lg:grid-cols-2">
                <section class="border border-base-300 bg-base-100 p-5" aria-labelledby="viewer-heading"><h3 id="viewer-heading" class="font-semibold">Viewer</h3><x-daisy-kit::forms.viewer :schema="$fixture['schema']" :value="$fixture['value']" /></section>
                <section class="border border-base-300 bg-base-100 p-5" aria-labelledby="builder-heading"><h3 id="builder-heading" class="font-semibold">Builder</h3><x-daisy-kit::forms.builder :schema="$fixture['schema']" /></section>
            </div>
        </section>

        <section class="mt-10" aria-labelledby="forms-usage-heading"><h2 id="forms-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Forms Blade usage"><code>{{ $viewerBlade }}

{{ $builderBlade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="forms-imports-heading"><h2 id="forms-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Forms ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="forms-contract-heading"><h2 id="forms-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300"><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Viewer</dt><dd class="sm:col-span-2"><code>x-daisy-kit::forms.viewer</code>; <code>schema</code> and <code>value</code>.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Builder</dt><dd class="sm:col-span-2"><code>x-daisy-kit::forms.builder</code>; <code>schema</code>. Livewire 4 enhances this optional module.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Lifecycle</dt><dd class="sm:col-span-2"><code>mount</code>, <code>mountAll</code>, <code>unmount</code>; <code>daisy-kit:forms-viewer:*</code> and <code>daisy-kit:forms-builder:*</code>.</dd></div></dl></section>
        <section class="mt-10" aria-labelledby="forms-states-heading"><h2 id="forms-states-heading" class="text-2xl font-semibold">States</h2><p class="mt-3 leading-7 text-base-content/75">Each mount starts loading, becomes ready when a schema contains fields, and reports empty for an empty schema. Invalid configuration and missing mount markup emit an accessible error event; the public component API deliberately does not expose an error-only demo prop.</p><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::forms.viewer :schema="['fields' => []]" /></div></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI form controls <span aria-hidden="true">↗</span></a>
    </article>
@endsection
