<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Executable documentation for Laravel Daisy Kit v5.">
        <title>{{ $title ?? 'Laravel Daisy Kit' }}</title>
        @vite([...['resources/css/app.css', 'resources/js/app.js'], ...($moduleAssets ?? [])])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-base-100 text-base-content">
        <a class="skip-link" href="#main-content">Skip to content</a>
        <div class="drawer lg:drawer-open" role="region" aria-label="Documentation layout">
            <input id="documentation-drawer" type="checkbox" class="drawer-toggle">
            <div class="drawer-content min-w-0">
                <header class="navbar sticky top-0 z-20 border-b border-base-300 bg-base-100/95 px-4 backdrop-blur lg:px-8">
                    <div class="navbar-start gap-2">
                        <label for="documentation-drawer" class="btn btn-square btn-ghost lg:hidden" aria-label="Open documentation navigation">☰</label>
                        <a class="font-semibold tracking-tight" href="{{ route('docs.overview') }}">Laravel Daisy Kit</a>
                        <span class="badge badge-outline badge-sm">v5 preview</span>
                    </div>
                    <div class="navbar-end gap-2">
                        <label class="input input-sm hidden w-56 md:flex" aria-label="Filter documentation navigation"><input data-doc-search="desktop" type="search" placeholder="Filter modules"></label>
                        <select data-theme-select class="select select-sm" aria-label="Choose color theme"><option value="light">Light</option><option value="dark">Dark</option><option value="cupcake">Cupcake</option></select>
                    </div>
                </header>
                <main id="main-content" tabindex="-1" class="mx-auto w-full max-w-6xl px-4 py-8 sm:px-6 lg:px-10 lg:py-12">@yield('content')</main>
            </div>
            <aside class="drawer-side z-30">
                <label for="documentation-drawer" aria-label="Close documentation navigation" class="drawer-overlay"></label>
                <nav aria-label="Documentation" class="min-h-full w-72 border-r border-base-300 bg-base-200 p-4">
                    <a class="mb-6 flex items-center gap-2 px-3 py-2 font-semibold lg:hidden" href="{{ route('docs.overview') }}">Laravel Daisy Kit <span class="badge badge-outline badge-sm">v5</span></a>
                    <label class="input mb-4 flex md:hidden" aria-label="Filter documentation navigation"><input data-doc-search="mobile" type="search" placeholder="Filter modules"></label>
                    <ul class="menu menu-sm gap-1" data-doc-navigation>
                        <li><a href="{{ route('docs.overview') }}" @class(['menu-active' => request()->routeIs('docs.overview')])>Overview</a></li>
                        <li><a href="{{ route('docs.installation') }}" @class(['menu-active' => request()->routeIs('docs.installation')])>Installation</a></li>
                        <li class="menu-title mt-4"><span>Modules</span></li>
                        @foreach (\App\Http\Controllers\DocumentationController::modules() as $slug => $module)
                            <li data-doc-item><a href="{{ route('docs.module', $slug) }}" @class(['menu-active' => request()->route('module') === $slug])>{{ $module['title'] }}</a></li>
                        @endforeach
                    </ul>
                    <p data-doc-empty class="mt-4 hidden px-3 text-sm text-base-content/70">No matching module.</p>
                </nav>
            </aside>
        </div>
        @livewireScripts
    </body>
</html>
