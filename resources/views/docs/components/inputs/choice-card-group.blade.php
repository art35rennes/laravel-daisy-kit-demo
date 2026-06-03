@php
    use App\Helpers\DocsHelper;
    $category = 'inputs';
    $name = 'choice-card-group';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Choice card group"
    category="inputs"
    name="choice-card-group"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Choice card group"
            subtitle="Grille de cartes sélectionnables (radio ou cases à cocher), avec icônes, badges et descriptions."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="choice-card-group">
        <x-slot:preview>
            <x-daisy::ui.inputs.choice-card-group
                name="plan_docs"
                legend="Choisir une offre"
                :items="[
                    [
                        'value' => 'solo',
                        'label' => 'Solo',
                        'description' => 'Un utilisateur, projets illimités pendant 14 jours.',
                        'icon' => 'person',
                        'badge' => 'Populaire',
                    ],
                    [
                        'value' => 'team',
                        'label' => 'Équipe',
                        'description' => 'Jusqu’à dix sièges avec facturation centralisée.',
                        'icon' => 'people',
                    ],
                    [
                        'value' => 'org',
                        'label' => 'Organisation',
                        'description' => 'SSO, journaux d’audit et support dédié.',
                        'icon' => 'building',
                        'badge' => 'New',
                    ],
                ]"
                value="team"
                columns="grid-cols-1 md:grid-cols-3"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.inputs.choice-card-group
    name="plan"
    legend="Choisir une offre"
    :items="[
        ['value' => 'solo', 'label' => 'Solo', 'description' => '…', 'icon' => 'person'],
        ['value' => 'team', 'label' => 'Équipe', 'description' => '…', 'icon' => 'people'],
    ]"
    value="team"
/>
CODE;
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

    <x-daisy::docs.sections.variants name="choice-card-group">
        <x-slot:preview>
            <div class="space-y-8">
                <div>
                    <p class="mb-2 text-sm font-semibold">Cases à cocher (multi-sélection)</p>
                    <x-daisy::ui.inputs.choice-card-group
                        name="addons_docs[]"
                        type="checkbox"
                        legend="Modules"
                        color="accent"
                        size="sm"
                        :values="['analytics']"
                        :items="[
                            ['value' => 'analytics', 'label' => 'Analytics', 'description' => 'Tableaux et exports CSV.', 'icon' => 'bar-chart-line'],
                            ['value' => 'sla', 'label' => 'SLA', 'description' => 'Temps de réponse garanti.', 'icon' => 'clock'],
                        ]"
                        columns="grid-cols-1 sm:grid-cols-2"
                    />
                </div>
                <div>
                    <p class="mb-2 text-sm font-semibold">Sans contrôle visible (carte seule)</p>
                    <x-daisy::ui.inputs.choice-card-group
                        name="theme_pick_docs"
                        legend="Thème"
                        :showControl="false"
                        color="neutral"
                        :items="[
                            ['value' => 'light', 'label' => 'Clair', 'description' => 'Contraste élevé pour la journée.'],
                            ['value' => 'dark', 'label' => 'Sombre', 'description' => 'Repos visuel en faible lumière.'],
                        ]"
                        columns="grid-cols-1 sm:grid-cols-2"
                    />
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
<x-daisy::ui.inputs.choice-card-group
    name="addons[]"
    type="checkbox"
    legend="Modules"
    color="accent"
    :values="['analytics']"
    :items="[
        ['value' => 'analytics', 'label' => 'Analytics', 'icon' => 'bar-chart-line'],
        ['value' => 'sla', 'label' => 'SLA', 'icon' => 'clock'],
    ]"
/>

<x-daisy::ui.inputs.choice-card-group
    name="theme_pick"
    :showControl="false"
    color="neutral"
    :items="[
        ['value' => 'light', 'label' => 'Clair'],
        ['value' => 'dark', 'label' => 'Sombre'],
    ]"
/>
CODE;
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
                height="340px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
