@php
    use App\Helpers\DocsHelper;

    $category = 'forms';
    $name = 'builder';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'workflow', 'label' => 'Parcours'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'schema-json', 'label' => 'Schéma JSON'],
        ['id' => 'integration', 'label' => 'Intégration'],
        ['id' => 'events', 'label' => 'Événements'],
        ['id' => 'api', 'label' => 'API'],
    ];

    $docsStarterSchema = [
        'version' => '1.0',
        'id' => 'lead-capture-docs',
        'meta' => [
            'title' => 'Lead (démo docs)',
            'description' => 'Schéma préchargé : modifiez-le dans le builder puis observez le JSON.',
        ],
        'fields' => [
            [
                'id' => 'company',
                'type' => 'text',
                'name' => 'company',
                'label' => 'Société',
                'rules' => ['required', 'max:120'],
            ],
            [
                'id' => 'contact_email',
                'type' => 'email',
                'name' => 'contact_email',
                'label' => 'Email',
                'rules' => ['required', 'email'],
            ],
            [
                'id' => 'plan',
                'type' => 'select',
                'name' => 'plan',
                'label' => 'Offre',
                'options' => [
                    ['label' => 'Starter', 'value' => 'starter'],
                    ['label' => 'Scale', 'value' => 'scale'],
                ],
                'rules' => ['required'],
            ],
            [
                'id' => 'notes',
                'type' => 'textarea',
                'name' => 'notes',
                'label' => 'Contexte',
                'rules' => ['nullable', 'max:500'],
            ],
        ],
        'submit' => [
            'mode' => 'event',
            'label' => 'Envoyer',
        ],
    ];

    $schemaShapeExample = json_encode([
        'version' => '1.0',
        'id' => 'my-form',
        'meta' => ['title' => 'Titre', 'description' => 'Sous-titre optionnel'],
        'fields' => [
            [
                'id' => 'email',
                'type' => 'email',
                'name' => 'email',
                'label' => 'Email',
                'rules' => ['required', 'email'],
            ],
            [
                'id' => 'total',
                'type' => 'number',
                'name' => 'total',
                'label' => 'Total estimé',
                'computed' => [
                    'type' => 'jsonata',
                    'expression' => '1 + 1',
                    'dependsOn' => [],
                    'mode' => 'readonly',
                ],
            ],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Valider'],
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $props = DocsHelper::getComponentProps($category, $name);
    $docsPrefix = trim((string) config('daisy-kit.docs.prefix', 'docs'), '/');
@endphp

<x-daisy::docs.page
    title="Form builder"
    category="forms"
    name="builder"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Form builder"
            subtitle="Authoring Livewire du schéma Daisy Form Kit : barre d’actions, plan imbriqué en table, édition des champs dans un modal sans backdrop, aperçu live via le vrai viewer et miroir JSON. Le même schéma versionné (`1.0`) peut être repris par `x-daisy::forms.viewer` ou vos validations Laravel (`FormSchemaValidator`, `LaravelRuleMapper`)."
        />
        <div class="not-prose mt-6 space-y-3">
            <div class="alert alert-info alert-soft">
                <div class="space-y-2 text-sm">
                    <p class="font-medium">À resituer dans le flux Form Kit</p>
                    <ul class="list-inside list-disc space-y-1 opacity-90">
                        <li><strong>Builder</strong> : produit ou édite un objet schéma (JSON).</li>
                        <li><strong>Viewer</strong> : rend les champs pour les utilisateurs finaux à partir du même schéma.</li>
                        <li><strong>Côté serveur</strong> : validez le schéma et les entrées avec les classes du namespace <code class="kbd kbd-xs">Art35rennes\DaisyKit\FormKit\*</code>.</li>
                    </ul>
                </div>
            </div>
            <p class="text-sm text-base-content/75">
                Démo combinée viewer + builder :
                <a href="{{ route('templates.forms.form-kit') }}" class="link link-primary">page interactive « Form Kit »</a>
                · Fiche template docs :
                <a href="{{ url('/'.$docsPrefix.'/templates/form/form-kit') }}" class="link link-primary">Form Kit (démo)</a>.
                Documentation du viewer :
                <a href="{{ url('/'.$docsPrefix.'/forms/viewer') }}" class="link link-primary">Form viewer</a>.
            </p>
        </div>
    </x-slot:intro>

    <x-daisy::docs.sections.example name="builder">
        <x-slot:preview>
            <div class="space-y-3">
                <p class="text-sm text-base-content/75">
                    Le builder charge un schéma initial via la prop <code class="kbd kbd-sm">schema</code>. Sans elle, un formulaire minimal « Untitled form » est proposé. Cliquez sur une ligne du plan pour ouvrir le modal d’édition : chaque attribut affiche un libellé métier, une aide courte et la clé JSON correspondante.
                </p>
                <div class="max-h-[min(72vh,760px)] overflow-auto rounded-box border border-base-300 bg-base-100 p-2">
                    <x-daisy::forms.builder
                        name="schema_docs_demo"
                        :schema="$docsStarterSchema"
                        :preview="true"
                        :jsonEditor="true"
                        :functionCatalog="[
                            ['name' => '$uuid', 'signature' => '<s:s>', 'description' => 'Identifiant unique'],
                            ['name' => '$now', 'signature' => '', 'description' => 'Horodatage ISO'],
                        ]"
                    />
                </div>
                <div class="rounded-box border border-base-300 bg-base-200/40 p-4 text-sm">
                    <p class="font-semibold text-base-content">Soumission HTML</p>
                    <p class="mt-1 text-base-content/75">
                        Emballez le composant dans un <code class="kbd kbd-xs">&lt;form&gt;</code>. Si vous passez <code class="kbd kbd-xs">name="schema"</code>, un <code class="kbd kbd-xs">&lt;textarea hidden&gt;</code> reçoit automatiquement le JSON canonique au moment du rendu synchronisé.
                    </p>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
{{-- Schéma initial optionnel (tableau PHP ou chaîne JSON) --}}
<x-daisy::forms.builder
    name="schema"
    :schema="[
        'version' => '1.0',
        'id' => 'lead',
        'meta' => ['title' => 'Lead'],
        'fields' => [
            ['id' => 'email', 'type' => 'email', 'name' => 'email', 'label' => 'Email', 'rules' => ['required', 'email']],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Envoyer'],
    ]"
    :preview="true"
    :jsonEditor="true"
    :functionCatalog="[
        ['name' => '$uuid', 'signature' => '<s:s>', 'description' => 'UUID'],
    ]"
/>

{{-- Catalogue JSONata global via config/daisy-kit.php : forms.jsonata.function_catalog --}}
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
                height="340px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="workflow" title="Parcours dans l’interface" class="mt-10">
        <div class="not-prose space-y-4">
            <ol class="list-inside list-decimal space-y-3 text-sm leading-relaxed">
                <li>
                    <strong>Barre d’actions</strong> : ajoute un type de champ depuis le catalogue, une étape de wizard, ou ouvre les réglages globaux du schéma.
                </li>
                <li>
                    <strong>Plan</strong> : table arborescente pour ordonner, supprimer ou ouvrir la configuration d’un champ.
                </li>
                <li>
                    <strong>Aperçu</strong> : rendu réel via <code class="kbd kbd-xs">x-daisy::forms.viewer</code>, sans renderer alternatif.
                </li>
                <li>
                    <strong>JSON</strong> : édition directe avec resynchronisation ; une erreur de structure remonte dans les diagnostics.
                </li>
                <li>
                    <strong>Modal d’édition</strong> : ids uniques, noms de payload (<code class="kbd kbd-xs">name</code>), règles, options, visibilité, calculs JSONata et props de composants expliquées sans dépendre seulement du nom de prop.
                </li>
            </ol>
            <div class="alert alert-warning alert-soft text-sm">
                Les types disponibles viennent du catalogue PHP <code class="kbd kbd-xs">FormFieldCatalog</code>. C’est le point d’extension pour rendre de nouveaux composants du package éligibles au builder avec leurs props pertinentes.
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.variants name="builder-variants">
        <x-slot:preview>
            <div class="grid gap-8 lg:grid-cols-2">
                <div class="space-y-2">
                    <p class="text-sm font-semibold">Mode « auteur »</p>
                    <p class="text-xs text-base-content/70">Sans aperçu, écran plus dense pour éditer vite le JSON.</p>
                    <div class="max-h-[420px] overflow-auto rounded-box border border-base-300 bg-base-100 p-2">
                        <x-daisy::forms.builder
                            :preview="false"
                            :jsonEditor="true"
                            :schema="array_merge($docsStarterSchema, ['id' => 'authoring-inline-docs'])"
                        />
                    </div>
                </div>
                <div class="space-y-2">
                    <p class="text-sm font-semibold">Mode « présentation »</p>
                    <p class="text-xs text-base-content/70">Masque l’éditeur JSON ; garde plan + modal d’édition + aperçu.</p>
                    <div class="max-h-[420px] overflow-auto rounded-box border border-base-300 bg-base-100 p-2">
                        <x-daisy::forms.builder
                            :preview="true"
                            :jsonEditor="false"
                            :schema="array_merge($docsStarterSchema, ['id' => 'presentation-inline-docs'])"
                        />
                    </div>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
{{-- Focus rédaction JSON --}}
<x-daisy::forms.builder :preview="false" :jsonEditor="true" :schema="$schema" />

{{-- Masquer le JSON aux profils non techniques --}}
<x-daisy::forms.builder :preview="true" :jsonEditor="false" :schema="$schema" />

{{-- Palette sur mesure : tableau compatible avec DEFAULT_FIELD_DEFINITIONS --}}
<x-daisy::forms.builder
    :field-types="[
        ['type' => 'text', 'label' => 'Texte court'],
        ['type' => 'email', 'label' => 'Email'],
        ['type' => 'section', 'label' => 'Section'],
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
                height="260px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.custom id="schema-json" title="Contrat du schéma (aperçu)" class="mt-10">
        <div class="not-prose space-y-4">
            <p class="text-sm text-base-content/80">
                Le builder canonise toujours vers la version <code class="kbd kbd-xs">1.0</code>. Les propriétés obligatoires minimales sont <code class="kbd kbd-xs">version</code>, <code class="kbd kbd-xs">id</code> et <code class="kbd kbd-xs">fields</code>.
                Chaque entrée de <code class="kbd kbd-xs">fields</code> porte au minimum <code class="kbd kbd-xs">id</code>, <code class="kbd kbd-xs">type</code> et un <code class="kbd kbd-xs">name</code> compatible Laravel (sauf cas particuliers comme <code class="kbd kbd-xs">staticText</code>).
                Les tableaux <code class="kbd kbd-xs">rules</code> acceptent une liste de jetons voisins des règles Laravel pour la passerelle serveur.
            </p>
            <x-daisy::ui.advanced.code-editor
                language="json"
                :value="$schemaShapeExample"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="380px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="integration" title="Intégration Laravel" class="mt-10">
        <div class="not-prose space-y-4 text-sm leading-relaxed">
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <p class="font-semibold">Validation du schéma et des données</p>
                <ul class="mt-2 list-inside list-disc space-y-2 text-base-content/80">
                    <li>
                        <code class="kbd kbd-xs">FormSchemaValidator</code> : vérifie la cohérence du schéma persisté avant de le servir au viewer ou après une sauvegarde builder.
                    </li>
                    <li>
                        <code class="kbd kbd-xs">LaravelRuleMapper</code> : convertit les entrées <code class="kbd kbd-xs">rules</code> déclaratives du schéma en règles compréhensibles par <code class="kbd kbd-xs">Validator</code> (les expressions JSONata restent hors validator natif).
                    </li>
                    <li>
                        <code class="kbd kbd-xs">FormSubmissionEvaluator</code> : après validation structurelle du schéma, exécute les charges JSONata (visibilité, champs calculés, validations déclaratives) pour aligner la réponse serveur sur le runtime navigateur.
                    </li>
                    <li>
                        <code class="kbd kbd-xs">FormErrorBagMapper</code> : adapte les erreurs Laravel au format attendu par le viewer (<code class="kbd kbd-xs">x-daisy::forms.viewer</code>).
                    </li>
                </ul>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <p class="font-semibold">Configuration JSONata</p>
                <p class="mt-2 text-base-content/80">
                    Les entrées globales vivent sous <code class="kbd kbd-xs">config('daisy-kit.forms.jsonata')</code> : catalogue de fonctions, timeouts et garde‑fous de taille.
                    La prop Blade <code class="kbd kbd-xs">functionCatalog</code> enrichit ponctuellement la liste affichée dans le builder sans toucher au fichier de config.
                </p>
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="events" title="Synchronisation" class="mt-10">
        <div class="not-prose space-y-3 text-sm">
            <p class="text-base-content/80">
                Le builder est un composant Livewire. Pour une soumission HTML progressive, passez <code class="kbd kbd-xs">name="schema"</code> : un textarea caché reçoit le JSON canonique. Pour un écran applicatif plus riche, écoutez les cycles Livewire ou persistez explicitement la valeur retournée par votre action host.
            </p>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Événement</th>
                            <th>Détail (<code class="kbd kbd-xs">event.detail</code>)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code class="kbd kbd-xs">data-builder-hidden</code></td>
                            <td>Textarea caché alimenté par le JSON canonique lorsque <code class="kbd kbd-xs">name</code> est fourni.</td>
                        </tr>
                        <tr>
                            <td><code class="kbd kbd-xs">data-builder-diagnostics</code></td>
                            <td>Liste Blade des diagnostics visibles, issue du validator PHP.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <pre class="rounded-box bg-base-200 p-4 text-xs leading-relaxed"><code>&lt;x-daisy::forms.builder
    name="schema"
    :schema="$storedSchema"
    :value="$previewData"
    :preview="true"
/&gt;</code></pre>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
