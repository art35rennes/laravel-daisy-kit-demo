@php
    $article = '<h1>Release notes</h1><div>Introduce your update with a <strong>clear summary</strong>.</div><ul><li>Describe the improvements.</li><li>Help readers take the next step.</li></ul>';
    $blade = <<<'BLADE'
<x-daisy-kit::wysiwyg
    name="article_body"
    label="Article body"
    placeholder="Write your article..."
    :value="$article"
    :required="true"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/wysiwyg.css';
import { mountAll, getInstance } from '@daisy-kit/wysiwyg.js';

mountAll();
const editor = getInstance(document.querySelector('[data-daisy-kit-module="wysiwyg"]'));
const html = editor.getValue();
JS;
@endphp

@extends('layouts.docs', ['title' => 'WYSIWYG - Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-base-content/70">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">WYSIWYG</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Write and format rich text with Trix. Headings, lists, links and history fit naturally into your DaisyUI theme.</p>
        <section class="mt-10 space-y-6" aria-label="Interactive examples">
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Draft an article</h2>
                <p class="my-3 text-sm text-base-content/70">Select text to format it, add a link, or organize your ideas into lists. Reset restores the original draft. This example stays in your browser.</p>
                <form>
                    <x-daisy-kit::wysiwyg name="article_body" label="Article body" placeholder="Write your article..." :value="$article" :required="true" />
                    <button class="btn btn-sm mt-4" type="reset">Reset article</button>
                </form>
            </section>
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5" data-theme="dark">
                <h2 class="text-xl font-semibold">Read-only article in a local theme</h2>
                <p class="my-3 text-sm text-base-content/70">The same content remains selectable in a dark theme, with editing controls hidden.</p>
                <x-daisy-kit::wysiwyg name="published_article" label="Published article" :value="$article" :readonly="true" :show-toolbar="false" />
            </section>
        </section>
        <section class="mt-10"><h2 class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10"><h2 class="text-2xl font-semibold">Module imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Module imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Options and integration</h2>
            <p>Use required, disabled, readonly, autofocus, show-toolbar and size (sm, md or lg) to configure the editor. A named toolbar slot can replace the default controls.</p>
            <p>The named hidden input stays synchronized with the HTML content for native form submission. Saving, authorization and server-side HTML sanitization belong to your application.</p>
            <p>Attachments are disabled in this example. Enable attachments when your host handles daisy-kit:wysiwyg:attachment-add, uploads the file and calls resolveAttachment with its permanent URL. Pending attachments block form submission.</p>
            <p>Use getValue, setValue, clear, focus, undo and redo on the mounted instance. The getTrixEditor escape hatch exposes the native Trix editor when needed.</p>
            <p>For CSP, place a trix-csp-nonce meta tag before the module scripts and authorize the same nonce in style-src. Trix also needs style-src-attr 'unsafe-inline' on pages that mount it. This demo scopes that exception to this page.</p>
        </section>
    </article>
@endsection
