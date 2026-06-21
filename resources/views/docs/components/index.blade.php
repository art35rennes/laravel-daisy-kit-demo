@php
    use App\Helpers\DocsHelper;
    use Illuminate\Support\Str;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getNavigationItems($prefix);
    $componentsByCategory = DocsHelper::getComponentsByCategory($prefix);
    $components = collect($componentsByCategory)
        ->flatMap(fn (array $category) => $category['components'] ?? []);
    $componentCount = $components->count();
    $statusCounts = $components
        ->countBy(fn (array $component) => $component['status'] ?? 'unknown')
        ->sortKeys();
    $jsModuleCount = $components
        ->filter(fn (array $component) => ! empty($component['jsModule']))
        ->count();
    $searchQuery = trim((string) request('q', ''));
    $normalizedSearchQuery = Str::of($searchQuery)->lower()->toString();
    $filteredComponentsByCategory = collect($componentsByCategory)
        ->map(function (array $category, string $categoryId) use ($normalizedSearchQuery): array {
            $category['components'] = collect($category['components'] ?? [])
                ->filter(function (array $component) use ($category, $categoryId, $normalizedSearchQuery): bool {
                    if ($normalizedSearchQuery === '') {
                        return true;
                    }

                    $haystack = collect([
                        $categoryId,
                        $category['label'] ?? '',
                        $component['name'] ?? '',
                        $component['view'] ?? '',
                        $component['status'] ?? '',
                        $component['jsModule'] ?? '',
                        ...($component['tags'] ?? []),
                    ])->implode(' ');

                    return str_contains(Str::of($haystack)->lower()->toString(), $normalizedSearchQuery);
                })
                ->values()
                ->all();

            return $category;
        })
        ->filter(fn (array $category): bool => $searchQuery === '' || ! empty($category['components'] ?? []))
        ->all();
    $visibleComponentCount = collect($filteredComponentsByCategory)
        ->sum(fn (array $category) => count($category['components'] ?? []));
    $recommendedEntries = [
        [
            'title' => 'Tableaux server-side',
            'alias' => 'x-daisy::ui.data-display.table',
            'href' => "/{$prefix}/data-display/table",
        ],
        [
            'title' => 'Form builder',
            'alias' => 'x-daisy::forms.builder',
            'href' => "/{$prefix}/forms/builder",
        ],
        [
            'title' => 'Modales',
            'alias' => 'x-daisy::ui.overlay.modal',
            'href' => "/{$prefix}/overlay/modal",
        ],
        [
            'title' => 'Charts',
            'alias' => 'x-daisy::charts.line',
            'href' => "/{$prefix}/charts/line",
        ],
    ];
    $sections = array_map(function ($cat) {
        return [
            'id' => \Illuminate\Support\Str::slug($cat['label']),
            'label' => $cat['label'],
        ];
    }, $navItems);
    array_unshift($sections, ['id' => 'search', 'label' => 'Recherche']);
    array_unshift($sections, ['id' => 'contract', 'label' => 'Contrat public']);
    array_unshift($sections, ['id' => 'components', 'label' => 'Composants']);
@endphp

