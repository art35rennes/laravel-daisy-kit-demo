@php
    $blade = <<<'BLADE'
<div class="max-w-sm">
    <x-daisy-kit::truncate :lines="2" text="This release adds six independent components for everyday Laravel interfaces. Select reviewers, capture approvals, copy reference numbers and navigate long documents without introducing a form engine or wrapping standard DaisyUI primitives." reveal-label="Read full release notes" />
</div>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/truncate.css';
import { mountAll, getInstance } from '@daisy-kit/truncate.js';

mountAll();
const root = document.querySelector('[data-daisy-kit-module="truncate"]');
const component = getInstance(root);

component.refresh();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Truncate — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Truncate</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Reveal overflowing text without losing selectable content.</p>
        <section class="mt-10 space-y-6" aria-labelledby="truncate-examples-heading">
            <h2 id="truncate-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="truncate-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Release notes</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Only overflowing text offers a reveal button. Open it to select and copy any portion of the full text.</p>
                <div class="max-w-sm">
                    <x-daisy-kit::truncate :lines="2" text="This release adds six independent components for everyday Laravel interfaces. Select reviewers, capture approvals, copy reference numbers and navigate long documents without introducing a form engine or wrapping standard DaisyUI primitives." reveal-label="Read full release notes" />
                </div>
            </section>
            <section id="truncate-example-2" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Short text</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Text that already fits does not need a reveal button.</p>
                <x-daisy-kit::truncate text="Release approved." />
            </section>
        </section>
        <section class="mt-10" aria-labelledby="truncate-usage-heading">
            <h2 id="truncate-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Truncate Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="truncate-imports-heading">
            <h2 id="truncate-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Truncate ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Integrator API</h2>
            <p class="leading-7">refresh(), isTruncated(), open(), close().</p>
            <p class="leading-7">mount(root) returns a stable facade or null; getInstance(root) retrieves it. unmount(root) cleans up the instance. Commands return booleans unless documented as asynchronous; getters return values.</p>
            <p class="leading-7">Events use the <code>daisy-kit:truncate:</code> prefix: opened { text }; closed { text }.</p>
            <h3 class="pt-3 text-lg font-semibold">Laravel submission</h3>
            <p class="leading-7">No form value is submitted. The full text remains selectable in the native popover.</p>
            <h3 class="pt-3 text-lg font-semibold">CSP and error handling</h3>
            <p class="leading-7">Uses ResizeObserver to measure real overflow. Content is rendered as text, never arbitrary HTML.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI styling patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
