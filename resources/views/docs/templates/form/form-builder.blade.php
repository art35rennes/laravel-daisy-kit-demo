@php
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'preview', 'label' => 'Preview'],
        ['id' => 'schema', 'label' => 'Schema'],
        ['id' => 'host', 'label' => 'Integration hote'],
    ];

    $schema = [
        'version' => '1.0',
        'id' => 'contact',
        'meta' => [
            'title' => 'Contact',
            'description' => 'Exemple de formulaire genere par Daisy Form Kit.',
        ],
        'layout' => ['type' => 'multi-step'],
        'fields' => [
            [
                'id' => 'contact_step',
                'type' => 'wizardStep',
                'label' => 'Contact',
                'fields' => [
                    [
                        'id' => 'identity',
                        'type' => 'section',
                        'label' => 'Identite',
                        'fields' => [
                            ['id' => 'name', 'type' => 'text', 'name' => 'name', 'label' => 'Nom', 'rules' => ['required']],
                            ['id' => 'email', 'type' => 'email', 'name' => 'email', 'label' => 'Email', 'rules' => ['required', 'email']],
                        ],
                    ],
                ],
            ],
            [
                'id' => 'message_step',
                'type' => 'wizardStep',
                'label' => 'Message',
                'fields' => [
                    ['id' => 'subject', 'type' => 'select', 'name' => 'subject', 'label' => 'Sujet', 'options' => [['label' => 'Support', 'value' => 'support'], ['label' => 'Commercial', 'value' => 'sales']], 'rules' => ['required']],
                    ['id' => 'message', 'type' => 'textarea', 'name' => 'message', 'label' => 'Message', 'rules' => ['required']],
                    ['id' => 'newsletter', 'type' => 'checkbox', 'name' => 'newsletter', 'label' => 'Recevoir les nouvelles', 'default' => true],
                ],
            ],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Envoyer'],
    ];

    $value = [
        'name' => 'Ada Lovelace',
        'email' => 'ada@example.com',
        'subject' => 'support',
        'message' => 'Bonjour, je souhaite recevoir plus d informations.',
        'newsletter' => true,
    ];

    $builderUsage = '<x-daisy::templates.form.builder
    :schema="$schema"
    :value="$submission"
    schema-name="form_schema"
    viewer-submit-mode="none"
/>';

    $viewerUsage = '<x-daisy::forms.viewer
    :schema="$schema"
    :value="$submission"
    submit-mode="event"
/>';
@endphp

<x-daisy::docs.page
    title="Form builder"
    category="form"
    name="form-builder"
    type="template"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Form builder"
            subtitle="Surface embarquable pour creer, editer et verifier un schema Daisy Form 1.0 sans imposer Filament."
        />

        <div class="mt-4 grid gap-3 md:grid-cols-3">
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Builder</h3>
                <p class="mt-1 text-sm text-base-content/70">Produit un schema versionne stockable par l app hote.</p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Viewer</h3>
                <p class="mt-1 text-sm text-base-content/70">Rend le meme schema en formulaire one-page ou multi-step.</p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Backend hote</h3>
                <p class="mt-1 text-sm text-base-content/70">Persiste le schema et exploite les submissions normalisees.</p>
            </div>
        </div>

        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('templates.forms.builder') }}" class="btn btn-primary btn-sm">Ouvrir la preview</a>
            <a href="{{ url('/'.trim(config('daisy-kit.docs.prefix', 'docs'), '/').'/forms/builder') }}" class="btn btn-ghost btn-sm">Composant builder</a>
            <a href="{{ url('/'.trim(config('daisy-kit.docs.prefix', 'docs'), '/').'/forms/viewer') }}" class="btn btn-ghost btn-sm">Composant viewer</a>
        </div>
    </x-slot:intro>

    <x-daisy::docs.sections.custom id="preview" title="Preview builder + viewer">
        <x-daisy::templates.form.builder
            :schema="$schema"
            :value="$value"
            schema-name="form_schema"
            viewer-submit-mode="none"
            :json-editor="true"
        />
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="schema" title="Schema 1.0">
        <div class="grid gap-4 lg:grid-cols-2">
            <div>
                <h3 class="text-base font-semibold">Template builder</h3>
                <div class="mockup-code mt-3">
                    <pre data-prefix=""><code>{{ $builderUsage }}</code></pre>
                </div>
            </div>
            <div>
                <h3 class="text-base font-semibold">Viewer seul</h3>
                <div class="mockup-code mt-3">
                    <pre data-prefix=""><code>{{ $viewerUsage }}</code></pre>
                </div>
            </div>
        </div>

        <div class="mt-6 overflow-x-auto">
            <table class="table table-sm">
                <thead>
                    <tr><th>Cle</th><th>Role</th></tr>
                </thead>
                <tbody>
                    <tr><td><code>version</code></td><td>Version du contrat public stocke par l app hote.</td></tr>
                    <tr><td><code>layout.type</code></td><td><code>one-page</code>, <code>sections</code> ou <code>multi-step</code>.</td></tr>
                    <tr><td><code>fields</code></td><td>Arbre de steps, sections et champs submitables.</td></tr>
                    <tr><td><code>rules</code></td><td>Regles simples mappees vers Laravel et validations JSONata optionnelles.</td></tr>
                    <tr><td><code>submit</code></td><td>Mode de soumission du viewer: event, html, fetch ou none.</td></tr>
                </tbody>
            </table>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="host" title="Integration hote">
        <div class="space-y-3 text-sm text-base-content/80">
            <p>L application hote garde la responsabilite du stockage, des policies, des routes et de l exploitation des donnees.</p>
            <p>Le package fournit le schema, le builder, le viewer, le mapping de regles Laravel et l evaluation serveur optionnelle des expressions JSONata.</p>
        </div>
        <div class="mockup-code mt-4">
            <pre data-prefix=""><code>view('daisy::templates.form.builder')</code></pre>
            <pre data-prefix=""><code>route('templates.forms.builder')</code></pre>
        </div>
        <div class="mt-4 rounded-box border border-base-300 bg-base-100 p-4">
            <p class="text-sm"><strong>Flux conseille :</strong> charger le schema depuis la base, afficher le builder, sauvegarder le JSON canonique, puis rendre les submissions avec <code>x-daisy::forms.viewer</code>.</p>
        </div>
    </x-daisy::docs.sections.custom>
</x-daisy::docs.page>
