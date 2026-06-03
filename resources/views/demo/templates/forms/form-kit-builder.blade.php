@php
    $formData = [
        'first_name' => 'Alex',
        'last_name' => 'Dupont',
        'email' => 'alex@example.com',
        'plan' => 'scale',
        'brand_color' => '#2f80ed',
        'start_date' => '2026-06-15',
        'access_code' => 'PK-2026-ALPHA',
        'notify' => true,
        'notes' => 'Migrer un formulaire métier vers Daisy Form Kit.',
    ];

    $formSchema = [
        'version' => '1.0',
        'id' => 'demo-form-kit-authoring',
        'meta' => [
            'title' => 'Brief projet',
            'description' => 'Un schéma court pour tester authoring, preview, export JSON et viewer autonome.',
        ],
        'layout' => ['type' => 'sections'],
        'fields' => [
            [
                'id' => 'identity',
                'type' => 'section',
                'label' => 'Contact',
                'fields' => [
                    [
                        'id' => 'first_name',
                        'type' => 'text',
                        'name' => 'first_name',
                        'label' => 'Prénom',
                        'rules' => ['required', 'max:120'],
                        'attrs' => ['placeholder' => 'Alex', 'autocomplete' => 'given-name'],
                        'ui' => ['width' => '1/2', 'size' => 'sm'],
                    ],
                    [
                        'id' => 'last_name',
                        'type' => 'text',
                        'name' => 'last_name',
                        'label' => 'Nom',
                        'rules' => ['required', 'max:120'],
                        'attrs' => ['placeholder' => 'Dupont', 'autocomplete' => 'family-name'],
                        'ui' => ['width' => '1/2', 'size' => 'sm'],
                    ],
                    [
                        'id' => 'email',
                        'type' => 'email',
                        'name' => 'email',
                        'label' => 'Email',
                        'rules' => ['required', 'email'],
                        'attrs' => ['placeholder' => 'alex@example.com', 'autocomplete' => 'email'],
                        'ui' => ['width' => '1/2', 'size' => 'sm'],
                    ],
                ],
            ],
            [
                'id' => 'project',
                'type' => 'section',
                'label' => 'Projet',
                'fields' => [
                    [
                        'id' => 'plan',
                        'type' => 'select',
                        'name' => 'plan',
                        'label' => 'Offre',
                        'options' => [
                            ['label' => 'Starter', 'value' => 'starter'],
                            ['label' => 'Scale', 'value' => 'scale'],
                            ['label' => 'Enterprise', 'value' => 'enterprise'],
                        ],
                        'rules' => ['required'],
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'start_date',
                        'type' => 'date',
                        'name' => 'start_date',
                        'label' => 'Début souhaité',
                        'attrs' => ['min' => '2026-06-01'],
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'brand_color',
                        'type' => 'color',
                        'name' => 'brand_color',
                        'label' => 'Couleur de marque',
                        'attrs' => [
                            'mode' => 'advanced',
                            'dropdown' => true,
                            'showAlpha' => false,
                            'swatches' => ['#2f80ed', '#10b981', '#f59e0b', '#ef4444'],
                        ],
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'access_code',
                        'type' => 'password',
                        'name' => 'access_code',
                        'label' => 'Code projet',
                        'attrs' => [
                            'obfuscate' => true,
                            'obfuscateKeepEnd' => 4,
                        ],
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'notify',
                        'type' => 'toggle',
                        'name' => 'notify',
                        'label' => 'Recevoir les notifications projet',
                        'default' => true,
                        'ui' => ['color' => 'success'],
                    ],
                    [
                        'id' => 'notes',
                        'type' => 'textarea',
                        'name' => 'notes',
                        'label' => 'Contexte',
                        'rules' => ['nullable', 'max:500'],
                        'attrs' => ['rows' => 4, 'placeholder' => 'Contexte, contraintes et prochaines étapes.'],
                    ],
                ],
            ],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Prévisualiser la soumission'],
    ];
@endphp

<x-daisy::layout.navbar-layout title="Form Kit - Builder">
    <div class="mx-auto flex w-full max-w-[calc(100vw-0.75rem)] flex-col gap-6 px-3 py-6">
        <header class="space-y-2">
            <div class="flex flex-wrap items-center gap-2">
                <h1 class="text-2xl font-semibold">Form Kit - Builder + preview</h1>
                <span class="badge badge-primary badge-outline">Livewire builder</span>
                <span class="badge badge-outline">Preview réelle</span>
            </div>
            <p class="max-w-4xl text-base-content/80">
                Template consacré à l’authoring : le builder Livewire édite le schéma, affiche la preview via le vrai viewer et expose le JSON canonique.
            </p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('templates.forms.form-kit') }}" class="btn btn-ghost btn-sm">Index Form Kit</a>
                <a href="{{ route('templates.forms.form-kit-viewers') }}" class="btn btn-ghost btn-sm">Template viewers</a>
                <a href="{{ url('/docs/forms/builder') }}" class="btn btn-ghost btn-sm">Documentation builder</a>
            </div>
        </header>

        <section class="space-y-4">
            <div>
                <h2 class="text-lg font-semibold">Authoring du schéma</h2>
                <p class="text-sm text-base-content/70">Cliquez une ligne du plan pour ouvrir le modal d’édition sans backdrop. Les attributs affichent un libellé métier, une aide courte et la clé JSON correspondante.</p>
            </div>

            <div class="rounded-box border border-base-300 bg-base-100 p-2">
                <x-daisy::forms.builder
                    name="demo_schema"
                    :schema="$formSchema"
                    :value="$formData"
                    :preview="true"
                    :jsonEditor="true"
                    viewer-submit-mode="none"
                />
            </div>
        </section>
    </div>
</x-daisy::layout.navbar-layout>
