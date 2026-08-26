@php
    $blueprintBlade = <<<'BLADE'
<x-daisy-kit::blueprint />
BLADE;

    $blueprintImports = <<<'JS'
import 'vendor/art35rennes/laravel-daisy-kit/dist/blueprint.css';
import { mount, mountAll, unmount } from 'vendor/art35rennes/laravel-daisy-kit/dist/blueprint.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Blueprint — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Blueprint</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Inspect a small workflow graph without adding a visual editor framework to the host. The deterministic fixture below is documentation data, not a temporary replacement for the package module.</p>

        <section class="mt-10" aria-labelledby="blueprint-usage-heading">
            <h2 id="blueprint-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <p class="mt-3 leading-7 text-base-content/75">The public component name is fixed. Input options will be documented from the published v5 prerelease instead of being invented by this demo.</p>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blueprint Blade usage"><code>{{ $blueprintBlade }}</code></pre>
        </section>

        <section class="mt-10" aria-labelledby="blueprint-imports-heading">
            <h2 id="blueprint-imports-heading" class="text-2xl font-semibold">CSS and ESM imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blueprint ESM and CSS imports"><code>{{ $blueprintImports }}</code></pre>
            <p class="mt-3 text-sm leading-6 text-base-content/70">Use module-scoped <code>mount</code>, <code>mountAll</code>, and <code>unmount</code> imports; the module exposes no global API.</p>
        </section>

        <section class="mt-10" aria-labelledby="blueprint-contract-heading">
            <h2 id="blueprint-contract-heading" class="text-2xl font-semibold">Public contract</h2>
            <dl class="mt-4 divide-y divide-base-300 border-y border-base-300">
                <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::blueprint</code></dd></div>
                <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Assets</dt><dd class="sm:col-span-2"><code>dist/blueprint.css</code> and <code>dist/blueprint.js</code></dd></div>
                <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Events</dt><dd class="sm:col-span-2"><code>daisy-kit:blueprint:*</code></dd></div>
            </dl>
        </section>

        <section class="mt-10" aria-labelledby="blueprint-fixture-heading">
            <h2 id="blueprint-fixture-heading" class="text-2xl font-semibold">Deterministic fixture</h2>
            <p class="mt-3 leading-7 text-base-content/75">This workflow stays deliberately small and deterministic: three named stages and two transitions.</p>
            <ol class="mt-4 grid gap-4 md:grid-cols-3" aria-label="Publication workflow fixture">
                <li class="border border-base-300 bg-base-100 p-4"><span class="badge badge-outline">1</span><h3 class="mt-3 font-semibold">Draft</h3><p class="mt-2 text-sm leading-6 text-base-content/70">Prepare the content.</p></li>
                <li class="border border-base-300 bg-base-100 p-4"><span class="badge badge-outline">2</span><h3 class="mt-3 font-semibold">Review</h3><p class="mt-2 text-sm leading-6 text-base-content/70">Check the release candidate.</p></li>
                <li class="border border-base-300 bg-base-100 p-4"><span class="badge badge-outline">3</span><h3 class="mt-3 font-semibold">Published</h3><p class="mt-2 text-sm leading-6 text-base-content/70">Expose the approved result.</p></li>
            </ol>
        </section>

        <section class="mt-10" aria-labelledby="blueprint-states-heading">
            <h2 id="blueprint-states-heading" class="text-2xl font-semibold">States</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <section class="border border-base-300 p-4" aria-labelledby="blueprint-empty-heading"><h3 id="blueprint-empty-heading" class="font-semibold">Empty</h3><p class="mt-2 text-sm leading-6 text-base-content/70">No workflow has been supplied.</p></section>
                <section class="border border-base-300 p-4" aria-labelledby="blueprint-loading-heading"><h3 id="blueprint-loading-heading" class="font-semibold">Loading</h3><div class="mt-3 space-y-2" role="status" aria-busy="true" aria-label="Loading blueprint fixture"><div class="h-4 w-2/3 animate-pulse bg-base-300"></div><div class="h-4 w-full animate-pulse bg-base-300"></div></div></section>
                <section class="border border-error/40 p-4" aria-labelledby="blueprint-error-heading"><h3 id="blueprint-error-heading" class="font-semibold">Error</h3><p class="mt-2 text-sm leading-6 text-base-content/70">The workflow could not be read. Surface a meaningful recovery action in the host.</p></section>
            </div>
        </section>

        <section class="mt-10 border-t border-base-300 pt-8" aria-labelledby="blueprint-checkpoint-heading" data-package-checkpoint>
            <h2 id="blueprint-checkpoint-heading" class="text-2xl font-semibold">Package prerelease checkpoint</h2>
            <p class="mt-3 leading-7 text-base-content/75">A v5 prerelease tag is required before Composer can resolve the module, a real blueprint can mount, and its <code>daisy-kit:blueprint:*</code> events can be verified. This documentation intentionally ships no substitute editor.</p>
            <a class="btn btn-outline btn-sm mt-4" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">Use native DaisyUI status patterns <span aria-hidden="true">↗</span></a>
        </section>
    </article>
@endsection
