@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'navigation';
    $name = 'section-nav';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'positions', 'label' => 'Positionnement'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Section Nav"
    category="navigation"
    name="section-nav"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Section Nav"
            subtitle="Sommaire flottant qui détecte automatiquement les sections d’une page et propose une recherche locale."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="section-nav">
        <x-slot:preview>
            <div class="relative min-h-72 overflow-hidden rounded-box border border-base-content/10 bg-base-100 p-6">
                <x-daisy::ui.navigation.section-nav
                    title="Sections de la démo"
                    targetSelector="#section-nav-demo > section"
                    headingSelector="h3"
                    position="top-right"
                    breakpointClass="block"
                    buttonColor="secondary"
                />

                <div id="section-nav-demo" class="space-y-6 pr-20">
                    <section>
                        <h3 class="text-base font-semibold">Introduction</h3>
                        <p class="mt-2 text-sm opacity-70">Le composant inspecte les sections ciblées et construit la navigation côté client.</p>
                    </section>
                    <section>
                        <h3 class="text-base font-semibold">Recherche</h3>
                        <p class="mt-2 text-sm opacity-70">La recherche filtre les entrées sans rechargement et tolère les accents.</p>
                    </section>
                    <section>
                        <h3 class="text-base font-semibold">Responsive</h3>
                        <p class="mt-2 text-sm opacity-70">Le bouton flottant peut être masqué ou forcé via <code>breakpointClass</code>.</p>
                    </section>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.navigation.section-nav
    title="Sections de la démo"
    targetSelector="#section-nav-demo > section"
    headingSelector="h3"
    position="top-right"
    breakpointClass="block"
    buttonColor="secondary"
/>
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
                height="220px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="positions" title="Positionnement">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>Utilisez <code>position</code> pour choisir le coin d’ancrage, et <code>panelWidth</code> ou <code>breakpointClass</code> pour ajuster l’encombrement.</span>
            </div>

            @php
                $positionsCode = <<<'CODE'
<x-daisy::ui.navigation.section-nav position="bottom-left" />
<x-daisy::ui.navigation.section-nav position="top-right" buttonColor="accent" />
<x-daisy::ui.navigation.section-nav breakpointClass="hidden xl:block" panelWidth="w-96" />
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$positionsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="180px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
