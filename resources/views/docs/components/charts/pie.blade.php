@php
    $category = 'charts';
    $name = 'pie';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.pie
    title="Répartition des alertes"
    :series="[
        ['name' => 'Incidents', 'data' => [
            ['value' => 18, 'name' => 'Performance'],
            ['value' => 12, 'name' => 'Données'],
            ['value' => 9, 'name' => 'Disponibilité'],
        ]],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Pie Chart" category="charts" name="pie" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Pie Chart"
            subtitle="Preset pour une distribution simple sur peu de catégories."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="pie">
        <x-slot:preview>
            <x-daisy::charts.pie
                title="Répartition des alertes"
                :series="[
                    ['name' => 'Incidents', 'data' => [
                        ['value' => 18, 'name' => 'Performance'],
                        ['value' => 12, 'name' => 'Données'],
                        ['value' => 9, 'name' => 'Disponibilité'],
                    ]],
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
                height="240px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
