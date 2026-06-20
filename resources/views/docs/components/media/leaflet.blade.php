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
        ['id' => 'gis', 'label' => 'SIG & mesures'],
        ['id' => 'plugins', 'label' => 'Plugins'],
        ['id' => 'events', 'label' => 'Events & API JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $gisBasemaps = [
        [
            'id' => 'plan',
            'label' => 'Plan clair',
            'type' => 'xyz',
            'url' => 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
            'options' => ['subdomains' => 'abcd', 'maxZoom' => 20],
            'active' => true,
        ],
        [
            'id' => 'terrain',
            'label' => 'Fond terrain',
            'type' => 'xyz',
            'url' => 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png',
            'options' => ['subdomains' => 'abcd', 'maxZoom' => 20],
        ],
    ];
    $gisReadonlyArea = [
        'type' => 'FeatureCollection',
        'features' => [[
            'type' => 'Feature',
            'properties' => ['name' => 'Secteur intervention AEP'],
            'geometry' => [
                'type' => 'Polygon',
                'coordinates' => [[[-1.696, 48.126], [-1.652, 48.125], [-1.651, 48.102], [-1.699, 48.101], [-1.696, 48.126]]],
            ],
        ]],
    ];
    $gisEditableTrace = [
        'type' => 'FeatureCollection',
        'features' => [[
            'type' => 'Feature',
            'properties' => ['name' => 'Conduite AEP à relever', 'objectType' => 'water_main', 'objectLabel' => 'Conduite AEP', 'diameter' => 'DN150', 'material' => 'fonte'],
            'geometry' => ['type' => 'LineString', 'coordinates' => [[-1.685, 48.119], [-1.677, 48.114], [-1.665, 48.116]]],
        ]],
    ];
    $gisInitialValue = [
        'type' => 'FeatureCollection',
        'features' => [[
            'type' => 'Feature',
            'properties' => ['name' => 'Borne incendie BI-042', 'objectType' => 'hydrant', 'objectLabel' => 'Borne incendie', 'reference' => 'BI-042', 'status' => 'à contrôler'],
            'geometry' => ['type' => 'Point', 'coordinates' => [-1.678, 48.117]],
        ]],
    ];
    $gisObjectTypes = [
        [
            'id' => 'hydrant',
            'label' => 'Borne incendie',
            'geometry' => 'point',
            'iconSvg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 21v-7a5 5 0 0 1 10 0v7"/><path d="M5 21h14"/><path d="M9 6h6"/><path d="M12 3v6"/><circle cx="12" cy="14" r="2"/></svg>',
            'markerSvg' => '<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path fill="#dc2626" d="M16 2c5.5 0 10 4.5 10 10 0 7.5-10 18-10 18S6 19.5 6 12C6 6.5 10.5 2 16 2Z"/><path fill="#fff" d="M13 8h6v4h3v5h-3v4h-6v-4h-3v-5h3z"/></svg>',
            'markerWidth' => 30,
            'markerHeight' => 30,
            'style' => ['color' => '#dc2626', 'outlineColor' => '#ffffff', 'outlineWidth' => 2],
            'properties' => ['category' => 'water_asset', 'assetType' => 'hydrant', 'inspectionStatus' => 'to_visit'],
        ],
        [
            'id' => 'water_main',
            'label' => 'Conduite AEP',
            'geometry' => 'line',
            'icon' => 'pipe',
            'style' => ['color' => '#2563eb', 'width' => 5, 'dashArray' => [8, 4]],
            'properties' => ['category' => 'water_network', 'network' => 'potable_water'],
        ],
        [
            'id' => 'work_zone',
            'label' => 'Zone de travaux',
            'geometry' => 'polygon',
            'icon' => 'structure',
            'style' => ['strokeColor' => '#b45309', 'strokeWidth' => 2, 'fillColor' => '#f59e0b', 'fillOpacity' => 0.18],
            'properties' => ['category' => 'work_area', 'workflow' => 'maintenance'],
        ],
    ];
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
            subtitle="Carte interactive avec Leaflet.js. Inclut les fonds custom, couches utilisateur, dessin GeoJSON, mesures, skeleton de chargement, états d'erreur et plugins optionnels."
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


    {{-- SIG & mesures --}}
    <x-daisy::docs.sections.custom id="gis" title="SIG & mesures">
        <p class="text-sm text-base-content/70 mb-6">
            Le mode SIG reste volontairement léger : Leaflet affiche les fonds et couches, Terra Draw gère les géométries éditables, et Turf recalcule les mesures depuis le GeoJSON. L’exemple ci-dessous simule une tournée réseau d’eau potable.
        </p>

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
            <div class="space-y-3">
                <div class="w-full overflow-hidden rounded-box" style="height: 28rem;">
                    <x-daisy::ui.media.leaflet
                        class="h-full w-full"
                        :lat="48.117"
                        :lng="-1.678"
                        :zoom="13"
                        :scale="true"
                        :basemaps="$gisBasemaps"
                        :overlays="[
                            [
                                'id' => 'project-area',
                                'label' => 'Secteur AEP readonly',
                                'type' => 'geojson',
                                'data' => $gisReadonlyArea,
                                'visible' => true,
                                'style' => ['color' => '#2563eb', 'weight' => 2, 'fillOpacity' => 0.08],
                            ],
                            [
                                'id' => 'editable-trace',
                                'label' => 'Conduite AEP éditable',
                                'type' => 'geojson',
                                'data' => $gisEditableTrace,
                                'editable' => true,
                            ],
                        ]"
                        :layerControl="true"
                        :controls="['persist' => true, 'storageKey' => 'docs-leaflet-gis-controls']"
                        :objectTypes="$gisObjectTypes"
                        :draw="['toolbar' => true, 'groupedToolbar' => true, 'point' => true, 'line' => true, 'polygon' => true, 'rectangle' => true, 'select' => true, 'delete' => true, 'undoRedo' => true]"
                        :measure="['display' => 'metric', 'showTooltip' => true, 'maxLabels' => 8]"
                        name="geometry"
                        :value="$gisInitialValue"
                    />
                </div>
            </div>

            <div class="space-y-4">
                <div class="alert alert-info text-sm">
                    <span>On ne garantit pas une mesure opposable depuis les pixels d'un fond de plan. On garantit une mesure traçable si elle est recalculée depuis les coordonnées GeoJSON, avec CRS, algorithme, arrondi et version de dépendance connus.</span>
                </div>
                <div class="overflow-x-auto rounded-box border border-base-300">
                    <table class="table table-sm">
                        <tbody>
                            <tr><th>Fonds</th><td><code>basemaps</code> XYZ/WMS avec un fond actif.</td></tr>
                            <tr><th>Couches</th><td><code>overlays</code> GeoJSON/XYZ/WMS, visibles ou masquées.</td></tr>
                            <tr><th>Edition</th><td>Seules les couches <code>editable: true</code> et <code>value</code> entrent dans Terra Draw.</td></tr>
                            <tr><th>Objets</th><td><code>objectTypes</code> ajoute des outils métier point, ligne ou polygone avec propriétés GeoJSON prérenseignées.</td></tr>
                            <tr><th>Icônes</th><td><code>icon</code>, <code>iconSvg</code> ou <code>iconHtml</code> pilotent la toolbar; <code>markerUrl</code> ou <code>markerSvg</code> pilotent les marqueurs ponctuels sur la carte.</td></tr>
                            <tr><th>Styles</th><td><code>draw.styles</code> définit les styles par défaut; <code>objectTypes[].style</code> surcharge par métier avec <code>color</code>, <code>width</code>, <code>dashArray</code>, <code>strokeColor</code>, <code>fillColor</code> ou <code>fillOpacity</code>.</td></tr>
                            <tr><th>Toolbar</th><td><code>draw.groupedToolbar</code> regroupe les outils en sous-menus; un second clic sur l'outil actif revient à la sélection.</td></tr>
                            <tr><th>Mesure</th><td>Lignes: longueur; polygones: surface + périmètre; points: coordonnées.</td></tr>
                            <tr><th>Densité</th><td><code>measure.maxLabels</code> limite les libellés visibles sans supprimer les mesures dans les événements.</td></tr>
                            <tr><th>Réglages</th><td><code>controls</code> expose un menu utilisateur, avec persistence optionnelle via <code>storageKey</code>.</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @php
            $gisCode = <<<'BLADE'
