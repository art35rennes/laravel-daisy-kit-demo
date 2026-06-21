@props([
    'title',
    'category' => null,
    'name' => null,
    'type' => 'component',
    'sections' => [],
])

@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $componentMeta = null;
    $componentAlias = null;
    $categoryUseCases = [
        'advanced' => 'Surfaces interactives riches, builders, éditeurs et composants à comportement avancé.',
        'charts' => 'Visualisations synthétiques à intégrer dans dashboards, rapports et vues analytiques.',
        'communication' => 'Flux conversationnels, notifications et interfaces temps réel simulées côté démo.',
        'data-display' => 'Listes, tableaux, prévisualisations et états de lecture de données métier.',
        'errors' => 'États d’erreur applicatifs et retours utilisateur cohérents.',
        'feedback' => 'Messages de statut, alertes, chargement, progression et confirmations.',
        'forms' => 'Composition de formulaires, rendu de schémas et collecte de saisies.',
        'inputs' => 'Contrôles de saisie atomiques à composer dans des formulaires Laravel.',
        'layout' => 'Structure de page, grilles, sections et écrans applicatifs.',
        'media' => 'Affichage de médias, fichiers, cartes et contenus riches.',
        'navigation' => 'Menus, sidebars, fil d’Ariane, onglets et repères de navigation.',
        'overlay' => 'Modales, drawers, popovers et interactions de surface temporaire.',
        'utilities' => 'Aides d’affichage transverses à composer dans d’autres composants.',
    ];

    if ($type === 'component' && $category && $name) {
        $navItems = DocsHelper::getNavigationItems($prefix);
        $props = DocsHelper::getComponentProps($category, $name);
        $componentMeta = collect(DocsHelper::getComponentsByCategory($prefix)[$category]['components'] ?? [])
            ->firstWhere('name', $name);
        $componentAlias = ! empty($componentMeta['view'] ?? null)
            ? 'x-daisy::'.str_replace('daisy::components.', '', $componentMeta['view'])
            : null;

        if (! collect($sections)->contains(fn (array $section): bool => ($section['id'] ?? null) === 'usage-contract')) {
            $sections[] = ['id' => 'usage-contract', 'label' => 'Contrat'];
        }
    } elseif ($type === 'template') {
        $navItems = DocsHelper::getTemplateNavigationItems($prefix);
    } else {
        $navItems = DocsHelper::getNavigationItems($prefix);
    }
@endphp

<x-daisy::layout.docs :title="$title" :sidebarItems="$navItems" :sections="$sections" :currentRoute="request()->path()">
    <x-slot:navbar>
        @php
            $currentPath = request()->path();
            $isDocs = str_starts_with($currentPath, $prefix) && ! str_contains($currentPath, 'templates');
            $isTemplates = str_contains($currentPath, 'templates');
            $isDemo = str_contains($currentPath, 'demo');
        @endphp
        <x-daisy::ui.navigation.menu :vertical="false" :bg="false" :rounded="false" size="sm">
            <li><a href="/{{ $prefix }}" class="{{ $isDocs && ! $isTemplates ? 'menu-active' : '' }}">Docs</a></li>
            <li><a href="{{ route('demo') }}" class="{{ $isDemo ? 'menu-active' : '' }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates" class="{{ $isTemplates ? 'menu-active' : '' }}">Templates</a></li>
        </x-daisy::ui.navigation.menu>
    </x-slot:navbar>

    {{ $intro ?? '' }}

    @if($type === 'component' && $category && $name && $componentMeta)
        <section id="usage-contract" class="mt-10">
            <h2>Contrat d’usage</h2>
            <div class="mt-4 grid gap-4 lg:grid-cols-3">
                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">Alias public</h3>
                    @if($componentAlias)
                        <code class="mt-2 block text-xs break-words">{{ $componentAlias }}</code>
                    @else
                        <p class="mt-2 text-sm text-base-content/70">Alias non déclaré dans le manifeste.</p>
                    @endif
                    <div class="mt-3 flex flex-wrap gap-2">
                        <span class="badge badge-sm {{ ($componentMeta['status'] ?? null) === 'active' ? 'badge-success' : 'badge-ghost' }}">
                            {{ $componentMeta['status'] ?? 'unknown' }}
                        </span>
                        @foreach(($componentMeta['tags'] ?? []) as $tag)
                            <span class="badge badge-ghost badge-sm">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>

                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">Comportement</h3>
                    @if(!empty($componentMeta['jsModule']))
                        <p class="mt-2 text-sm text-base-content/70">
                            Module JS package : <code class="kbd kbd-xs">{{ $componentMeta['jsModule'] }}</code>.
                        </p>
                    @else
                        <p class="mt-2 text-sm text-base-content/70">Aucun module JS déclaré; le rendu Blade suffit.</p>
                    @endif
                    @if(!empty($componentMeta['dataAttributes']))
                        <p class="mt-3 text-xs text-base-content/60">Attributs data exposés :</p>
                        <div class="mt-1 flex flex-wrap gap-1">
                            @foreach($componentMeta['dataAttributes'] as $attribute)
                                <code class="rounded bg-base-200 px-1 text-xs">data-{{ $attribute }}</code>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">Accessibilité et pièges</h3>
                    <p class="mt-2 text-sm text-base-content/70">
                        Préserver les attributs générés par le composant, fournir des labels explicites pour les contenus interactifs et composer l’alias public avant de copier le markup interne.
                    </p>
                </div>
            </div>

            <div class="mt-4 grid gap-4 lg:grid-cols-4">
                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">Cas d’usage</h3>
                    <p class="mt-2 text-sm text-base-content/70">
                        {{ $categoryUseCases[$category] ?? 'Usage applicatif documenté par la fiche et le manifeste public.' }}
                    </p>
                </div>

                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">États visuels</h3>
                    <p class="mt-2 text-sm text-base-content/70">
                        Vérifier les variantes, l’état vide ou désactivé quand il existe, puis conserver les classes et attributs émis par le composant.
                    </p>
                </div>

                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">Exemples copiables</h3>
                    <p class="mt-2 text-sm text-base-content/70">
                        Les blocs de code doivent utiliser l’alias public et correspondre au rendu affiché dans la preview de la fiche.
                    </p>
                </div>

                <div class="rounded-box border border-base-300 bg-base-100 p-4">
                    <h3 class="text-sm font-semibold">Responsabilités hôte</h3>
                    <p class="mt-2 text-sm text-base-content/70">
                        Garder routes, validation, autorisations et persistance dans l’application; garder la présentation réutilisable dans Daisy Kit.
                    </p>
                </div>
            </div>
        </section>
    @endif

    {{ $content ?? $slot }}
</x-daisy::layout.docs>
