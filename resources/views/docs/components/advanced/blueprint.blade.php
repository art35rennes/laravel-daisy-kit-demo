@php
    use App\Helpers\DocsHelper;

    $category = 'advanced';
    $name = 'blueprint';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'example', 'label' => 'Exemple'],
        ['id' => 'contract', 'label' => 'Contrat'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $componentCode = <<<'CODE'
<x-daisy::ui.advanced.blueprint
    name="publication_workflow"
    direction="TB"
    :node-categories="$nodeCategories"
    :transition-categories="$transitionCategories"
    :value="$workflow"
/>
CODE;

    $workflow = [
        'version' => 1,
        'nodes' => [
            ['id' => 'draft', 'label' => 'Brouillon', 'description' => 'Contenu en préparation.', 'category' => 'draft', 'position' => ['x' => 160, 'y' => 50], 'data' => []],
            ['id' => 'review', 'label' => 'Relecture', 'description' => 'Contrôle éditorial.', 'category' => 'review', 'position' => ['x' => 160, 'y' => 210], 'data' => []],
            ['id' => 'published', 'label' => 'Publié', 'description' => 'Contenu diffusé.', 'category' => 'published', 'position' => ['x' => 160, 'y' => 370], 'data' => []],
        ],
        'transitions' => [
            ['id' => 'submit', 'source' => 'draft', 'target' => 'review', 'label' => 'Soumettre', 'description' => '', 'category' => 'progress', 'data' => []],
            ['id' => 'publish', 'source' => 'review', 'target' => 'published', 'label' => 'Publier', 'description' => '', 'category' => 'progress', 'data' => []],
        ],
        'viewport' => ['x' => 0, 'y' => 0, 'zoom' => 1],
    ];
@endphp

<x-daisy::docs.page title="Blueprint" category="advanced" name="blueprint" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Blueprint"
            subtitle="Éditeur visuel de workflows orientés, avec nœuds, transitions et inspection contextuelle."
            jsModule="blueprint"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="blueprint">
        <x-slot:preview>
            <x-daisy::ui.advanced.blueprint
                name="docs_blueprint"
                direction="TB"
                height="440px"
                :node-categories="[
                    ['value' => 'draft', 'label' => 'Préparation'],
                    ['value' => 'review', 'label' => 'Relecture'],
                    ['value' => 'published', 'label' => 'Publication'],
                ]"
                :transition-categories="[['value' => 'progress', 'label' => 'Progression']]"
                :value="$workflow"
            />
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor language="blade" :value="$componentCode" :readonly="true" :showToolbar="false" :showFoldAll="false" :showUnfoldAll="false" :showFormat="false" :showCopy="true" height="220px" />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="contract" title="Contrat de données">
        <div class="not-prose grid gap-4 lg:grid-cols-2">
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Workflow</h3>
                <p class="mt-2 text-sm text-base-content/70"><code>value</code> contient <code>nodes</code>, <code>transitions</code> et un <code>viewport</code>. Chaque nœud possède un identifiant, un libellé, une catégorie et une position.</p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Synchronisation</h3>
                <p class="mt-2 text-sm text-base-content/70">Donnez un <code>name</code> pour récupérer le JSON mis à jour à la soumission d’un formulaire. Les événements <code>daisy:blueprint:change</code> et <code>daisy:blueprint:select</code> permettent de brancher votre logique métier.</p>
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
