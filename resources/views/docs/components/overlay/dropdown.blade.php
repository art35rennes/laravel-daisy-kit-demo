@php
    $category = 'overlay';
    $name = 'dropdown';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
@endphp

<x-daisy::docs.page
    title="Menu déroulant"
    category="overlay"
    name="dropdown"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Menu déroulant"
            subtitle="Menu ancré sur un déclencheur. Le slot alimente le contenu du menu : passer des éléments li (le composant enveloppe déjà le ul avec les classes daisyUI)."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="dropdown">
        <x-slot:preview>
            <x-daisy::ui.overlay.dropdown label="Menu">
                <li><a>Profil</a></li>
                <li><a>Paramètres</a></li>
                <li><a>Déconnexion</a></li>
            </x-daisy::ui.overlay.dropdown>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'BLADE'
<x-daisy::ui.overlay.dropdown label="Menu">
    <li><a>Profil</a></li>
    <li><a>Paramètres</a></li>
    <li><a>Déconnexion</a></li>
</x-daisy::ui.overlay.dropdown>
BLADE;
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
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="dropdown">
        <x-slot:preview>
            <div class="flex flex-wrap gap-8">
                <div>
                    <p class="text-sm font-semibold mb-2">Ouverture au survol</p>
                    <x-daisy::ui.overlay.dropdown label="Hover" :hover="true">
                        <li><a>Action</a></li>
                        <li><a>Autre</a></li>
                    </x-daisy::ui.overlay.dropdown>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">
                        <code class="kbd kbd-sm">forceClose</code> + survol (classe <code class="kbd kbd-sm">dropdown-close</code>, daisyUI 5.5+)
                    </p>
                    <x-daisy::ui.overlay.dropdown label="Fermé jusqu’au survol" :hover="true" :forceClose="true">
                        <li><a>Option A</a></li>
                        <li><a>Option B</a></li>
                    </x-daisy::ui.overlay.dropdown>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'BLADE'
{{-- Hover : dropdown-hover sur le conteneur. --}}
<x-daisy::ui.overlay.dropdown label="Hover" :hover="true">
    <li><a>Action</a></li>
</x-daisy::ui.overlay.dropdown>

{{-- Fermeture forcée jusqu’à interaction : dropdown-close (souvent combiné au hover). --}}
<x-daisy::ui.overlay.dropdown label="Menu" :hover="true" :forceClose="true">
    <li><a>Option</a></li>
</x-daisy::ui.overlay.dropdown>
BLADE;
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

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
