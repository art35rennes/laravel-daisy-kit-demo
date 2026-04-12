@php
    $category = 'utilities';
    $name = 'fab';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
@endphp

<x-daisy::docs.page
    title="FAB / Speed dial"
    category="utilities"
    name="fab"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="FAB / Speed dial"
            subtitle="Bouton d’action flottant avec actions secondaires. Le premier élément focusable du groupe doit être un élément avec tabindex (recommandation daisyUI / Safari). Requiert daisyUI 5.1+."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="fab">
        <x-slot:preview>
            <div class="relative h-48 w-full overflow-hidden rounded-box border border-base-300 bg-base-100">
                <p class="absolute left-3 top-3 text-xs text-base-content/60">Zone démo</p>
                <x-daisy::ui.utilities.fab class="absolute bottom-3 right-3">
                    <x-slot:trigger>
                        <div tabindex="0" role="button" class="btn btn-lg btn-circle btn-primary" aria-label="Ouvrir">+</div>
                    </x-slot:trigger>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="A">A</button>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="B">B</button>
                </x-daisy::ui.utilities.fab>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'BLADE'
<x-daisy::ui.utilities.fab class="fixed bottom-4 right-4">
    <x-slot:trigger>
        <div tabindex="0" role="button" class="btn btn-lg btn-circle btn-primary" aria-label="Ouvrir">+</div>
    </x-slot:trigger>
    <button type="button" class="btn btn-lg btn-circle">A</button>
    <button type="button" class="btn btn-lg btn-circle">B</button>
</x-daisy::ui.utilities.fab>
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
                height="260px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="fab">
        <x-slot:preview>
            <div class="space-y-6">
                <div>
                    <p class="text-sm font-semibold mb-2">Disposition en arc (<code class="kbd kbd-sm">flower</code>)</p>
                    <div class="relative h-56 w-full overflow-hidden rounded-box border border-base-300 bg-base-100">
                        <x-daisy::ui.utilities.fab flower class="absolute bottom-3 right-3">
                            <x-slot:trigger>
                                <div tabindex="0" role="button" class="btn btn-lg btn-circle btn-secondary" aria-label="Menu">◎</div>
                            </x-slot:trigger>
                            <button type="button" class="btn btn-lg btn-circle">1</button>
                            <button type="button" class="btn btn-lg btn-circle">2</button>
                            <button type="button" class="btn btn-lg btn-circle">3</button>
                        </x-daisy::ui.utilities.fab>
                    </div>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'BLADE'
<x-daisy::ui.utilities.fab flower class="fixed bottom-4 right-4">
    <x-slot:trigger>
        <div tabindex="0" role="button" class="btn btn-lg btn-circle btn-primary">+</div>
    </x-slot:trigger>
    <button type="button" class="btn btn-lg btn-circle">1</button>
    <button type="button" class="btn btn-lg btn-circle">2</button>
</x-daisy::ui.utilities.fab>
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
                height="240px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
