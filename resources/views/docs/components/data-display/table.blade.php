@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'data-display';
    $name = 'table';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'client', 'label' => 'Mode client'],
        ['id' => 'filters', 'label' => 'Filtres'],
        ['id' => 'selection', 'label' => 'Sélection'],
        ['id' => 'advanced', 'label' => 'Détails et liens'],
        ['id' => 'editable', 'label' => 'Édition'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'server', 'label' => 'Mode serveur'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $clientCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="client"
    zebra
    size="sm"
    caption="Utilisateurs"
    :columns="[
        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
        ['key' => 'team', 'label' => 'Équipe', 'sortable' => true, 'filterable' => true, 'filter' => [
            'type' => 'select',
            'options' => [
                ['value' => 'Platform', 'label' => 'Platform'],
                ['value' => 'Growth', 'label' => 'Growth'],
            ],
        ]],
        ['key' => 'status', 'label' => 'Statut', 'cell' => ['renderer' => 'trusted-html'], 'filterable' => true, 'filter' => ['type' => 'text']],
    ]"
    :rows="[
        ['name' => 'Cy Ganderton', 'team' => 'Platform', 'status' => '<span class=\'badge badge-primary badge-soft\'>Active</span>'],
        ['name' => 'Hart Hagerty', 'team' => 'Growth', 'status' => '<span class=\'badge badge-success badge-soft\'>Invited</span>'],
        ['name' => 'Brice Swyre', 'team' => 'Platform', 'status' => '<span class=\'badge badge-ghost\'>Archived</span>'],
    ]"
    :initial-state="[
        'pagination' => ['pageSize' => 2],
    ]"
    :page-size-options="[2, 4, 6]"
    column-visibility
/>
CODE;

    $filtersCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="server"
    persist-state="url"
    state-key="users-table"
    endpoint="{{ route('demo.table.api.get') }}"
    :columns="[
        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
        ['key' => 'status', 'label' => 'Statut', 'sortable' => true, 'filterable' => true, 'filterKey' => 'status', 'filter' => [
            'type' => 'select',
            'options' => [
                ['value' => 'Active', 'label' => 'Active'],
                ['value' => 'Invited', 'label' => 'Invited'],
                ['value' => 'Archived', 'label' => 'Archived'],
            ],
        ]],
    ]"
    :filters="[
        ['id' => 'email_domain', 'label' => 'Domaine', 'type' => 'select', 'filterKey' => 'email_domain', 'options' => [
            ['value' => 'example.com', 'label' => 'example.com'],
        ]],
        ['id' => 'active_only', 'label' => 'Actifs', 'type' => 'boolean', 'filterKey' => 'active_only'],
    ]"
/>
CODE;

    $selectionCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="server"
    endpoint="{{ route('demo.table.api.get') }}"
    selection="multiple"
    row-key="id"
    :columns="$columns"
    :filters="$filters"
>
    <x-slot:bulkActions>
        <button type="button" class="btn btn-xs btn-primary" data-table-bulk-action="export">
            Exporter la sélection
        </button>
    </x-slot:bulkActions>
</x-daisy::ui.data-display.table>
CODE;

    $advancedCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="client"
    row-key="id"
    sub-rows-key="children"
    row-detail="inline"
    search-mode="includes"
    table-layout="fixed"
    min-width="900px"
    scroll-x="always"
    toolbar-layout="split"
    column-resizing
    :link-policy="['allowedSchemes' => ['https', 'mailto']]"
    :columns="[
        ['key' => 'name', 'label' => 'Programme', 'size' => 220],
        ['key' => 'owner', 'label' => 'Owner', 'type' => 'link'],
        ['key' => 'actions', 'label' => 'Actions', 'type' => 'actions'],
    ]"
    :rows="$rows"
    :initial-state="[
        'expanded' => ['release' => true],
        'columnSizing' => ['name' => 240],
    ]"
