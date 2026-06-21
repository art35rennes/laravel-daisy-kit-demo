@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getNavigationItems($prefix);
    $componentsByCategory = DocsHelper::getComponentsByCategory($prefix);
    $templatesByCategory = DocsHelper::getTemplatesByCategory();
    $componentCount = collect($componentsByCategory)->sum(fn (array $category) => count($category['components'] ?? []));
    $templateCount = collect($templatesByCategory)->sum(fn (array $category) => count($category['templates'] ?? []));
    $documentedComponentCount = collect($componentsByCategory)
        ->flatMap(fn (array $category, string $categoryId) => collect($category['components'] ?? [])
            ->map(fn (array $component) => [
                'category' => $categoryId,
                'name' => $component['name'] ?? '',
            ]))
        ->filter(fn (array $component) => $component['name'] !== '' && view()->exists("daisy-dev::docs.components.{$component['category']}.{$component['name']}"))
        ->count();
    $componentDocumentationStatuses = collect($componentsByCategory)
        ->flatMap(fn (array $category, string $categoryId) => collect($category['components'] ?? [])
            ->map(function (array $component) use ($categoryId): array {
                $name = (string) ($component['name'] ?? '');
                $view = (string) ($component['view'] ?? '');
                $jsModule = $component['jsModule'] ?? null;
                $path = resource_path("views/docs/components/{$categoryId}/{$name}.blade.php");
                $href = $component['href'] ?? "/docs/{$categoryId}/{$name}";

                if ($name === '' || ! file_exists($path)) {
                    return [
                        'name' => $name,
                        'href' => $href,
                        'status' => 'non-documenté',
                    ];
                }

                $contents = file_get_contents($path);
                $alias = 'x-daisy::'.str_replace('daisy::components.', '', $view);
                $hasExample = str_contains($contents, 'docs.sections.example')
                    || str_contains($contents, '<x-slot:preview>');
                $isComplete = str_contains($contents, 'docs.sections.intro')
                    && $hasExample
                    && str_contains($contents, 'docs.sections.api')
                    && ($view === '' || str_contains($contents, $alias))
                    && (! $jsModule || str_contains($contents, $jsModule));

                return [
                    'name' => "{$categoryId}/{$name}",
                    'href' => $href,
                    'status' => $isComplete ? 'documenté' : 'partiel',
                ];
            }))
        ->values();
    $documentedComponents = $componentDocumentationStatuses->where('status', 'documenté');
    $partialComponents = $componentDocumentationStatuses->where('status', 'partiel');
    $missingComponents = $componentDocumentationStatuses->where('status', 'non-documenté');
    $documentedTemplateCount = collect($templatesByCategory)
        ->flatMap(fn (array $category, string $categoryId) => collect($category['templates'] ?? [])
            ->map(fn (array $template) => [
                'category' => $categoryId,
                'name' => $template['name'] ?? '',
            ]))
        ->filter(fn (array $template) => $template['name'] !== '' && view()->exists("daisy-dev::docs.templates.{$template['category']}.{$template['name']}"))
        ->count();
    $coverageStatus = $documentedComponentCount === $componentCount && $documentedTemplateCount === $templateCount
        ? 'Couverture complète'
        : 'Couverture partielle';
    $quickStarts = [
        [
            'title' => 'Installer et explorer',
            'description' => 'Commencez par le catalogue complet, puis ouvrez une fiche composant pour copier l’usage Blade exact.',
            'href' => "/{$prefix}/components",
            'label' => 'Catalogue composants',
        ],
        [
            'title' => 'Assembler une interface',
            'description' => 'Comparez layouts, formulaires, tableaux, overlays et charts dans des contextes applicatifs.',
            'href' => route('demo'),
            'label' => 'Démo UI',
        ],
        [
            'title' => 'Copier une page complète',
            'description' => 'Partez des templates auth, profile, forms, communication, layout ou documentation.',
            'href' => "/{$prefix}/templates",
            'label' => 'Index templates',
        ],
    ];
    $recommendedPaths = [
        ['title' => 'Inputs', 'href' => "/{$prefix}/inputs/button", 'label' => 'Button'],
        ['title' => 'Data Display', 'href' => "/{$prefix}/data-display/table", 'label' => 'Table server-side'],
        ['title' => 'Forms', 'href' => "/{$prefix}/forms/builder", 'label' => 'Form builder'],
        ['title' => 'Overlays', 'href' => "/{$prefix}/overlay/modal", 'label' => 'Modal'],
        ['title' => 'Charts', 'href' => "/{$prefix}/charts/line", 'label' => 'Line chart'],
        ['title' => 'Templates', 'href' => "/{$prefix}/templates/auth/login-simple", 'label' => 'Login simple'],
    ];
    $assetBuildDirectory = trim((string) config('daisy-kit.vite_build_directory'), '/');
    $assetManifestPath = public_path("{$assetBuildDirectory}/manifest.json");
    $assetManifest = file_exists($assetManifestPath)
        ? json_decode((string) file_get_contents($assetManifestPath), true)
        : [];
    $assetReferences = collect($assetManifest)
        ->flatMap(function (mixed $entry) use ($assetBuildDirectory): array {
            if (! is_array($entry)) {
                return [];
            }

            $references = array_filter([$entry['file'] ?? null]);

            foreach (($entry['css'] ?? []) as $cssPath) {
                $references[] = $cssPath;
            }

            return collect($references)
                ->map(fn (string $path): string => "{$assetBuildDirectory}/{$path}")
                ->all();
        })
        ->values();
    $missingAssetReferences = $assetReferences
        ->reject(fn (string $path): bool => file_exists(public_path($path)))
        ->values();
    $auditFindings = [
        [
            'impact' => 'Critique',
            'title' => 'Pages docs non couvertes',
            'status' => "{$documentedComponentCount}/{$componentCount} composants et {$documentedTemplateCount}/{$templateCount} templates rendus par les tests.",
        ],
        [
            'impact' => 'Élevé',
            'title' => 'Contrat public implicite',
            'status' => 'Les index exposent maintenant alias publics, statuts, modules JS, previews et vues package.',
        ],
        [
            'impact' => 'Moyen',
            'title' => 'Démos interactives faillibles',
            'status' => 'Les routes de démo critiques et endpoints JSON sont couverts par Pest.',
        ],
        [
            'impact' => 'Moyen',
            'title' => 'Assets package publiés',
            'status' => "{$assetReferences->count()} références Vite vérifiées; {$missingAssetReferences->count()} fichier manquant.",
        ],
    ];
    $targetStructure = [
        'Getting Started' => "/{$prefix}",
        'Layouts' => "/{$prefix}/layout/grid-layout",
        'UI Components' => "/{$prefix}/components",
        'Forms' => "/{$prefix}/forms/builder",
        'Feedback' => "/{$prefix}/feedback/alert",
        'Navigation' => "/{$prefix}/navigation/menu",
        'Overlays' => "/{$prefix}/overlay/modal",
        'Data Display' => "/{$prefix}/data-display/table",
        'Charts' => "/{$prefix}/charts/line",
        'Templates' => "/{$prefix}/templates",
        'Auth' => "/{$prefix}/templates/auth/login-simple",
        'CRUD' => "/{$prefix}/layout/crud-layout",
        'Advanced Usage' => "/{$prefix}/advanced/blueprint",
    ];
    $nextSteps = [
        'Surveiller les composants interactifs avec tests navigateur lorsque le comportement dépasse le rendu HTTP.',
        'Extraire les exemples les plus copiés vers le package si leur usage devient récurrent.',
        'Documenter tout bug confirmé côté package Daisy Kit à la source, sans contournement dans cette démo.',
    ];
    $sections = [
        ['id' => 'overview', 'label' => 'Vue d’ensemble'],
        ['id' => 'getting-started', 'label' => 'Getting Started'],
        ['id' => 'coverage', 'label' => 'Couverture'],
        ['id' => 'audit', 'label' => 'Audit'],
        ['id' => 'quick-start', 'label' => 'Parcours'],
        ['id' => 'recommended', 'label' => 'Chemins recommandés'],
        ['id' => 'categories', 'label' => 'Catégories'],
    ];
