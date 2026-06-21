@php
    use App\Helpers\DocsHelper;

    $category = 'utilities';
    $name = 'truncate-text';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Truncate Text"
    category="utilities"
    name="truncate-text"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Truncate Text"
            subtitle="Texte tronqué avec accessibilité et infobulle optionnelle seulement lorsque le contenu déborde."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="truncate-text">
        <x-slot:preview>
            <div class="max-w-sm rounded-box border border-base-300 bg-base-100 p-4">
                <x-daisy::ui.utilities.truncate-text
                    text="Nom de client très long avec une référence contractuelle que l'interface doit garder lisible"
                    max-width="max-w-xs"
                />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.utilities.truncate-text
    text="Nom de client très long avec une référence contractuelle que l\'interface doit garder lisible"
    max-width="max-w-xs"
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
                height="220px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="truncate-text">
        <x-slot:preview>
            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <p class="mb-2 text-sm font-semibold">Deux lignes</p>
                    <x-daisy::ui.utilities.truncate-text
                        tag="p"
                        :lines="2"
                        text="Résumé produit volontairement long pour vérifier le comportement sur deux lignes dans une carte dense."
                    />
                </div>
                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <p class="mb-2 text-sm font-semibold">Sans infobulle</p>
                    <x-daisy::ui.utilities.truncate-text
                        text="Identifiant interne TRUNCATE-TEXT-2026-REFERENCE-LONGUE"
                        max-width="max-w-48"
                        :tooltip="false"
                    />
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = '<x-daisy::ui.utilities.truncate-text
    tag="p"
    :lines="2"
    text="Résumé produit volontairement long pour vérifier le comportement sur deux lignes dans une carte dense."
/>

<x-daisy::ui.utilities.truncate-text
    text="Identifiant interne TRUNCATE-TEXT-2026-REFERENCE-LONGUE"
    max-width="max-w-48"
    :tooltip="false"
/>';
            @endphp
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$variantsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="280px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
