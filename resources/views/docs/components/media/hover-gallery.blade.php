@php
    $category = 'media';
    $name = 'hover-gallery';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
@endphp

<x-daisy::docs.page
    title="Hover gallery"
    category="media"
    name="hover-gallery"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Hover gallery"
            subtitle="Galerie au survol horizontal : idéale pour e-commerce (vues produit, coloris) sans carrousel complet. Requiert daisyUI 5.1+."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="hover-gallery">
        <x-slot:preview>
            <x-daisy::ui.media.hover-gallery
                class="max-w-60"
                :images="[
                    ['src' => 'https://picsum.photos/400/300?random=41', 'alt' => '1'],
                    ['src' => 'https://picsum.photos/400/300?random=42', 'alt' => '2'],
                    ['src' => 'https://picsum.photos/400/300?random=43', 'alt' => '3'],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'BLADE'
<x-daisy::ui.media.hover-gallery
    class="max-w-60"
    :images="[
        ['src' => 'https://picsum.photos/400/300?random=41', 'alt' => '1'],
        ['src' => 'https://picsum.photos/400/300?random=42', 'alt' => '2'],
        ['src' => 'https://picsum.photos/400/300?random=43', 'alt' => '3'],
    ]"
/>
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
                height="220px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="hover-gallery">
        <x-slot:preview>
            <div class="space-y-8">
                <div>
                    <p class="text-sm font-semibold mb-2">Slot — images dans le markup (carte produit)</p>
                    <div class="card card-sm bg-base-100 card-border max-w-60 shadow">
                        <x-daisy::ui.media.hover-gallery :maxWidth="''" class="w-full max-w-none">
                            <img src="https://picsum.photos/400/300?random=61" alt="A" class="w-full" loading="lazy" />
                            <img src="https://picsum.photos/400/300?random=62" alt="B" class="w-full" loading="lazy" />
                            <img src="https://picsum.photos/400/300?random=63" alt="C" class="w-full" loading="lazy" />
                        </x-daisy::ui.media.hover-gallery>
                        <div class="card-body gap-1">
                            <h3 class="card-title text-base justify-between">
                                Article
                                <span class="font-normal">49&nbsp;€</span>
                            </h3>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">Largeur max explicite (<code class="kbd kbd-sm">maxWidth</code>)</p>
                    <x-daisy::ui.media.hover-gallery
                        maxWidth="max-w-72"
                        :images="[
                            ['src' => 'https://picsum.photos/400/300?random=71', 'alt' => ''],
                            ['src' => 'https://picsum.photos/400/300?random=72', 'alt' => ''],
                        ]"
                    />
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'BLADE'
{{-- Slot + carte : chaîne vide sur maxWidth pour retirer max-w-60 par défaut. --}}
<x-daisy::ui.media.hover-gallery :maxWidth="''" class="w-full max-w-none">
    <img src="..." alt="" />
</x-daisy::ui.media.hover-gallery>

{{-- Prop maxWidth : classes utilitaires (défaut package : max-w-60). --}}
<x-daisy::ui.media.hover-gallery maxWidth="max-w-72" :images="[['src' => '...', 'alt' => '']]" />
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
                height="280px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
