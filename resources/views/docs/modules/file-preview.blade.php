@php
    $blade = <<<'BLADE'
<x-daisy-kit::file-preview
    src="/fixtures/release-notes.pdf"
    type="pdf"
    name="Release notes"
    layout="modal"
    :max-bytes="10 * 1024 * 1024"
    notice="Preview is isolated; download for the original file."
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/file-preview.css';
import { mountAll } from '@daisy-kit/file-preview.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'File Preview — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl"><p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p><h1 class="mt-3 text-4xl font-bold tracking-tight">File Preview</h1><p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Every preview is fetched from a local deterministic fixture and rendered inside the package’s opaque-origin sandboxed frame.</p>
        <section class="mt-10 space-y-6" aria-labelledby="file-preview-examples-heading"><h2 id="file-preview-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="text-report" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Text report</h3><p class="mt-2 text-sm text-base-content/70">Open the local text report, then close it to verify focus returns to the package control.</p><x-daisy-kit::file-preview src="/fixtures/quarterly-report.txt" type="text" name="Quarterly report" layout="modal" notice="Preview is isolated; download for the original file." /></section>
            <section id="document-gallery" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Document gallery</h3><p class="mt-2 text-sm text-base-content/70">Image, PDF and DOCX sources exercise the published type detection and modal/card layouts.</p><div class="mt-4 grid gap-4 lg:grid-cols-3"><x-daisy-kit::file-preview src="/fixtures/office-plan.svg" type="image" name="Office plan" layout="card" /><x-daisy-kit::file-preview src="/fixtures/release-notes.pdf" type="pdf" name="Release notes" layout="modal" /><x-daisy-kit::file-preview src="/fixtures/editorial-brief.docx" type="docx" name="Editorial brief" layout="action-only" /></div></section>
            <section id="rejected-file" class="rounded-box border border-base-300 bg-base-100 p-5"><h3 class="font-semibold">Rejected file</h3><p class="mt-2 text-sm text-base-content/70">A small explicit byte limit shows the real package rejection state without a host-side substitute.</p><x-daisy-kit::file-preview src="/fixtures/quarterly-report.txt" type="text" name="Rejected report" :max-bytes="1" /></section>
        </section>
        <section class="mt-10" aria-labelledby="file-preview-usage-heading"><h2 id="file-preview-usage-heading" class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="File Preview Blade usage"><code>{{ $blade }}</code></pre></section><section class="mt-10" aria-labelledby="file-preview-imports-heading"><h2 id="file-preview-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="File Preview ESM and CSS imports"><code>{{ $imports }}</code></pre></section><section class="mt-10"><h2 class="text-2xl font-semibold">Common options</h2><p class="mt-3 leading-7 text-base-content/75"><code>src</code>, <code>type</code>, <code>name</code>, <code>maxBytes</code>, <code>layout</code> and <code>notice</code> are the complete public options. Supported types are text, image, PDF, video and DOCX; see the API for MIME and event details.</p></section><a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI loading states <span aria-hidden="true">↗</span></a></article>
@endsection
