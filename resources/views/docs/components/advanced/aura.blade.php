@php
    $category = 'advanced';
    $name = 'aura';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];

    $baseCode = <<<'CODE'
<x-daisy::ui.advanced.aura variant="rainbow" size="lg">
    <x-daisy::ui.layout.card title="Mise en avant" :bordered="true">
        Une bordure animée pour attirer l’attention.
    </x-daisy::ui.layout.card>
</x-daisy::ui.advanced.aura>
CODE;
@endphp

<x-daisy::docs.page title="Aura" :category="$category" :name="$name" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Aura"
            subtitle="Conteneur décoratif qui met visuellement en avant son contenu."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="aura">
        <x-slot:preview>
            <x-daisy::ui.advanced.aura variant="rainbow" size="lg">
                <x-daisy::ui.layout.card title="Mise en avant" :bordered="true">
                    Une bordure animée pour attirer l’attention.
                </x-daisy::ui.layout.card>
            </x-daisy::ui.advanced.aura>
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor language="blade" :value="$baseCode" :readonly="true" :showToolbar="false" :showFoldAll="false" :showUnfoldAll="false" :showFormat="false" :showCopy="true" height="220px" />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="aura">
        <x-slot:preview>
            <div class="flex flex-wrap items-center gap-6">
                <x-daisy::ui.advanced.aura variant="gold" size="md">
                    <x-daisy::ui.inputs.button color="primary">Accès premium</x-daisy::ui.inputs.button>
                </x-daisy::ui.advanced.aura>
                <x-daisy::ui.advanced.aura variant="holo" size="sm">
                    <span class="rounded-box bg-base-200 px-4 py-2">Aura holo</span>
                </x-daisy::ui.advanced.aura>
            </div>
        </x-slot:preview>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
