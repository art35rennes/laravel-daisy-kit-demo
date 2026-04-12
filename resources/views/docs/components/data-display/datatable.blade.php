@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'data-display';
    $name = 'datatable';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple local'],
        ['id' => 'slots', 'label' => 'Slots structurés'],
        ['id' => 'server', 'label' => 'Mode serveur'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $baseCode = <<<'CODE'
<x-daisy::ui.data-display.datatable
    size="sm"
    zebra
    caption="Utilisateurs"
    :columns="[
        ['key' => 'name', 'title' => 'Nom'],
        ['key' => 'role', 'title' => 'Rôle'],
        ['key' => 'status', 'title' => 'Statut', 'html' => true],
    ]"
    :data="[
        ['name' => 'Cy Ganderton', 'role' => 'Admin', 'status' => '<span class=\'badge badge-primary badge-soft\'>Active</span>'],
        ['name' => 'Hart Hagerty', 'role' => 'Support', 'status' => '<span class=\'badge badge-success badge-soft\'>Invited</span>'],
        ['name' => 'Brice Swyre', 'role' => 'Finance', 'status' => '<span class=\'badge badge-ghost\'>Archived</span>'],
        ['name' => 'Jolie Winters', 'role' => 'Ops', 'status' => '<span class=\'badge badge-primary badge-soft\'>Active</span>'],
        ['name' => 'Nico Bernard', 'role' => 'Support', 'status' => '<span class=\'badge badge-success badge-soft\'>Invited</span>'],
        ['name' => 'Lina Carter', 'role' => 'Finance', 'status' => '<span class=\'badge badge-ghost\'>Archived</span>'],
    ]"
    :options="[
        'pageLength' => 2,
        'lengthMenu' => [2, 4, 6],
    ]"
/>
CODE;

    $slotsCode = <<<'CODE'
<x-daisy::ui.data-display.datatable
    :columns="[
        ['key' => 'name', 'title' => 'Nom'],
        ['key' => 'team', 'title' => 'Équipe'],
    ]"
    :options="[
        'pageLength' => 2,
        'lengthMenu' => [2, 4, 6],
    ]"
>
    <x-slot:head>
        <tr>
            <th>Nom</th>
            <th>Équipe</th>
        </tr>
    </x-slot:head>

    <x-slot:body>
        <tr>
            <td>Cy Ganderton</td>
            <td>Ops</td>
        </tr>
        <tr>
            <td>Hart Hagerty</td>
            <td>Support</td>
        </tr>
        <tr>
            <td>Brice Swyre</td>
            <td>Finance</td>
        </tr>
        <tr>
            <td>Jolie Winters</td>
            <td>Ops</td>
        </tr>
        <tr>
            <td>Nico Bernard</td>
            <td>Support</td>
        </tr>
        <tr>
            <td>Lina Carter</td>
            <td>Finance</td>
        </tr>
    </x-slot:body>
</x-daisy::ui.data-display.datatable>
CODE;

    $serverCode = <<<'CODE'
