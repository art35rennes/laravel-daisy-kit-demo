@php
    $schema = [
        'version' => '1.0',
        'id' => 'lead_intake',
        'meta' => [
            'title' => 'Lead intake',
            'description' => 'Formulaire multi-step pret a stocker comme schema Daisy Form.',
        ],
        'layout' => ['type' => 'multi-step'],
        'fields' => [
            [
                'id' => 'contact',
                'type' => 'wizardStep',
                'label' => 'Contact',
                'fields' => [
                    ['id' => 'company', 'type' => 'text', 'name' => 'company', 'label' => 'Entreprise', 'rules' => ['required']],
                    ['id' => 'email', 'type' => 'email', 'name' => 'email', 'label' => 'Email', 'rules' => ['required', 'email']],
                ],
            ],
            [
                'id' => 'needs',
                'type' => 'wizardStep',
                'label' => 'Besoins',
                'fields' => [
                    ['id' => 'budget', 'type' => 'number', 'name' => 'budget', 'label' => 'Budget', 'rules' => ['nullable', 'min:0']],
                    ['id' => 'details', 'type' => 'textarea', 'name' => 'details', 'label' => 'Details'],
                ],
            ],
        ],
    ];
@endphp

<x-daisy::layout.app title="Form builder">
    <x-daisy::templates.form.builder
        :schema="$schema"
        :value="['company' => 'Acme', 'email' => 'contact@example.com']"
        schema-name="form_schema"
        :json-editor="true"
    />
</x-daisy::layout.app>
