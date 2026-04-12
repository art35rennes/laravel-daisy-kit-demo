<!-- Datatable -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Datatable</h2>
    <div class="space-y-4">
        <!-- Données locales -->
        <x-daisy::ui.data-display.datatable
            zebra
            size="sm"
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

        <!-- Slots structurés -->
        <x-daisy::ui.data-display.datatable
            zebra
            size="sm"
            caption="Équipe support"
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

        <!-- Multi-page serveur -->
        <x-daisy::ui.data-display.datatable
            server-side
            responsive
            size="sm"
            pin-cols
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
</section>