/>
CODE;

    $editableCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="client"
    row-key="id"
    editable
    edit-endpoint="{{ route('demo.table.api.update') }}"
    edit-method="PATCH"
    edit-mode="row"
    :editable-columns="['name', 'status', 'joined_at']"
    :columns="[
        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
        ['key' => 'status', 'label' => 'Statut', 'filterable' => true, 'filter' => ['type' => 'select', 'options' => $statusOptions]],
        ['key' => 'joined_at', 'label' => 'Entrée', 'filterable' => true, 'filter' => ['type' => 'date']],
    ]"
    :filters="[
        ['id' => 'joined_period', 'label' => 'Période', 'type' => 'date-range', 'filterKeyFrom' => 'joined_after', 'filterKeyTo' => 'joined_before'],
    ]"
    :rows="$rows"
/>
CODE;

    $variantsCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="client"
    size="xs"
    pin-rows
    pin-cols
    :search="false"
    :columns="[
        ['key' => 'ticket', 'label' => 'Ticket'],
        ['key' => 'queue', 'label' => 'File'],
        ['key' => 'sla', 'label' => 'SLA', 'headerClass' => 'text-right', 'cellClass' => 'text-right'],
    ]"
    :rows="[
        ['ticket' => '#4210', 'queue' => 'Billing', 'sla' => '12 min'],
        ['ticket' => '#4211', 'queue' => 'Auth', 'sla' => '18 min'],
        ['ticket' => '#4212', 'queue' => 'Search', 'sla' => '24 min'],
    ]"
    :initial-state="[
        'pagination' => ['pageSize' => 3],
    ]"
    :page-size-options="[3, 6]"
/>
CODE;

    $serverCode = <<<'CODE'
<x-daisy::ui.data-display.table
    mode="server"
    size="sm"
    pin-cols
    persist-state="url"
    state-key="demo-users-table"
    caption="Annuaire synchronisé"
    endpoint="{{ route('demo.table.api.get') }}"
    :columns="[
        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
        ['key' => 'status', 'label' => 'Statut', 'sortable' => true, 'filterable' => true, 'filterKey' => 'status', 'filter' => [
            'type' => 'select',
            'options' => [
                ['value' => 'Active', 'label' => 'Active'],
                ['value' => 'Invited', 'label' => 'Invited'],
                ['value' => 'Archived', 'label' => 'Archived'],
            ],
        ]],
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
CODE;
@endphp

