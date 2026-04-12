@php
    $category = 'advanced';
    $name = 'text-rotate';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
@endphp

<x-daisy::docs.page
    title="Text rotate"
    category="advanced"
    name="text-rotate"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Text rotate"
            subtitle="Animation de mots ou courtes phrases dans un bloc (accroches, titres dynamiques). Limiter à quelques segments pour la lisibilité. Requiert daisyUI 5.5+."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="text-rotate">
        <x-slot:preview>
            <p class="text-lg">
                <x-daisy::ui.advanced.text-rotate :words="['Design', 'Build', 'Ship']" />
            </p>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'BLADE'
<x-daisy::ui.advanced.text-rotate :words="['Design', 'Build', 'Ship']" />
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
                height="120px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="text-rotate">
        <x-slot:preview>
            <div class="space-y-6">
                <div>
                    <p class="text-sm font-semibold mb-2">Dans une phrase + couleur</p>
                    <p class="text-xl font-semibold">
                        Nous aidons les équipes à
                        <x-daisy::ui.advanced.text-rotate
                            class="text-primary font-bold"
                            innerClass="justify-items-start"
                            :words="['livrer', 'itérer', 'grandir']"
                        />
                        plus vite.
                    </p>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">Slot (sans prop <code class="kbd kbd-sm">words</code>)</p>
                    <x-daisy::ui.advanced.text-rotate>
                        <span class="justify-items-center">
                            <span>Alpha</span>
                            <span>Beta</span>
                            <span>Gamma</span>
                        </span>
                    </x-daisy::ui.advanced.text-rotate>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'BLADE'
{{-- Phrase : innerClass aligne la grille interne (daisyUI). --}}
<p class="text-xl">
    Build
    <x-daisy::ui.advanced.text-rotate class="text-primary" innerClass="justify-items-start" :words="['fast', 'right', 'well']" />
    .
</p>

{{-- Slot : plusieurs <span> enfants du wrapper interne. --}}
<x-daisy::ui.advanced.text-rotate>
    <span class="justify-items-center">
        <span>Un</span>
        <span>Deux</span>
    </span>
</x-daisy::ui.advanced.text-rotate>
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
                height="320px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
