@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'calendar-full';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Calendrier complet" 
    category="advanced" 
    name="calendar-full"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Calendrier complet" 
            subtitle="Calendrier complet avec gestion d'événements et affichage mensuel."
            jsModule="calendar-full"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="calendar-full">
        <x-slot:preview>
            @php
                $events = [
                    ['title' => 'Réunion', 'start' => '2024-01-15 10:00'],
                    ['title' => 'Déjeuner', 'start' => '2024-01-15 12:30'],
                    ['title' => 'Conférence', 'start' => '2024-01-20 14:00'],
                ];
            @endphp
            <x-daisy::ui.advanced.calendar-full :events="$events" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.advanced.calendar-full :events="[
    ['title' => 'Réunion', 'start' => '2024-01-15 10:00'],
    ['title' => 'Déjeuner', 'start' => '2024-01-15 12:30'],
    ['title' => 'Conférence', 'start' => '2024-01-20 14:00'],
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

    <x-daisy::docs.sections.custom id="behavior" title="Hydratation et données" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Racine <code class="kbd kbd-xs">data-module="calendar-full"</code> et <code class="kbd kbd-xs">data-calendar-full="1"</code>.
                Les options de vue (<code class="kbd kbd-xs">view</code>, plages horaires, <code class="kbd kbd-xs">firstDay</code>, etc.) sont sérialisées en dataset puis consommées par
                <code class="kbd kbd-xs">resources/js/calendar-full/core.js</code>.
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li><code class="kbd kbd-xs">:events</code> — tableau PHP encodé pour bootstrap rapide.</li>
                <li><code class="kbd kbd-xs">events-url</code> — fetch JSON avec fenêtre <code class="kbd kbd-xs">start</code>/<code class="kbd kbd-xs">end</code> (voir démo API).</li>
                <li><code class="kbd kbd-xs">detail</code> — modale intégrée ou événements custom uniquement lorsque désactivée.</li>
            </ul>
            <p>Export du module : <code class="kbd kbd-xs">mount(root)</code> / <code class="kbd kbd-xs">mountAllCalendars()</code> depuis <code class="kbd kbd-xs">calendar-full/index.js</code>.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