<x-daisy::docs.page
    title="Table"
    category="data-display"
    name="table"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Table"
            subtitle="Composant tabulaire Daisy Kit avec mode client ou serveur, filtres, persistance d’état, tri, recherche et visibilité des colonnes."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="table">
        <x-slot:preview>
            <x-daisy::ui.data-display.table
                mode="client"
                zebra
                size="sm"
                caption="Utilisateurs"
                :columns="[
                    ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
                    ['key' => 'team', 'label' => 'Équipe', 'sortable' => true, 'filterable' => true, 'filter' => [
                        'type' => 'select',
                        'options' => [
                            ['value' => 'Platform', 'label' => 'Platform'],
                            ['value' => 'Growth', 'label' => 'Growth'],
                        ],
                    ]],
                    ['key' => 'status', 'label' => 'Statut', 'cell' => ['renderer' => 'trusted-html'], 'filterable' => true, 'filter' => ['type' => 'text']],
                ]"
                :rows="[
                    ['name' => 'Cy Ganderton', 'team' => 'Platform', 'status' => '<span class=\'badge badge-primary badge-soft\'>Active</span>'],
                    ['name' => 'Hart Hagerty', 'team' => 'Growth', 'status' => '<span class=\'badge badge-success badge-soft\'>Invited</span>'],
                    ['name' => 'Brice Swyre', 'team' => 'Platform', 'status' => '<span class=\'badge badge-ghost\'>Archived</span>'],
                ]"
                :initial-state="[
                    'pagination' => ['pageSize' => 2],
                ]"
                :page-size-options="[2, 4, 6]"
                column-visibility
            />
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$clientCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="420px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="filters" title="Filtres">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Déclarez des filtres directement sur les colonnes via <code>filterable</code> + <code>filter</code>,
                    ou ajoutez des contrôles de toolbar avec la prop <code>filters</code>. Les types supportés sont
                    <code>text</code>, <code>select</code>, <code>boolean</code>, <code>date</code> et <code>date-range</code>.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.table
                    mode="server"
                    persist-state="url"
                    state-key="users-table"
                    endpoint="{{ route('demo.table.api.get') }}"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
                        ['key' => 'status', 'label' => 'Statut', 'sortable' => true, 'filterable' => true, 'filterKey' => 'status', 'filter' => [
                            'type' => 'select',
                            'options' => [
                                ['value' => 'Active', 'label' => 'Active'],
                                ['value' => 'Invited', 'label' => 'Invited'],
                                ['value' => 'Archived', 'label' => 'Archived'],
                            ],
                        ]],
                    ]"
                    :filters="[
                        ['id' => 'email_domain', 'label' => 'Domaine', 'type' => 'select', 'filterKey' => 'email_domain', 'options' => [
                            ['value' => 'example.com', 'label' => 'example.com'],
                        ]],
                        ['id' => 'active_only', 'label' => 'Actifs', 'type' => 'boolean', 'filterKey' => 'active_only'],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 5],
                    ]"
                    :page-size-options="[5, 10]"
                />
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$filtersCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="380px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="selection" title="Sélection">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Activez <code>selection="multiple"</code> avec un <code>row-key</code> stable. La sélection persiste
                    entre les pages et le tri. Une modification de filtre ou de recherche réinitialise la sélection.
                    Après “tous les résultats filtrés”, décocher une ligne l’ajoute à <code>excludedIds</code> et le
                    feedback revient aux compteurs de page et hors page. Le bandeau d’actions reste visible; les actions
                    indisponibles sont désactivées. Une barre custom peut écouter <code>daisy:table-selection-changed</code>
                    ou utiliser <code>window.DaisyTable.table(...).selection()</code>.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.table
                    mode="server"
                    size="sm"
                    endpoint="{{ route('demo.table.api.get') }}"
                    selection="multiple"
                    row-key="id"
                    caption="Annuaire avec actions de masse"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
                        ['key' => 'email', 'label' => 'Email'],
                        ['key' => 'status', 'label' => 'Statut', 'filterable' => true, 'filterKey' => 'status', 'filter' => [
                            'type' => 'select',
                            'options' => [
                                ['value' => 'Active', 'label' => 'Active'],
                                ['value' => 'Invited', 'label' => 'Invited'],
                                ['value' => 'Archived', 'label' => 'Archived'],
                            ],
                        ]],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 5],
                    ]"
                    :page-size-options="[5, 10]"
                >
                    <x-slot:bulkActions>
                        <button type="button" class="btn btn-xs btn-primary" data-table-bulk-action="export">
                            Exporter la sélection
                        </button>
                    </x-slot:bulkActions>
                </x-daisy::ui.data-display.table>
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$selectionCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="340px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="advanced" title="Détails, sous-lignes et liens">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Combinez <code>row-key</code>, <code>row-detail</code> et <code>sub-rows-key</code> pour afficher
                    des lignes extensibles. Les colonnes <code>type="link"</code> appliquent une politique d’URL sûre via
                    <code>link-policy</code>. Activez <code>column-resizing</code> avec <code>size</code>, <code>minSize</code>
                    et <code>maxSize</code> pour déléguer le redimensionnement au runtime TanStack.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
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
                    caption="Programmes extensibles"
                    :link-policy="['allowedSchemes' => ['https', 'mailto']]"
                    :columns="[
                        ['key' => 'name', 'label' => 'Programme', 'sortable' => true, 'size' => 220, 'minSize' => 160],
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
                            'detail' => 'Détail inline rendu par la ligne extensible.',
                            'actions' => ['action' => 'open', 'label' => 'Ouvrir'],
                            'children' => [
                                ['id' => 'release-api', 'name' => 'API publique', 'owner' => ['href' => 'https://example.com/api', 'label' => 'API'], 'status' => '<span class=\'badge badge-info badge-soft\'>In progress</span>', 'actions' => ['action' => 'view', 'label' => 'Voir']],
                            ],
                        ],
                        [
                            'id' => 'security',
                            'name' => 'Durcissement sécurité',
                            'owner' => ['href' => 'https://example.com/security', 'label' => 'Security'],
                            'status' => '<span class=\'badge badge-warning badge-soft\'>Review</span>',
                            'detail' => 'Détail inline avec lien externe autorisé.',
                            'actions' => ['action' => 'open', 'label' => 'Ouvrir'],
                            'children' => [],
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

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$advancedCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="420px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="editable" title="Édition inline et filtres dates">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Activez <code>editable</code> avec <code>edit-endpoint</code>, <code>edit-method</code> et
                    <code>editable-columns</code>. Les filtres acceptent maintenant <code>date</code> et
                    <code>date-range</code>, avec <code>filterKeyFrom</code> et <code>filterKeyTo</code> pour les APIs
                    qui attendent deux paramètres distincts.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.table
                    mode="client"
                    size="sm"
                    row-key="id"
                    editable
                    edit-endpoint="{{ route('demo.table.api.update') }}"
                    edit-method="PATCH"
                    edit-mode="row"
                    :editable-columns="['name', 'status', 'joined_at']"
                    caption="Planning éditable"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
                        ['key' => 'status', 'label' => 'Statut', 'filterable' => true, 'filter' => ['type' => 'select', 'options' => [
                            ['value' => 'Active', 'label' => 'Active'],
                            ['value' => 'Invited', 'label' => 'Invited'],
                            ['value' => 'Archived', 'label' => 'Archived'],
                        ]]],
                        ['key' => 'joined_at', 'label' => 'Entrée', 'sortable' => true, 'filterable' => true, 'filter' => ['type' => 'date']],
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

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$editableCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="420px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="variants" title="Variantes">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Les props <code>size</code>, <code>zebra</code>, <code>pinRows</code>, <code>pinCols</code>,
                    <code>search</code>, <code>persist-state</code> et <code>columnVisibility</code> se combinent entre elles.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.table
                    mode="client"
                    size="xs"
                    pin-rows
                    pin-cols
                    :search="false"
                    :columns="[
                        ['key' => 'ticket', 'label' => 'Ticket'],
                        ['key' => 'queue', 'label' => 'File'],
                        ['key' => 'sla', 'label' => 'SLA', 'headerClass' => 'text-right', 'cellClass' => 'text-right'],
                    ]"
                    :rows="[
                        ['ticket' => '#4210', 'queue' => 'Billing', 'sla' => '12 min'],
                        ['ticket' => '#4211', 'queue' => 'Auth', 'sla' => '18 min'],
                        ['ticket' => '#4212', 'queue' => 'Search', 'sla' => '24 min'],
                    ]"
                    :initial-state="[
                        'pagination' => ['pageSize' => 3],
                    ]"
                    :page-size-options="[3, 6]"
                />
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$variantsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="300px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="server" title="Mode serveur">
        <div class="not-prose space-y-4">
            <div class="alert alert-warning alert-soft">
                <span>
                    En mode serveur, utilisez <code>mode="server"</code> avec <code>endpoint</code>. L’endpoint doit accepter
                    <code>pageIndex</code>, <code>pageSize</code>, <code>sorting</code>, <code>globalFilter</code> et
                    <code>columnFilters</code>, puis renvoyer <code>rows</code>, <code>rowCount</code>, <code>pageCount</code> et
                    <code>state</code>. Pour une API Spatie Query Builder, ajoutez <code>server-adapter="spatie-query-builder"</code>.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.table
                    mode="server"
                    size="sm"
                    pin-cols
                    persist-state="url"
                    state-key="demo-users-table"
                    caption="Annuaire synchronisé"
                    endpoint="{{ route('demo.table.api.get') }}"
                    :columns="[
                        ['key' => 'name', 'label' => 'Nom', 'sortable' => true],
                        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
                        ['key' => 'status', 'label' => 'Statut', 'sortable' => true, 'filterable' => true, 'filterKey' => 'status', 'filter' => [
                            'type' => 'select',
                            'options' => [
                                ['value' => 'Active', 'label' => 'Active'],
                                ['value' => 'Invited', 'label' => 'Invited'],
                                ['value' => 'Archived', 'label' => 'Archived'],
                            ],
                        ]],
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

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$serverCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="460px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
