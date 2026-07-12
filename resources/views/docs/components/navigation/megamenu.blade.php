@php
    $category = 'navigation';
    $name = 'megamenu';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];

    $baseCode = <<<'CODE'
<x-daisy::ui.navigation.megamenu mode="wide" size="md" class="rounded-box border border-base-300 bg-base-100 p-2">
    <button popovertarget="products-menu">Produits</button>
    <div id="products-menu" popover>
        <ul class="menu menu-horizontal">
            <li><a href="#dashboard">Tableau de bord</a></li>
            <li><a href="#automation">Automatisations</a></li>
        </ul>
    </div>
    <button popovertarget="solutions-menu">Solutions</button>
    <div id="solutions-menu" popover>
        <ul class="menu menu-horizontal">
            <li><a href="#product">Équipe produit</a></li>
            <li><a href="#support">Équipe support</a></li>
        </ul>
    </div>
</x-daisy::ui.navigation.megamenu>
CODE;
@endphp

<x-daisy::docs.page title="Megamenu" :category="$category" :name="$name" type="component" :sections="$sections">
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Megamenu"
            subtitle="Navigation de bureau avec des panneaux Popover associés à chaque entrée."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="megamenu">
        <x-slot:preview>
            <x-daisy::ui.navigation.megamenu mode="wide" size="md" class="rounded-box border border-base-300 bg-base-100 p-2 shadow-sm">
                <button popovertarget="docs-megamenu-products">Produits</button>
                <div id="docs-megamenu-products" popover>
                    <x-daisy::ui.navigation.menu :vertical="false">
                        <li><a>Tableau de bord</a></li>
                        <li><a>Automatisations</a></li>
                    </x-daisy::ui.navigation.menu>
                </div>
                <button popovertarget="docs-megamenu-solutions">Solutions</button>
                <div id="docs-megamenu-solutions" popover>
                    <x-daisy::ui.navigation.menu :vertical="false">
                        <li><a>Équipe produit</a></li>
                        <li><a>Équipe support</a></li>
                    </x-daisy::ui.navigation.menu>
                </div>
            </x-daisy::ui.navigation.megamenu>
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor language="blade" :value="$baseCode" :readonly="true" :showToolbar="false" :showFoldAll="false" :showUnfoldAll="false" :showFormat="false" :showCopy="true" height="220px" />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="megamenu">
        <x-slot:preview>
            <div class="rounded-box border border-base-300 bg-base-100 p-4 text-sm text-base-content/70">
                Pour mobile, placez un Megamenu <code>mode="vertical"</code> dans un élément <code>popover</code>,
                déclenché par un bouton visible uniquement sur petit écran.
            </div>
        </x-slot:preview>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
