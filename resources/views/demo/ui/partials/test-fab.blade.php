{{-- FAB / Speed dial (daisyUI 5.1+) : le premier contrôle focusable doit être un div (Safari). --}}
<section class="space-y-6 rounded-box bg-base-200 p-6">
    <h2 class="text-lg font-medium">FAB / Speed dial</h2>
    <p class="text-sm text-base-content/70 max-w-2xl">
        Bouton flottant avec actions secondaires. Les zones ci-dessous sont isolées pour éviter de recouvrir toute la page.
    </p>

    <div class="grid gap-8 lg:grid-cols-2">
        <div class="space-y-2">
            <p class="text-xs font-medium uppercase opacity-60">Vertical (défaut)</p>
            <div class="relative h-56 w-full overflow-hidden rounded-box border border-base-300 bg-base-100">
                <p class="absolute left-3 top-3 text-xs text-base-content/60">Zone démo</p>
                <x-daisy::ui.utilities.fab class="absolute bottom-3 right-3">
                    <x-slot:trigger>
                        <div tabindex="0" role="button" class="btn btn-lg btn-circle btn-primary" aria-label="Ouvrir les actions rapides">
                            <x-bi-plus-lg class="size-6" />
                        </div>
                    </x-slot:trigger>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="Éditer">
                        <x-bi-pencil class="size-5" />
                    </button>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="Joindre">
                        <x-bi-paperclip class="size-5" />
                    </button>
                    <button type="button" class="btn btn-lg btn-circle btn-error" aria-label="Supprimer">
                        <x-bi-trash class="size-5" />
                    </button>
                </x-daisy::ui.utilities.fab>
            </div>
        </div>

        <div class="space-y-2">
            <p class="text-xs font-medium uppercase opacity-60">Mode <code class="kbd kbd-sm">fab-flower</code></p>
            <div class="relative h-56 w-full overflow-hidden rounded-box border border-base-300 bg-base-100">
                <p class="absolute left-3 top-3 text-xs text-base-content/60">Disposition en arc</p>
                <x-daisy::ui.utilities.fab flower class="absolute bottom-3 right-3">
                    <x-slot:trigger>
                        <div tabindex="0" role="button" class="btn btn-lg btn-circle btn-secondary" aria-label="Menu radial">
                            <x-bi-grid-3x3-gap class="size-6" />
                        </div>
                    </x-slot:trigger>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="Un">1</button>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="Deux">2</button>
                    <button type="button" class="btn btn-lg btn-circle" aria-label="Trois">3</button>
                </x-daisy::ui.utilities.fab>
            </div>
        </div>
    </div>
</section>
