@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getTemplateNavigationItems($prefix);
@endphp

<x-daisy::layout.docs title="Layout editable grid" :sidebarItems="$navItems" :currentRoute="request()->path()">
    <x-slot:navbar>
        <x-daisy::ui.overlay.dropdown label="Templates" buttonClass="btn btn-sm btn-ghost" end>
            <li><a href="/{{ $prefix }}">Docs</a></li>
            <li><a href="{{ route('demo') }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates" class="menu-active">Templates</a></li>
        </x-daisy::ui.overlay.dropdown>
    </x-slot:navbar>

    <section id="intro">
        <h1>Layout editable grid</h1>
        <p class="text-base-content/70">Template de dashboard éditable fondé sur <code>x-daisy::ui.layout.editable-grid</code> et ses items Gridstack.</p>
        <div class="mt-4 text-sm space-y-1">
            <p><strong>Vue :</strong> <code>{{ "view('daisy::templates.layout.editable-grid')" }}</code></p>
            <p><strong>Alias composant :</strong> <code>&lt;x-daisy::templates.layout.editable-grid /&gt;</code></p>
        </div>
    </section>

    <section id="example" class="mt-10">
        <h2>Exemple</h2>
        <div class="mockup-code mt-4">
<pre data-prefix=""><code>&lt;x-daisy::templates.layout.editable-grid
    title="Editable dashboard"
    :editable="true"
    :columns="12"
    :cell-height="96"
    :gap="16"
/&gt;</code></pre>
        </div>
    </section>

    <section id="usage" class="mt-10">
        <h2>Utilisation</h2>
        <p class="text-base-content/70 mb-4">
            Utilisez ce template pour des dashboards ou surfaces builder explicitement éditables.
            Pour une grille purement statique, conservez <code>grid-layout</code>.
        </p>

        <div class="alert alert-info mt-4">
            <x-daisy::ui.advanced.icon name="info-circle" size="lg" />
            <span>
                Le template embarque déjà plusieurs <code>editable-grid-item</code> prêts à être déplacés,
                redimensionnés, ou rendus en lecture seule avec <code>:editable="false"</code> / <code>:static="true"</code>.
            </span>
        </div>
    </section>

    <section id="api" class="mt-10">
        <h2>Props</h2>
        <div class="overflow-x-auto mt-4">
            <table class="table table-sm">
                <thead><tr><th>Prop</th><th>Type</th><th>Défaut</th><th>Description</th></tr></thead>
                <tbody>
                    <tr><td><code>title</code></td><td>string</td><td><code>Editable dashboard</code></td><td>Titre de page.</td></tr>
                    <tr><td><code>theme</code></td><td>string|null</td><td><code>null</code></td><td>Thème daisyUI.</td></tr>
                    <tr><td><code>editable</code></td><td>bool</td><td><code>true</code></td><td>Active l’édition drag/resize.</td></tr>
                    <tr><td><code>columns</code></td><td>int</td><td><code>12</code></td><td>Nombre de colonnes Gridstack.</td></tr>
                    <tr><td><code>cellHeight</code></td><td>int</td><td><code>96</code></td><td>Hauteur d’une cellule.</td></tr>
                    <tr><td><code>gap</code></td><td>int</td><td><code>16</code></td><td>Espacement entre widgets.</td></tr>
                    <tr><td><code>static</code></td><td>bool</td><td><code>false</code></td><td>Force le mode lecture seule.</td></tr>
                </tbody>
            </table>
        </div>
    </section>
</x-daisy::layout.docs>
