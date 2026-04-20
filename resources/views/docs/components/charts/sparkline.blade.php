@php
    $category = 'charts';
    $name = 'sparkline';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $baseCode = <<<'CODE'
<x-daisy::charts.sparkline
    :series="[
        ['name' => 'Pipeline', 'data' => [18, 24, 21, 29, 34, 37, 44]],
    ]"
    value-format="currency"
    height="88px"
/>
CODE;
@endphp

<x-daisy::docs.page title="Sparkline" category="charts" name="sparkline" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Sparkline"
            subtitle="Micro-graphe pensé pour les cartes KPI et résumés compacts."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="sparkline">
        <x-slot:preview>
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <p class="text-xs uppercase tracking-[0.24em] text-base-content/50">Pipeline</p>
                <p class="mt-2 text-2xl font-semibold">€84k</p>
                <x-daisy::charts.sparkline
                    :series="[
                        ['name' => 'Pipeline', 'data' => [18, 24, 21, 29, 34, 37, 44]],
                    ]"
                    value-format="currency"
                    height="88px"
                />
            </div>
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
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
