@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'inputs';
    $name = 'token-input';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Suggestions et limites'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Token Input"
    category="inputs"
    name="token-input"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Token Input"
            subtitle="Champ enrichi pour saisir plusieurs valeurs, avec hidden inputs, validation légère et suggestions."
            jsModule="token-input"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="token-input">
        <x-slot:preview>
            <x-daisy::ui.inputs.token-input
                name="recipients"
                :values="['alice@example.com', 'bob@example.com']"
                placeholder="Ajouter des destinataires"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.inputs.token-input
    name="recipients"
    :values="['alice@example.com', 'bob@example.com']"
    placeholder="Ajouter des destinataires"
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
                height="180px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="token-input">
        <x-slot:preview>
            <div class="space-y-4">
                <div>
                    <p class="mb-2 text-sm font-semibold">Suggestions locales</p>
                    <x-daisy::ui.inputs.token-input
                        name="tags"
                        preset="text"
                        size="sm"
                        color="primary"
                        :maxItems="4"
                        :suggestions="[
                            ['value' => 'laravel', 'label' => 'Laravel'],
                            ['value' => 'livewire', 'label' => 'Livewire'],
                            ['value' => 'alpine', 'label' => 'Alpine.js'],
                            ['value' => 'tailwind', 'label' => 'Tailwind CSS'],
                        ]"
                        placeholder="Ajouter un tag"
                    />
                </div>

                <div>
                    <p class="mb-2 text-sm font-semibold">Suggestions distantes</p>
                    <x-daisy::ui.inputs.token-input
                        name="contributors"
                        preset="text"
                        endpoint="/demo/datatable/api/get"
                        param="search[value]"
                        :debounce="150"
                        :minChars="1"
                        placeholder="Rechercher un contributeur"
                    />
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
<x-daisy::ui.inputs.token-input
    name="tags"
    preset="text"
    size="sm"
    color="primary"
    :maxItems="4"
    :suggestions="[
        ['value' => 'laravel', 'label' => 'Laravel'],
        ['value' => 'livewire', 'label' => 'Livewire'],
        ['value' => 'alpine', 'label' => 'Alpine.js'],
        ['value' => 'tailwind', 'label' => 'Tailwind CSS'],
    ]"
    placeholder="Ajouter un tag"
/>

<x-daisy::ui.inputs.token-input
    name="contributors"
    preset="text"
    endpoint="/demo/datatable/api/get"
    param="search[value]"
    :debounce="150"
    :minChars="1"
    placeholder="Rechercher un contributeur"
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
