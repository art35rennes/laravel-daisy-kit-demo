@php
    $editableData = [
        'account_email' => 'marie@example.com',
        'profile_name' => 'Marie Dupont',
        'accent_color' => '#8b5cf6',
        'consent' => true,
    ];

    $editableSchema = [
        'version' => '1.0',
        'id' => 'demo-form-kit-stepper',
        'meta' => [
            'title' => 'Inscription guidée',
            'description' => 'Un viewer édition avec navigation multi-step, couleur et validation à chaque changement.',
        ],
        'layout' => ['type' => 'multi-step'],
        'fields' => [
            [
                'id' => 'step_account',
                'type' => 'wizardStep',
                'label' => 'Compte',
                'fields' => [
                    [
                        'id' => 'account_email',
                        'type' => 'email',
                        'name' => 'account_email',
                        'label' => 'Email',
                        'rules' => ['required', 'email'],
                        'attrs' => ['autocomplete' => 'email'],
                    ],
                ],
            ],
            [
                'id' => 'step_profile',
                'type' => 'wizardStep',
                'label' => 'Profil',
                'fields' => [
                    [
                        'id' => 'profile_name',
                        'type' => 'text',
                        'name' => 'profile_name',
                        'label' => 'Nom affiché',
                        'rules' => ['required', 'max:120'],
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'accent_color',
                        'type' => 'color',
                        'name' => 'accent_color',
                        'label' => 'Couleur préférée',
                        'attrs' => [
                            'mode' => 'advanced',
                            'dropdown' => true,
                            'showAlpha' => false,
                            'swatches' => ['#8b5cf6', '#06b6d4', '#22c55e', '#f97316'],
                        ],
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'consent',
                        'type' => 'toggle',
                        'name' => 'consent',
                        'label' => 'Recevoir les notifications',
                        'default' => true,
                        'ui' => ['color' => 'success'],
                    ],
                ],
            ],
        ],
        'submit' => ['mode' => 'event', 'label' => 'Créer le compte'],
    ];

    $readonlyData = [
        'owner' => 'Alex Dupont',
        'plan' => 'scale',
        'api_token' => 'sk_live_demo_9xR4pQ2mA8',
        'notes' => 'Configuration validée pour un lancement pilote.',
    ];

    $readonlySchema = [
        'version' => '1.0',
        'id' => 'demo-form-kit-readonly',
        'meta' => [
            'title' => 'Résumé de configuration',
            'description' => 'Un viewer lecture seule avec données sensibles obfusquées.',
        ],
        'layout' => ['type' => 'sections'],
        'fields' => [
            [
                'id' => 'summary',
                'type' => 'section',
                'label' => 'Projet',
                'fields' => [
                    [
                        'id' => 'owner',
                        'type' => 'text',
                        'name' => 'owner',
                        'label' => 'Responsable',
                        'ui' => ['width' => '1/2'],
                    ],
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
                        'ui' => ['width' => '1/2'],
                    ],
                    [
                        'id' => 'api_token',
                        'type' => 'password',
                        'name' => 'api_token',
                        'label' => 'Jeton API',
                        'attrs' => [
                            'obfuscate' => true,
                            'obfuscateKeepEnd' => 6,
                        ],
                    ],
                    [
                        'id' => 'notes',
                        'type' => 'textarea',
                        'name' => 'notes',
                        'label' => 'Notes',
                        'attrs' => ['rows' => 3],
                    ],
                ],
            ],
        ],
        'submit' => ['mode' => 'none'],
    ];
@endphp

<x-daisy::layout.navbar-layout title="Form Kit - Viewers">
    <div class="mx-auto flex w-full max-w-7xl flex-col gap-6 px-4 py-6">
        <header class="space-y-2">
            <div class="flex flex-wrap items-center gap-2">
                <h1 class="text-2xl font-semibold">Form Kit - Viewers autonomes</h1>
                <span class="badge badge-success badge-outline">édition</span>
                <span class="badge badge-outline">lecture seule</span>
            </div>
            <p class="max-w-4xl text-base-content/80">
                Template consacré à l’usage viewer : le même schéma est rendu en édition et en lecture seule, sans surface builder.
            </p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('templates.forms.form-kit') }}" class="btn btn-ghost btn-sm">Index Form Kit</a>
                <a href="{{ route('templates.forms.form-kit-builder') }}" class="btn btn-ghost btn-sm">Template builder</a>
                <a href="{{ url('/docs/forms/viewer') }}" class="btn btn-ghost btn-sm">Documentation viewer</a>
            </div>
        </header>

        <section class="grid gap-4 xl:grid-cols-2">
            <x-daisy::ui.layout.card bordered compact>
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="text-lg font-semibold">Viewer édition autonome</h2>
                    <span class="badge badge-success badge-outline">editable</span>
                </div>
                <x-daisy::forms.viewer
                    :schema="$editableSchema"
                    :value="$editableData"
                    validate-on="change"
                    action="#"
                    method="POST"
                />
            </x-daisy::ui.layout.card>

            <x-daisy::ui.layout.card bordered compact>
                <div class="mb-4 flex items-center justify-between gap-3">
                    <h2 class="text-lg font-semibold">Viewer lecture seule</h2>
                    <span class="badge badge-outline">readonly</span>
                </div>
                <x-daisy::forms.viewer
                    :schema="$readonlySchema"
                    :value="$readonlyData"
                    :readonly="true"
                    submit-mode="none"
                />
            </x-daisy::ui.layout.card>
        </section>
    </div>
</x-daisy::layout.navbar-layout>
