@extends('layouts.docs', ['title' => 'Forms — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-4xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Forms</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Render a deterministic schema with the viewer. The builder is available only when an application opts into Livewire 4.</p>

        <section class="mt-12" aria-labelledby="forms-contract">
            <h2 id="forms-contract" class="text-2xl font-semibold">Public contract</h2>
            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                <div class="border border-base-300 bg-base-100 p-5"><code class="font-semibold">x-daisy-kit::forms.viewer</code><p class="mt-2 text-sm leading-6 text-base-content/75">Viewer does not require Livewire. It is the server-rendered entry point for a form schema.</p></div>
                <div class="border border-base-300 bg-base-100 p-5"><code class="font-semibold">x-daisy-kit::forms.builder</code><p class="mt-2 text-sm leading-6 text-base-content/75">Livewire 4 is optional for the builder. Install and enable it only when authoring schemas in the browser.</p></div>
            </div>
            <p class="mt-4 text-sm leading-6 text-base-content/70">Browser lifecycle: <code>mount</code>, <code>mountAll</code>, and <code>unmount</code>. Listen for <code>daisy-kit:forms:*</code> events; the module creates no global object.</p>
        </section>

        <section class="mt-12" aria-labelledby="forms-usage">
            <h2 id="forms-usage" class="text-2xl font-semibold">Blade usage</h2>
            <p class="mt-3 leading-7 text-base-content/75">Copy the entry point that fits the runtime. Add only attributes published with the v5 prerelease contract.</p>
            <pre class="code-sample mt-4" tabindex="0" aria-label="Forms Blade usage"><code>@verbatim&lt;x-daisy-kit::forms.viewer /&gt;

&lt;!-- Optional: requires Livewire 4 --&gt;
&lt;x-daisy-kit::forms.builder /&gt;@endverbatim</code></pre>
        </section>

        <section class="mt-12" aria-labelledby="forms-assets">
            <h2 id="forms-assets" class="text-2xl font-semibold">CSS and ESM imports</h2>
            <pre class="code-sample mt-4" tabindex="0" aria-label="Forms ESM and CSS imports"><code>import 'vendor/art35rennes/laravel-daisy-kit/dist/forms.css';
import { mountAll } from 'vendor/art35rennes/laravel-daisy-kit/dist/forms.js';

mountAll();</code></pre>
        </section>

        <section class="mt-12" aria-labelledby="forms-fixture">
            <h2 id="forms-fixture" class="text-2xl font-semibold">Deterministic fixture</h2>
            <p class="mt-3 leading-7 text-base-content/75">The published example will receive a small “Profile” schema: <strong>Ada Lovelace</strong>, <strong>ada@example.test</strong>, and a <strong>weekly</strong> update preference. The fixture remains local to the demo and makes no network or database request.</p>
            <div class="mt-4 overflow-x-auto border border-base-300" aria-label="Forms fixture values">
                <table class="table table-sm"><thead><tr><th>Field</th><th>Value</th></tr></thead><tbody><tr><td>Name</td><td>Ada Lovelace</td></tr><tr><td>Email</td><td>ada@example.test</td></tr><tr><td>Updates</td><td>weekly</td></tr></tbody></table>
            </div>
        </section>

        <section class="mt-12" aria-labelledby="forms-states">
            <h2 id="forms-states" class="text-2xl font-semibold">Empty, loading, and error states</h2>
            <div class="mt-4 grid gap-4 md:grid-cols-3">
                <div class="border border-base-300 p-4"><h3 class="font-semibold">Empty</h3><p class="mt-2 text-sm text-base-content/75">No schema is available yet.</p></div>
                <div class="border border-base-300 p-4"><h3 class="font-semibold">Loading</h3><p class="mt-2 text-sm text-base-content/75">Schema preparation is in progress.</p></div>
                <div class="border border-error/40 p-4"><h3 class="font-semibold">Error</h3><p class="mt-2 text-sm text-base-content/75">The host can show a recoverable schema error.</p></div>
            </div>
        </section>

        <section class="mt-12 border-t border-base-300 pt-8" aria-labelledby="forms-checkpoint">
            <h2 id="forms-checkpoint" class="text-2xl font-semibold">Package prerelease checkpoint</h2>
            <p class="mt-3 leading-7 text-base-content/75">The v5 prerelease is not published or Composer-resolved in this branch. This page deliberately does not render a fake component. Its real viewer and optional builder example will be enabled only after the exact package tag is validated.</p>
            <a class="btn btn-outline btn-sm mt-4" href="{{ $module['daisyUiUrl'] }}" target="_blank" rel="noopener noreferrer">DaisyUI form controls <span aria-hidden="true">↗</span></a>
        </section>
    </article>
@endsection
