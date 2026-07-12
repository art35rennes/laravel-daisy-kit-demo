<!-- Card -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Card</h2>
    <div class="grid md:grid-cols-3 gap-6">
        <x-daisy::ui.layout.card title="Titre" color="base-100" size="sm">
            Contenu simple
            <x-slot:actions>
                <x-daisy::ui.inputs.button size="sm">Action</x-daisy::ui.inputs.button>
            </x-slot:actions>
        </x-daisy::ui.layout.card>
        <x-daisy::ui.layout.card title="Bordered" :bordered="true" :dash="true">
            Carte avec bordure
        </x-daisy::ui.layout.card>
        <x-daisy::ui.layout.card title="Compact" :compact="true" size="lg">
            Moins d'espacement
        </x-daisy::ui.layout.card>
    </div>
    <div class="grid md:grid-cols-2 gap-6">
        <x-daisy::ui.layout.card :side="true" title="Side" imageAlt="Exemple image">
            <x-slot:figure>
                <img src="/img/divers/dummy-200x200-Map.jpg" alt="" />
            </x-slot:figure>
            Carte avec image latérale
        </x-daisy::ui.layout.card>
        <x-daisy::ui.layout.card :imageFull="true" title="Image Full" imageUrl="/img/food/dummy-600x800-Strawberry.jpg" imageAlt="Image de démonstration">
            Texte sur image full
        </x-daisy::ui.layout.card>
    </div>
    <fieldset class="grid gap-4 md:grid-cols-2">
        <legend class="text-sm font-semibold">Cartes sélectionnables</legend>
        <label>
            <x-daisy::ui.layout.card title="Plan Starter" :bordered="true" :selectable="true" :checked="true" role="radio">
                <input type="radio" name="demo-plan" value="starter" class="sr-only" checked />
                10 projets et 5 membres inclus.
            </x-daisy::ui.layout.card>
        </label>
        <label>
            <x-daisy::ui.layout.card title="Plan Pro" :bordered="true" :selectable="true" :checked="false" role="radio">
                <input type="radio" name="demo-plan" value="pro" class="sr-only" />
                Projets et membres illimités.
            </x-daisy::ui.layout.card>
        </label>
    </fieldset>
</section>

