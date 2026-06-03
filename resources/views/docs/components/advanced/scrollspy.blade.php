@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'scrollspy';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Navigation au défilement" 
    category="advanced" 
    name="scrollspy"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Navigation au défilement" 
            subtitle="Navigation automatique qui met à jour l'élément actif selon la position de défilement."
            jsModule="scrollspy"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="scrollspy">
        <x-slot:preview>
            @php
                $items = [
                    ['label' => 'Section 1', 'href' => '#section1'],
                    ['label' => 'Section 2', 'href' => '#section2'],
                    ['label' => 'Section 3', 'href' => '#section3'],
                ];
            @endphp
            <div class="w-64">
                <x-daisy::ui.advanced.scrollspy :items="$items" />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.advanced.scrollspy :items="[
    ['label' => 'Section 1', 'href' => '#section1'],
    ['label' => 'Section 2', 'href' => '#section2'],
    ['label' => 'Section 3', 'href' => '#section3'],
]" />
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

    <x-daisy::docs.sections.custom id="behavior" title="IntersectionObserver et API" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Navigation avec <code class="kbd kbd-xs">data-scrollspy="1"</code> et <code class="kbd kbd-xs">data-module="scrollspy"</code>.
                Import paresseux via <code class="kbd kbd-xs">resources/js/scrollspy.js</code> lorsque le sélecteur correspond dans <code class="kbd kbd-xs">app.js</code>.
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li><code class="kbd kbd-xs">data-container</code> — scroll parent si différent de la fenêtre.</li>
                <li><code class="kbd kbd-xs">data-track</code> — sélecteur des sections suivies (défaut <code class="kbd kbd-xs">section</code>).</li>
                <li><code class="kbd kbd-xs">data-root-margin</code>, <code class="kbd kbd-xs">data-threshold</code> — options IntersectionObserver.</li>
                <li><code class="kbd kbd-xs">autogen</code> — génère les liens depuis les titres du conteneur.</li>
            </ul>
            <p>
                API globale : <code class="kbd kbd-xs">window.DaisyScrollSpy.init(nav)</code>,
                <code class="kbd kbd-xs">refresh(nav)</code> après mutations DOM,
                <code class="kbd kbd-xs">dispose(nav)</code> pour libérer les observers.
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
