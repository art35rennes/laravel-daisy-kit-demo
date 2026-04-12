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
                    :markers="[
                        [48.116, -1.675, '<b>Centre</b>'],
                        [48.121, -1.682, '<b>Spot 1</b>'],
                        [48.108, -1.669, '<b>Spot 2</b>'],
                    ]"
                />
            </div>
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
                />
            </div>
        </div>
    </div>
</section>