<x-daisy::docs.page 
    title="Composants" 
    category="" 
    name="index"
    type="index"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Composants UI" 
            subtitle="Catalogue des composants Blade publics du kit Daisy, organisé par famille et synchronisé avec le manifeste d’inventaire."
        />
    </x-slot:intro>

    <section id="contract" class="mt-8">
        <div class="grid gap-4 md:grid-cols-3">
            <x-daisy::ui.data-display.stat
                title="Alias publics"
                :value="$componentCount"
                desc="Exposés par le manifeste"
            />
            <x-daisy::ui.data-display.stat
                title="Modules JS"
                :value="$jsModuleCount"
                desc="Déclarés par composant"
            />
            <x-daisy::ui.data-display.stat
                title="Catégories"
                :value="count($componentsByCategory)"
                desc="Familles de composants"
            />
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-[minmax(0,1fr)_minmax(18rem,24rem)]">
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <div class="flex flex-col gap-3">
                    <div>
                        <h2 class="text-xl font-semibold">Contrat public</h2>
                        <p class="mt-2 text-sm text-base-content/70">
                            Une fiche est considérée publique quand son alias <code>x-daisy::...</code> existe dans le manifeste généré. Les vues <code>daisy::components...</code> restent l’implémentation interne à ne pas copier dans l’application hôte.
                        </p>
                    </div>
                    <div class="alert alert-info">
                        <span>Réutiliser et composer les composants du package en priorité. Si une fiche révèle un défaut package, le documenter et le corriger à la source plutôt que le contourner dans cette démo.</span>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @foreach($statusCounts as $status => $count)
                            <span class="badge {{ $status === 'active' ? 'badge-success' : 'badge-ghost' }} badge-outline">
                                {{ $status }} · {{ $count }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Entrées recommandées</h2>
                <div class="mt-4 flex flex-col gap-3">
                    @foreach($recommendedEntries as $entry)
                        <a href="{{ $entry['href'] }}" class="rounded-box border border-base-300 p-3 transition hover:border-primary hover:bg-base-200">
                            <span class="block text-sm font-medium">{{ $entry['title'] }}</span>
                            <code class="mt-1 block text-xs text-base-content/70 break-words">{{ $entry['alias'] }}</code>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section id="search" class="mt-8">
        <form method="GET" action="/{{ $prefix }}/components" class="rounded-box border border-base-300 bg-base-100 p-5">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-end">
                <div class="flex-1">
                    <label for="component-search" class="text-sm font-medium">Rechercher dans les composants</label>
                    <p class="mt-1 text-sm text-base-content/60">
                        Filtre par nom, alias public, catégorie, tag ou module JS.
                    </p>
                    <x-daisy::ui.inputs.input
                        id="component-search"
                        type="search"
                        name="q"
                        class="mt-3 w-full"
                        placeholder="Ex. table, modal, alert-dismiss, navigation..."
                        value="{{ $searchQuery }}"
                    />
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    <button type="submit" class="btn btn-primary">Rechercher</button>
                    @if($searchQuery !== '')
                        <a href="/{{ $prefix }}/components" class="btn btn-ghost">Effacer</a>
                    @endif
                </div>
            </div>
            <p class="mt-4 text-sm text-base-content/70">
                {{ $visibleComponentCount }} composant{{ $visibleComponentCount > 1 ? 's' : '' }} affiché{{ $visibleComponentCount > 1 ? 's' : '' }} sur {{ $componentCount }}.
            </p>
        </form>
    </section>

    @if($searchQuery !== '' && $visibleComponentCount === 0)
        <div class="mt-8 rounded-box border border-base-300 bg-base-100 p-6">
            <h2 class="text-xl font-semibold">Aucun composant trouvé</h2>
            <p class="mt-2 text-sm text-base-content/70">
                Essayez un alias public, une famille comme <code>overlay</code>, ou un module JS déclaré dans le manifeste.
            </p>
        </div>
    @endif

    @foreach($filteredComponentsByCategory as $categoryId => $category)
        <section id="{{ $categoryId }}" class="mt-12">
            <div class="flex items-center justify-between gap-3 mb-4">
                <h2 class="text-2xl font-semibold">{{ $category['label'] ?? $categoryId }}</h2>
                <span class="badge badge-outline">{{ count($category['components'] ?? []) }} composants</span>
            </div>
            @if(empty($category['components'] ?? []))
                <p class="text-base-content/60 text-sm">Aucun composant listé dans cette catégorie.</p>
            @else
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach($category['components'] as $component)
                        @php
                            $alias = ! empty($component['view'])
                                ? 'x-daisy::'.str_replace('daisy::components.', '', $component['view'])
                                : null;
                        @endphp
                        <a href="{{ $component['href'] ?? '#' }}" class="card bg-base-100 shadow hover:shadow-md transition-shadow">
                            <div class="card-body">
                                <div class="flex items-start justify-between gap-2">
                                    <h3 class="card-title text-base break-words">{{ $component['name'] ?? 'Composant' }}</h3>
                                    @if(!empty($component['status']))
                                        <span class="badge badge-sm {{ $component['status'] === 'active' ? 'badge-success' : 'badge-ghost' }}">{{ $component['status'] }}</span>
                                    @endif
                                </div>
                                @if($alias)
                                    <p class="text-xs text-base-content/70 break-words">
                                        Alias public : <code>{{ $alias }}</code>
                                    </p>
                                @endif
                                @if(!empty($component['view']))
                                    <p class="text-xs text-base-content/50 break-words">
                                        Vue package : <code>{{ $component['view'] }}</code>
                                    </p>
                                @endif
                                @if(!empty($component['tags']))
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach($component['tags'] as $tag)
                                            <span class="badge badge-ghost badge-xs">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                                @if(!empty($component['jsModule']))
                                    <p class="text-xs text-info mt-2">Module JS : <code>{{ $component['jsModule'] }}</code></p>
                                @endif
                                <div class="card-actions justify-end">
                                    <span class="btn btn-sm btn-primary btn-outline">Ouvrir</span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </section>
    @endforeach
</x-daisy::docs.page>
