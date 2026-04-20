@php
    $category = 'charts';
    $name = 'area';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.area
    title="Consommation API"
    subtitle="Millions de requêtes"
    :categories="['Jan', 'Fév', 'Mar', 'Avr']"
    :series="[
        ['name' => 'API v1', 'data' => [1.2, 1.5, 1.7, 1.9]],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Area Chart" category="charts" name="area" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Area Chart"
            subtitle="Variante orientée volume pour visualiser une tendance et sa surface cumulée."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="area">
        <x-slot:preview>
            <x-daisy::charts.area
                title="Consommation API"
                subtitle="Millions de requêtes"
                :categories="['Jan', 'Fév', 'Mar', 'Avr']"
                :series="[
                    ['name' => 'API v1', 'data' => [1.2, 1.5, 1.7, 1.9]],
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
                height="220px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
