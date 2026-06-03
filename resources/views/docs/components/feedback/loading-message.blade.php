@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'feedback';
    $name = 'loading-message';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'usage', 'label' => 'Intégration'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="Message de chargement"
    category="feedback"
    name="loading-message"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Message de chargement"
            subtitle="Message de chargement avec indicateur visuel et texte personnalisable."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="loading-message">
        <x-slot:preview>
            <x-daisy::ui.feedback.loading-message shape="spinner" message="Chargement en cours..." size="lg" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.feedback.loading-message shape="spinner" message="Chargement en cours..." size="lg" />';
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

    <x-daisy::docs.sections.variants name="loading-message">
        <x-slot:preview>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-semibold mb-2">Formes d'indicateur</p>
                    <div class="flex flex-wrap gap-3">
                        <x-daisy::ui.feedback.loading-message shape="spinner" message="Spinner" />
                        <x-daisy::ui.feedback.loading-message shape="dots" message="Dots" />
                        <x-daisy::ui.feedback.loading-message shape="ring" message="Ring" />
                        <x-daisy::ui.feedback.loading-message shape="ball" message="Ball" />
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">Tailles</p>
                    <div class="flex flex-wrap items-center gap-3">
                        <x-daisy::ui.feedback.loading-message shape="spinner" message="Small" size="sm" />
                        <x-daisy::ui.feedback.loading-message shape="spinner" message="Medium" size="md" />
                        <x-daisy::ui.feedback.loading-message shape="spinner" message="Large" size="lg" />
                    </div>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">Messages personnalisés</p>
                    <div class="space-y-2">
                        <x-daisy::ui.feedback.loading-message shape="spinner" message="Téléchargement des données..." />
                        <x-daisy::ui.feedback.loading-message shape="dots" message="Traitement en cours..." />
                        <x-daisy::ui.feedback.loading-message shape="ring" message="Veuillez patienter..." />
                    </div>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = '{{-- Formes d\'indicateur --}}
<x-daisy::ui.feedback.loading-message shape="spinner" message="Spinner" />
<x-daisy::ui.feedback.loading-message shape="dots" message="Dots" />
<x-daisy::ui.feedback.loading-message shape="ring" message="Ring" />

{{-- Tailles --}}
<x-daisy::ui.feedback.loading-message shape="spinner" message="Small" size="sm" />
<x-daisy::ui.feedback.loading-message shape="spinner" message="Large" size="lg" />

{{-- Messages personnalisés --}}
<x-daisy::ui.feedback.loading-message shape="spinner" message="Téléchargement des données..." />
<x-daisy::ui.feedback.loading-message shape="dots" message="Traitement en cours..." />';
            @endphp
            <x-daisy::ui.advanced.code-editor 
                language="blade" 
                :value="$variantsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="350px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.custom id="usage" title="Intégration" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Affichez le composant dans un slot réservé (carte, ligne de tableau, bannière) et retirez-le dès que les données sont disponibles —
                évitez de superposer plusieurs instances concurrentes pour une même zone sans animation de transition.
            </p>
            <p>
                Les valeurs <code class="kbd kbd-xs">shape</code> correspondent aux variantes daisyUI <code class="kbd kbd-xs">loading-*</code> ;
                préférez <code class="kbd kbd-xs">size</code> cohérent avec les boutons adjacents pour un alignement vertical net.
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
