@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'navigation';
    $name = 'stepper';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Assistant" 
    category="navigation" 
    name="stepper"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Assistant" 
            subtitle="Assistant pas à pas avec navigation."
            jsModule="stepper"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="stepper">
        <x-slot:preview>
            @php
                $items = [
                    ['title' => 'Étape 1', 'content' => 'Contenu de l\'étape 1'],
                    ['title' => 'Étape 2', 'content' => 'Contenu de l\'étape 2'],
                    ['title' => 'Étape 3', 'content' => 'Contenu de l\'étape 3'],
                ];
            @endphp
            <x-daisy::ui.navigation.stepper :items="$items" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.navigation.stepper :items="[
    ['title' => 'Étape 1', 'content' => 'Contenu de l\'étape 1'],
    ['title' => 'Étape 2', 'content' => 'Contenu de l\'étape 2'],
    ['title' => 'Étape 3', 'content' => 'Contenu de l\'étape 3'],
]" />
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor 
                language="blade" 
                :value="$baseCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="behavior" title="Dataset et événements" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Le bundle charge <code class="kbd kbd-xs">resources/js/stepper.js</code> lorsque des éléments
                <code class="kbd kbd-xs">[data-stepper]</code> existent (voir aussi le wizard qui pilote le même dataset).
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li>Racine : <code class="kbd kbd-xs">data-stepper="true"</code></li>
                <li>Entêtes : conteneur <code class="kbd kbd-xs">data-stepper-headers</code>, étapes avec <code class="kbd kbd-xs">data-step-index</code></li>
                <li>Contenus : <code class="kbd kbd-xs">data-stepper-contents</code> et panneaux <code class="kbd kbd-xs">data-step-content</code></li>
                <li>Boutons : <code class="kbd kbd-xs">data-stepper-prev</code>, <code class="kbd kbd-xs">data-stepper-next</code>, <code class="kbd kbd-xs">data-stepper-finish</code></li>
            </ul>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead><tr><th>Événement</th><th>Détail</th></tr></thead>
                    <tbody>
                        <tr><td><code class="kbd kbd-xs">stepper:change</code></td><td><code class="kbd kbd-xs">detail.current</code> — index de l’étape active.</td></tr>
                        <tr><td><code class="kbd kbd-xs">stepper:finish</code></td><td>Dernier clic sur « terminer ».</td></tr>
                    </tbody>
                </table>
            </div>
            <p>L’étape peut être persistée dans <code class="kbd kbd-xs">sessionStorage</code> lorsque la racine possède un <code class="kbd kbd-xs">id</code> stable.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
