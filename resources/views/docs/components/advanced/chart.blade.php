@php
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'migration', 'label' => 'Migration'],
    ];
    $migrationCode = <<<'CODE'
{{-- Ancien composant --}}
<x-daisy::ui.advanced.chart
    type="line"
    :labels="['Jan', 'Fév', 'Mar']"
    :datasets="[
        ['label' => 'Ventes', 'data' => [100, 200, 150]],
    ]"
/>

{{-- Nouveau preset charts --}}
<x-daisy::charts.line
    :categories="['Jan', 'Fév', 'Mar']"
    :series="[
        ['name' => 'Ventes', 'data' => [100, 200, 150]],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page title="Chart (legacy)" category="advanced" name="chart" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Chart (legacy)"
            subtitle="Le composant Chart.js historique reste documenté pour migration, mais les nouveaux graphiques passent par `x-daisy::charts.*`."
            jsModule="chart"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.custom id="migration" title="Migration vers x-daisy::charts.*">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>Privilégiez désormais <code>x-daisy::charts.line</code>, <code>x-daisy::charts.bar</code>, <code>x-daisy::charts.donut</code> et les autres presets ECharts.</span>
            </div>

            <ul class="list-disc space-y-2 pl-5 text-sm text-base-content/80">
                <li><code>labels</code> devient <code>categories</code>.</li>
                <li><code>datasets</code> devient <code>series</code> avec <code>name</code> au lieu de <code>label</code>.</li>
                <li>Le type n'est plus une string libre: choisissez le preset Blade adapté.</li>
            </ul>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$migrationCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="320px"
            />
        </div>
    </x-daisy::docs.sections.custom>
</x-daisy::docs.page>
