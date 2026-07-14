<!-- Calendar -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Calendar</h2>
    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
        <!-- Cally (via npm) : date simple -->
        <div class="bg-base-100 card-border shadow rounded-box p-4">
            <div class="text-sm font-medium opacity-70 mb-2">Cally - Date (1 mois)</div>
            <x-daisy::ui.advanced.calendar provider="cally" mode="date" class="cally" />
        </div>

        <!-- Cally : range + 2 mois -->
        <div class="bg-base-100 card-border shadow rounded-box p-4">
            <div class="text-sm font-medium opacity-70 mb-2">Cally - Range (2 mois)</div>
            <x-daisy::ui.advanced.calendar provider="cally" mode="range" :months="2" class="cally" />
        </div>

        <!-- Cally : multi + 2 mois + locale FR -->
        <div class="bg-base-100 card-border shadow rounded-box p-4">
            <div class="text-sm font-medium opacity-70 mb-2">Cally - Multi (2 mois, fr-FR)</div>
            <x-daisy::ui.advanced.calendar provider="cally" mode="multi" :months="2" locale="fr-FR" class="cally" />
        </div>

        <div class="bg-base-100 card-border shadow rounded-box p-4">
            <div class="text-sm font-medium opacity-70 mb-2">Vanilla Calendar Pro - Date</div>
            <x-daisy::ui.advanced.calendar provider="vanilla" name="demo_vanilla_date" value="2026-07-14" locale="fr-FR" />
        </div>

        <div class="bg-base-100 card-border shadow rounded-box p-4">
            <div class="text-sm font-medium opacity-70 mb-2">Vanilla Calendar Pro - Plage (2 mois)</div>
            <x-daisy::ui.advanced.calendar
                provider="vanilla"
                name="demo_vanilla_range"
                mode="range"
                :months="2"
                value="2026-07-14,2026-07-18"
                min="2026-07-01"
                max="2026-07-31"
                locale="fr-FR"
            />
        </div>

        <!-- Native input type=date -->
        <div class="bg-base-100 card-border shadow rounded-box p-4">
            <div class="text-sm font-medium opacity-70 mb-2">Input natif - type="date"</div>
            <x-daisy::ui.advanced.calendar provider="native" min="2026-07-01" max="2026-07-31" class="w-56" />
        </div>
    </div>
</section>

