@php
    $category = 'layout';
    $name = 'ordered-list';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::ui.layout.ordered-list
    :sortable="true"
    name="roadmap_order"
    :persist="true"
    :items="[
        ['id' => 'backlog', 'label' => 'Backlog grooming', 'content' => 'Préparer les tickets du sprint'],
        ['id' => 'delivery', 'label' => 'Delivery review', 'content' => 'Valider les sorties de sprint'],
        ['id' => 'retro', 'label' => 'Retro', 'content' => 'Clôturer avec les actions de suivi'],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Liste ordonnée" category="layout" name="ordered-list" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Liste ordonnée"
            subtitle="Liste ordonnée avec mode sortable optionnel et persistance via champ caché."
            jsModule="ordered-list"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="ordered-list">
        <x-slot:preview>
            <x-daisy::ui.layout.ordered-list
                :sortable="true"
                name="roadmap_order"
                :persist="true"
                :items="[
                    ['id' => 'backlog', 'label' => 'Backlog grooming', 'content' => 'Préparer les tickets du sprint'],
                    ['id' => 'delivery', 'label' => 'Delivery review', 'content' => 'Valider les sorties de sprint'],
                    ['id' => 'retro', 'label' => 'Retro', 'content' => 'Clôturer avec les actions de suivi'],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$baseCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="260px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="behavior" title="Tri et événements" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Module <code class="kbd kbd-xs">resources/js/modules/ordered-list.js</code> — racine
                <code class="kbd kbd-xs">data-ordered-list="1"</code>, activation du drag si
                <code class="kbd kbd-xs">data-sortable="true"</code> et absence de <code class="kbd kbd-xs">data-disabled="true"</code>.
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li>Les lignes portent <code class="kbd kbd-xs">data-ordered-list-item</code> et <code class="kbd kbd-xs">data-id</code>.</li>
                <li>Persistance : champ hidden relié via <code class="kbd kbd-xs">data-ordered-list-input</code> ou <code class="kbd kbd-xs">data-ordered-list-input-for="{id}"</code>.</li>
                <li><code class="kbd kbd-xs">dataset.order</code> reflète le JSON courant après chaque déplacement.</li>
            </ul>
            <p>
                Événement bulle : <code class="kbd kbd-xs">ordered-list:change</code> avec <code class="kbd kbd-xs">detail.items</code>
                (<code class="kbd kbd-xs">id</code>, <code class="kbd kbd-xs">index</code>, <code class="kbd kbd-xs">disabled</code>).
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
