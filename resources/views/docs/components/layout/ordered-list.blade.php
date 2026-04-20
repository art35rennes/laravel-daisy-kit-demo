@php
    $category = 'layout';
    $name = 'ordered-list';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
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

<x-daisy::docs.page title="Ordered List" category="layout" name="ordered-list" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Ordered List"
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

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
