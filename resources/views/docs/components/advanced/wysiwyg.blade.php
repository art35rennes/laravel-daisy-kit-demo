@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'wysiwyg';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Éditeur WYSIWYG" 
    category="advanced" 
    name="wysiwyg"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Éditeur WYSIWYG"
            subtitle="Éditeur de texte riche (What You See Is What You Get) pour la création de contenu."
            jsModule="lazy-editors"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="wysiwyg">
        <x-slot:preview>
            <x-daisy::ui.advanced.wysiwyg 
                name="content" 
                value="<p>Contenu riche avec <strong>formatage</strong> et <em>styles</em>.</p>" 
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.advanced.wysiwyg 
    name="content" 
    value="<p>Contenu riche avec <strong>formatage</strong> et <em>styles</em>.</p>" 
/>';
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

    <x-daisy::docs.sections.custom id="behavior" title="Chargement Trix et lazy init" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Le composant enveloppe <strong>Trix</strong> avec <code class="kbd kbd-xs">data-module="lazy-editors"</code>.
                Le bundle <code class="kbd kbd-xs">resources/js/lazy-editors.js</code> est importé lorsque la zone éditoriale entre dans le viewport
                (sélecteurs configurés dans <code class="kbd kbd-xs">resources/js/app.js</code>) ou lorsque vous ouvrez un collapse qui contient l’éditeur.
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li><code class="kbd kbd-xs">lazy</code> / <code class="kbd kbd-xs">lazy="button"</code> — ajoute <code class="kbd kbd-xs">data-trix-deferred="1"</code> et un bouton <code class="kbd kbd-xs">data-trix-init-button</code>.</li>
                <li><code class="kbd kbd-xs">data-trix-container</code> — masqué jusqu’à activation lorsque différé.</li>
                <li><code class="kbd kbd-xs">attachments</code> — reflété dans <code class="kbd kbd-xs">data-trix-attachments</code>.</li>
            </ul>
            <p>Pensez à appeler <code class="kbd kbd-xs">window.DaisyKit.reinit()</code> après avoir injecté du HTML contenant Trix sans passer par Vite/Livewire.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
