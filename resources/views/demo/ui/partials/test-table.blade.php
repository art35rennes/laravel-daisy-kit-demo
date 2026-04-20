<!-- Table -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Table</h2>
    <p class="opacity-70">Composant tabulaire client/serveur piloté par <code>table-kit</code>. La démo montre ici des cas concrets: tri initial, visibilité de colonnes, cellules HTML, table compacte et endpoint distant.</p>

    <div class="grid gap-6 xl:grid-cols-[minmax(0,1.2fr)_minmax(18rem,0.8fr)]">
        <div class="space-y-6">
            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge badge-primary badge-soft">Client</span>
                    <span class="badge badge-outline">Tri initial</span>
                    <span class="badge badge-outline">Colonnes masquables</span>
                    <span class="badge badge-outline">Filtres</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold">Pipeline équipe produit</h3>
                    <p class="text-sm opacity-70">Table locale avec statut enrichi, priorité colorée, tri initial sur la priorité, filtres déclaratifs et colonne secondaire cachée par défaut.</p>
                </div>

                <x-daisy::ui.data-display.table
                    mode="client"
                    zebra
                    size="sm"
                    caption="Pipeline équipe produit"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true, 'width' => '16rem'],
                        ['key' => 'team', 'label' => 'Équipe', 'sortable' => true, 'filterable' => true, 'filter' => ['type' => 'select', 'options' => [
                            ['value' => 'Platform', 'label' => 'Platform'],
                            ['value' => 'Growth', 'label' => 'Growth'],
                            ['value' => 'Data', 'label' => 'Data'],
                            ['value' => 'Legal', 'label' => 'Legal'],
                        ]]],
                        ['key' => 'priority', 'label' => 'Priorité', 'sortable' => true, 'headerClass' => 'text-right', 'cellClass' => 'text-right font-medium'],
                        ['key' => 'status', 'label' => 'Statut', 'html' => true, 'filterable' => true, 'filter' => ['type' => 'text']],
                        ['key' => 'owner', 'label' => 'Owner', 'visible' => false],
                    ]"
                    :rows="[
                        ['name' => 'Refonte billing', 'team' => 'Platform', 'priority' => '1', 'status' => '<span class=\'badge badge-error badge-soft\'>Blocked</span>', 'owner' => 'Marie'],
                        ['name' => 'Portail partenaires', 'team' => 'Growth', 'priority' => '2', 'status' => '<span class=\'badge badge-warning badge-soft\'>Review</span>', 'owner' => 'Sami'],
                        ['name' => 'Search analytics', 'team' => 'Data', 'priority' => '3', 'status' => '<span class=\'badge badge-info badge-soft\'>In progress</span>', 'owner' => 'Nina'],
                        ['name' => 'SDK export', 'team' => 'Platform', 'priority' => '2', 'status' => '<span class=\'badge badge-success badge-soft\'>Ready</span>', 'owner' => 'Leo'],
                        ['name' => 'Audit RGPD', 'team' => 'Legal', 'priority' => '1', 'status' => '<span class=\'badge badge-error badge-soft\'>Blocked</span>', 'owner' => 'Claire'],
                        ['name' => 'Nouveaux onboarding mails', 'team' => 'Growth', 'priority' => '4', 'status' => '<span class=\'badge badge-ghost\'>Queued</span>', 'owner' => 'Iris'],
                    ]"
                    :initial-state="[
                        'sorting' => [
                            ['id' => 'priority', 'desc' => false],
                        ],
                        'pagination' => ['pageSize' => 3],
                        'columnVisibility' => [
                            'owner' => false,
                        ],
                    ]"
                    :page-size-options="[3, 6]"
                    column-visibility
                />
            </div>

            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge badge-secondary badge-soft">Serveur</span>
                    <span class="badge badge-outline">Pagination distante</span>
                    <span class="badge badge-outline">Recherche</span>
                    <span class="badge badge-outline">État persistant</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold">Annuaire synchronisé</h3>
                    <p class="text-sm opacity-70">Le composant délègue ici tri, pagination, filtres et recherche à l’endpoint de démo <code>/demo/table/api/get</code>, avec persistance de l’état dans l’URL.</p>
                </div>

                <x-daisy::ui.data-display.table
                    mode="server"
                    size="sm"
                    pin-cols
                    persist-state="url"
                    state-key="demo-users-table"
                    caption="Annuaire synchronisé"
                    endpoint="{{ route('demo.table.api.get') }}"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true, 'width' => '14rem'],
                        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
                        ['key' => 'status', 'label' => 'Statut', 'sortable' => true, 'filterable' => true, 'filterKey' => 'status', 'filter' => ['type' => 'select', 'options' => [
                            ['value' => 'Active', 'label' => 'Active'],
                            ['value' => 'Invited', 'label' => 'Invited'],
                            ['value' => 'Archived', 'label' => 'Archived'],
                        ]]],
                    ]"
                    :filters="[
                        ['id' => 'email_domain', 'label' => 'Domaine', 'type' => 'select', 'filterKey' => 'email_domain', 'options' => [
                            ['value' => 'example.com', 'label' => 'example.com'],
                        ]],
                        ['id' => 'active_only', 'label' => 'Actifs', 'type' => 'boolean', 'filterKey' => 'active_only'],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 5],
                        'sorting' => [
                            ['id' => 'name', 'desc' => false],
                        ],
                    ]"
                    :page-size-options="[5, 10, 25]"
                    column-visibility
                />
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4 space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge badge-accent badge-soft">Compact</span>
                    <span class="badge badge-outline">Sans recherche</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold">Checklist support</h3>
                    <p class="text-sm opacity-70">Variante dense pour tableaux opérationnels courts, avec barre de recherche désactivée et lignes épinglées.</p>
                </div>

                <x-daisy::ui.data-display.table
                    mode="client"
                    size="xs"
                    pin-rows
                    pin-cols
                    :search="false"
                    caption="Checklist support"
                    :columns="[
                        ['key' => 'ticket', 'label' => 'Ticket', 'width' => '7rem'],
                        ['key' => 'queue', 'label' => 'File'],
                        ['key' => 'sla', 'label' => 'SLA', 'headerClass' => 'text-right', 'cellClass' => 'text-right'],
                    ]"
                    :rows="[
                        ['ticket' => '#4210', 'queue' => 'Billing', 'sla' => '12 min'],
                        ['ticket' => '#4211', 'queue' => 'Auth', 'sla' => '18 min'],
                        ['ticket' => '#4212', 'queue' => 'Search', 'sla' => '24 min'],
                        ['ticket' => '#4213', 'queue' => 'Exports', 'sla' => '31 min'],
                        ['ticket' => '#4214', 'queue' => 'Billing', 'sla' => '42 min'],
                        ['ticket' => '#4215', 'queue' => 'Auth', 'sla' => '55 min'],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 3],
                    ]"
                    :page-size-options="[3, 6]"
                />
            </div>

            <div class="rounded-box border border-dashed border-base-content/15 bg-base-100/60 p-4">
                <h3 class="text-sm font-semibold mb-2">Ce que la démo couvre</h3>
                <ul class="space-y-2 text-sm opacity-70">
                    <li>Tri initial via <code>initialState.sorting</code></li>
                    <li>Pagination multi-page en client et serveur</li>
                    <li>Filtres texte, select et booléen via <code>filter</code> et <code>filters</code></li>
                    <li>Masquage dynamique avec <code>column-visibility</code></li>
                    <li>Persistance de l’état avec <code>persist-state</code> et <code>state-key</code></li>
                    <li>Cellules HTML sûres avec <code>html =&gt; true</code></li>
                    <li>Tables denses avec <code>size</code>, <code>pinRows</code> et <code>pinCols</code></li>
                </ul>
            </div>
        </div>
    </div>
</section>
