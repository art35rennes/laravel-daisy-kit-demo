@php
    $blade = <<<'BLADE'
<x-daisy-kit::copyable
    show-icon
    success-label="Invoice reference copied."
    :feedback-duration="1500"
>
    INV-2026-0042
</x-daisy-kit::copyable>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/copyable.css';
import { mountAll, getInstance } from '@daisy-kit/copyable.js';

mountAll();
const root = document.querySelector('[data-daisy-kit-module="copyable"]');
const component = getInstance(root);

root.addEventListener('daisy-kit:copyable:copied', ({ detail }) => {
    console.log(detail.value);
});
JS;
@endphp

@extends('layouts.docs', ['title' => 'Copyable — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Copyable</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Copy a reference or plain-text payload with an optional icon and transient, accessible feedback.</p>
        <section class="mt-10 space-y-6" aria-labelledby="copyable-examples-heading">
            <h2 id="copyable-examples-heading" class="text-2xl font-semibold">Interactive examples</h2>
            <section id="copyable-example-1" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Reference number</h3>
                <p class="mb-10 mt-2 text-sm text-base-content/70">The optional copy icon reinforces the action; the feedback tooltip disappears automatically.</p>
                <x-daisy-kit::copyable
                    show-icon
                    success-label="Invoice reference copied."
                    :feedback-duration="1500"
                >
                    INV-2026-0042
                </x-daisy-kit::copyable>
            </section>
            <section id="copyable-example-2" class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="font-semibold">Structured plain text</h3>
                <p class="mb-5 mt-2 text-sm text-base-content/70">The button copies serialized JSON, never active HTML.</p>
                <x-daisy-kit::copyable value='{"invoice":"INV-2026-0042","currency":"EUR"}'>Copy invoice JSON</x-daisy-kit::copyable>
            </section>
        </section>
        <section class="mt-10" aria-labelledby="copyable-usage-heading">
            <h2 id="copyable-usage-heading" class="text-2xl font-semibold">Blade usage</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Copyable Blade usage"><code>{{ $blade }}</code></pre>
        </section>
        <section class="mt-10" aria-labelledby="copyable-imports-heading">
            <h2 id="copyable-imports-heading" class="text-2xl font-semibold">ESM and CSS imports</h2>
            <pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Copyable ESM and CSS imports"><code>{{ $imports }}</code></pre>
        </section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Integrator API</h2>
            <p class="leading-7">copy(value?): Promise&lt;boolean&gt;; getValue(): string.</p>
            <p class="leading-7"><code>showIcon=false</code> adds the decorative copy glyph when enabled. <code>showFeedback=true</code> displays success or error as a temporary tooltip using the existing labels and <code>feedbackDuration</code>; disabling it keeps the screen-reader announcement.</p>
            <p class="leading-7">mount(root) returns a stable facade or null; getInstance(root) retrieves it. unmount(root) cleans up the instance. Commands return booleans unless documented as asynchronous; getters return values.</p>
            <p class="leading-7">Events use the <code>daisy-kit:copyable:</code> prefix: copied { value }; error { code, message }.</p>
            <h3 class="pt-3 text-lg font-semibold">Laravel submission</h3>
            <p class="leading-7">No form value is submitted. value overrides the displayed textContent.</p>
            <h3 class="pt-3 text-lg font-semibold">CSP and error handling</h3>
            <p class="leading-7">Clipboard requires HTTPS or localhost and a user action. Refusal produces accessible error feedback.</p>
        </section>
        <a class="btn btn-outline btn-sm mt-10" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI styling patterns <span aria-hidden="true">↗</span></a>
    </article>
@endsection
