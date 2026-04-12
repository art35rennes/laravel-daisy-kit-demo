<!-- Token Input -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Token Input</h2>
    <p class="opacity-70">Saisie de listes de valeurs avec suggestions, validation légère et hidden inputs synchronisés pour les formulaires.</p>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="space-y-3">
            <div class="text-sm opacity-70">Preset email avec valeurs préremplies</div>
            <x-daisy::ui.inputs.token-input
                name="recipients"
                :values="['alice@example.com', 'bob@example.com']"
                placeholder="Ajouter des destinataires"
            />
        </div>

        <div class="space-y-3">
            <div class="text-sm opacity-70">Suggestions locales, taille compacte et limite</div>
            <x-daisy::ui.inputs.token-input
                name="tags"
                preset="text"
                size="sm"
                color="primary"
                :maxItems="4"
                :suggestions="[
                    ['value' => 'laravel', 'label' => 'Laravel'],
                    ['value' => 'livewire', 'label' => 'Livewire'],
                    ['value' => 'alpine', 'label' => 'Alpine.js'],
                    ['value' => 'tailwind', 'label' => 'Tailwind CSS'],
                ]"
                placeholder="Ajouter un tag"
            />
        </div>
    </div>
</section>
