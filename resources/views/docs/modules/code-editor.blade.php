@php
    $configuration = json_encode(['application' => 'Daisy Kit', 'features' => ['search', 'themes', 'completion'], 'enabled' => true], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    $blade = <<<'BLADE'
<x-daisy-kit::code-editor
    name="configuration"
    label="Application configuration"
    filename="settings.json"
    language="json"
    :value="$configuration"
    :nonce="Vite::cspNonce()"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/code-editor.css';
import { mountAll, getInstance } from '@daisy-kit/code-editor.js';

mountAll();
const editor = getInstance(document.querySelector('[data-daisy-kit-module="code-editor"]'));
const code = editor.getValue();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Code Editor - Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-base-content/70">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Code Editor</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Read, search and edit code in your application’s theme. Language support loads when needed, with native form submission and keyboard navigation.</p>
        <section class="mt-10 space-y-6" aria-label="Interactive examples">
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Edit application configuration</h2>
                <p class="my-3 text-sm text-base-content/70">Search and replace, fold all sections or only the other blocks, and enlarge or restore the editor. Suggest and Ctrl+Space open language and document-word completions, including JSON. Tab moves to the next control.</p>
                <form>
                    <x-daisy-kit::code-editor name="configuration" label="Application configuration" filename="settings.json" language="json" :value="$configuration" :required="true" :nonce="Vite::cspNonce()" />
                    <button class="btn btn-sm mt-4" type="reset">Reset configuration</button>
                </form>
            </section>
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5" data-theme="dark">
                <h2 class="text-xl font-semibold">Read-only code in a local theme</h2>
                <p class="my-3 text-sm text-base-content/70">Selection, search and copy remain available. This example inherits its own dark DaisyUI theme.</p>
                <x-daisy-kit::code-editor label="Example response" filename="response.json" language="json" :value="$configuration" :read-only="true" :nonce="Vite::cspNonce()" />
            </section>
        </section>
        <section class="mt-10"><h2 class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10"><h2 class="text-2xl font-semibold">Module imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Module imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Options and integration</h2>
            <p>Use read-only, disabled, required, line-numbers, line-wrapping, tab-size, toolbar and status-bar to configure the control. Supply labels for toolbar and status text, and phrases for CodeMirror search and completion text.</p>
            <p>Supported languages: text, php, html, css, javascript, typescript, json, markdown, sql and yaml. Blade directives are not parsed separately. Saving and business validation remain in your application.</p>
            <p>Use getValue, setValue, getState, setLanguage, setReadOnly, setLineWrapping, focus, undo, redo, openSearch, copy, setExpanded and complete on the mounted instance. foldAll, unfoldAll, foldOthers and unfoldOthers control code sections; the other-block actions preserve the block at the cursor and its parents. setValue resets history. Change events use daisy-kit:code-editor:change with value and origin.</p>
            <p>For CSP, pass the response nonce and authorize it in style-src. The component does not require inline scripts. Customize the editor height through the --code-editor-height CSS property in your stylesheet.</p>
        </section>
    </article>
@endsection
