@php
    $blade = <<<'BLADE'
<form>
    <x-daisy-kit::signature name="approval_signature" label="Approval signature" :required="true" />
</form>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/signature.css';
import { mountAll, getInstance } from '@daisy-kit/signature.js';

mountAll();
const root = document.querySelector('[data-daisy-kit-module="signature"]');
const component = getInstance(root);

const isEmpty = component.isEmpty();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Signature — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Signature</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Capture an approval signature with undo, redo and PNG export.</p>
        <section class="mt-10 space-y-6" aria-labelledby="signature-examples-heading">
            <h2 id="signature-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="signature-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Approval signature</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Draw with a mouse, touch or stylus. Undo, redo, clear and download are available through the component.</p>
                <form>
                    <x-daisy-kit::signature name="approval_signature" label="Approval signature" :required="true" />
                </form>
            </section>
            <section id="signature-example-2" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Read-only workflow</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">Disable capture when approval is not currently available.</p>
                <x-daisy-kit::signature name="locked_signature" label="Signature unavailable" :disabled="true" />
            </section>
        </section>
        <section class="mt-10" aria-labelledby="signature-usage-heading">
            <h2 id="signature-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Signature Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="signature-imports-heading">
            <h2 id="signature-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Signature ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Integrator API</h2>
            <p class="leading-7">clear(), undo(), redo(), isEmpty(), toDataURL(), toSVG(), toData(); setValue(value): Promise&lt;boolean&gt;.</p>
            <p class="leading-7">mount(root) returns a stable facade or null; getInstance(root) retrieves it. unmount(root) cleans up the instance. Commands return booleans unless documented as asynchronous; getters return values.</p>
            <p class="leading-7">Events use the <code>daisy-kit:signature:</code> prefix: change { empty, value }; stroke-ended { value }; clear { empty, value }; error { code, message }.</p>
            <h3 class="pt-3 text-lg font-semibold">Laravel submission</h3>
            <p class="leading-7">The hidden field submits a canonical PNG Data URL under name. Validate and bound it on the server.</p>
            <h3 class="pt-3 text-lg font-semibold">CSP and error handling</h3>
            <p class="leading-7">SignaturePad writes DOM styles. This page explicitly permits style-src-attr 'unsafe-inline'; the other CSP directives remain enforced.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI styling patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
