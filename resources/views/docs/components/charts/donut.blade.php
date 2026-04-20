@php
    $category = 'charts';
    $name = 'donut';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.donut
    title="Mix de revenus"
    subtitle="Répartition du MRR"
    :series="[
        ['name' => 'MRR', 'data' => [
            ['value' => 42, 'name' => 'Abonnements'],
            ['value' => 18, 'name' => 'Services'],
            ['value' => 11, 'name' => 'Partenariats'],
        ]],
    ]"
    value-format="currency"
/>
CODE;
@endphp

<x-daisy::docs.page title="Donut Chart" category="charts" name="donut" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Donut Chart"
            subtitle="Variante annulaire utile pour afficher une répartition et son total."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="donut">
        <x-slot:preview>
            <x-daisy::charts.donut
                title="Mix de revenus"
                subtitle="Répartition du MRR"
                :series="[
                    ['name' => 'MRR', 'data' => [
                        ['value' => 42, 'name' => 'Abonnements'],
                        ['value' => 18, 'name' => 'Services'],
                        ['value' => 11, 'name' => 'Partenariats'],
                    ]],
                ]"
                value-format="currency"
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
