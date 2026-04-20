@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'data-display';
    $name = 'datatable';
    $sections = [
        ['id' => 'intro', 'label' => 'Migration'],
        ['id' => 'replacement', 'label' => 'Remplacement'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $migrationCode = <<<'CODE'
{{-- Ancien composant supprimé --}}
<x-daisy::ui.data-display.datatable />

{{-- Nouveau composant --}}
<x-daisy::ui.data-display.table
    mode="client"
    :columns="[
        ['key' => 'name', 'label' => 'Nom'],
    ]"
    :rows="[
        ['name' => 'Cy Ganderton'],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page
    title="Datatable"
    category="data-display"
    name="datatable"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Datatable"
            subtitle="L’alias historique a été retiré. Utilisez désormais le composant table."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.custom id="replacement" title="Remplacement">
        <div class="not-prose space-y-4">
            <div class="alert alert-warning alert-soft">
                <span>
                    <code>x-daisy::ui.data-display.datatable</code> ne doit plus être utilisé.
                    Le package lève maintenant une erreur explicite pour forcer la migration vers
                    <a class="link link-hover" href="/{{ trim($prefix, '/') }}/data-display/table"><code>x-daisy::ui.data-display.table</code></a>.
                </span>
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$migrationCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="240px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
