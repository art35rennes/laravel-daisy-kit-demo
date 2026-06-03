@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'inputs';
    $name = 'sign';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Signature" 
    category="inputs" 
    name="sign"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Signature"
            subtitle="Zone de signature numérique avec support du dessin et des actions."
            jsModule="sign"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="sign">
        <x-slot:preview>
            <x-daisy::ui.inputs.sign width="320" height="120" :showActions="true" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.inputs.sign width="320" height="120" :showActions="true" />';
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
                height="140px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="behavior" title="Dataset et événements" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Module <code class="kbd kbd-xs">resources/js/modules/sign.js</code> sur la racine
                <code class="kbd kbd-xs">data-sign="1"</code> — canvas <code class="kbd kbd-xs">data-sign-canvas</code>,
                champ <code class="kbd kbd-xs">data-sign-input</code>, boutons effacer / télécharger lorsque
                <code class="kbd kbd-xs">data-show-actions</code> est actif.
            </p>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead><tr><th>Événement</th><th>Détail</th></tr></thead>
                    <tbody>
                        <tr><td><code class="kbd kbd-xs">sign:change</code></td><td><code class="kbd kbd-xs">isEmpty</code>, <code class="kbd kbd-xs">dataURL</code>.</td></tr>
                        <tr><td><code class="kbd kbd-xs">sign:clear</code></td><td>Effacement utilisateur.</td></tr>
                        <tr><td><code class="kbd kbd-xs">sign:end</code></td><td>Fin de trait (<code class="kbd kbd-xs">signature_pad</code>).</td></tr>
                    </tbody>
                </table>
            </div>
            <p>API globale : <code class="kbd kbd-xs">window.DaisySign.init(root)</code>.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
