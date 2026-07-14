@php
    $category = 'advanced';
    $name = 'calendar-vanilla';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Valeur synchronisée'],
        ['id' => 'api', 'label' => 'API'],
    ];
@endphp

<x-daisy::docs.page title="Calendar Vanilla" category="advanced" name="calendar-vanilla" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro title="Calendar Vanilla" subtitle="Calendrier Vanilla Calendar Pro avec valeurs de formulaire synchronisées." jsModule="calendar-vanilla" />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="calendar-vanilla">
        <x-slot:preview>
            <x-daisy::ui.advanced.calendar-vanilla name="booking_dates" mode="range" :months="2" value="2026-07-14,2026-07-18" min="2026-07-01" max="2026-07-31" locale="fr-FR" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.advanced.calendar-vanilla
    name="booking_dates"
    mode="range"
    :months="2"
    value="2026-07-14,2026-07-18"
    value-separator=","
    min="2026-07-01"
    max="2026-07-31"
    locale="fr-FR"
/>
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor language="blade" :value="$baseCode" :readonly="true" :showToolbar="false" :showFoldAll="false" :showUnfoldAll="false" :showFormat="false" :showCopy="true" height="260px" />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="behavior" title="Valeur synchronisée" class="mt-10">
        <p class="text-sm text-base-content/70">Le composant rend un input caché portant <code>name</code>. À chaque sélection, il émet <code>input</code>, <code>change</code> et <code>calendar:change</code>. Utilisez <code>mode=&quot;date|range|multi&quot;</code>; <code>value-separator</code> contrôle le format de la valeur envoyée.</p>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
