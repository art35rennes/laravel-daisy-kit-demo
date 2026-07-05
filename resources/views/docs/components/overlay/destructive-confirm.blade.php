@php
    use App\Helpers\DocsHelper;

    $category = 'overlay';
    $name = 'destructive-confirm';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Destructive Confirm"
    category="overlay"
    name="destructive-confirm"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Destructive Confirm"
            subtitle="Confirmation modale pour actions destructives, basée sur le module popconfirm."
            jsModule="popconfirm"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="destructive-confirm">
        <x-slot:preview>
            <x-daisy::ui.overlay.destructive-confirm
                id="docs-destructive-confirm"
                title="Supprimer le segment"
                message="Cette suppression retirera le segment de tous les tableaux."
                detail="L’action reste une démo et ne modifie aucune donnée."
                confirmText="Supprimer"
            >
                <x-slot:trigger>
                    <x-daisy::ui.inputs.button color="error">Supprimer</x-daisy::ui.inputs.button>
                </x-slot:trigger>
            </x-daisy::ui.overlay.destructive-confirm>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.overlay.destructive-confirm
    title="Supprimer le segment"
    message="Cette suppression retirera le segment de tous les tableaux."
    detail="L’action reste une démo et ne modifie aucune donnée."
    confirmText="Supprimer"
>
    <x-slot:trigger>
        <x-daisy::ui.inputs.button color="error">Supprimer</x-daisy::ui.inputs.button>
    </x-slot:trigger>
</x-daisy::ui.overlay.destructive-confirm>';
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
                height="300px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