<x-daisy::ui.media.leaflet
    class="h-[28rem] w-full"
    :lat="48.117" :lng="-1.678" :zoom="13"
    :scale="true"
    :basemaps="[
        [
            'id' => 'plan',
            'label' => 'Plan clair',
            'type' => 'xyz',
            'url' => 'https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png',
            'active' => true,
        ],
    ]"
    :overlays="[
        ['id' => 'sector', 'label' => 'Secteur AEP', 'type' => 'geojson', 'data' => $geojson, 'visible' => true],
        ['id' => 'water-main', 'label' => 'Conduite AEP éditable', 'type' => 'geojson', 'data' => $trace, 'editable' => true],
    ]"
    :layerControl="true"
    :controls="['persist' => true, 'storageKey' => 'project-map-controls']"
    :objectTypes="[
        ['id' => 'hydrant', 'label' => 'Borne incendie', 'geometry' => 'point', 'iconSvg' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M7 21v-7a5 5 0 0 1 10 0v7"/><path d="M5 21h14"/><circle cx="12" cy="14" r="2"/></svg>', 'markerSvg' => '<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path fill="#dc2626" d="M16 2c5.5 0 10 4.5 10 10 0 7.5-10 18-10 18S6 19.5 6 12C6 6.5 10.5 2 16 2Z"/><path fill="#fff" d="M13 8h6v4h3v5h-3v4h-6v-4h-3v-5h3z"/></svg>', 'markerWidth' => 30, 'markerHeight' => 30, 'properties' => ['category' => 'water_asset', 'assetType' => 'hydrant']],
        ['id' => 'water_main', 'label' => 'Conduite AEP', 'geometry' => 'line', 'icon' => 'pipe', 'style' => ['color' => '#2563eb', 'width' => 5, 'dashArray' => [8, 4]], 'properties' => ['category' => 'water_network']],
        ['id' => 'work_zone', 'label' => 'Zone de travaux', 'geometry' => 'polygon', 'icon' => 'structure', 'style' => ['strokeColor' => '#b45309', 'strokeWidth' => 2, 'fillColor' => '#f59e0b', 'fillOpacity' => 0.18], 'properties' => ['category' => 'work_area']],
    ]"
    :draw="[
        'toolbar' => true,
        'groupedToolbar' => true,
        'styles' => [
            'line' => ['color' => '#2563eb', 'width' => 4, 'dashArray' => [8, 4]],
            'polygon' => ['strokeColor' => '#b45309', 'fillColor' => '#f59e0b', 'fillOpacity' => 0.18],
        ],
        'point' => true,
        'line' => true,
        'polygon' => true,
        'rectangle' => true,
        'select' => true,
        'delete' => true,
    ]"
    :measure="['display' => 'metric', 'showTooltip' => true, 'maxLabels' => 8]"
    name="geometry"
    :value="$initialGeojson"
