@php
    $blade = <<<'BLADE'
<x-daisy-kit::scrollspy target="#release-guide" />
<div id="release-guide" class="mt-6 space-y-10">
    <section class="min-h-64"><h2 id="guide-overview" class="text-xl font-semibold">Release overview</h2><p class="mt-4">Each component owns its behavior. The Laravel host owns routes, data and DaisyUI styling.</p></section>
    <section class="min-h-64"><h2 id="guide-review" class="text-xl font-semibold">Review checklist</h2><p class="mt-4">Confirm keyboard access, submitted values and the Content Security Policy before shipping.</p></section>
    <section class="min-h-64"><h2 id="guide-publish" class="text-xl font-semibold">Publish the release</h2><p class="mt-4">Install the verified Composer reference and compile the explicit module entries with Vite.</p></section>
</div>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/scrollspy.css';
import { mountAll, getInstance } from '@daisy-kit/scrollspy.js';

mountAll();
const root = document.querySelector('[data-daisy-kit-module="scrollspy"]');
const component = getInstance(root);

component.scrollTo('guide-review');
JS;
@endphp

@extends('layouts.docs', ['title' => 'Scrollspy — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Scrollspy</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Follow headings in a document as you navigate.</p>
        <section class="mt-10 space-y-6" aria-labelledby="scrollspy-examples-heading">
            <h2 id="scrollspy-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="scrollspy-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Document navigation</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Select a heading or scroll the document; the current destination is announced with aria-current.</p>
                <x-daisy-kit::scrollspy target="#release-guide" />
                <div id="release-guide" class="mt-6 space-y-10">
                    <section class="min-h-64"><h2 id="guide-overview" class="text-xl font-semibold">Release overview</h2><p class="mt-4">Each component owns its behavior. The Laravel host owns routes, data and DaisyUI styling.</p></section>
                    <section class="min-h-64"><h2 id="guide-review" class="text-xl font-semibold">Review checklist</h2><p class="mt-4">Confirm keyboard access, submitted values and the Content Security Policy before shipping.</p></section>
                    <section class="min-h-64"><h2 id="guide-publish" class="text-xl font-semibold">Publish the release</h2><p class="mt-4">Install the verified Composer reference and compile the explicit module entries with Vite.</p></section>
                </div>
            </section>
        </section>
        <section class="mt-10" aria-labelledby="scrollspy-usage-heading">
            <h2 id="scrollspy-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Scrollspy Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="scrollspy-imports-heading">
            <h2 id="scrollspy-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Scrollspy ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Integrator API</h2>
            <p class="leading-7">refresh(), getActive(), scrollTo(id).</p>
            <p class="leading-7">mount(root) returns a stable facade or null; getInstance(root) retrieves it. unmount(root) cleans up the instance. Commands return booleans unless documented as asynchronous; getters return values.</p>
            <p class="leading-7">Events use the <code>daisy-kit:scrollspy:</code> prefix: change { id }.</p>
            <h3 class="pt-3 text-lg font-semibold">Laravel submission</h3>
            <p class="leading-7">No form value is submitted.</p>
            <h3 class="pt-3 text-lg font-semibold">CSP and error handling</h3>
            <p class="leading-7">Refresh after changing headings. Navigation respects reduced-motion preferences and supports a scrollable target.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI styling patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
