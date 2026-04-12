@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'media';
    $name = 'leaflet';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'features', 'label' => 'Features'],
        ['id' => 'plugins', 'label' => 'Plugins'],
        ['id' => 'events', 'label' => 'Events & API JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Carte" 
    category="media" 
    name="leaflet"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Carte" 
            subtitle="Carte interactive avec Leaflet.js. Inclut un skeleton de chargement, un état d'erreur visuel, la gestion automatique du redimensionnement, et le support de plugins (clustering, fullscreen, gesture handling, scale)."
            jsModule="leaflet"
        />
    </x-slot:intro>

    {{-- Exemple de base --}}
    <x-daisy::docs.sections.example name="leaflet">
        <x-slot:preview>
            <div class="w-full overflow-hidden rounded-box" style="height: 16rem;">
                <x-daisy::ui.media.leaflet class="h-full w-full" :lat="48.8566" :lng="2.3522" :zoom="13" />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.media.leaflet
    class="h-64 w-full"
    :lat="48.8566"
    :lng="2.3522"
    :zoom="13"
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

    {{-- Variantes --}}
    <x-daisy::docs.sections.variants name="leaflet">
        <x-slot:preview>
            <div class="space-y-6">
                {{-- Markers with fitBounds --}}
                <div>
                    <p class="text-sm font-semibold mb-2">Marqueurs + fitBounds automatique</p>
                    <div class="w-full overflow-hidden rounded-box" style="height: 12rem;">
                        <x-daisy::ui.media.leaflet 
                            class="h-full w-full" 
                            :lat="48.8566" 
                            :lng="2.3522" 
                            :zoom="13"
                            :fitBounds="true"
                            :markers="[
                                [48.8566, 2.3522, '<b>Tour Eiffel</b>'],
                                [48.8606, 2.3376, '<b>Arc de Triomphe</b>'],
                                [48.8530, 2.3499, '<b>Musée d\'Orsay</b>'],
                            ]"
                        />
                    </div>
                </div>

                {{-- Tile providers --}}
                <div>
                    <p class="text-sm font-semibold mb-2">Providers de tuiles</p>
                    <div class="grid grid-cols-2 gap-2">
                        <div class="overflow-hidden rounded-box">
                            <p class="text-xs text-center mb-1">CartoDB Positron</p>
                            <div style="height: 8rem;">
                                <x-daisy::ui.media.leaflet class="h-full w-full" :lat="48.8566" :lng="2.3522" :zoom="12" provider="cartodb.positron" />
                            </div>
                        </div>
                        <div class="overflow-hidden rounded-box">
                            <p class="text-xs text-center mb-1">CartoDB Dark Matter</p>
                            <div style="height: 8rem;">
                                <x-daisy::ui.media.leaflet class="h-full w-full" :lat="48.8566" :lng="2.3522" :zoom="12" provider="cartodb.darkmatter" />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- minZoom / maxZoom --}}
                <div>
                    <p class="text-sm font-semibold mb-2">minZoom / maxZoom (zoom restreint entre 10 et 15)</p>
                    <div class="w-full overflow-hidden rounded-box" style="height: 12rem;">
                        <x-daisy::ui.media.leaflet 
                            class="h-full w-full" 
                            :lat="48.8566" 
                            :lng="2.3522" 
                            :zoom="12"
                            :minZoom="10"
                            :maxZoom="15"
                        />
                    </div>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = '{{-- Marqueurs + fitBounds automatique --}}
