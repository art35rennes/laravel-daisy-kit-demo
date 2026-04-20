@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'data-display';
    $name = 'table';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'client', 'label' => 'Mode client'],
        ['id' => 'filters', 'label' => 'Filtres'],
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
        ['key' => 'status', 'label' => 'Statut', 'html' => true, 'filterable' => true, 'filter' => ['type' => 'text']],
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
                    ['key' => 'status', 'label' => 'Statut', 'html' => true, 'filterable' => true, 'filter' => ['type' => 'text']],
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
                    <code>text</code>, <code>select</code> et <code>boolean</code>.
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
