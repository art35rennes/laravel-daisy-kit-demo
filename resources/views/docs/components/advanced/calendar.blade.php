@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'calendar';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Calendar" 
    category="advanced" 
    name="calendar"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Calendar" 
            subtitle="Façade unique pour Cally, Vanilla Calendar Pro ou le champ date natif."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="calendar">
        <x-slot:preview>
            <x-daisy::ui.advanced.calendar provider="vanilla" name="date" value="2026-07-14" locale="fr-FR" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.advanced.calendar provider="vanilla" name="date" value="2026-07-14" locale="fr-FR" />';
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
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="providers" title="Choisir un fournisseur" class="mt-10">
        <div class="not-prose grid gap-4 text-sm md:grid-cols-3">
            <div class="rounded-box border border-base-300 bg-base-100 p-4"><strong>Cally</strong><p class="mt-1 text-base-content/70">Défaut, basé sur des Web Components.</p></div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4"><strong>Vanilla</strong><p class="mt-1 text-base-content/70">Sélection date, plage ou multiple avec un champ caché synchronisé.</p></div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4"><strong>Native</strong><p class="mt-1 text-base-content/70">Champ <code>type=&quot;date&quot;</code> accessible du navigateur.</p></div>
        </div>
        <p class="mt-4 text-sm text-base-content/70">Le fournisseur Vanilla émet <code>calendar:change</code> avec <code>selectedDates</code> et <code>value</code>.</p>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
