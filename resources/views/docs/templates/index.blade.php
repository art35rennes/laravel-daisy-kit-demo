@php
    use App\Helpers\DocsHelper;
    use Illuminate\Support\Facades\Route;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getTemplateNavigationItems($prefix);
    $templatesByCategory = DocsHelper::getTemplatesByCategory();
    $templates = collect($templatesByCategory)
        ->flatMap(fn (array $category) => $category['templates'] ?? []);
    $templateCount = $templates->count();
    $reusableCount = $templates->where('type', 'reusable')->count();
    $exampleCount = $templates->where('type', 'example')->count();
    $previewCount = $templates
        ->filter(fn (array $template): bool => ! empty($template['route']) && Route::has($template['route']))
        ->count();
    $componentBackedCount = $templates
        ->filter(fn (array $template) => ! empty($template['component']))
        ->count();
    $recommendedTemplates = [
        [
            'title' => 'Login simple',
            'contract' => 'x-daisy::templates.auth.login-simple',
            'href' => "/{$prefix}/templates/auth/login-simple",
        ],
        [
            'title' => 'Form builder',
            'contract' => "view('daisy::templates.form.builder')",
            'href' => "/{$prefix}/templates/form/builder",
        ],
        [
            'title' => 'Blueprint examples',
            'contract' => "view('daisy::templates.advanced.blueprint')",
            'href' => "/{$prefix}/templates/advanced/blueprint",
        ],
        [
            'title' => 'Profile settings',
            'contract' => "view('daisy::templates.profile.profile-settings')",
            'href' => "/{$prefix}/templates/profile/profile-settings",
        ],
    ];
    $sections = array_map(function ($categoryId) use ($templatesByCategory) {
        $category = $templatesByCategory[$categoryId]['category'] ?? null;

        return [
            'id' => $categoryId,
            'label' => $category['label'] ?? ucfirst($categoryId),
        ];
    }, array_keys($templatesByCategory));
    array_unshift($sections, ['id' => 'contract', 'label' => 'Contrat public']);
    array_unshift($sections, ['id' => 'templates', 'label' => 'Templates']);
@endphp

<x-daisy::layout.docs title="Templates" :sidebarItems="$navItems" :sections="$sections" :currentRoute="request()->path()">
    <x-slot:navbar>
        <x-daisy::ui.navigation.menu :vertical="false" :bg="false" :rounded="false" size="sm">
            <li><a href="/{{ $prefix }}">Docs</a></li>
            <li><a href="{{ route('demo') }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates" class="menu-active">Templates</a></li>
        </x-daisy::ui.navigation.menu>
    </x-slot:navbar>

    <section id="templates">
        <h1>Templates</h1>
        <p>Accédez rapidement à des structures de pages prêtes à l’emploi, avec leur contrat d’usage, leur fiche de documentation et leur preview quand elle existe.</p>
    </section>

    <section id="contract" class="mt-8">
        <div class="grid gap-4 md:grid-cols-4">
            <x-daisy::ui.data-display.stat
                title="Templates publics"
                :value="$templateCount"
                desc="Présents dans l’inventaire"
            />
            <x-daisy::ui.data-display.stat
                title="Réutilisables"
                :value="$reusableCount"
                desc="Composants ou vues stables"
            />
            <x-daisy::ui.data-display.stat
                title="Exemples"
                :value="$exampleCount"
                desc="Démo à copier/adapter"
            />
            <x-daisy::ui.data-display.stat
                title="Previews"
                :value="$previewCount"
                desc="Routes de démonstration"
            />
        </div>

        <div class="mt-6 grid gap-4 lg:grid-cols-[minmax(0,1fr)_minmax(18rem,24rem)]">
            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Contrat templates</h2>
                <p class="mt-2 text-sm text-base-content/70">
                    Les templates réutilisables exposent un composant ou une vue <code>daisy::templates...</code>. Les exemples applicatifs servent à comprendre l’assemblage dans un contexte réel; ils ne doivent pas remplacer un composant package quand un alias public existe.
                </p>
                <div class="alert alert-info mt-4">
                    <span>{{ $componentBackedCount }} templates déclarent un composant Blade direct. Les autres sont des vues package ou des exemples de composition à copier avec leur contexte.</span>
                </div>
                <div class="alert alert-success mt-4">
                    <span>
                        Les templates layout du package se rendent maintenant directement via <code>view()</code>, avec un slot vide par défaut quand ils sont appelés comme vues autonomes. Les boutons <code>Voir</code> pointent donc vers les routes de preview officielles de la démo.
                    </span>
                </div>
            </div>

            <div class="rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Parcours recommandés</h2>
                <div class="mt-4 flex flex-col gap-3">
                    @foreach($recommendedTemplates as $template)
                        <a href="{{ $template['href'] }}" class="rounded-box border border-base-300 p-3 transition hover:border-primary hover:bg-base-200">
                            <span class="block text-sm font-medium">{{ $template['title'] }}</span>
                            <code class="mt-1 block text-xs text-base-content/70 break-words">{{ $template['contract'] }}</code>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @foreach($templatesByCategory as $categoryId => $categoryData)
        @php
            $category = $categoryData['category'];
            $templates = $categoryData['templates'];
        @endphp
        <section id="{{ $categoryId }}" class="mt-12">
            <div class="mb-6">
                <h2 class="text-2xl font-semibold mb-2">{{ $category['label'] }}</h2>
                @if(!empty($category['description']))
                    <p class="text-base-content/70">{{ $category['description'] }}</p>
                @endif
            </div>

            <div class="grid gap-6 md:grid-cols-3">
                @foreach($templates as $template)
                    @php
                        $routeName = $template['route'] ?? null;
                        $hasRoute = $routeName && Route::has($routeName);
                        $previewUrl = $hasRoute ? route($routeName) : null;
                        $publicContract = isset($template['component'])
                            ? 'x-daisy::'.str_replace('daisy::', '', $template['component'])
                            : "view('".($template['view'] ?? '')."')";
                    @endphp
                    <div class="card bg-base-100 shadow">
                        <div class="card-body">
                            <div class="flex items-start justify-between gap-2 mb-2">
                                <h3 class="card-title text-base break-words flex-1 min-w-0">{{ $template['label'] }}</h3>
                                @if(isset($template['type']))
                                    @if($template['type'] === 'reusable')
                                        <span class="badge badge-success badge-sm">Réutilisable</span>
                                    @else
                                        <span class="badge badge-info badge-sm">Exemple</span>
                                    @endif
                                @endif
                            </div>
                            <p class="text-sm mb-4">{{ $template['description'] }}</p>
                            @if(isset($template['type']))
                                <div class="text-xs text-base-content/60 mb-3 break-words">
                                    @if($template['type'] === 'reusable')
                                        <p class="mb-1"><strong>Usage :</strong> composant Blade ou vue package</p>
                                    @else
                                        <p class="mb-1"><strong>Usage :</strong> vue package à copier/adapter</p>
                                    @endif
                                    <code class="text-xs break-words break-all">{{ $publicContract }}</code>
                                    @if($routeName)
                                        <p class="mt-2">Preview : <code>{{ $routeName }}</code></p>
                                    @endif
                                </div>
                            @endif
                            <div class="card-actions justify-end">
                                <a href="/{{ $prefix }}/templates/{{ $categoryId }}/{{ $template['name'] }}" class="btn btn-ghost btn-sm">
                                    Documentation
                                </a>
                                @if($previewUrl)
                                    <a href="{{ $previewUrl }}" class="btn btn-primary btn-sm">Voir</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endforeach
</x-daisy::layout.docs>
