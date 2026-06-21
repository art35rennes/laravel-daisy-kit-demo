
@php
    $sigBasemaps = [
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

    $readonlyArea = [
        'type' => 'FeatureCollection',
        'features' => [[
            'type' => 'Feature',
            'properties' => ['name' => 'Secteur intervention AEP'],
            'geometry' => [
                'type' => 'Polygon',
                'coordinates' => [[
                    [-1.696, 48.126],
                    [-1.652, 48.125],
                    [-1.651, 48.102],
                    [-1.699, 48.101],
                    [-1.696, 48.126],
                ]],
            ],
        ]],
    ];

    $editableTrace = [
        'type' => 'FeatureCollection',
        'features' => [[
            'type' => 'Feature',
            'properties' => ['name' => 'Conduite AEP à relever', 'objectType' => 'water_main', 'objectLabel' => 'Conduite AEP', 'diameter' => 'DN150', 'material' => 'fonte'],
            'geometry' => [
                'type' => 'LineString',
                'coordinates' => [
                    [-1.685, 48.119],
                    [-1.677, 48.114],
                    [-1.665, 48.116],
                ],
            ],
        ]],
    ];

    $initialDrawing = [
        'type' => 'FeatureCollection',
        'features' => [[
            'type' => 'Feature',
            'properties' => ['name' => 'Borne incendie BI-042', 'objectType' => 'hydrant', 'objectLabel' => 'Borne incendie', 'reference' => 'BI-042', 'status' => 'à contrôler'],
            'geometry' => ['type' => 'Point', 'coordinates' => [-1.678, 48.117]],
        ]],
    ];

    $sigObjectTypes = [
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

<section class="space-y-6 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Leaflet Maps</h2>

    <div class="space-y-6">
        <!-- Carte basique -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">Basique</h3>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 300px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="12"
                    provider="cartodb.positron"
                />
            </div>
        </div>

        <!-- Carte avec marqueurs et fitBounds -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">Marqueurs + fitBounds automatique</h3>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 350px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="13"
                    :fitBounds="true"
                    provider="cartodb.positron"
                    :markers="[
                        [48.8566, 2.3522, '<b>Paris</b>'],
                        [48.117, -1.678, '<b>Rennes</b>'],
                        [47.218, -1.554, '<b>Nantes</b>'],
                    ]"
                />
            </div>
        </div>

        <!-- Carte avec provider CartoDB Positron -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">Provider CartoDB Positron</h3>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 300px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.8566"
                    :lng="2.3522"
                    :zoom="12"
                    provider="cartodb.positron"
                />
            </div>
        </div>

        <!-- Carte avec provider CartoDB Dark Matter -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">Provider CartoDB Dark Matter</h3>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 300px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.8566"
                    :lng="2.3522"
                    :zoom="12"
                    provider="cartodb.darkmatter"
                />
            </div>
        </div>

        <!-- Carte avec scale + gesture handling + fullscreen -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">Scale + Gesture Handling + Fullscreen</h3>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 400px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="13"
                    :scale="true"
                    :gestureHandling="true"
                    :fullscreen="true"
                    provider="cartodb.positron"
                    :markers="[
                        [48.116, -1.675, '<b>Centre</b>'],
                        [48.121, -1.682, '<b>Spot 1</b>'],
                        [48.108, -1.669, '<b>Spot 2</b>'],
                    ]"
                />
            </div>
        </div>

        <!-- Carte SIG avec fonds custom et couches -->
        <div class="space-y-3">
            <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium">SIG - fonds custom et couches</h3>
                    <p class="text-sm text-base-content/70">Basemaps XYZ, couche GeoJSON readonly et contrôle utilisateur des couches.</p>
                </div>
                <span class="badge badge-outline">layerControl</span>
            </div>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 420px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="13"
                    :scale="true"
                    :basemaps="$sigBasemaps"
                    :overlays="[
                        [
                            'id' => 'reference-area',
                            'label' => 'Secteur intervention AEP',
                            'type' => 'geojson',
                            'data' => $readonlyArea,
                            'visible' => true,
                            'locked' => true,
                            'style' => ['color' => '#2563eb', 'weight' => 2, 'fillOpacity' => 0.08],
                        ],
                        [
                            'id' => 'labels',
                            'label' => 'Libellés terrain',
                            'type' => 'xyz',
                            'url' => 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager_labels_under/{z}/{x}/{y}{r}.png',
                            'options' => ['subdomains' => 'abcd', 'maxZoom' => 20],
                            'visible' => false,
                        ],
                    ]"
                    :layerControl="['mode' => 'multiple', 'lockedOverlays' => ['reference-area']]"
                    :controls="['persist' => true, 'storageKey' => 'demo-leaflet-layers-controls']"
                />
            </div>
        </div>

        <!-- Carte SIG avec dessin et mesures -->
        <div class="space-y-3" data-leaflet-selection-demo>
            <div class="flex flex-col gap-1 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <h3 class="text-lg font-medium">SIG - tournée réseau d’eau potable</h3>
                    <p class="text-sm text-base-content/70">Cas terrain : saisir une borne incendie, tracer une conduite AEP et délimiter une zone de travaux.</p>
                </div>
                <div class="flex flex-wrap gap-1">
                    <span class="badge badge-outline">dessin + mesure</span>
                    <span class="badge badge-primary badge-outline">Borne incendie</span>
                    <span class="badge badge-secondary badge-outline">Conduite AEP</span>
                    <span class="badge badge-accent badge-outline">Zone de travaux</span>
                </div>
            </div>
            <div class="alert alert-info py-3 text-sm">
                <span>Les mesures affichées sont fiables pour l'aide métier interactive si les géométries source sont en WGS84 et recalculées à la sauvegarde. Pour une valeur opposable ou cadastrale, il faut valider côté serveur dans le CRS officiel de la donnée.</span>
            </div>
            <div class="grid gap-2 text-xs sm:grid-cols-3">
                <div class="rounded-box border border-base-300 bg-base-100 p-2"><strong>Borne incendie</strong><br><span class="text-base-content/70">objet ponctuel, référence, état de visite</span></div>
                <div class="rounded-box border border-base-300 bg-base-100 p-2"><strong>Conduite AEP</strong><br><span class="text-base-content/70">diamètre, matériau, longueur mesurée</span></div>
                <div class="rounded-box border border-base-300 bg-base-100 p-2"><strong>Zone de travaux</strong><br><span class="text-base-content/70">emprise, surface et périmètre</span></div>
            </div>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 460px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="13"
                    :scale="true"
                    :basemaps="$sigBasemaps"
                    :overlays="[
                        [
                            'id' => 'readonly-area',
                            'label' => 'Secteur AEP readonly',
                            'type' => 'geojson',
                            'data' => $readonlyArea,
                            'visible' => true,
                            'style' => ['color' => '#0f766e', 'weight' => 2, 'fillOpacity' => 0.1],
                        ],
                        [
                            'id' => 'editable-trace',
                            'label' => 'Conduite AEP éditable',
                            'type' => 'geojson',
                            'data' => $editableTrace,
                            'editable' => true,
                        ],
                    ]"
                    :layerControl="['mode' => 'multiple', 'lockedOverlays' => ['readonly-area']]"
                    :controls="['persist' => true, 'storageKey' => 'demo-leaflet-draw-controls']"
                    :objectTypes="$sigObjectTypes"
                    :draw="['toolbar' => true, 'groupedToolbar' => true, 'point' => true, 'line' => true, 'polygon' => true, 'rectangle' => true, 'select' => true, 'delete' => true, 'undoRedo' => true, 'selectionDetails' => ['label' => 'Détail de la sélection']]"
                    :measure="['display' => 'metric', 'showTooltip' => true, 'maxLabels' => 8]"
                    name="demo_geometry"
                    :value="$initialDrawing"
                />
            </div>
            <x-daisy::ui.overlay.modal
                id="demo-leaflet-selection-modal"
                title="Détail de la sélection SIG"
                size="5xl"
                :teleport="false"
                boxClass="space-y-3"
            >
                <p class="text-sm text-base-content/70" data-leaflet-selection-summary>
                    Sélectionnez un ou plusieurs objets, puis cliquez sur Détail de la sélection.
                </p>
                <x-daisy::ui.advanced.code-editor
                    id="demo-leaflet-selection-json"
                    language="json"
                    theme="light"
                    :readonly="true"
                    :showToolbar="true"
                    :showFormat="true"
                    height="360px"
                    value='{
  "features": []
}'
                />
            </x-daisy::ui.overlay.modal>
        </div>

        <!-- Carte avec clustering -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">Clustering (50 marqueurs)</h3>
            @php
                $clusterMarkers = [];
                for ($i = 0; $i < 50; $i++) {
                    $clusterMarkers[] = [
                        48.117 + (rand(-500, 500) / 10000),
                        -1.678 + (rand(-500, 500) / 10000),
                        '<b>Point ' . ($i + 1) . '</b>',
                    ];
                }
            @endphp
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 400px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="12"
                    :cluster="true"
                    :fitBounds="true"
                    provider="cartodb.positron"
                    :markers="$clusterMarkers"
                />
            </div>
        </div>

        <!-- Carte avec minZoom/maxZoom et preferCanvas -->
        <div class="space-y-3">
            <h3 class="text-lg font-medium">minZoom/maxZoom + preferCanvas</h3>
            <div class="min-h-0 overflow-hidden rounded-box" style="height: 300px;">
                <x-daisy::ui.media.leaflet
                    class="h-full min-h-0 rounded-box shadow"
                    :lat="48.117"
                    :lng="-1.678"
                    :zoom="12"
                    :minZoom="10"
                    :maxZoom="15"
                    :preferCanvas="true"
                    :scale="true"
                    provider="cartodb.positron"
                />
            </div>
        </div>
    </div>
</section>
