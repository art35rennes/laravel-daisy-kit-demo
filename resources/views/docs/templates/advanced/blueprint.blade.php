@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getTemplateNavigationItems($prefix);
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'preview', 'label' => 'Preview'],
        ['id' => 'usage', 'label' => 'Usage'],
    ];

    $basicUsage = <<<'CODE'
<x-daisy::templates.advanced.blueprint
    name-prefix="demo"
    workflow-height="560px"
    example-height="420px"
/>
CODE;

    $customUsage = <<<'CODE'
<x-daisy::templates.advanced.blueprint
    :workflow-node-types="$workflowNodeTypes"
    :workflow-value="$workflowValue"
    :schema-node-types="$schemaNodeTypes"
    :schema-value="$schemaValue"
    :integration-node-types="$integrationNodeTypes"
    :integration-value="$integrationValue"
/>
CODE;
@endphp

<x-daisy::layout.docs title="Blueprint examples" :sidebarItems="$navItems" :sections="$sections" :currentRoute="request()->path()">
    <x-slot:navbar>
        <x-daisy::ui.overlay.dropdown label="Templates" buttonClass="btn btn-sm btn-ghost" end>
            <li><a href="/{{ $prefix }}">Docs</a></li>
            <li><a href="{{ route('demo') }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates" class="menu-active">Templates</a></li>
        </x-daisy::ui.overlay.dropdown>
    </x-slot:navbar>

    <section id="intro">
        <h1>Blueprint examples</h1>
        <p class="text-base-content/70">
            Template avancé pour exposer plusieurs graphes Blueprint prêts à adapter : workflow éditable,
            workflow readonly, schéma de données et pipeline d’intégration.
        </p>
        <div class="mt-4 grid gap-3 md:grid-cols-2">
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Vue</h3>
                <p class="mt-1 text-sm text-base-content/70"><code>{{ "view('daisy::templates.advanced.blueprint')" }}</code></p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Alias composant</h3>
                <p class="mt-1 text-sm text-base-content/70"><code>&lt;x-daisy::templates.advanced.blueprint /&gt;</code></p>
            </div>
        </div>
    </section>

    <section id="preview" class="mt-10">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2>Preview</h2>
            <a href="{{ route('templates.advanced.blueprint') }}" class="btn btn-primary btn-sm">Voir en pleine page</a>
        </div>

        <x-daisy::templates.advanced.blueprint
            name-prefix="docs_template_blueprint"
            workflow-height="560px"
            example-height="420px"
        />
    </section>

    <section id="usage" class="mt-10">
        <h2>Usage</h2>
        <div class="grid gap-4 lg:grid-cols-2">
            <div>
                <h3 class="text-base font-semibold">Utilisation rapide</h3>
                <div class="mockup-code mt-3">
                    <pre data-prefix=""><code>{{ $basicUsage }}</code></pre>
                </div>
            </div>
            <div>
                <h3 class="text-base font-semibold">Graphes personnalisés</h3>
                <div class="mockup-code mt-3">
                    <pre data-prefix=""><code>{{ $customUsage }}</code></pre>
                </div>
            </div>
        </div>
    </section>
</x-daisy::layout.docs>
