@php
    use App\Helpers\DocsHelper;

    $category = 'data-display';
    $name = 'description-list';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Description List"
    category="data-display"
    name="description-list"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Description List"
            subtitle="Liste descriptive pour métadonnées, fiches résumé et détails métier."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="description-list">
        <x-slot:preview>
            <x-daisy::ui.data-display.description-list
                :columns="2"
                :sections="[
                    ['title' => 'Compte', 'icon' => 'bi-person', 'items' => [
                        ['label' => 'Référence', 'value' => 'ACME-2026-001', 'copyable' => true],
                        ['label' => 'Contact', 'value' => 'ops@example.com', 'link' => true, 'href' => 'mailto:ops@example.com'],
                        ['label' => 'Statut', 'value' => 'Actif', 'icon' => 'bi-check-circle'],
                        ['label' => 'Note', 'value' => 'Contrat renouvelé automatiquement.', 'wide' => true],
                    ]],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.data-display.description-list
    :columns="2"
    :sections="[
        [\'title\' => \'Compte\', \'items\' => [
            [\'label\' => \'Référence\', \'value\' => \'ACME-2026-001\', \'copyable\' => true],
            [\'label\' => \'Contact\', \'value\' => \'ops@example.com\', \'link\' => true, \'href\' => \'mailto:ops@example.com\'],
        ]],
    ]"
/>';
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
                height="260px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