<x-daisy::ui.data-display.datatable
    server-side
    responsive
    size="sm"
    caption="Catalogue"
    :ajax="[
        'url' => route('demo.datatable.api.get'),
        'type' => 'GET',
    ]"
    :columns="[
        ['data' => 'name', 'title' => 'Nom', 'name' => 'users.name'],
        ['data' => 'email', 'title' => 'Email'],
        ['data' => 'status', 'title' => 'Statut', 'responsivePriority' => 1],
    ]"
    :options="[
        'pageLength' => 5,
        'lengthMenu' => [5, 10, 25],
        'scrollX' => true,
        'searching' => true,
        'ordering' => true,
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page
    title="Datatable"
    category="data-display"
    name="datatable"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Datatable"
            subtitle="Composant tabulaire basé sur DataTables. Il remplace les anciens composants table et advanced.table."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="datatable">
        <x-slot:preview>
            <x-daisy::ui.data-display.datatable
                size="sm"
                zebra
                caption="Utilisateurs"
                :columns="[
                    ['key' => 'name', 'title' => 'Nom'],
                    ['key' => 'role', 'title' => 'Rôle'],
                    ['key' => 'status', 'title' => 'Statut', 'html' => true],
                ]"
                :data="[
                    ['name' => 'Cy Ganderton', 'role' => 'Admin', 'status' => '<span class=\'badge badge-primary badge-soft\'>Active</span>'],
                    ['name' => 'Hart Hagerty', 'role' => 'Support', 'status' => '<span class=\'badge badge-success badge-soft\'>Invited</span>'],
                    ['name' => 'Brice Swyre', 'role' => 'Finance', 'status' => '<span class=\'badge badge-ghost\'>Archived</span>'],
                    ['name' => 'Jolie Winters', 'role' => 'Ops', 'status' => '<span class=\'badge badge-primary badge-soft\'>Active</span>'],
                    ['name' => 'Nico Bernard', 'role' => 'Support', 'status' => '<span class=\'badge badge-success badge-soft\'>Invited</span>'],
                    ['name' => 'Lina Carter', 'role' => 'Finance', 'status' => '<span class=\'badge badge-ghost\'>Archived</span>'],
                ]"
                :options="[
                    'pageLength' => 2,
                    'lengthMenu' => [2, 4, 6],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$baseCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="320px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="slots" title="Slots structurés">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Si vous devez maîtriser complètement le <code>thead</code> ou le <code>tbody</code>,
                    le composant accepte les slots <code>head</code>, <code>body</code> et <code>foot</code>.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.datatable
                    :columns="[
                        ['key' => 'name', 'title' => 'Nom'],
                        ['key' => 'team', 'title' => 'Équipe'],
                    ]"
                    :options="[
                        'pageLength' => 2,
                        'lengthMenu' => [2, 4, 6],
                    ]"
                >
                    <x-slot:head>
                        <tr>
                            <th>Nom</th>
                            <th>Équipe</th>
                        </tr>
                    </x-slot:head>

                    <x-slot:body>
                        <tr>
                            <td>Cy Ganderton</td>
                            <td>Ops</td>
                        </tr>
                        <tr>
                            <td>Hart Hagerty</td>
                            <td>Support</td>
                        </tr>
                        <tr>
                            <td>Brice Swyre</td>
                            <td>Finance</td>
                        </tr>
                        <tr>
                            <td>Jolie Winters</td>
                            <td>Ops</td>
                        </tr>
                        <tr>
                            <td>Nico Bernard</td>
                            <td>Support</td>
                        </tr>
                        <tr>
                            <td>Lina Carter</td>
                            <td>Finance</td>
                        </tr>
                    </x-slot:body>
                </x-daisy::ui.data-display.datatable>
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$slotsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="260px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="server" title="Mode serveur">
        <div class="not-prose space-y-4">
            <div class="alert alert-warning alert-soft">
                <span>
                    Le mode serveur se pilote avec <code>serverSide</code> et requiert obligatoirement l’option <code>ajax</code>.
                    La pagination multi-page, la recherche et le tri sont alors délégués à DataTables côté client et à votre endpoint côté serveur.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.data-display.datatable
                    server-side
                    responsive
                    size="sm"
                    caption="Catalogue"
                    :ajax="[
                        'url' => route('demo.datatable.api.get'),
                        'type' => 'GET',
                    ]"
                    :columns="[
                        ['data' => 'name', 'title' => 'Nom', 'name' => 'users.name'],
                        ['data' => 'email', 'title' => 'Email'],
                        ['data' => 'status', 'title' => 'Statut', 'responsivePriority' => 1],
                    ]"
                    :options="[
                        'pageLength' => 5,
                        'lengthMenu' => [5, 10, 25],
                        'scrollX' => true,
                        'searching' => true,
                        'ordering' => true,
                    ]"
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
                height="340px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
