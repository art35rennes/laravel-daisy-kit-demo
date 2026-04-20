@php
    $category = 'charts';
    $name = 'stacked-bar';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.stacked-bar
    title="Charge support"
    subtitle="Tickets ouverts par équipe"
    :categories="['Lun', 'Mar', 'Mer', 'Jeu', 'Ven']"
    :series="[
        ['name' => 'Support', 'data' => [12, 15, 11, 16, 13]],
        ['name' => 'Produit', 'data' => [5, 7, 9, 6, 8]],
        ['name' => 'Infra', 'data' => [3, 4, 2, 5, 4]],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Stacked Bar Chart" category="charts" name="stacked-bar" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Stacked Bar Chart"
            subtitle="Preset pour empiler des contributions sur des catégories discrètes."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="stacked-bar">
        <x-slot:preview>
            <x-daisy::charts.stacked-bar
                title="Charge support"
                subtitle="Tickets ouverts par équipe"
                :categories="['Lun', 'Mar', 'Mer', 'Jeu', 'Ven']"
                :series="[
                    ['name' => 'Support', 'data' => [12, 15, 11, 16, 13]],
                    ['name' => 'Produit', 'data' => [5, 7, 9, 6, 8]],
                    ['name' => 'Infra', 'data' => [3, 4, 2, 5, 4]],
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
