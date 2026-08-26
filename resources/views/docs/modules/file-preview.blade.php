@extends('layouts.docs', ['title' => 'File Preview — Laravel Daisy Kit'])

@php($file = \App\Support\FileMapFixtures::filePreview())

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">File Preview</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Render file-preview UI from a deterministic descriptor. The package owns the preview module; the host keeps surrounding controls and status messaging in native DaisyUI.</p>

        <section class="mt-10" aria-labelledby="file-preview-example-heading">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <div><h2 id="file-preview-example-heading" class="text-2xl font-semibold">Deterministic fixture</h2><p class="mt-2 leading-7 text-base-content/75">This host-owned descriptor lets the page document a realistic input without storage, uploads, or a package stub.</p></div>
                <a class="btn btn-outline btn-sm" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI loading states <span aria-hidden="true">↗</span></a>
            </div>
            <div class="mt-5 grid gap-4 border border-base-300 bg-base-100 p-5 sm:grid-cols-[auto_1fr]" data-file-preview-fixture>
                <div class="grid size-14 place-items-center bg-base-200 text-2xl" aria-hidden="true">PDF</div>
                <div><h3 class="font-semibold">{{ $file['name'] }}</h3><dl class="mt-2 grid gap-x-6 gap-y-1 text-sm text-base-content/70 sm:grid-cols-2"><div><dt class="sr-only">Type</dt><dd>{{ $file['type'] }}</dd></div><div><dt class="sr-only">Size</dt><dd>{{ $file['size'] }}</dd></div><div><dt class="sr-only">Updated</dt><dd>Updated {{ $file['updatedAt'] }}</dd></div></dl><p class="mt-4 text-sm text-base-content/70">The package component is not mounted before the v5 prerelease is resolved.</p></div>
            </div>
        </section>

        <section class="mt-12" aria-labelledby="file-preview-blade-heading">
            <h2 id="file-preview-blade-heading" class="text-2xl font-semibold">Blade usage</h2>
            <p class="mt-2 leading-7 text-base-content/75">Copy the fixed component entry point. Its final attribute contract will be documented with the published prerelease rather than guessed here.</p>
            <pre class="code-sample mt-4" tabindex="0" aria-label="File Preview Blade usage"><code>&lt;x-daisy-kit::file-preview /&gt;</code></pre>
        </section>

        <section class="mt-12" aria-labelledby="file-preview-assets-heading">
            <h2 id="file-preview-assets-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4" tabindex="0" aria-label="File Preview ESM and CSS imports"><code>import 'vendor/art35rennes/laravel-daisy-kit/dist/file-preview.css';
import { mountAll } from 'vendor/art35rennes/laravel-daisy-kit/dist/file-preview.js';

mountAll();</code></pre>
        </section>

        <section class="mt-12" aria-labelledby="file-preview-contract-heading">
            <h2 id="file-preview-contract-heading" class="text-2xl font-semibold">Public contract</h2>
            <dl class="mt-4 divide-y divide-base-300 border-y border-base-300 text-sm"><div class="grid gap-1 py-4 sm:grid-cols-[11rem_1fr]"><dt class="font-medium">Blade component</dt><dd><code>x-daisy-kit::file-preview</code></dd></div><div class="grid gap-1 py-4 sm:grid-cols-[11rem_1fr]"><dt class="font-medium">JavaScript</dt><dd><code>mount</code>, <code>mountAll</code>, <code>unmount</code></dd></div><div class="grid gap-1 py-4 sm:grid-cols-[11rem_1fr]"><dt class="font-medium">Events</dt><dd><code>daisy-kit:file-preview:*</code>; no global object is exposed.</dd></div></dl>
        </section>

        <section class="mt-12" aria-labelledby="file-preview-states-heading">
            <h2 id="file-preview-states-heading" class="text-2xl font-semibold">State references</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3"><section class="border border-base-300 p-4"><h3 class="font-semibold">Empty</h3><p class="mt-2 text-sm leading-6 text-base-content/70">No file descriptor is available yet.</p></section><section class="border border-base-300 p-4"><h3 class="font-semibold">Loading</h3><p class="mt-2 text-sm leading-6 text-base-content/70">The host is resolving a file descriptor.</p></section><section class="border border-base-300 p-4"><h3 class="font-semibold">Error</h3><p class="mt-2 text-sm leading-6 text-base-content/70">The descriptor could not be resolved. Keep recovery UI in the host.</p></section></div>
        </section>

        <section class="mt-12 border-t border-base-300 pt-8" aria-labelledby="file-preview-checkpoint-heading">
            <h2 id="file-preview-checkpoint-heading" class="text-2xl font-semibold">Package prerelease checkpoint</h2>
            <p class="mt-3 leading-7 text-base-content/75">The v5 package prerelease is not published or Composer-resolved in this branch. This page deliberately documents only the agreed entry points and does not imitate a file-preview implementation.</p>
        </section>
    </article>
@endsection