<x-daisy::ui.media.leaflet 
    class="h-48 w-full"
    :lat="48.8566" :lng="2.3522" :zoom="13"
    :fitBounds="true"
    :markers="[
        [48.8566, 2.3522, \'<b>Tour Eiffel</b>\'],
        [48.8606, 2.3376, \'<b>Arc de Triomphe</b>\'],
    ]"
/>

{{-- Provider CartoDB Positron --}}
<x-daisy::ui.media.leaflet 
    class="h-32 w-full"
    :lat="48.8566" :lng="2.3522" :zoom="12"
    provider="cartodb.positron"
/>

{{-- Provider CartoDB Dark Matter --}}
<x-daisy::ui.media.leaflet 
    class="h-32 w-full"
    :lat="48.8566" :lng="2.3522" :zoom="12"
    provider="cartodb.darkmatter"
/>

{{-- Zoom restreint --}}
<x-daisy::ui.media.leaflet 
    class="h-48 w-full"
    :lat="48.8566" :lng="2.3522" :zoom="12"
    :minZoom="10" :maxZoom="15"
/>';
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
                height="500px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    {{-- Features: loading, error, height --}}
    <x-daisy::docs.sections.custom id="features" title="Features">
        <p class="text-sm text-base-content/70 mb-6">
            Le composant inclut automatiquement un skeleton de chargement et un état d'erreur visuel. 
            Le spinner disparaît une fois la carte initialisée. En cas d'échec, une icône de carte barrée s'affiche.
        </p>

        <div class="space-y-6">
            {{-- Loading state --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Loading state</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Un spinner <code>loading-spinner</code> s'affiche automatiquement pendant le chargement de Leaflet et des tuiles. 
                    Il est supprimé du DOM une fois la carte prête.
                </p>
                @php
                    $loadingCode = '{{-- Le loading state est automatique, aucune configuration nécessaire --}}
<x-daisy::ui.media.leaflet :lat="48.8566" :lng="2.3522" :zoom="13" />

{{-- Structure HTML générée: --}}
<div data-module="leaflet" class="relative w-full bg-base-200 h-80">
    <div id="leaflet-xxx" class="w-full h-full"></div>
    
    {{-- Spinner visible pendant le chargement --}}
    <div class="daisy-leaflet-loading absolute inset-0 z-10 flex items-center justify-center">
        <span class="loading loading-spinner loading-lg text-base-content/30"></span>
    </div>
    
    {{-- Icône d\'erreur (masquée par défaut) --}}
    <div class="daisy-leaflet-error absolute inset-0 z-10 ... hidden">
        ...
    </div>
</div>';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$loadingCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="400px"
                />
            </div>

            {{-- Hauteur automatique --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Détection intelligente de la hauteur</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Le composant applique <code>h-80</code> par défaut. Si vous passez une classe de hauteur 
                    (<code>h-64</code>, <code>h-full</code>, <code>h-screen</code>, <code>h-dvh</code>, <code>h-[500px]</code>, 
                    <code>min-h-*</code>, <code>aspect-*</code>, ou avec des préfixes responsifs comme <code>sm:h-64</code>), 
                    la hauteur par défaut est automatiquement omise.
                </p>
                @php
                    $heightCode = '{{-- Hauteur par défaut (h-80 = 20rem) --}}
<x-daisy::ui.media.leaflet :lat="48.8566" :lng="2.3522" />

{{-- Hauteur personnalisée --}}
<x-daisy::ui.media.leaflet class="h-64" :lat="48.8566" :lng="2.3522" />

{{-- Hauteur responsive --}}
<x-daisy::ui.media.leaflet class="h-48 sm:h-64 lg:h-96" :lat="48.8566" :lng="2.3522" />

{{-- Hauteur arbitraire --}}
<x-daisy::ui.media.leaflet class="h-[500px]" :lat="48.8566" :lng="2.3522" />

{{-- Avec aspect ratio --}}
<x-daisy::ui.media.leaflet class="aspect-16/9" :lat="48.8566" :lng="2.3522" />';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$heightCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="350px"
                />
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    {{-- Plugins --}}
    <x-daisy::docs.sections.custom id="plugins" title="Plugins">
        <p class="text-sm text-base-content/70 mb-6">
            Le composant Leaflet supporte des plugins activables par props. Les plugins sont chargés dynamiquement 
            (code-splitting) &mdash; aucun coût si non utilisé.
        </p>

        <div class="space-y-6">
            {{-- Scale --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Scale (natif Leaflet)</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Affiche une barre d'échelle métrique en bas à gauche de la carte.
                </p>
                @php
                    $scaleCode = '<x-daisy::ui.media.leaflet 
    :lat="48.8566" :lng="2.3522" :zoom="13"
    :scale="true"
/>';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$scaleCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="150px"
                />
            </div>

            {{-- Gesture handling --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Gesture Handling</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Empêche le scroll-hijack sur mobile/embed. Exige Ctrl+scroll pour zoomer et deux doigts pour 
                    déplacer la carte sur mobile.
                </p>
                @php
                    $gestureCode = '<x-daisy::ui.media.leaflet 
    :lat="48.8566" :lng="2.3522" :zoom="13"
    :gestureHandling="true"
/>';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$gestureCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="150px"
                />
            </div>

            {{-- Fullscreen --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Fullscreen</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Ajoute un bouton plein écran dans le coin supérieur gauche de la carte.
                </p>
                @php
                    $fullscreenCode = '<x-daisy::ui.media.leaflet 
    :lat="48.8566" :lng="2.3522" :zoom="13"
    :fullscreen="true"
/>';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$fullscreenCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="150px"
                />
            </div>

            {{-- Cluster --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Clustering</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Regroupe les marqueurs proches en clusters cliquables. Indispensable pour les cartes à 50+ marqueurs.
                </p>
                @php
                    $clusterCode = '<x-daisy::ui.media.leaflet 
    :lat="48.8566" :lng="2.3522" :zoom="12"
    :cluster="true"
    :clusterOptions="[\'maxClusterRadius\' => 80]"
    :markers="$markers"
/>';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$clusterCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="200px"
                />
            </div>

            {{-- Combinaison --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Combinaison de plugins</h3>
                <p class="text-sm text-base-content/70 mb-3">
                    Tous les plugins peuvent être combinés librement.
                </p>
                @php
                    $comboCode = '<x-daisy::ui.media.leaflet 
    :lat="48.8566" :lng="2.3522" :zoom="12"
    provider="cartodb.positron"
    :scale="true"
    :gestureHandling="true"
    :fullscreen="true"
    :cluster="true"
    :fitBounds="true"
    :markers="$markers"
/>';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="blade" 
                    :value="$comboCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="250px"
                />
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    {{-- Events & API JS --}}
    <x-daisy::docs.sections.custom id="events" title="Events & API JS">
        <p class="text-sm text-base-content/70 mb-6">
            Le composant expose des événements et une API JavaScript globale pour l'interaction programmatique.
        </p>

        <div class="space-y-6">
            {{-- Events --}}
            <div>
                <h3 class="text-base font-semibold mb-2">Événements</h3>
                <div class="overflow-x-auto">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Événement</th>
                                <th>Target</th>
                                <th>Detail</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><code>daisy:leaflet:init</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ map, config }' }}</code></td>
                                <td>La carte est initialisée avec succès. <code>detail.map</code> est l'instance Leaflet.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- API JS --}}
            <div>
                <h3 class="text-base font-semibold mb-2">API JavaScript globale</h3>
                @php
                    $apiCode = '// Écouter l\'initialisation réussie
const root = document.querySelector(\'[data-module="leaflet"]\');
root.addEventListener(\'daisy:leaflet:init\', (e) => {
    const map = e.detail.map;
    
    // Accéder à l\'instance Leaflet pour ajouter des interactions
    map.on(\'click\', (ev) => console.log(ev.latlng));
    
    // Utiliser des fonctions natives Leaflet (ex: geolocation)
    map.locate({ setView: true, maxZoom: 16 });
});';
                @endphp
                <x-daisy::ui.advanced.code-editor 
                    language="javascript" 
                    :value="$apiCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="350px"
                />
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
