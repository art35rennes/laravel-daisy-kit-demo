@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'media';
    $name = 'media-gallery';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Galerie média" 
    category="media" 
    name="media-gallery"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Galerie média" 
            subtitle="Galerie multimédia interactive pour afficher des images et vidéos."
            jsModule="media-gallery"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="media-gallery">
        <x-slot:preview>
            <x-daisy::ui.media.media-gallery 
                src="https://picsum.photos/800/600" 
                alt="Galerie photo" 
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.media.media-gallery 
    src="https://picsum.photos/800/600" 
    alt="Galerie photo" 
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

    <x-daisy::docs.sections.custom id="behavior" title="Dataset et chargement" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Module <code class="kbd kbd-xs">resources/js/media-gallery.js</code>, chargé à proximité du viewport lorsque
                <code class="kbd kbd-xs">data-media-gallery="1"</code> est présent (<code class="kbd kbd-xs">data-module="media-gallery"</code> côté Blade).
            </p>
            <ul class="list-inside list-disc space-y-1">
                <li><code class="kbd kbd-xs">template[data-items]</code> — JSON des vignettes (<code class="kbd kbd-xs">src</code>, <code class="kbd kbd-xs">thumb</code>, <code class="kbd kbd-xs">alt</code>).</li>
                <li><code class="kbd kbd-xs">data-main</code> / <code class="kbd kbd-xs">data-main-wrapper</code> — image principale et conteneur zoom.</li>
                <li><code class="kbd kbd-xs">data-thumb</code> + <code class="kbd kbd-xs">data-index</code> — vignettes synchronisées.</li>
                <li><code class="kbd kbd-xs">data-activation</code> — <code class="kbd kbd-xs">click</code> ou <code class="kbd kbd-xs">mouseenter</code>.</li>
                <li><code class="kbd kbd-xs">data-zoom="true"</code> — zoom au survol sur l’image principale.</li>
            </ul>
            <p>API globale : <code class="kbd kbd-xs">window.DaisyMediaGallery.init(root)</code> / <code class="kbd kbd-xs">initAll()</code>.</p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
