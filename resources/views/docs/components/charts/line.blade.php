@php
    $category = 'charts';
    $name = 'line';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.line
    title="Trafic d'acquisition"
    subtitle="Sessions hebdomadaires"
    :categories="['S1', 'S2', 'S3', 'S4']"
    :series="[
        ['name' => 'SEO', 'data' => [1240, 1380, 1510, 1660]],
        ['name' => 'Paid', 'data' => [840, 920, 890, 980]],
    ]"
    :toolbar="true"
/>
CODE;
@endphp

<x-daisy::docs.page title="Line Chart" category="charts" name="line" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Line Chart"
            subtitle="Preset ECharts pour comparer des tendances sur une échelle commune."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="line">
        <x-slot:preview>
            <x-daisy::charts.line
                title="Trafic d'acquisition"
                subtitle="Sessions hebdomadaires"
                :categories="['S1', 'S2', 'S3', 'S4']"
                :series="[
                    ['name' => 'SEO', 'data' => [1240, 1380, 1510, 1660]],
                    ['name' => 'Paid', 'data' => [840, 920, 890, 980]],
                ]"
                :toolbar="true"
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
