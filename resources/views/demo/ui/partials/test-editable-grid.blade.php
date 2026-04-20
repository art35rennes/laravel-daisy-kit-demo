<!-- Editable Grid -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Editable Grid</h2>
    <p class="opacity-70">Surface de dashboard déplaçable basée sur Gridstack. À réserver aux interfaces réellement éditables, en gardant <code>grid-layout</code> comme layout statique par défaut.</p>

    <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <div>
                <h3 class="text-sm font-semibold">Dashboard éditable</h3>
                <p class="text-sm opacity-70">Exemple principal avec 12 colonnes fixes pour garder une lecture propre sur desktop.</p>
            </div>
            <div class="flex flex-wrap gap-2 text-xs">
                <span class="badge badge-primary badge-soft">12 colonnes</span>
                <span class="badge badge-neutral badge-soft">Drag & resize</span>
                <span class="badge badge-accent badge-soft">Layout compact</span>
            </div>
        </div>

        <x-daisy::ui.layout.editable-grid :columns="12" :cell-height="72" :gap="12" :float="true" :min-row="4" layout="compact">
            <x-daisy::ui.layout.editable-grid-item id="eg-revenue" type="stat" :x="0" :y="0" :w="4" :h="2">
                <x-daisy::ui.layout.card class="h-full border border-primary/10 bg-gradient-to-br from-primary/6 via-base-100 to-base-100 shadow-sm">
                    <div class="card-body gap-3">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm font-semibold">Revenue</p>
                            <span class="badge badge-primary badge-soft">MRR</span>
                        </div>
                        <x-daisy::ui.data-display.stat
                            title="MRR"
                            value="€42,500"
                            desc="+12.4% ce mois-ci"
                        />
                    </div>
                </x-daisy::ui.layout.card>
            </x-daisy::ui.layout.editable-grid-item>

            <x-daisy::ui.layout.editable-grid-item id="eg-users" type="stat" :x="4" :y="0" :w="4" :h="2">
                <x-daisy::ui.layout.card class="h-full border border-secondary/10 bg-gradient-to-br from-secondary/6 via-base-100 to-base-100 shadow-sm">
                    <div class="card-body gap-3">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm font-semibold">Users</p>
                            <span class="badge badge-secondary badge-soft">Actifs</span>
                        </div>
                        <x-daisy::ui.data-display.stat
                            title="Actifs"
                            value="1,284"
                            desc="84 nouveaux cette semaine"
                        />
                    </div>
                </x-daisy::ui.layout.card>
            </x-daisy::ui.layout.editable-grid-item>

            <x-daisy::ui.layout.editable-grid-item id="eg-sla" type="stat" :x="8" :y="0" :w="4" :h="2">
                <x-daisy::ui.layout.card class="h-full border border-accent/10 bg-gradient-to-br from-accent/6 via-base-100 to-base-100 shadow-sm">
                    <div class="card-body gap-3">
                        <div class="flex items-center justify-between gap-3">
                            <p class="text-sm font-semibold">Ops</p>
                            <span class="badge badge-accent badge-soft">SLA</span>
                        </div>
                        <x-daisy::ui.data-display.stat
                            title="Réponse moyenne"
                            value="2m 14s"
                            desc="Dans la cible SLA"
                        />
                    </div>
                </x-daisy::ui.layout.card>
            </x-daisy::ui.layout.editable-grid-item>

            <x-daisy::ui.layout.editable-grid-item id="eg-priorities" type="list" :x="0" :y="2" :w="7" :h="3">
                <x-daisy::ui.layout.card class="h-full border border-base-content/10 bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <div class="space-y-1">
                            <p class="text-sm font-semibold">Priorités</p>
                            <p class="text-sm opacity-70">Cette semaine</p>
                        </div>
                        <x-daisy::ui.layout.list :bg="false">
                            <x-daisy::ui.layout.list-row>Stabiliser la démo package</x-daisy::ui.layout.list-row>
                            <x-daisy::ui.layout.list-row>Valider la persistance des widgets</x-daisy::ui.layout.list-row>
                            <x-daisy::ui.layout.list-row>Préparer le mode lecture seule</x-daisy::ui.layout.list-row>
                        </x-daisy::ui.layout.list>
                    </div>
                </x-daisy::ui.layout.card>
            </x-daisy::ui.layout.editable-grid-item>

            <x-daisy::ui.layout.editable-grid-item id="eg-release" type="list" :x="7" :y="2" :w="5" :h="3" :meta="['team' => 'release']">
                <x-daisy::ui.layout.card class="h-full border border-base-content/10 bg-base-100 shadow-sm">
                    <div class="card-body gap-4">
                        <div class="space-y-1">
                            <p class="text-sm font-semibold">Checklist release</p>
                            <p class="text-sm opacity-70">Avant publication</p>
                        </div>
                        <x-daisy::ui.layout.list :bg="false">
                            <x-daisy::ui.layout.list-row>Tester le drag and drop</x-daisy::ui.layout.list-row>
                            <x-daisy::ui.layout.list-row>Vérifier le mode statique</x-daisy::ui.layout.list-row>
                            <x-daisy::ui.layout.list-row>Documenter la sérialisation</x-daisy::ui.layout.list-row>
                        </x-daisy::ui.layout.list>
                    </div>
                </x-daisy::ui.layout.card>
            </x-daisy::ui.layout.editable-grid-item>
        </x-daisy::ui.layout.editable-grid>
    </div>

    <div class="grid gap-6 xl:grid-cols-[minmax(0,0.95fr)_minmax(0,1.05fr)]">
        <div class="space-y-4">
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
                <h3 class="text-sm font-semibold mb-2">Mode statique</h3>
                <p class="text-sm opacity-70 mb-3">Le même composant peut être rendu en lecture seule avec <code>:editable="false"</code> ou <code>:static="true"</code>.</p>
                <x-daisy::ui.layout.editable-grid :editable="false" :static="true" :columns="6" :cell-height="72" :gap="10">
                    <x-daisy::ui.layout.editable-grid-item id="eg-static-a" :x="0" :y="0" :w="3" :h="2">
                        <x-daisy::ui.layout.card class="h-full border border-base-content/10 bg-base-100 shadow-sm">
                            <div class="card-body">
                                <p class="text-sm font-semibold">Read only</p>
                                <p class="text-sm opacity-70">Aucune interaction de drag/resize.</p>
                            </div>
                        </x-daisy::ui.layout.card>
                    </x-daisy::ui.layout.editable-grid-item>
                    <x-daisy::ui.layout.editable-grid-item id="eg-static-b" :x="3" :y="0" :w="3" :h="2">
                        <x-daisy::ui.layout.card class="h-full border border-base-content/10 bg-base-100 shadow-sm">
                            <div class="card-body">
                                <p class="text-sm font-semibold">Widget</p>
                                <p class="text-sm opacity-70">Placement figé pour les dashboards publiés.</p>
                            </div>
                        </x-daisy::ui.layout.card>
                    </x-daisy::ui.layout.editable-grid-item>
                </x-daisy::ui.layout.editable-grid>
            </div>

            <div class="rounded-box border border-dashed border-base-content/15 bg-base-100/60 p-4">
                <h3 class="text-sm font-semibold mb-2">Quand activer le responsive</h3>
                <ul class="space-y-2 text-sm opacity-70">
                    <li>Activez <code>responsive</code> pour un builder ou une surface embarquée.</li>
                    <li>Gardez une grille fixe sur les grands exemples docs/démo si vous voulez montrer la composition cible.</li>
                    <li>Ajustez <code>columnWidth</code> manuellement si le conteneur est étroit.</li>
                </ul>
            </div>
        </div>

        <div class="rounded-box border border-base-content/10 bg-base-100 p-4 shadow-sm">
            <h3 class="text-sm font-semibold mb-2">Rendu via <code>items</code></h3>
            <p class="mb-4 text-sm opacity-70">Pratique quand la configuration vient d'un builder ou d'un JSON stocké.</p>
            <x-daisy::ui.layout.editable-grid
                :editable="false"
                :static="true"
                :columns="8"
                :cell-height="72"
                :gap="10"
                :responsive="['columnWidth' => 220, 'columnMax' => 8, 'layout' => 'compact']"
                :items="[
                    [
                        'id' => 'eg-items-priority',
                        'type' => 'list',
                        'x' => 0,
                        'y' => 0,
                        'w' => 4,
                        'h' => 3,
                        'content' => new \Illuminate\Support\HtmlString('<div class=&quot;h-full rounded-box border border-base-content/10 bg-gradient-to-br from-base-200/55 to-base-100 p-4 text-sm&quot;><div class=&quot;font-medium mb-2&quot;>Team priorities</div><p class=&quot;opacity-70&quot;>Builder, docs et revue package.</p></div>'),
                    ],
                    [
                        'id' => 'eg-items-release',
                        'type' => 'stat',
                        'x' => 4,
                        'y' => 0,
                        'w' => 4,
                        'h' => 2,
                        'meta' => ['section' => 'release'],
                        'content' => new \Illuminate\Support\HtmlString('<div class=&quot;h-full rounded-box border border-base-content/10 bg-gradient-to-br from-base-200/55 to-base-100 p-4 text-sm&quot;><div class=&quot;font-medium&quot;>Release checklist</div><p class=&quot;opacity-70&quot;>Assets, inventaire, tests ciblés.</p></div>'),
                    ],
                ]"
            />
        </div>
    </div>
</section>
