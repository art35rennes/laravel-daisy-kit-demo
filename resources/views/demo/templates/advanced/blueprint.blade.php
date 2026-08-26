@php
    $editorialFields = [
        [
            'key' => 'owner',
            'type' => 'text',
            'label' => 'Responsable',
            'section' => 'Affectation',
            'placeholder' => 'Équipe ou personne',
            'required' => true,
        ],
        [
            'key' => 'instructions',
            'type' => 'textarea',
            'label' => 'Instructions',
            'section' => 'Affectation',
            'maxLength' => 500,
        ],
        [
            'key' => 'sla_hours',
            'type' => 'number',
            'label' => 'Délai cible (heures)',
            'section' => 'Pilotage',
            'min' => 1,
            'max' => 168,
            'step' => 1,
        ],
        [
            'key' => 'priority',
            'type' => 'select',
            'label' => 'Priorité',
            'section' => 'Pilotage',
            'options' => [
                ['value' => 'normal', 'label' => 'Normale'],
                ['value' => 'high', 'label' => 'Haute'],
                ['value' => 'critical', 'label' => 'Critique'],
            ],
        ],
        [
            'key' => 'requires_review',
            'type' => 'checkbox',
            'label' => 'Relecture obligatoire',
            'section' => 'Pilotage',
        ],
        [
            'key' => 'channels',
            'type' => 'multiselect',
            'label' => 'Canaux',
            'section' => 'Publication',
            'options' => [
                ['value' => 'web', 'label' => 'Web'],
                ['value' => 'newsletter', 'label' => 'Newsletter'],
                ['value' => 'social', 'label' => 'Réseaux sociaux'],
            ],
        ],
        [
            'key' => 'eligibility_rule',
            'type' => 'code-editor',
            'label' => 'Règle d’éligibilité',
            'section' => 'Automatisation',
            'language' => 'jsonata',
            'height' => '160px',
            'help' => 'Expression métier conservée telle quelle dans node.data.',
        ],
        [
            'key' => 'recommendation',
            'type' => 'wysiwyg',
            'label' => 'Recommandation',
            'section' => 'Publication',
            'height' => '10rem',
        ],
    ];
    $editorialDefaults = [
        'owner' => 'Équipe éditoriale',
        'instructions' => '',
        'sla_hours' => 24,
        'priority' => 'normal',
        'requires_review' => true,
        'channels' => ['web'],
        'eligibility_rule' => '$exists(content.title)',
        'recommendation' => '',
    ];
    $nodeCategories = [
        ['value' => 'draft', 'label' => 'Préparation', 'defaults' => $editorialDefaults, 'fields' => $editorialFields],
        ['value' => 'review', 'label' => 'Relecture', 'defaults' => [...$editorialDefaults, 'sla_hours' => 12], 'fields' => $editorialFields],
        ['value' => 'approval', 'label' => 'Validation', 'defaults' => [...$editorialDefaults, 'priority' => 'high'], 'fields' => $editorialFields],
        ['value' => 'published', 'label' => 'Publication', 'defaults' => [...$editorialDefaults, 'requires_review' => false], 'fields' => $editorialFields],
    ];

    $transitionCategories = [
        ['value' => 'progress', 'label' => 'Progression', 'defaults' => ['notify' => false], 'fields' => [['key' => 'notify', 'type' => 'checkbox', 'label' => 'Notifier']]],
        ['value' => 'feedback', 'label' => 'Retour', 'defaults' => ['notify' => true], 'fields' => [['key' => 'notify', 'type' => 'checkbox', 'label' => 'Notifier']]],
        ['value' => 'approval', 'label' => 'Décision', 'defaults' => ['notify' => true], 'fields' => [['key' => 'notify', 'type' => 'checkbox', 'label' => 'Notifier']]],
    ];

    $workflow = [
        'version' => 1,
        'nodes' => [
            ['id' => 'brief', 'label' => 'Brief éditorial', 'description' => 'Objectifs, audience et angle de la publication.', 'category' => 'draft', 'position' => ['x' => 280, 'y' => 40], 'data' => []],
            ['id' => 'writing', 'label' => 'Rédaction', 'description' => 'La version de travail est prête à relire.', 'category' => 'draft', 'position' => ['x' => 280, 'y' => 190], 'data' => []],
            ['id' => 'review', 'label' => 'Relecture', 'description' => 'Contenu, ton et sources sont contrôlés.', 'category' => 'review', 'position' => ['x' => 280, 'y' => 340], 'data' => [...$editorialDefaults, 'owner' => 'Camille', 'channels' => ['web', 'newsletter'], 'recommendation' => '<p>Vérifier les sources avant validation.</p>', 'opaque_reference' => 'EDITORIAL-42']],
            ['id' => 'approval', 'label' => 'Validation', 'description' => 'La responsable éditoriale donne son accord.', 'category' => 'approval', 'position' => ['x' => 280, 'y' => 490], 'data' => []],
            ['id' => 'published', 'label' => 'Publié', 'description' => 'La version finale est diffusée.', 'category' => 'published', 'position' => ['x' => 280, 'y' => 640], 'data' => []],
        ],
        'transitions' => [
            ['id' => 'start-writing', 'source' => 'brief', 'target' => 'writing', 'label' => 'Lancer la rédaction', 'description' => '', 'category' => 'progress', 'data' => []],
            ['id' => 'submit-review', 'source' => 'writing', 'target' => 'review', 'label' => 'Soumettre une version', 'description' => '', 'category' => 'progress', 'data' => []],
            ['id' => 'request-changes', 'source' => 'review', 'target' => 'writing', 'label' => 'Demander des corrections', 'description' => '', 'category' => 'feedback', 'data' => []],
            ['id' => 'approve', 'source' => 'review', 'target' => 'approval', 'label' => 'Valider la relecture', 'description' => '', 'category' => 'approval', 'data' => []],
            ['id' => 'publish', 'source' => 'approval', 'target' => 'published', 'label' => 'Publier', 'description' => '', 'category' => 'approval', 'data' => []],
        ],
        'viewport' => ['x' => 0, 'y' => 0, 'zoom' => 1],
    ];

    $submissionCode = <<<'CODE'