@endphp

<x-daisy::layout.docs title="Documentation" :sidebarItems="$navItems" :sections="$sections" :currentRoute="request()->path()">
    <x-slot:navbar>
        <x-daisy::ui.navigation.menu :vertical="false" :bg="false" :rounded="false" size="sm">
            <li><a href="/{{ $prefix }}" class="menu-active">Docs</a></li>
            <li><a href="{{ route('demo') }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates">Templates</a></li>
        </x-daisy::ui.navigation.menu>
    </x-slot:navbar>

    <section id="overview">
        <div class="flex flex-col gap-6">
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <h1>Documentation Laravel Daisy Kit</h1>
                    <span class="badge badge-success badge-outline">{{ $coverageStatus }}</span>
                </div>
                <p class="max-w-3xl">
                    Portail de référence pour comprendre ce que le package expose, ouvrir une démo réaliste, copier un exemple Blade maintenu et vérifier la couverture documentaire du contrat public.
                </p>
            </div>

            <div class="grid gap-4 sm:grid-cols-3">
                <x-daisy::ui.data-display.stat
                    title="Composants publics"
                    :value="$componentCount"
                    desc="Fiches reliées au manifeste"
                />
                <x-daisy::ui.data-display.stat
                    title="Templates publics"
                    :value="$templateCount"
                    desc="Pages prêtes à comparer"
                />
                <x-daisy::ui.data-display.stat
                    title="Catégories"
                    :value="count($componentsByCategory)"
                    desc="Navigation par familles"
                />
            </div>

            <div class="alert alert-info">
                <span>Les routes de documentation sont activées par <code>daisy-kit.docs</code>. Les listes ci-dessous sont générées depuis les manifestes d’inventaire, pas maintenues à la main.</span>
            </div>
        </div>
    </section>

    <section id="getting-started" class="mt-12">
        <h2>Getting Started</h2>
        <div class="mt-4 grid gap-4 lg:grid-cols-3">
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Installer</h3>
                <div class="mockup-code mt-3 text-xs">
                    <pre data-prefix="$"><code>composer require art35rennes/laravel-daisy-kit</code></pre>
                    <pre data-prefix="$"><code>php artisan vendor:publish --tag=daisy-config</code></pre>
                    <pre data-prefix="$"><code>php artisan vendor:publish --tag=daisy-assets</code></pre>
                </div>
            </div>

            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Composer</h3>
                <div class="mockup-code mt-3 text-xs">
                    <pre data-prefix="1"><code>&lt;x-daisy::layout.app title=&quot;Dashboard&quot;&gt;</code></pre>
                    <pre data-prefix="2"><code>    &lt;x-daisy::ui.feedback.alert color=&quot;success&quot; dismissible /&gt;</code></pre>
                    <pre data-prefix="3"><code>&lt;/x-daisy::layout.app&gt;</code></pre>
                </div>
            </div>

            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Vérifier</h3>
                <div class="mt-3 flex flex-col gap-2 text-sm text-base-content/70">
                    <span>Publier les assets après chaque mise à jour du package.</span>
                    <span>Utiliser <code>x-daisy::ui.*</code>, <code>x-daisy::layout.*</code>, <code>x-daisy::charts.*</code> et <code>x-daisy::templates.*</code> avant d’écrire du markup hôte.</span>
                    <span>Si le builder Form Kit est rendu, fournir Livewire 3 dans l’application hôte.</span>
                </div>
            </div>
        </div>
    </section>

    <section id="coverage" class="mt-12">
        <h2>Couverture documentaire</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-2">
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-base font-semibold">Composants documentés</h3>
                        <p class="text-sm text-base-content/70">Chaque alias public du manifeste doit avoir une page rendue.</p>
                    </div>
                    <span class="badge badge-primary">{{ $documentedComponentCount }}/{{ $componentCount }}</span>
                </div>
                <progress class="progress progress-primary mt-4 w-full" value="{{ $documentedComponentCount }}" max="{{ max($componentCount, 1) }}"></progress>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-base font-semibold">Templates documentés</h3>
                        <p class="text-sm text-base-content/70">Les previews et fiches templates restent synchronisées avec l’inventaire.</p>
                    </div>
                    <span class="badge badge-primary">{{ $documentedTemplateCount }}/{{ $templateCount }}</span>
                </div>
                <progress class="progress progress-primary mt-4 w-full" value="{{ $documentedTemplateCount }}" max="{{ max($templateCount, 1) }}"></progress>
            </div>
        </div>

        <div class="mt-4 grid gap-4 md:grid-cols-3">
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Documentés</h3>
                <p class="mt-2 text-3xl font-semibold">{{ $documentedComponents->count() }}</p>
                <p class="mt-1 text-sm text-base-content/70">Fiches complètes selon les critères docs.</p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Partiellement documentés</h3>
                <p class="mt-2 text-3xl font-semibold">{{ $partialComponents->count() }}</p>
                <p class="mt-1 text-sm text-base-content/70">
                    @if($partialComponents->isEmpty())
                        Aucun composant partiel.
                    @else
                        {{ $partialComponents->take(5)->pluck('name')->join(', ') }}
                    @endif
                </p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Non documentés</h3>
                <p class="mt-2 text-3xl font-semibold">{{ $missingComponents->count() }}</p>
                <p class="mt-1 text-sm text-base-content/70">
                    @if($missingComponents->isEmpty())
                        Aucun composant manquant.
                    @else
                        {{ $missingComponents->take(5)->pluck('name')->join(', ') }}
                    @endif
                </p>
            </div>
        </div>
    </section>

    <section id="audit" class="mt-12">
        <h2>Audit et trajectoire</h2>
        <div class="mt-4 grid gap-4 lg:grid-cols-[minmax(0,1fr)_minmax(18rem,24rem)]">
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Problèmes traités par impact</h3>
                <div class="mt-4 flex flex-col gap-3">
                    @foreach($auditFindings as $finding)
                        <div class="rounded-box border border-base-300 p-3">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="badge badge-outline badge-sm">{{ $finding['impact'] }}</span>
                                <span class="font-medium">{{ $finding['title'] }}</span>
                            </div>
                            <p class="mt-2 text-sm text-base-content/70">{{ $finding['status'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h3 class="text-base font-semibold">Structure cible</h3>
                <div class="mt-4 flex flex-col gap-2">
                    @foreach($targetStructure as $label => $href)
                        <a href="{{ $href }}" class="rounded-box border border-base-300 px-3 py-2 text-sm transition hover:border-primary hover:bg-base-200">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="mt-4 rounded-box border border-base-300 bg-base-100 p-5">
            <h3 class="text-base font-semibold">Recommandations finales</h3>
            <ul class="mt-3 flex flex-col gap-2 text-sm text-base-content/70">
                @foreach($nextSteps as $step)
                    <li>{{ $step }}</li>
                @endforeach
            </ul>
        </div>
    </section>

    <section id="quick-start" class="mt-12">
        <h2>Parcours rapides</h2>
        <div class="mt-4 grid gap-4 md:grid-cols-3">
            @foreach($quickStarts as $item)
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h3 class="card-title text-base">{{ $item['title'] }}</h3>
                        <p class="text-sm text-base-content/70">{{ $item['description'] }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ $item['href'] }}" class="btn btn-primary btn-sm">{{ $item['label'] }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="recommended" class="mt-12">
        <h2>Chemins recommandés</h2>
        <div class="mt-4 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($recommendedPaths as $path)
                <a href="{{ $path['href'] }}" class="rounded-box border border-base-300 bg-base-100 p-4 transition hover:border-primary hover:bg-base-200">
                    <span class="text-xs font-semibold uppercase text-base-content/50">{{ $path['title'] }}</span>
                    <span class="mt-1 block font-medium">{{ $path['label'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <section id="categories" class="mt-12">
        <h2>Catégories</h2>
        <div class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($componentsByCategory as $categoryId => $category)
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <div class="flex items-center justify-between gap-2 mb-2">
                            <h3 class="card-title text-base">{{ $category['label'] ?? $categoryId }}</h3>
                            <span class="badge badge-outline badge-sm">{{ count($category['components'] ?? []) }}</span>
                        </div>
                        @if(!empty($category['components'] ?? []))
                            <ul class="list mt-2">
                                @foreach(($category['components'] ?? []) as $component)
                                    <li class="list-row">
                                        <a class="link" href="{{ $component['href'] ?? '#' }}">{{ $component['name'] ?? '' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-base-content/60">Aucun composant</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-daisy::layout.docs>
