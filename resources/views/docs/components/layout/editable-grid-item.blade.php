@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'layout';
    $name = 'editable-grid-item';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $baseCode = <<<'CODE'
<x-daisy::ui.layout.editable-grid-item
    id="release-notes"
    type="list"
    :x="4"
    :y="0"
    :w="8"
    :h="3"
    :meta="['team' => 'release']"
>
    <x-daisy::ui.layout.card title="Release notes" class="h-full card-border">
        <p class="text-sm opacity-70">Le widget expose ses coordonnées via gs-x / gs-y / gs-w / gs-h.</p>
    </x-daisy::ui.layout.card>
</x-daisy::ui.layout.editable-grid-item>
CODE;
@endphp

<x-daisy::docs.page
    title="Editable Grid Item"
    category="layout"
    name="editable-grid-item"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Editable Grid Item"
            subtitle="Élément positionné dans un `editable-grid`, avec coordonnées Gridstack et métadonnées optionnelles."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="editable-grid-item">
        <x-slot:preview>
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <x-daisy::ui.layout.editable-grid :editable="false" :static="true" :columns="12" :cell-height="88" :gap="12">
                    <x-daisy::ui.layout.editable-grid-item
                        id="release-notes"
                        type="list"
                        :x="4"
                        :y="0"
                        :w="8"
                        :h="3"
                        :meta="['team' => 'release']"
                    >
                        <x-daisy::ui.layout.card title="Release notes" class="h-full card-border">
                            <p class="text-sm opacity-70">Le widget expose ses coordonnées via <code>gs-x</code>, <code>gs-y</code>, <code>gs-w</code> et <code>gs-h</code>.</p>
                        </x-daisy::ui.layout.card>
                    </x-daisy::ui.layout.editable-grid-item>
                </x-daisy::ui.layout.editable-grid>
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
                height="280px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