/>
BLADE;
        @endphp
        <div class="mt-6">
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$gisCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="520px"
            />
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
                                <td><code>{{ '{ map, config, context, exportGeoJSON }' }}</code></td>
                                <td>La carte est initialisée avec succès. <code>detail.map</code> est l'instance Leaflet et <code>exportGeoJSON()</code> retourne les objets éditables.</td>
                            </tr>
                            <tr>
                                <td><code>daisy:leaflet:change</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ value, measurements, draw }' }}</code></td>
                                <td>Le GeoJSON éditable change après dessin, édition, suppression, undo ou redo.</td>
                            </tr>
                            <tr>
                                <td><code>daisy:leaflet:measure</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ measurements, latest, draw }' }}</code></td>
                                <td>Les mesures Turf sont recalculées depuis les géométries GeoJSON.</td>
                            </tr>
                            <tr>
                                <td><code>daisy:leaflet:object-created</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ feature, featureId, objectType, exportGeoJSON }' }}</code></td>
                                <td>Un objet métier vient d'être dessiné; c'est le point d'entrée prévu pour ouvrir une modale de saisie complémentaire.</td>
                            </tr>
                            <tr>
                                <td><code>daisy:leaflet:draw-finish</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ feature, featureId, objectType, draw }' }}</code></td>
                                <td>Une géométrie dessinée est finalisée, avec ou sans type métier.</td>
                            </tr>
                            <tr>
                                <td><code>daisy:leaflet:zone-select</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ type, featureIds, features, map, draw }' }}</code></td>
                                <td>Une sélection par rectangle, polygone ou cercle est terminée; tous les identifiants sélectionnés sont exposés.</td>
                            </tr>
                            <tr>
                                <td><code>daisy:leaflet:layer-toggle</code></td>
                                <td>root <code>[data-module]</code></td>
                                <td><code>{{ '{ name, type, layer }' }}</code></td>
                                <td>Un fond ou une couche est activé, affiché ou masqué via le contrôle Leaflet.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- API JS --}}
            <div>
                <h3 class="text-base font-semibold mb-2">API JavaScript globale</h3>
                @php
                    $apiCode = <<<'JS'
// Écouter l'initialisation réussie
const root = document.querySelector('[data-module="leaflet"]');
root.addEventListener('daisy:leaflet:init', (e) => {
    const map = e.detail.map;
    map.on('click', (ev) => console.log(ev.latlng));
});

root.addEventListener('daisy:leaflet:change', (e) => {
    console.log(e.detail.value);
});

root.addEventListener('daisy:leaflet:measure', (e) => {
    console.log(e.detail.measurements);
});

root.addEventListener('daisy:leaflet:zone-select', (e) => {
    console.log(e.detail.featureIds);
});
JS;
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
