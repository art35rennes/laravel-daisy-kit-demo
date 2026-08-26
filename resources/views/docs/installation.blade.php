@php
    $composer = <<<'JSON'
{
  "repositories": [
    { "type": "vcs", "url": "https://github.com/art35rennes/laravel-daisy-kit" }
  ],
  "require": {
    "art35rennes/laravel-daisy-kit": "<verified-corrective-v5-version>"
  }
}
JSON;
    $vite = <<<'JS'
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const projectRoot = fileURLToPath(new URL('.', import.meta.url));

export default defineConfig({
  resolve: {
    alias: {
      '@daisy-kit': path.resolve(projectRoot, 'vendor/art35rennes/laravel-daisy-kit/dist'),
    },
  },
});
JS;
    $assets = <<<'JS'
import '@daisy-kit/forms-viewer.css';
import { mountAll } from '@daisy-kit/forms-viewer.js';

mountAll();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Installation — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-3xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Getting started</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Installation</h1>
        <p class="mt-5 leading-7 text-base-content/75">Laravel Daisy Kit is installed from GitHub as a Composer VCS package. This development branch waits for the corrective v5 tag and owner browser validation before publishing a copyable Composer version; it is not published on Packagist or npm.</p>
        <section class="mt-10" aria-labelledby="composer-heading"><h2 id="composer-heading" class="text-2xl font-semibold">1. Require the verified package from VCS</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Composer VCS package configuration"><code>{{ $composer }}</code></pre><p class="mt-3 leading-7 text-base-content/75">Replace the version constraint with the verified corrective v5 version when its tag is supplied. Do not use this development page as compatibility guidance for an earlier v5 release.</p></section>
        <section class="mt-10" aria-labelledby="vite-heading"><h2 id="vite-heading" class="text-2xl font-semibold">2. Configure the official Vite alias</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Vite Daisy Kit alias"><code>{{ $vite }}</code></pre><p class="mt-3 leading-7 text-base-content/75">The package is Composer-installed, so Vite resolves its distributable assets through <code>@daisy-kit</code>, never through the Composer package name.</p></section>
        <section class="mt-10" aria-labelledby="assets-heading"><h2 id="assets-heading" class="text-2xl font-semibold">3. Import module assets</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Module asset imports"><code>{{ $assets }}</code></pre><p class="mt-3 leading-7 text-base-content/75">Import only the CSS and ESM stem used on the page. The available stems are <code>forms-viewer</code>, <code>forms-builder</code>, <code>table</code>, <code>tree</code>, <code>blueprint</code>, <code>file-preview</code>, and <code>map</code>.</p></section>
        <section class="mt-10" aria-labelledby="host-heading"><h2 id="host-heading" class="text-2xl font-semibold">4. Keep standard UI in the host</h2><p class="mt-3 leading-7 text-base-content/75">Install Tailwind CSS and DaisyUI in the Laravel application. Use their native classes for standard buttons, cards, fields, modals, and navigation.</p><a class="btn btn-outline btn-sm mt-4" href="https://daisyui.com/docs/" target="_blank" rel="noopener noreferrer">DaisyUI documentation <span aria-hidden="true">↗</span></a></section>
        <section class="mt-10" aria-labelledby="legacy-entry-heading"><h2 id="legacy-entry-heading" class="text-2xl font-semibold">Legacy demo entry point</h2><p class="mt-3 leading-7 text-base-content/75">The historic <code>/demo</code> URL redirects to this v5 overview. It preserves a useful entry point without restoring the retired v4 catalogue.</p></section>
    </article>
@endsection
