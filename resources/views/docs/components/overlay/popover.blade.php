@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'overlay';
    $name = 'popover';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Popover" 
    category="overlay" 
    name="popover"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Popover" 
            subtitle="Popover pour afficher des informations contextuelles."
            jsModule="popover"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="popover">
        <x-slot:preview>
            <x-daisy::ui.overlay.popover title="Informations">
                <x-slot:trigger>
                    <x-daisy::ui.inputs.button>Plus d'infos</x-daisy::ui.inputs.button>
                </x-slot:trigger>
                <p>Contenu informatif affiché dans le popover.</p>
            </x-daisy::ui.overlay.popover>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.overlay.popover title="Informations">
    <x-slot:trigger>
        <x-daisy::ui.inputs.button>Plus d\'infos</x-daisy::ui.inputs.button>
    </x-slot:trigger>
    <p>Contenu informatif affiché dans le popover.</p>
</x-daisy::ui.overlay.popover>';
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
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="behavior" title="Module JS et dataset" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Initialisation via <code class="kbd kbd-xs">data-module="popover"</code> (<code class="kbd kbd-xs">resources/js/modules/popover.js</code>).
                Le panneau porte la classe <code class="kbd kbd-xs">popover-panel</code> et doit être masqué par défaut (<code class="kbd kbd-xs">hidden</code>).
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li><code class="kbd kbd-xs">data-trigger</code> ou option équivalente : <code class="kbd kbd-xs">click</code> (défaut), <code class="kbd kbd-xs">hover</code>, <code class="kbd kbd-xs">focus</code>.</li>
                <li>Positionnement : attribut de placement lu par le composant Blade (top/right/bottom/left) — le module applique les classes Tailwind correspondantes au panneau.</li>
                <li>Un seul panneau ouvert à la fois : fermeture des autres instances lors de l’ouverture ; clic extérieur pour fermer.</li>
            </ul>
            <p>
                Après injection dynamique du DOM, appelez <code class="kbd kbd-xs">window.DaisyKit.reinit()</code> pour rattacher les écouteurs.
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
