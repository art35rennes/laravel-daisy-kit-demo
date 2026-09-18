@php
    $blade = <<<'BLADE'
<div class="grid gap-6 lg:grid-cols-[14rem_minmax(0,1fr)]">
    <div class="self-start lg:sticky lg:top-6">
        <x-daisy-kit::scrollspy target="#release-guide" />
    </div>
    <div id="release-guide" class="max-h-96 space-y-10 overflow-y-auto" tabindex="0">
        <!-- Document sections with h2/h3 identifiers -->
    </div>
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
        <p class="text-sm font-medium uppercase tracking-widest text-base-content/70">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Scrollspy</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Follow headings in a document as you navigate.</p>
        <section class="mt-10 space-y-6" aria-labelledby="scrollspy-examples-heading">
            <h2 id="scrollspy-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="scrollspy-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Document navigation</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Select a heading or scroll the document; the current destination is announced with aria-current.</p>
                <div class="grid gap-6 lg:grid-cols-[14rem_minmax(0,1fr)] lg:gap-8">
                    <div class="self-start rounded-box bg-base-200 p-3 lg:sticky lg:top-6">
                        <x-daisy-kit::scrollspy target="#release-guide" />
                    </div>
                    <div id="release-guide" class="max-h-96 min-w-0 space-y-10 overflow-y-auto scroll-smooth pr-3" tabindex="0" aria-label="Release guide">
                        <section class="min-h-64 border-b border-base-300 pb-8">
                            <h2 id="guide-overview" class="text-xl font-semibold">Release overview</h2>
                            <p class="mt-4 leading-7">This release separates thirteen focused components. Each one owns its browser behavior while the Laravel application continues to own routes, data and DaisyUI styling.</p>
                            <p class="mt-4 leading-7 text-base-content/75">Start by identifying the smallest component that covers the user outcome, then import only its JavaScript and CSS entries.</p>
                        </section>
                        <section class="min-h-64 border-b border-base-300 pb-8">
                            <h2 id="guide-review" class="text-xl font-semibold">Review checklist</h2>
                            <p class="mt-4 leading-7">Exercise the control with a keyboard, verify the native Laravel value and inspect its accessible name and state before shipping.</p>
                            <h3 id="guide-review-csp" class="mt-6 text-base font-semibold">Content Security Policy</h3>
                            <p class="mt-2 leading-7 text-base-content/75">Keep the strict policy for this module and confirm that the browser reports no inline script or style violations.</p>
                        </section>
                        <section class="min-h-64 pb-8">
                            <h2 id="guide-publish" class="text-xl font-semibold">Publish the release</h2>
                            <p class="mt-4 leading-7">Install the verified Composer reference, compile the explicit module entries with Vite and deploy the generated application assets.</p>
                            <p class="mt-4 leading-7 text-base-content/75">The active link follows this scrollable document and remains visible in the adjacent navigation.</p>
                        </section>
                    </div>
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
