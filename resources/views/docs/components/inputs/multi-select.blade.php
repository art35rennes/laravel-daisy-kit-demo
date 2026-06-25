@php
    use App\Helpers\DocsHelper;

    $category = 'inputs';
    $name = 'multi-select';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Recherche locale et distante'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Multi Select"
    category="inputs"
    name="multi-select"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Multi Select"
            subtitle="Select multiple avec recherche, valeurs cachées de formulaire, options locales ou endpoint JSON."
            jsModule="multi-select"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="multi-select">
        <x-slot:preview>
            <x-daisy::ui.inputs.multi-select
                name="countries"
                placeholder="Rechercher un pays"
                :values="['fr', 'ca']"
                :options="[
                    ['value' => 'fr', 'label' => 'France'],
                    ['value' => 'be', 'label' => 'Belgique'],
                    ['value' => 'ca', 'label' => 'Canada'],
                    ['value' => 'ch', 'label' => 'Suisse'],
                    ['value' => 'de', 'label' => 'Allemagne'],
                    ['value' => 'es', 'label' => 'Espagne'],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.inputs.multi-select
    name="countries"
    placeholder="Rechercher un pays"
    :values="['fr', 'ca']"
    :options="[
        ['value' => 'fr', 'label' => 'France'],
        ['value' => 'be', 'label' => 'Belgique'],
        ['value' => 'ca', 'label' => 'Canada'],
        ['value' => 'ch', 'label' => 'Suisse'],
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
                height="280px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="multi-select">
        <x-slot:preview>
            <div class="space-y-4">
                <div>
                    <p class="mb-2 text-sm font-semibold">Recherche locale avec limite</p>
                    <x-daisy::ui.inputs.multi-select
                        name="stack"
                        color="primary"
                        :maxItems="3"
                        placeholder="Ajouter une technologie"
                        :values="['laravel']"
                        :options="[
                            ['value' => 'laravel', 'label' => 'Laravel'],
                            ['value' => 'livewire', 'label' => 'Livewire'],
                            ['value' => 'alpine', 'label' => 'Alpine.js'],
                            ['value' => 'tailwind', 'label' => 'Tailwind CSS'],
                            ['value' => 'pest', 'label' => 'Pest'],
                        ]"
                    />
                </div>

                <div>
                    <p class="mb-2 text-sm font-semibold">Recherche distante</p>
                    <x-daisy::ui.inputs.multi-select
                        name="contacts"
                        endpoint="{{ route('demo.select.options') }}"
                        param="q"
                        :debounce="150"
                        :minChars="1"
                        :default="[
                            ['value' => 'c_john', 'label' => 'John Carter', 'subtitle' => 'john.carter@example.com', 'avatar' => '/img/people/people-1.jpg'],
                            ['value' => 'c_jane', 'label' => 'Jane Doe', 'subtitle' => 'jane.doe@example.com', 'avatar' => '/img/people/people-2.jpg'],
                            ['value' => 'alpha', 'label' => 'Alpha'],
                            ['value' => 'beta', 'label' => 'Beta'],
                        ]"
                        placeholder="Rechercher un contact ou un mot"
                    />
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
<x-daisy::ui.inputs.multi-select
    name="stack"
    color="primary"
    :maxItems="3"
    :values="['laravel']"
    :options="$technologies"
    placeholder="Ajouter une technologie"
/>

<x-daisy::ui.inputs.multi-select
    name="contacts"
    endpoint="{{ route('demo.select.options') }}"
    param="q"
    :debounce="150"
    :minChars="1"
    :default="$defaultContacts"
    placeholder="Rechercher un contact ou un mot"
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
                height="360px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
