@php
    $category = 'advanced';
    $name = 'hover-3d';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
@endphp

<x-daisy::docs.page
    title="Hover 3D"
    category="advanced"
    name="hover-3d"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Hover 3D"
            subtitle="Conteneur avec couches de profondeur et perspective au survol (cartes produit, visuels marketing). Requiert daisyUI 5.5+."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="hover-3d">
        <x-slot:preview>
            <x-daisy::ui.advanced.hover-3d class="max-w-xs">
                <figure class="rounded-box overflow-hidden shadow">
                    <img src="https://picsum.photos/400/260?random=50" alt="Demo" class="w-full" loading="lazy" />
                </figure>
            </x-daisy::ui.advanced.hover-3d>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'BLADE'
<x-daisy::ui.advanced.hover-3d class="max-w-xs">
    <figure class="rounded-box overflow-hidden shadow">
        <img src="https://picsum.photos/400/260" alt="Demo" class="w-full" loading="lazy" />
    </figure>
</x-daisy::ui.advanced.hover-3d>
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

    <x-daisy::docs.sections.variants name="hover-3d">
        <x-slot:preview>
            <div class="space-y-6">
                <div>
                    <p class="text-sm font-semibold mb-2">Conteneur cliquable (<code class="kbd kbd-sm">as</code>)</p>
                    <x-daisy::ui.advanced.hover-3d as="a" href="#" class="max-w-sm block">
                        <div class="card card-border bg-base-100 shadow overflow-hidden rounded-box">
                            <figure class="aspect-[4/3] overflow-hidden">
                                <img src="https://picsum.photos/600/450?random=88" alt="" class="h-full w-full object-cover" loading="lazy" />
                            </figure>
                            <div class="card-body">
                                <span class="card-title text-base">Carte lien</span>
                            </div>
                        </div>
                    </x-daisy::ui.advanced.hover-3d>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'BLADE'
<x-daisy::ui.advanced.hover-3d as="a" href="#" class="max-w-sm block">
    <div class="card card-border bg-base-100 shadow overflow-hidden rounded-box">
        <figure class="aspect-[4/3] overflow-hidden">
            <img src="..." alt="" class="h-full w-full object-cover" />
        </figure>
        <div class="card-body">
            <span class="card-title text-base">Titre</span>
        </div>
    </div>
</x-daisy::ui.advanced.hover-3d>
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
