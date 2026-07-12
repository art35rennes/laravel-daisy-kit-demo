@php
    $category = 'inputs';
    $name = 'otp';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];

    $baseCode = <<<'CODE'
<x-daisy::ui.inputs.otp
    name="verification_code"
    value="123456"
    color="primary"
    required
/>
CODE;
@endphp

<x-daisy::docs.page title="Code OTP" :category="$category" :name="$name" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Code OTP"
            subtitle="Champ à code unique, compatible avec l’autoremplissage des codes de vérification."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="otp">
        <x-slot:preview>
            <x-daisy::ui.inputs.otp name="verification_code" value="123456" color="primary" required />
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor language="blade" :value="$baseCode" :readonly="true" :showToolbar="false" :showFoldAll="false" :showUnfoldAll="false" :showFormat="false" :showCopy="true" height="180px" />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="otp">
        <x-slot:preview>
            <div class="flex flex-wrap items-end gap-6">
                <x-daisy::ui.inputs.otp name="short_code" length="4" value="1234" :joined="true" size="sm" color="success" />
                <x-daisy::ui.inputs.otp name="recovery_code" length="5" value="A7X2Q" :numeric="false" size="lg" />
            </div>
        </x-slot:preview>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
