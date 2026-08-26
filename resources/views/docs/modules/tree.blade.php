@php
    $treeBlade = <<<'BLADE'
<x-daisy-kit::tree />
BLADE;

    $treeImports = <<<'JS'
import 'vendor/art35rennes/laravel-daisy-kit/dist/tree.css';
import { mount, mountAll, unmount } from 'vendor/art35rennes/laravel-daisy-kit/dist/tree.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Tree — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Tree</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Explore nested data while keeping the host application responsible for ordinary interface controls. This page uses a deterministic documentation fixture; it does not simulate the package before the v5 prerelease is available.</p>

        <section class="mt-10" aria-labelledby="tree-usage-heading">
            <h2 id="tree-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <p class="mt-3 leading-7 text-base-content/75">The public component name is fixed. Required data attributes and options will be copied from the published prerelease documentation rather than guessed here.</p>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Tree Blade usage"><code>{{ $treeBlade }}</code></pre>
        </section>

        <section class="mt-10" aria-labelledby="tree-imports-heading">
            <h2 id="tree-imports-heading" class="text-2xl font-semibold">CSS and ESM imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Tree ESM and CSS imports"><code>{{ $treeImports }}</code></pre>
            <p class="mt-3 text-sm leading-6 text-base-content/70"><code>mount</code>, <code>mountAll</code>, and <code>unmount</code> are module exports. They do not register a global object.</p>
        </section>

        <section class="mt-10" aria-labelledby="tree-contract-heading">
            <h2 id="tree-contract-heading" class="text-2xl font-semibold">Public contract</h2>
            <dl class="mt-4 divide-y divide-base-300 border-y border-base-300">
                <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::tree</code></dd></div>
                <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Assets</dt><dd class="sm:col-span-2"><code>dist/tree.css</code> and <code>dist/tree.js</code></dd></div>
                <div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Events</dt><dd class="sm:col-span-2"><code>daisy-kit:tree:*</code></dd></div>
            </dl>
        </section>

        <section class="mt-10" aria-labelledby="tree-fixture-heading">
            <h2 id="tree-fixture-heading" class="text-2xl font-semibold">Deterministic fixture</h2>
            <p class="mt-3 leading-7 text-base-content/75">The host fixture documents a small project tree. It is plain semantic HTML, so it remains useful while the package component is intentionally not mounted.</p>
            <div class="mt-4 border border-base-300 bg-base-100 p-5">
                <details id="tree-fixture" open>
                    <summary class="cursor-pointer font-medium">Documentation</summary>
                    <ul class="mt-3 space-y-2 border-l border-base-300 pl-5" aria-label="Documentation fixture tree">
                        <li><span class="font-medium">README.md</span></li>
                        <li>
                            <details open>
                                <summary class="cursor-pointer font-medium">Guides</summary>
                                <ul class="mt-2 space-y-2 border-l border-base-300 pl-5"><li>installation.md</li><li>accessibility.md</li></ul>
                            </details>
                        </li>
                    </ul>
                </details>
            </div>
        </section>

        <section class="mt-10" aria-labelledby="tree-states-heading">
            <h2 id="tree-states-heading" class="text-2xl font-semibold">States</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <section class="border border-base-300 p-4" aria-labelledby="tree-empty-heading"><h3 id="tree-empty-heading" class="font-semibold">Empty</h3><p class="mt-2 text-sm leading-6 text-base-content/70">No nodes are available for this tree.</p></section>
                <section class="border border-base-300 p-4" aria-labelledby="tree-loading-heading"><h3 id="tree-loading-heading" class="font-semibold">Loading</h3><div class="mt-3 space-y-2" role="status" aria-busy="true" aria-label="Loading tree fixture"><div class="h-4 w-3/4 animate-pulse bg-base-300"></div><div class="h-4 w-1/2 animate-pulse bg-base-300"></div></div></section>
                <section class="border border-error/40 p-4" aria-labelledby="tree-error-heading"><h3 id="tree-error-heading" class="font-semibold">Error</h3><p class="mt-2 text-sm leading-6 text-base-content/70">The tree data could not be loaded. Keep the retry action in the host application.</p></section>
            </div>
        </section>

        <section class="mt-10 border-t border-base-300 pt-8" aria-labelledby="tree-checkpoint-heading" data-package-checkpoint>
            <h2 id="tree-checkpoint-heading" class="text-2xl font-semibold">Package prerelease checkpoint</h2>
            <p class="mt-3 leading-7 text-base-content/75">A v5 prerelease tag is required before this branch can resolve Composer, mount <code>x-daisy-kit::tree</code>, and verify emitted events in a real component. No package stand-in is rendered on this page.</p>
            <a class="btn btn-outline btn-sm mt-4" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">Use native DaisyUI navigation patterns <span aria-hidden="true">↗</span></a>
        </section>
    </article>
@endsection
