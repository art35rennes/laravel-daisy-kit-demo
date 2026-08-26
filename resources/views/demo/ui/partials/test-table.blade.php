<!-- Table -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Table</h2>
    <p class="opacity-70">Composant tabulaire client/serveur piloté par <code>table-kit</code>. La démo montre ici des cas concrets: tri initial, visibilité de colonnes, cellules HTML, sélection, détails, sous-lignes, liens, resize, édition inline et endpoint distant.</p>

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
                    id="demo-local-table"
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
                        ['key' => 'status', 'label' => 'Statut', 'cell' => ['renderer' => 'trusted-html'], 'filterable' => true, 'filter' => ['type' => 'text']],
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
                    <span class="badge badge-outline">Sélection multipage</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold">Annuaire synchronisé avec sélection</h3>
                    <p class="text-sm opacity-70">Le composant délègue ici tri, pagination, filtres, recherche et sélection de lignes à l’endpoint de démo <code>/demo/table/api/get</code>. La sélection initiale contient une ligne visible et une ligne située sur une autre page.</p>
                </div>

                <x-daisy::ui.data-display.table
                    mode="server"
                    size="sm"
                    pin-cols
                    persist-state="url"
                    state-key="demo-users-table"
                    caption="Annuaire synchronisé avec sélection"
                    endpoint="{{ route('demo.table.api.get') }}"
                    selection="multiple"
                    row-key="id"
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
                        'selection' => [
                            'selectedIds' => [1, 8],
                            'selectionScope' => 'page',
                        ],
                    ]"
                    :page-size-options="[5, 10, 25]"
                    column-visibility
                >
                    <x-slot:bulkActions>
                        <button type="button" class="btn btn-xs btn-primary" data-table-bulk-action="export">
                            Exporter la sélection
                        </button>
                        <button type="button" class="btn btn-xs btn-ghost" data-table-bulk-action="assign">
                            Assigner
                        </button>
                    </x-slot:bulkActions>
                </x-daisy::ui.data-display.table>
            </div>

            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge badge-info badge-soft">Hiérarchie</span>
                    <span class="badge badge-outline">Détails inline</span>
                    <span class="badge badge-outline">Liens sûrs</span>
                    <span class="badge badge-outline">Resize</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold">Programmes avec sous-lignes</h3>
                    <p class="text-sm opacity-70">Table locale avec recherche <code>includes</code>, détail de ligne inline, sous-lignes via <code>sub-rows-key</code>, colonnes redimensionnables et cellules lien protégées par <code>link-policy</code>.</p>
                </div>

                <x-daisy::ui.data-display.table
                    mode="client"
                    size="sm"
                    row-key="id"
                    sub-rows-key="children"
                    row-detail="inline"
                    search-mode="includes"
                    table-layout="fixed"
                    min-width="900px"
                    scroll-x="always"
                    toolbar-layout="split"
                    column-resizing
                    caption="Programmes avec sous-lignes"
                    :link-policy="['allowedSchemes' => ['https', 'mailto']]"
                    :columns="[
                        ['key' => 'name', 'label' => 'Programme', 'sortable' => true, 'size' => 220, 'minSize' => 160, 'truncate' => 'line'],
                        ['key' => 'owner', 'label' => 'Owner', 'type' => 'link', 'size' => 180],
                        ['key' => 'status', 'label' => 'Statut', 'cell' => ['renderer' => 'trusted-html'], 'size' => 140],
                        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions'],
                    ]"
                    :rows="[
                        [
                            'id' => 'release',
                            'name' => 'Release unifiée',
                            'owner' => ['href' => 'mailto:release@example.com', 'label' => 'release@example.com'],
                            'status' => '<span class=\'badge badge-success badge-soft\'>Ready</span>',
                            'detail' => 'Détail inline: jalons, risques et dépendances du programme.',
                            'actions' => ['action' => 'open', 'label' => 'Ouvrir'],
                            'children' => [
                                ['id' => 'release-api', 'name' => 'API publique', 'owner' => ['href' => 'https://example.com/api', 'label' => 'API'], 'status' => '<span class=\'badge badge-info badge-soft\'>In progress</span>', 'actions' => ['action' => 'view', 'label' => 'Voir']],
                                ['id' => 'release-docs', 'name' => 'Documentation', 'owner' => ['href' => 'https://example.com/docs', 'label' => 'Docs'], 'status' => '<span class=\'badge badge-warning badge-soft\'>Review</span>', 'actions' => ['action' => 'view', 'label' => 'Voir']],
                            ],
                        ],
                        [
                            'id' => 'security',
                            'name' => 'Durcissement sécurité',
                            'owner' => ['href' => 'https://example.com/security', 'label' => 'Security'],
                            'status' => '<span class=\'badge badge-error badge-soft\'>Blocked</span>',
                            'detail' => 'Détail inline: validation des politiques de lien et des rendus HTML.',
                            'actions' => ['action' => 'open', 'label' => 'Ouvrir'],
                            'children' => [
                                ['id' => 'security-links', 'name' => 'Politique de liens', 'owner' => ['href' => 'https://example.com/security/links', 'label' => 'Links'], 'status' => '<span class=\'badge badge-success badge-soft\'>Ready</span>', 'actions' => ['action' => 'view', 'label' => 'Voir']],
                            ],
                        ],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 4],
                        'expanded' => ['release' => true],
                        'columnSizing' => ['name' => 240],
                    ]"
                    :page-size-options="[4, 8]"
                />
            </div>

            <div class="space-y-3">
                <div class="flex flex-wrap items-center gap-2">
                    <span class="badge badge-success badge-soft">Édition</span>
                    <span class="badge badge-outline">Filtres date</span>
                    <span class="badge badge-outline">Mode row</span>
                </div>
                <div>
                    <h3 class="text-sm font-semibold">Planning éditable</h3>
                    <p class="text-sm opacity-70">Table locale avec cellules éditables, sauvegarde PATCH, filtres <code>date</code> et <code>date-range</code>, et colonnes éditables limitées.</p>
                </div>

                <x-daisy::ui.data-display.table
                    mode="client"
                    size="sm"
                    row-key="id"
                    :editable="[
                        'enabled' => true,
                        'mode' => 'row',
                        'columns' => ['name', 'status', 'joined_at'],
                        'update' => ['strategy' => 'remote', 'endpoint' => ['url' => route('demo.table.api.update'), 'method' => 'PATCH']],
                        'create' => [
                            'enabled' => true,
                            'strategy' => 'remote',
                            'endpoint' => ['url' => route('demo.table.api.create'), 'method' => 'POST'],
                            'defaults' => ['status' => 'Invited', 'joined_at' => '2026-05-01'],
                        ],
                    ]"
                    caption="Planning éditable"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true, 'editor' => ['type' => 'text', 'required' => true]],
                        ['key' => 'status', 'label' => 'Statut', 'filterable' => true, 'filter' => ['type' => 'select', 'options' => [
                            ['value' => 'Active', 'label' => 'Active'],
                            ['value' => 'Invited', 'label' => 'Invited'],
                            ['value' => 'Archived', 'label' => 'Archived'],
                        ]], 'editor' => ['type' => 'select', 'required' => true, 'options' => [
                            ['value' => 'Active', 'label' => 'Active'],
                            ['value' => 'Invited', 'label' => 'Invited'],
                            ['value' => 'Archived', 'label' => 'Archived'],
                        ]]],
                        ['key' => 'joined_at', 'label' => 'Entrée', 'sortable' => true, 'filterable' => true, 'filter' => ['type' => 'date'], 'editor' => ['type' => 'date', 'required' => true]],
                    ]"
                    :filters="[
                        ['id' => 'joined_period', 'label' => 'Période', 'type' => 'date-range', 'filterKeyFrom' => 'joined_after', 'filterKeyTo' => 'joined_before'],
                    ]"
                    :rows="[
                        ['id' => 1, 'name' => 'Cy Ganderton', 'status' => 'Active', 'joined_at' => '2026-01-08'],
                        ['id' => 2, 'name' => 'Hart Hagerty', 'status' => 'Invited', 'joined_at' => '2026-01-16'],
                        ['id' => 3, 'name' => 'Brice Swyre', 'status' => 'Archived', 'joined_at' => '2026-02-03'],
                        ['id' => 4, 'name' => 'Jolie Winters', 'status' => 'Active', 'joined_at' => '2026-02-11'],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 4],
                    ]"
                    :page-size-options="[4, 8]"
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
                    <li>Sélection de lignes avec conservation entre pages</li>
                    <li>Détails inline, sous-lignes et liens sécurisés</li>
                    <li>Resize de colonnes, recherche <code>fuzzy</code>/<code>includes</code> et layout fixe</li>
                    <li>Édition inline avec endpoint PATCH et filtres <code>date</code>/<code>date-range</code></li>
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
