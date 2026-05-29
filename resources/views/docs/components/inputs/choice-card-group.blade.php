@php
    use App\Helpers\DocsHelper;
    $category = 'inputs';
    $name = 'choice-card-group';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Selection multiple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $plans = [
        ['value' => 'starter', 'label' => 'Starter', 'description' => 'Pour demarrer un projet rapidement.'],
        ['value' => 'team', 'label' => 'Team', 'description' => 'Pour une equipe avec plusieurs espaces.'],
        ['value' => 'scale', 'label' => 'Scale', 'description' => 'Pour un usage avance avec support prioritaire.'],
    ];
@endphp

<x-daisy::docs.page
    title="Choice Card Group"
    category="inputs"
    name="choice-card-group"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Choice Card Group"
            subtitle="Groupe de choix radio ou checkbox presente sous forme de cartes selectionnables."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="choice-card-group">
        <x-slot:preview>
            <x-daisy::ui.inputs.choice-card-group
                name="plan"
                legend="Plan"
                hint="Choisissez une option."
                value="team"
                :items="$plans"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.inputs.choice-card-group
    name="plan"
    legend="Plan"
    hint="Choisissez une option."
    value="team"
    :items="[
        ['value' => 'starter', 'label' => 'Starter', 'description' => 'Pour demarrer un projet rapidement.'],
        ['value' => 'team', 'label' => 'Team', 'description' => 'Pour une equipe avec plusieurs espaces.'],
        ['value' => 'scale', 'label' => 'Scale', 'description' => 'Pour un usage avance avec support prioritaire.'],
    ]"
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
                height="260px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="choice-card-group">
        <x-slot:preview>
            <x-daisy::ui.inputs.choice-card-group
                name="features"
                type="checkbox"
                legend="Options incluses"
                color="success"
                :values="['docs', 'support']"
                :items="[
                    ['value' => 'docs', 'label' => 'Documentation', 'description' => 'Publier la documentation du projet.'],
                    ['value' => 'support', 'label' => 'Support', 'description' => 'Activer le support prioritaire.'],
                    ['value' => 'analytics', 'label' => 'Analytics', 'description' => 'Ajouter les rapports d usage.'],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
<x-daisy::ui.inputs.choice-card-group
    name="features"
    type="checkbox"
    legend="Options incluses"
    color="success"
    :values="['docs', 'support']"
    :items="[
        ['value' => 'docs', 'label' => 'Documentation', 'description' => 'Publier la documentation du projet.'],
        ['value' => 'support', 'label' => 'Support', 'description' => 'Activer le support prioritaire.'],
        ['value' => 'analytics', 'label' => 'Analytics', 'description' => 'Ajouter les rapports d usage.'],
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
                height="300px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
