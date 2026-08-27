@php
    $profile = \App\Support\FileMapFixtures::formsParity();
    $preferences = \App\Support\FileMapFixtures::forms();
    $viewerBlade = <<<'BLADE'
<x-daisy-kit::forms.viewer
    :schema="$schema"
    :value="$value"
    submit-mode="event"
    validate-on="input"
/>
BLADE;
    $builderBlade = <<<'BLADE'
<x-daisy-kit::forms.builder
    :schema="$schema"
    name="contributor_schema"
    :preview="true"
    :json-editor="true"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/forms-viewer.css';
import { mountAll as mountFormsViewer } from '@daisy-kit/forms-viewer.js';
import '@daisy-kit/forms-builder.css';
import { mountAll as mountFormsBuilder } from '@daisy-kit/forms-builder.js';

mountFormsViewer();
mountFormsBuilder();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Forms — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Forms</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Viewer works without Livewire; this demo installs Livewire 4 to expose the published Builder authoring surface.</p>

        <section class="mt-10 space-y-6" aria-labelledby="forms-examples-heading">
            <h2 id="forms-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="contributor-profile" class="rounded-box border border-base-300 bg-base-100 p-5" aria-labelledby="contributor-profile-heading">
                <h3 id="contributor-profile-heading" class="font-semibold">Contributor profile</h3>
                <p class="mt-2 text-sm text-base-content/70">A nested, progressively validated profile with a JSONata computed review value and an event submission.</p>
                <x-daisy-kit::forms.viewer :schema="$profile['schema']" :value="$profile['value']" submit-mode="event" validate-on="input" />
            </section>
            <section id="preference-variant" class="rounded-box border border-base-300 bg-base-100 p-5" aria-labelledby="preference-variant-heading">
                <h3 id="preference-variant-heading" class="font-semibold">Preference variant</h3>
                <p class="mt-2 text-sm text-base-content/70">A compact viewer shows standard select options without requiring Livewire.</p>
                <x-daisy-kit::forms.viewer :schema="$preferences['schema']" :value="$preferences['value']" submit-mode="event" />
            </section>
            <section id="invalid-submission" class="rounded-box border border-base-300 bg-base-100 p-5" aria-labelledby="invalid-submission-heading">
                <h3 id="invalid-submission-heading" class="font-semibold">Invalid submission</h3>
                <p class="mt-2 text-sm text-base-content/70">Laravel-style errors remain visible while the Viewer continues to own progressive validation.</p>
                <x-daisy-kit::forms.viewer :schema="$preferences['schema']" :value="[]" :errors="['email' => ['An email address is required.']]" submit-mode="none" />
            </section>
            <section class="rounded-box border border-base-300 bg-base-100 p-5" aria-labelledby="builder-heading">
                <h3 id="builder-heading" class="font-semibold">Livewire Builder authoring</h3>
                <p class="mt-2 text-sm text-base-content/70">Add, remove, reorder and inspect fields; preview, JSON import/export and undo/redo use the real optional Livewire module.</p>
                <x-daisy-kit::forms.builder :schema="$profile['schema']" name="contributor_schema" :preview="true" :json-editor="true" />
            </section>
        </section>

        <section class="mt-10" aria-labelledby="forms-usage-heading"><h2 id="forms-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Forms Blade usage"><code>{{ $viewerBlade }}

{{ $builderBlade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="forms-imports-heading"><h2 id="forms-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Forms ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="forms-contract-heading"><h2 id="forms-contract-heading" class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>schema</code>, <code>value</code>, <code>errors</code>, <code>readonly</code>, <code>submitMode</code>, <code>action</code>, <code>method</code> and <code>validateOn</code> configure Viewer. Builder accepts <code>schema</code>, <code>name</code>, <code>value</code>, <code>errors</code>, <code>preview</code> and <code>jsonEditor</code>. JSONata always uses the documented object descriptor; see the package API for rare field attributes and rule descriptors.</p></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI form controls <span aria-hidden="true">↗</span></a>
    </article>
@endsection
