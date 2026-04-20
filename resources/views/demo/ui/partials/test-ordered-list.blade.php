<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Ordered List</h2>
    <p class="opacity-70">Liste ordonnée sortable avec persistance optionnelle de l'ordre côté formulaire.</p>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
            <h3 class="mb-2 text-sm font-semibold">Roadmap éditoriale</h3>
            <x-daisy::ui.layout.ordered-list
                :sortable="true"
                name="content_roadmap"
                :persist="true"
                :items="[
                    ['id' => 'brief', 'label' => 'Valider le brief', 'content' => 'Confirmer le message, le public et les contraintes.'],
                    ['id' => 'draft', 'label' => 'Rédiger le draft', 'content' => 'Assembler le premier jet pour revue interne.'],
                    ['id' => 'review', 'label' => 'Passer en revue', 'content' => 'Produit, support et marketing valident le contenu.'],
                    ['id' => 'ship', 'label' => 'Publier', 'content' => 'Planifier la diffusion et mesurer la portée.'],
                ]"
            />
        </div>

        <div class="space-y-4">
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <h3 class="mb-2 text-sm font-semibold">Avec slot libre</h3>
                <x-daisy::ui.layout.ordered-list :sortable="true">
                    <li class="list-row" data-ordered-list-item data-id="triage">
                        <div class="font-medium">Trier les retours</div>
                    </li>
                    <li class="list-row" data-ordered-list-item data-id="assign">
                        <div class="font-medium">Assigner les actions</div>
                    </li>
                    <li class="list-row" data-ordered-list-item data-id="close">
                        <div class="font-medium">Clôturer la boucle</div>
                    </li>
                </x-daisy::ui.layout.ordered-list>
            </div>

            <div class="rounded-box border border-dashed border-base-content/15 bg-base-100/60 p-4 text-sm opacity-70">
                <p><code>sortable</code> active le réordonnancement.</p>
                <p><code>persist</code> + <code>name</code> ajoutent le champ caché sérialisé.</p>
                <p><code>handle</code> reste activé par défaut pour éviter les drag accidentels.</p>
            </div>
        </div>
    </div>
</section>
