@php
    $file = \App\Support\FileMapFixtures::filePreview();
    $blade = <<<'BLADE'
<x-daisy-kit::file-preview src="/fixtures/quarterly-report.txt" type="text" name="Quarterly report" />
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/file-preview.css';
import { mountAll } from '@daisy-kit/file-preview.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'File Preview — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">File Preview</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Render a local, deterministic text fixture in the package’s sandboxed preview frame.</p>
        <section class="mt-10" aria-labelledby="file-preview-example-heading"><h2 id="file-preview-example-heading" class="text-2xl font-semibold">Interactive example</h2><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::file-preview :src="$file['src']" :type="$file['type']" :name="$file['name']" /><p class="mt-4 text-sm text-base-content/70">{{ $file['name'] }} · {{ $file['size'] }} · updated {{ $file['updatedAt'] }}</p></div></section>
        <section class="mt-10" aria-labelledby="file-preview-usage-heading"><h2 id="file-preview-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="File Preview Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10" aria-labelledby="file-preview-imports-heading"><h2 id="file-preview-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="File Preview ESM and CSS imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10" aria-labelledby="file-preview-contract-heading"><h2 id="file-preview-contract-heading" class="text-2xl font-semibold">Public contract</h2><dl class="mt-4 divide-y divide-base-300 border-y border-base-300"><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Blade component</dt><dd class="sm:col-span-2"><code>x-daisy-kit::file-preview</code>; <code>src</code>, <code>type</code>, <code>name</code>, <code>maxBytes</code>.</dd></div><div class="grid gap-1 py-4 sm:grid-cols-3 sm:gap-4"><dt class="font-medium">Lifecycle</dt><dd class="sm:col-span-2"><code>mount</code>, <code>mountAll</code>, <code>unmount</code>; <code>daisy-kit:file-preview:*</code>.</dd></div></dl></section>
        <section class="mt-10" aria-labelledby="file-preview-states-heading"><h2 id="file-preview-states-heading" class="text-2xl font-semibold">States</h2><p class="mt-3 leading-7 text-base-content/75">The real component reports loading while it retrieves a file, empty without a source, and an accessible error for an unsupported type or rejected file.</p><div class="mt-4 border border-base-300 bg-base-100 p-5"><x-daisy-kit::file-preview /></div></section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI loading states <span aria-hidden="true">↗</span></a>
    </article>
@endsection
