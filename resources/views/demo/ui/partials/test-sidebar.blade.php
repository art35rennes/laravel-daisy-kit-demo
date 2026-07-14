@php
    $sidebarSections = [
        [
            'label' => 'Espace de travail',
            'items' => [
                ['label' => 'Vue d’ensemble', 'href' => '#overview', 'icon' => 'grid', 'active' => true],
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

<section class="space-y-4 rounded-box bg-base-200 p-6">
    <h2 class="text-lg font-medium">Sidebar repliable et recherchable</h2>
    <p class="text-sm text-base-content/70">La largeur, la recherche et les sous-menus restent gérés par le composant et son module.</p>

    <div class="h-80 overflow-hidden rounded-box border border-base-300 bg-base-100">
        <x-daisy::ui.navigation.sidebar
            brand="Studio"
            :sections="$sidebarSections"
            :searchable="true"
            storageKey="demo-sidebar-state"
            collapseAt="sm"
            class="h-full"
        />
    </div>
</section>
