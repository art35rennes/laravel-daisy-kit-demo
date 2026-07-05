@php
    use App\Helpers\DocsHelper;

    $category = 'inputs';
    $name = 'icon-button';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Icon Button"
    category="inputs"
    name="icon-button"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Icon Button"
            subtitle="Bouton circulaire icon-only avec libellé accessible, tooltip optionnelle et variante lien."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="icon-button">
        <x-slot:preview>
            <div class="flex flex-wrap items-center gap-3">
                <x-daisy::ui.inputs.icon-button icon="bi-pencil" label="Modifier" color="primary" variant="soft" />
                <x-daisy::ui.inputs.icon-button icon="bi-trash" label="Supprimer" color="error" variant="outline" />
                <x-daisy::ui.inputs.icon-button icon="bi-box-arrow-up-right" label="Ouvrir" href="https://example.com" target="_blank" />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.inputs.icon-button icon="bi-pencil" label="Modifier" color="primary" variant="soft" />
<x-daisy::ui.inputs.icon-button icon="bi-trash" label="Supprimer" color="error" variant="outline" />
<x-daisy::ui.inputs.icon-button icon="bi-box-arrow-up-right" label="Ouvrir" href="https://example.com" target="_blank" />';
            @endphp
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
