@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'navigation';
    $name = 'sidebar';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Barre latérale" 
    category="navigation" 
    name="sidebar"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Barre latérale" 
            subtitle="Navigation repliable, persistante et filtrable, avec sous-menus accessibles."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="sidebar">
        <x-slot:preview>
            @php
                $sidebarSections = [
                    [
                        'label' => 'Navigation',
                        'items' => [
                            ['label' => 'Dashboard', 'href' => '#', 'icon' => 'house'],
                            ['label' => 'Utilisateurs', 'href' => '#', 'icon' => 'people'],
                            [
                                'label' => 'Projets',
                                'icon' => 'folder',
                                'children' => [
                                    ['label' => 'Site vitrine', 'href' => '#site'],
                                    ['label' => 'Application mobile', 'href' => '#mobile'],
                                ],
                            ],
                        ],
                    ],
                ];
            @endphp
            <div class="h-64 border border-base-300 rounded-box overflow-hidden">
                <x-daisy::ui.navigation.sidebar :sections="$sidebarSections" brand="Mon App" :searchable="true" storageKey="docs-sidebar" collapseAt="sm" />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.navigation.sidebar :sections="[
    [
        'label' => 'Navigation',
        'items' => [
            ['label' => 'Dashboard', 'href' => '#', 'icon' => 'house'],
            ['label' => 'Utilisateurs', 'href' => '#', 'icon' => 'people'],
            [
                'label' => 'Projets',
                'icon' => 'folder',
                'children' => [
                    ['label' => 'Site vitrine', 'href' => '#site'],
                    ['label' => 'Application mobile', 'href' => '#mobile'],
                ],
            ],
        ],
    ],
]" brand="Mon App" :searchable="true" storage-key="docs-sidebar" collapse-at="sm" />
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
                height="250px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.variants name="sidebar">
        <x-slot:preview>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-semibold mb-2">Variants de largeur</p>
                    @php
                        $sidebarSections = [
                            [
                                'label' => 'Menu',
                                'items' => [
                                    ['label' => 'Item 1', 'href' => '#', 'icon' => 'house'],
                                ],
                            ],
                        ];
                    @endphp
                    <div class="space-y-2">
                        <div class="h-32 border border-base-300 rounded-box overflow-hidden">
                            <x-daisy::ui.navigation.sidebar :sections="$sidebarSections" variant="slim" brand="Slim" />
                        </div>
                        <div class="h-32 border border-base-300 rounded-box overflow-hidden">
                            <x-daisy::ui.navigation.sidebar :sections="$sidebarSections" variant="wide" brand="Wide" />
                        </div>
                    </div>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = <<<'CODE'
<x-daisy::ui.navigation.sidebar :sections="[
    [
        'label' => 'Menu',
        'items' => [
            ['label' => 'Item 1', 'href' => '#', 'icon' => 'house'],
        ],
    ],
]" variant="slim" />

<x-daisy::ui.navigation.sidebar :sections="[
    [
        'label' => 'Menu',
        'items' => [
            ['label' => 'Item 1', 'href' => '#', 'icon' => 'house'],
        ],
    ],
]" variant="wide" />
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
                height="300px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.custom id="responsive" title="Réduction et recherche" class="mt-10">
        <div class="not-prose space-y-3 rounded-box border border-base-300 bg-base-100 p-4 text-sm text-base-content/70">
            <p><code>collapse-at</code> définit le breakpoint où le bouton de réduction apparaît. <code>storage-key</code> mémorise la préférence dans le navigateur.</p>
            <p><code>searchable</code> active la recherche dans les éléments et ouvre les sous-menus contenant un résultat. Les entrées peuvent aussi fournir <code>activeRoute</code> ou <code>activeRoutes</code>.</p>
            <p>Les layouts <code>sidebar-layout</code> et <code>navbar-sidebar-layout</code> transmettent ces options, avec <code>logo</code>, <code>logo-alt</code>, <code>end</code> et <code>fallback-icon</code>.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="behavior" title="Module JS" class="mt-10">
        <div class="rounded-box border border-base-300 bg-base-100 p-4">
            <p class="text-sm text-base-content/70">
                Le module <code class="kbd kbd-xs">sidebar</code> gère la réduction, la persistance, la recherche et les sous-menus. Conserver le rendu du composant préserve les attributs <code class="kbd kbd-xs">data-sidebar-*</code> requis.
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
