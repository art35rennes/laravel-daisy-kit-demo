@php
    $category = 'charts';
    $name = 'stacked-area';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.stacked-area
    title="Capacité équipe"
    subtitle="Heures allouées par flux"
    :categories="['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4']"
    :series="[
        ['name' => 'Build', 'data' => [48, 52, 54, 56]],
        ['name' => 'Run', 'data' => [26, 24, 22, 20]],
        ['name' => 'Enablement', 'data' => [10, 12, 14, 13]],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Stacked Area Chart" category="charts" name="stacked-area" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Stacked Area Chart"
            subtitle="Preset adapté aux contributions cumulées et à l'évolution d'un total."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="stacked-area">
        <x-slot:preview>
            <x-daisy::charts.stacked-area
                title="Capacité équipe"
                subtitle="Heures allouées par flux"
                :categories="['Sprint 1', 'Sprint 2', 'Sprint 3', 'Sprint 4']"
                :series="[
                    ['name' => 'Build', 'data' => [48, 52, 54, 56]],
                    ['name' => 'Run', 'data' => [26, 24, 22, 20]],
                    ['name' => 'Enablement', 'data' => [10, 12, 14, 13]],
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
