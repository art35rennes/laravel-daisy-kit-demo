@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'onboarding';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Assistant de démarrage" 
    category="advanced" 
    name="onboarding"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Assistant de démarrage" 
            subtitle="Assistant interactif pour guider les utilisateurs dans leur première utilisation."
            jsModule="onboarding"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="onboarding">
        <x-slot:preview>
            @php
                $steps = [
                    ['title' => 'Bienvenue', 'content' => 'Bienvenue dans notre application !'],
                    ['title' => 'Première étape', 'content' => 'Voici comment commencer.'],
                    ['title' => 'Terminé', 'content' => 'Vous êtes prêt à utiliser l\'application.'],
                ];
            @endphp
            <div class="p-4 bg-base-200 rounded-box">
                <x-daisy::ui.advanced.onboarding :steps="$steps" />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.advanced.onboarding :steps="[
    ['title' => 'Bienvenue', 'content' => 'Bienvenue dans notre application !'],
    ['title' => 'Première étape', 'content' => 'Voici comment commencer.'],
    ['title' => 'Terminé', 'content' => 'Vous êtes prêt à utiliser l\'application.'],
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

    <x-daisy::docs.sections.custom id="behavior" title="Configuration et événements" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Le composant rend un span avec <code class="kbd kbd-xs">data-onboarding="1"</code>, <code class="kbd kbd-xs">data-start</code> et un bloc JSON
                <code class="kbd kbd-xs">script[data-onboarding-config]</code> décrivant masques, étapes et libellés (<code class="kbd kbd-xs">resources/js/onboarding.js</code>).
            </p>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead><tr><th>Événement</th><th>Détail</th></tr></thead>
                    <tbody>
                        <tr><td><code class="kbd kbd-xs">onboarding:start</code></td><td>Début du tour (<code class="kbd kbd-xs">detail.index</code>).</td></tr>
                        <tr><td><code class="kbd kbd-xs">onboarding:step</code></td><td>Changement d’étape (<code class="kbd kbd-xs">detail.index</code>).</td></tr>
                        <tr><td><code class="kbd kbd-xs">onboarding:finish</code></td><td>Dernière étape validée.</td></tr>
                        <tr><td><code class="kbd kbd-xs">onboarding:skip</code></td><td>Sortie utilisateur.</td></tr>
                    </tbody>
                </table>
            </div>
            <p>Chaque entrée de <code class="kbd kbd-xs">steps</code> peut cibler un sélecteur DOM (<code class="kbd kbd-xs">target</code>), ajuster le placement du popover et activer ponctuellement <code class="kbd kbd-xs">interactive</code>.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
