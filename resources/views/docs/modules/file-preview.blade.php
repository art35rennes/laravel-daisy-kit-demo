@php
    $blade = <<<'BLADE'
<x-daisy-kit::file-preview
    url="/fixtures/file-preview/release-notes.pdf"
    mime-type="application/pdf"
    name="Release notes"
    layout="card"
    preview-mode="modal"
    :max-preview-bytes="10 * 1024 * 1024"
    :max-text-preview-bytes="64 * 1024"
    notice="Preview is isolated; download for the original file."
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/file-preview.css';
import { getInstance, mountAll } from '@daisy-kit/file-preview.js';

mountAll();

getInstance(document.querySelector('[data-file-preview-instance="customer-handoff"]'))?.open();
JS;
@endphp

@extends('layouts.docs', ['title' => 'File Preview — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">File Preview</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Preview images, audio, video, text, PDF and DOCX files inside an opaque-origin sandbox. Unsupported formats keep an explicit, useful download state.</p>

        <section class="mt-10 space-y-6" aria-labelledby="file-preview-examples-heading">
            <h2 id="file-preview-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>

            <section id="media-previews" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Media previews</h3>
                <p class="mt-2 text-sm text-base-content/70">The image and video open in bounded modals while audio stays compact and playable inline.</p>
                <div class="mt-4 grid items-start gap-4 md:grid-cols-2 lg:grid-cols-3">
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/office-plan.svg"
                        type="image"
                        mime-type="image/svg+xml"
                        name="Office plan.svg"
                        preview-mode="modal"
                    />
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/preview.wav"
                        type="audio"
                        mime-type="audio/wav"
                        name="Interview excerpt.wav"
                        layout="compact-list"
                        preview-mode="inline"
                    />
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/preview-walkthrough.mp4"
                        type="video"
                        mime-type="video/mp4"
                        name="Preview walkthrough.mp4"
                        preview-mode="modal"
                    />
                </div>
            </section>

            <section id="document-previews" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Document previews</h3>
                <p class="mt-2 text-sm text-base-content/70">Text renders inline; PDF and DOCX use the same isolated modal with document-specific controls.</p>
                <div class="mt-4 grid items-start gap-4 lg:grid-cols-3">
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/quarterly-report.txt"
                        type="text"
                        mime-type="text/plain"
                        name="Quarterly report.txt"
                        preview-mode="inline"
                        notice="Rendered in an isolated sandbox."
                    />
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/release-notes.pdf"
                        type="pdf"
                        mime-type="application/pdf"
                        name="Release notes.pdf"
                        preview-mode="modal"
                    />
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/editorial-brief.docx"
                        type="docx"
                        mime-type="application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        name="Editorial brief.docx"
                        preview-mode="modal"
                        docx-view="width"
                    />
                </div>
            </section>

            <section id="custom-actions" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Custom actions and public API</h3>
                <p class="mt-2 text-sm text-base-content/70">Slots own the trigger and footer; an external control opens the same instance through <code>getInstance()</code>.</p>
                <div class="mt-4 flex flex-wrap items-center gap-3">
                    <x-daisy-kit::file-preview
                        data-file-preview-instance="customer-handoff"
                        url="/fixtures/file-preview/quarterly-report.txt"
                        type="text"
                        name="Customer hand-off.txt"
                        layout="action-only"
                        preview-mode="modal"
                    >
                        <x-slot:trigger>
                            <button class="btn btn-secondary" type="button">Inspect customer hand-off</button>
                        </x-slot:trigger>
                        <x-slot:modalFooter>
                            <p class="text-sm text-base-content/70">Custom footer supplied by the integrator.</p>
                        </x-slot:modalFooter>
                    </x-daisy-kit::file-preview>
                    <button class="btn btn-outline" data-file-preview-open-external="customer-handoff" type="button">Open through the public API</button>
                </div>
            </section>

            <section id="preview-errors" class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Errors and limits</h3>
                <p class="mt-2 text-sm text-base-content/70">The first source has an invalid MIME for PDF; the second exceeds its explicit transport limit. Both errors stay local and retryable.</p>
                <div class="mt-4 grid gap-4 md:grid-cols-2">
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/quarterly-report.txt"
                        type="pdf"
                        mime-type="application/pdf"
                        name="Invalid contract.pdf"
                        preview-mode="modal"
                    />
                    <x-daisy-kit::file-preview
                        url="/fixtures/file-preview/quarterly-report.txt"
                        type="text"
                        name="Oversized report.txt"
                        :max-preview-bytes="1"
                    />
                </div>
            </section>
        </section>

        <section class="mt-10" aria-labelledby="file-preview-usage-heading">
            <h2 id="file-preview-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="File Preview Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="file-preview-imports-heading">
            <h2 id="file-preview-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="File Preview ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10">
            <h2 class="text-2xl font-semibold">Common options</h2>
            <p class="mt-3 leading-7 text-base-content/75"><code>file</code> or <code>url</code> describes the source; <code>layout</code> chooses <code>card</code>, <code>compact-list</code> or <code>action-only</code>; <code>previewMode</code> chooses <code>auto</code>, <code>inline</code>, <code>modal</code> or <code>download</code>. Image, video, audio, PDF, text and DOCX are previewable. Modal previews retain the validated download action; multipage DOCX and PDF files scroll inside their isolated frame. The stable instance facade exposes state, open/close, retry, zoom and <code>fit()</code> controls, with English and French labels supplied by Laravel translations.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI loading states <span aria-hidden="true">↗</span></a>
    </article>
@endsection
