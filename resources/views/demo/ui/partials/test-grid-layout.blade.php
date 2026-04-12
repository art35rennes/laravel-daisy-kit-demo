<div class="space-y-4">
    <div class="font-semibold">Grid Layout</div>

    <!-- 1) Grille simple, fallback responsive -->
    <div class="card bg-base-100">
        <div class="card-body">
            <div class="mb-2 text-sm opacity-70">Grille simple (col-sm-12 col-xl-4)</div>
            <x-daisy::ui.layout.grid-layout gap="6" align="start">
                <div class="col-sm-12 col-xl-4"><div class="p-4 bg-base-200 rounded">Col 1</div></div>
                <div class="col-sm-12 col-xl-4"><div class="p-4 bg-base-200 rounded">Col 2</div></div>
                <div class="col-sm-12 col-xl-4"><div class="p-4 bg-base-200 rounded">Col 3</div></div>
            </x-daisy::ui.layout.grid-layout>
        </div>
    </div>

    <!-- 2) Largeurs variées, offsets -->
    <div class="card bg-base-100">
        <div class="card-body">
            <div class="mb-2 text-sm opacity-70">Offsets et largeurs variées</div>
            <x-daisy::ui.layout.grid-layout gap="4" align="center" class="bg-base-100">
                <div class="col-12 col-md-6 col-lg-3"><div class="p-4 bg-base-200 rounded">A</div></div>
                <div class="col-12 col-md-6 col-lg-6 offset-lg-3"><div class="p-4 bg-base-200 rounded">B (offset lg-3)</div></div>
                <div class="col-12 col-md-12 col-lg-3"><div class="p-4 bg-base-200 rounded">C</div></div>
            </x-daisy::ui.layout.grid-layout>
        </div>
    </div>

    <!-- 3) Layout magazine -->
    <div class="card bg-base-100">
        <div class="card-body">
            <div class="mb-2 text-sm opacity-70">Layout “magazine”</div>
            <x-daisy::ui.layout.grid-layout gap="3">
                <div class="col-12 col-md-8"><div class="p-4 bg-base-200 rounded">Contenu principal</div></div>
                <div class="col-12 col-md-4"><div class="p-4 bg-base-200 rounded">Sidebar</div></div>
                <div class="col-12 col-md-4"><div class="p-4 bg-base-200 rounded">Bloc A</div></div>
                <div class="col-12 col-md-4"><div class="p-4 bg-base-200 rounded">Bloc B</div></div>
                <div class="col-12 col-md-4"><div class="p-4 bg-base-200 rounded">Bloc C</div></div>
            </x-daisy::ui.layout.grid-layout>
        </div>
    </div>

    <!-- 4) DaisyUI inside -->
    <div class="card bg-base-100">
        <div class="card-body">
            <div class="mb-2 text-sm opacity-70">Composants DaisyUI dans la grille</div>
            <x-daisy::ui.layout.grid-layout gap="5" align="start">
                <div class="col-12 col-lg-6">
                    <x-daisy::ui.layout.card title="Carte 1">
                        <div>Contenu</div>
                    </x-daisy::ui.layout.card>
                </div>
                <div class="col-12 col-lg-6">
                    <x-daisy::ui.layout.card title="Carte 2">
                        <div>Contenu</div>
                    </x-daisy::ui.layout.card>
                </div>
            </x-daisy::ui.layout.grid-layout>
        </div>
    </div>

    <!-- 5) Exemple visuel (cartes avec images & badges) -->
    <div class="card bg-base-100">
        <div class="card-body">
            <div class="mb-2 text-sm opacity-70">Exemple visuel: cartes produits (images, badges, boutons)</div>
            <x-daisy::ui.layout.grid-layout gap="4" class="items-stretch">
                <div class="col-12 col-sm-6 col-lg-4 flex">
                    <x-daisy::ui.layout.card class="h-full w-full" title="Strawberry" imageUrl="/img/food/dummy-600x800-Strawberry.jpg" imageAlt="Strawberry" figureClass="aspect-[4/3] overflow-hidden" imageClass="h-full w-full object-cover">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge badge-primary badge-sm">Food</span>
                            <span class="badge badge-ghost badge-sm">New</span>
                        </div>
                        <x-slot:actions>
                            <button type="button" class="btn btn-primary btn-sm">Commander</button>
                        </x-slot:actions>
                    </x-daisy::ui.layout.card>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 flex">
                    <x-daisy::ui.layout.card class="h-full w-full" title="Bottle" imageUrl="/img/object/dummy-454x280-Bottle.jpg" imageAlt="Bottle" figureClass="aspect-[4/3] overflow-hidden" imageClass="h-full w-full object-cover">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge badge-accent badge-sm">Object</span>
                            <span class="badge badge-ghost badge-sm">Promo</span>
                        </div>
                        <x-slot:actions>
                            <button type="button" class="btn btn-secondary btn-sm">Détails</button>
                        </x-slot:actions>
                    </x-daisy::ui.layout.card>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 flex">
                    <x-daisy::ui.layout.card class="h-full w-full" title="Chip" imageUrl="/img/business/dummy-454x280-Chip.jpg" imageAlt="Chip" figureClass="aspect-[4/3] overflow-hidden" imageClass="h-full w-full object-cover">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge badge-info badge-sm">Business</span>
                            <span class="badge badge-ghost badge-sm">Hot</span>
                        </div>
                        <x-slot:actions>
                            <button type="button" class="btn btn-outline btn-sm">Ajouter</button>
                        </x-slot:actions>
                    </x-daisy::ui.layout.card>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 flex">
                    <x-daisy::ui.layout.card class="h-full w-full" title="Windflower" imageUrl="/img/object/dummy-600x900-Windflower.jpg" imageAlt="Windflower" figureClass="aspect-[4/3] overflow-hidden" imageClass="h-full w-full object-cover">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge badge-success badge-sm">Feature</span>
                            <span class="badge badge-ghost badge-sm">Nature</span>
                        </div>
                        <x-slot:actions>
                            <button type="button" class="btn btn-primary btn-sm">En savoir plus</button>
                        </x-slot:actions>
                    </x-daisy::ui.layout.card>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 flex">
                    <x-daisy::ui.layout.card class="h-full w-full" title="Portrait" imageUrl="/img/people/dummy-600x450-RobertDeNiro.jpg" imageAlt="Portrait" figureClass="aspect-[4/3] overflow-hidden" imageClass="h-full w-full object-cover">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge badge-warning badge-sm">People</span>
                            <span class="badge badge-ghost badge-sm">Cinéma</span>
                        </div>
                        <x-slot:actions>
                            <button type="button" class="btn btn-ghost btn-sm">Voir</button>
                        </x-slot:actions>
                    </x-daisy::ui.layout.card>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 flex">
                    <x-daisy::ui.layout.card class="h-full w-full" title="Utrecht" imageUrl="/img/divers/dummy-576x1024-Utrecht.jpg" imageAlt="Utrecht" figureClass="aspect-[4/3] overflow-hidden" imageClass="h-full w-full object-cover">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="badge badge-neutral badge-sm">Divers</span>
                            <span class="badge badge-ghost badge-sm">Voyage</span>
                        </div>
                        <x-slot:actions>
                            <button type="button" class="btn btn-outline btn-sm">Explorer</button>
                        </x-slot:actions>
                    </x-daisy::ui.layout.card>
                </div>
            </x-daisy::ui.layout.grid-layout>
        </div>
    </div>
</div>


