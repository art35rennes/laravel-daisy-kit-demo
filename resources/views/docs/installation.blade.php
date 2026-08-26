@extends('layouts.docs', ['title' => 'Installation — Laravel Daisy Kit'])

@section('content')
    <article class="max-w-3xl">
        <p class="text-sm font-medium uppercase tracking-widest text-primary">Getting started</p><h1 class="mt-3 text-4xl font-bold tracking-tight">Installation</h1><p class="mt-5 leading-7 text-base-content/75">Laravel Daisy Kit is installed through Composer from its Git repository until a registry publication exists. Pin the published v5 prerelease tag supplied by the package release.</p>
        <section class="mt-10" aria-labelledby="composer-heading"><h2 id="composer-heading" class="text-2xl font-semibold">1. Require the package</h2><pre class="code-sample mt-4" tabindex="0" aria-label="Composer installation command"><code>composer require art35rennes/laravel-daisy-kit:&lt;v5-prerelease&gt;</code></pre><p class="mt-3 text-sm leading-6 text-base-content/70">The exact prerelease tag is intentionally not guessed here. This demo’s Composer lock will be updated once that tag is available and validated.</p></section>
        <section class="mt-10" aria-labelledby="assets-heading"><h2 id="assets-heading" class="text-2xl font-semibold">2. Import module assets</h2><pre class="code-sample mt-4" tabindex="0" aria-label="Module asset imports"><code>import 'vendor/art35rennes/laravel-daisy-kit/dist/forms.css';
import { mountAll } from 'vendor/art35rennes/laravel-daisy-kit/dist/forms.js';

mountAll();</code></pre><p class="mt-3 leading-7 text-base-content/75">Each module exposes its own ESM import and CSS file. Import only the modules used by an application; nothing is registered as a global object.</p></section>
        <section class="mt-10" aria-labelledby="host-heading"><h2 id="host-heading" class="text-2xl font-semibold">3. Keep standard UI in the host</h2><p class="mt-3 leading-7 text-base-content/75">Install Tailwind CSS and DaisyUI in the Laravel application. Use their native classes for standard buttons, cards, fields, modals, and navigation.</p><a class="btn btn-outline btn-sm mt-4" href="https://daisyui.com/docs/" target="_blank" rel="noopener noreferrer">DaisyUI documentation <span aria-hidden="true">↗</span></a></section>
    </article>
@endsection
