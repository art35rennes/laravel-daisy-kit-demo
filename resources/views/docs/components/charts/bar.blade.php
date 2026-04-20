@php
    $category = 'charts';
    $name = 'bar';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.bar
    title="Nouveaux comptes"
    subtitle="Comparaison mensuelle"
    :categories="['Jan', 'Fév', 'Mar', 'Avr']"
    :series="[
        ['name' => 'Self-serve', 'data' => [48, 55, 63, 60]],
        ['name' => 'Sales-led', 'data' => [18, 22, 25, 29]],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Bar Chart" category="charts" name="bar" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Bar Chart"
            subtitle="Preset ECharts pour comparer plusieurs séries discrètes."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="bar">
        <x-slot:preview>
            <x-daisy::charts.bar
                title="Nouveaux comptes"
                subtitle="Comparaison mensuelle"
                :categories="['Jan', 'Fév', 'Mar', 'Avr']"
                :series="[
                    ['name' => 'Self-serve', 'data' => [48, 55, 63, 60]],
                    ['name' => 'Sales-led', 'data' => [18, 22, 25, 29]],
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