<form method="POST" action="/workflows">
    @csrf

    <x-daisy::ui.advanced.blueprint
        name="workflow"
        :value="$workflow"
    />

    <button type="submit">Enregistrer</button>
</form>
CODE;
@endphp

<x-daisy::layout.app title="Workflow de publication" :container="true">
    <div class="space-y-6 py-8">
        <header class="flex flex-wrap items-start justify-between gap-4">
            <div class="space-y-2">
                <p class="text-sm font-medium text-primary">Blueprint</p>
                <h1 class="text-3xl font-bold">Workflow de publication</h1>
                <p class="max-w-3xl text-base-content/70">
                    Une démo du contrat intégrateur : sélectionnez un élément pour modifier ses attributs métier typés dans l’inspecteur, puis reliez les étapes du workflow.
                </p>
            </div>

            <a href="{{ url('/docs/advanced/blueprint') }}" class="btn btn-ghost btn-sm">Documentation</a>
        </header>

        <x-daisy::ui.feedback.alert color="info" title="Édition locale">
            Les modifications sont synchronisées dans le champ <code>demo_blueprint_release</code>. La persistance et l’exécution du workflow restent à votre charge.
        </x-daisy::ui.feedback.alert>

        <x-daisy::ui.advanced.blueprint
            id="demo-blueprint-release"
            name="demo_blueprint_release"
            direction="TB"
            height="760px"
            :node-categories="$nodeCategories"
            :transition-categories="$transitionCategories"
            :value="$workflow"
        >
            <x-slot:inspector>
                @include('demo.templates.advanced.partials.blueprint-inspector')
            </x-slot:inspector>
        </x-daisy::ui.advanced.blueprint>

        <section class="space-y-3" aria-labelledby="blueprint-secondary-title">
            <div class="space-y-1">
                <h2 id="blueprint-secondary-title" class="text-xl font-semibold">Seconde instance synchronisée</h2>
                <p class="text-sm text-base-content/70">Cette seconde instance expose le même workflow dans un espace d’édition indépendant.</p>
            </div>

            <x-daisy::ui.advanced.blueprint
                id="demo-blueprint-autosave"
                name="demo_blueprint_autosave"
                height="420px"
                :node-categories="$nodeCategories"
                :transition-categories="$transitionCategories"
                :value="$workflow"
            >
                <x-slot:inspector>
                    @include('demo.templates.advanced.partials.blueprint-inspector')
                </x-slot:inspector>
            </x-daisy::ui.advanced.blueprint>
        </section>

        <section class="space-y-3" aria-labelledby="blueprint-view-title">
            <div class="space-y-1">
                <h2 id="blueprint-view-title" class="text-xl font-semibold">Aperçu lecture seule</h2>
                <p class="text-sm text-base-content/70">Le même workflow peut être exposé sans contrôles de modification pour les personnes qui suivent son avancement.</p>
            </div>

            <x-daisy::ui.advanced.blueprint
                name="demo_blueprint_release_view"
                mode="view"
                direction="TB"
                height="360px"
                :node-categories="$nodeCategories"
                :transition-categories="$transitionCategories"
                :value="$workflow"
            />
        </section>

        <section class="grid gap-4 lg:grid-cols-2" aria-labelledby="blueprint-submit-title">
            <div class="space-y-2">
                <h2 id="blueprint-submit-title" class="text-xl font-semibold">Récupérer le workflow synchronisé</h2>
                <p class="text-sm text-base-content/70">
                    Le composant maintient un champ caché portant le nom indiqué. Placez-le dans votre formulaire : Laravel recevra le JSON final dans <code>workflow</code> lors de la soumission.
                </p>
            </div>

            <x-daisy::ui.advanced.code-editor language="blade" :value="$submissionCode" :readonly="true" :showToolbar="false" :showFoldAll="false" :showUnfoldAll="false" :showFormat="false" :showCopy="true" height="260px" />
        </section>
    </div>
</x-daisy::layout.app>
