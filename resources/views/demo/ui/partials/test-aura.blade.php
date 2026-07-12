<!-- Aura -->
<section class="space-y-4 rounded-box bg-base-200 p-6">
    <h2 class="text-lg font-medium">Aura</h2>
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <x-daisy::ui.advanced.aura variant="rainbow" size="lg">
            <x-daisy::ui.layout.card title="Mise en avant" :bordered="true" class="h-full">
                Une bordure animée pour attirer l’attention sur une action prioritaire.
            </x-daisy::ui.layout.card>
        </x-daisy::ui.advanced.aura>
        <x-daisy::ui.advanced.aura variant="gold" size="md">
            <x-daisy::ui.inputs.button color="primary">Accès premium</x-daisy::ui.inputs.button>
        </x-daisy::ui.advanced.aura>
        <x-daisy::ui.advanced.aura variant="holo" size="sm">
            <div class="rounded-box bg-base-100 p-4 text-sm">Aura holo compacte</div>
        </x-daisy::ui.advanced.aura>
    </div>
</section>
