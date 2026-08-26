@extends('layouts.docs', ['title' => 'Laravel Daisy Kit — Overview'])

@section('content')
    <section class="max-w-3xl">
        <p class="mb-3 text-sm font-medium uppercase tracking-widest text-primary">Laravel Daisy Kit v5</p>
        <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Focused modules for Laravel interfaces.</h1>
        <p class="mt-5 text-lg leading-8 text-base-content/75">This demo documents six package modules. DaisyUI and Tailwind CSS remain regular host-application dependencies, so standard interface elements stay familiar and portable.</p>
        <div class="mt-8 flex flex-wrap gap-3"><a class="btn btn-primary" href="{{ route('docs.installation') }}">Read installation</a><a class="btn btn-ghost" href="https://daisyui.com/components/" target="_blank" rel="noopener noreferrer">Browse DaisyUI components <span aria-hidden="true">↗</span></a></div>
    </section>
    <section class="mt-14" aria-labelledby="modules-heading"><h2 id="modules-heading" class="text-2xl font-semibold">Modules</h2><div class="mt-5 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">@foreach ($modules as $slug => $module)<article class="border border-base-300 bg-base-100 p-5"><h3 class="font-semibold"><a class="link-hover link" href="{{ route('docs.module', $slug) }}">{{ $module['title'] }}</a></h3><p class="mt-2 text-sm leading-6 text-base-content/75">{{ $module['description'] }}</p></article>@endforeach</div></section>
    <section class="mt-14 border-t border-base-300 pt-8" aria-labelledby="integration-heading"><h2 id="integration-heading" class="text-2xl font-semibold">Corrective v5 integration</h2><p class="mt-3 max-w-3xl leading-7 text-base-content/75">This development demo will lock Laravel Daisy Kit from its Git VCS repository after the corrective package tag is verified. The owner must validate the integrated browser experience before this documentation is presented as final. Every example uses only the published component and its corresponding ESM and CSS entry through the official <code>@daisy-kit</code> Vite alias.</p></section>
@endsection
