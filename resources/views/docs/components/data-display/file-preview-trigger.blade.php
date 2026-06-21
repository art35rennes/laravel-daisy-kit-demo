@php
    use App\Helpers\DocsHelper;

    $category = 'data-display';
    $name = 'file-preview-trigger';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'states', 'label' => 'Etats'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="File Preview Trigger"
    category="data-display"
    name="file-preview-trigger"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="File Preview Trigger"
            subtitle="Bouton public qui ouvre l'aperçu de fichier lorsque le type fourni est compatible."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="file-preview-trigger">
        <x-slot:preview>
            <div class="flex flex-wrap gap-3">
                <x-daisy::ui.data-display.file-preview-trigger
                    url="https://picsum.photos/640/420"
                    type="image"
                    label="Prévisualiser l'image"
                />
                <x-daisy::ui.data-display.file-preview-trigger
                    url="/documents/specification.pdf"
                    mime-type="application/pdf"
                    label="Prévisualiser le PDF"
                />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.data-display.file-preview-trigger
    url="https://picsum.photos/640/420"
    type="image"
    label="Prévisualiser l\'image"
/>

<x-daisy::ui.data-display.file-preview-trigger
    url="/documents/specification.pdf"
    mime-type="application/pdf"
    label="Prévisualiser le PDF"
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

    <section id="states" class="mt-12">
        <h2 class="text-2xl font-semibold mb-4">Etats</h2>
        <div class="grid gap-4 md:grid-cols-2">
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <p class="mb-3 text-sm font-semibold">Fichier compatible</p>
                <x-daisy::ui.data-display.file-preview-trigger
                    url="/media/rapport.png"
                    extension="png"
                    label="Ouvrir l'aperçu"
                />
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <p class="mb-3 text-sm font-semibold">Fichier non prévisualisable</p>
                <x-daisy::ui.data-display.file-preview-trigger
                    url="/archives/source.zip"
                    extension="zip"
                    label="Aperçu indisponible"
                />
            </div>
        </div>
    </section>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
