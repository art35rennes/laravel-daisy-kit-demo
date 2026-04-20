@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'layout';
    $name = 'editable-grid';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'items', 'label' => 'Items JSON'],
        ['id' => 'readonly', 'label' => 'Lecture seule'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $baseCode = <<<'CODE'
<x-daisy::ui.layout.editable-grid
    :columns="12"
    :cell-height="72"
    :gap="12"
    :float="true"
    :min-row="4"
    layout="compact"
>
    <x-daisy::ui.layout.editable-grid-item id="kpi-revenue" type="stat" :x="0" :y="0" :w="4" :h="2">
        <x-daisy::ui.layout.card class="h-full border border-primary/10 bg-gradient-to-br from-primary/6 via-base-100 to-base-100 shadow-sm">
            <div class="card-body gap-3">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold">Revenue</p>
                    <span class="badge badge-primary badge-soft">MRR</span>
                </div>
                <x-daisy::ui.data-display.stat title="MRR" value="€42,500" desc="+12.4% ce mois-ci" />
            </div>
        </x-daisy::ui.layout.card>
    </x-daisy::ui.layout.editable-grid-item>

    <x-daisy::ui.layout.editable-grid-item id="kpi-users" type="stat" :x="4" :y="0" :w="4" :h="2">
        <x-daisy::ui.layout.card class="h-full border border-secondary/10 bg-gradient-to-br from-secondary/6 via-base-100 to-base-100 shadow-sm">
            <div class="card-body gap-3">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold">Users</p>
                    <span class="badge badge-secondary badge-soft">Actifs</span>
                </div>
                <x-daisy::ui.data-display.stat title="Actifs" value="1,284" desc="84 nouveaux cette semaine" />
            </div>
        </x-daisy::ui.layout.card>
    </x-daisy::ui.layout.editable-grid-item>

    <x-daisy::ui.layout.editable-grid-item id="release-notes" type="list" :x="8" :y="0" :w="4" :h="2">
        <x-daisy::ui.layout.card class="h-full border border-accent/10 bg-gradient-to-br from-accent/6 via-base-100 to-base-100 shadow-sm">
            <div class="card-body gap-3">
                <div class="flex items-center justify-between gap-3">
                    <p class="text-sm font-semibold">Ops</p>
                    <span class="badge badge-accent badge-soft">SLA</span>
                </div>
                <x-daisy::ui.data-display.stat title="Réponse moyenne" value="2m 14s" desc="Dans la cible SLA" />
            </div>
        </x-daisy::ui.layout.card>
    </x-daisy::ui.layout.editable-grid-item>

    <x-daisy::ui.layout.editable-grid-item id="team-priorities" type="list" :x="0" :y="2" :w="7" :h="3">
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

    <x-daisy::ui.layout.editable-grid-item id="release-checklist" type="list" :x="7" :y="2" :w="5" :h="3">
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
CODE;

    $itemsCode = <<<'CODE'
<x-daisy::ui.layout.editable-grid
    :editable="false"
    :static="true"
    :columns="8"
    :cell-height="72"
    :gap="10"
    :items="[
        [
            'id' => 'notes',
            'type' => 'list',
            'x' => 0,
            'y' => 0,
            'w' => 4,
            'h' => 3,
            'content' => new \Illuminate\Support\HtmlString('<p>Grid item content</p>'),
        ],
        [
            'id' => 'release',
            'type' => 'stat',
            'x' => 4,
            'y' => 0,
            'w' => 4,
            'h' => 2,
            'meta' => ['section' => 'release'],
            'content' => new \Illuminate\Support\HtmlString('<p>Release widget</p>'),
        ],
    ]"
/>
CODE;

    $readonlyCode = <<<'CODE'
<x-daisy::ui.layout.editable-grid :editable="false" :static="true" :columns="6" :cell-height="72">
    <x-daisy::ui.layout.editable-grid-item id="summary" :x="0" :y="0" :w="3" :h="2">
        <x-daisy::ui.layout.card title="Read only" class="h-full card-border">
            <p class="text-sm opacity-70">Aucune interaction utilisateur.</p>
        </x-daisy::ui.layout.card>
    </x-daisy::ui.layout.editable-grid-item>
</x-daisy::ui.layout.editable-grid>
CODE;
@endphp

<x-daisy::docs.page
    title="Editable Grid"
    category="layout"
    name="editable-grid"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Editable Grid"
            subtitle="Grille éditable pour dashboards ou surfaces builder. Gardez `grid-layout` pour les layouts statiques classiques."
            jsModule="editable-grid"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="editable-grid">
        <x-slot:preview>
            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <x-daisy::ui.layout.editable-grid :columns="12" :cell-height="88" :gap="12" :float="true" :min-row="2" layout="compact" :responsive="true">
                    <x-daisy::ui.layout.editable-grid-item id="kpi-revenue" type="stat" :x="0" :y="0" :w="4" :h="2">
                        <x-daisy::ui.layout.card title="Revenue" class="h-full card-border">
                            <x-daisy::ui.data-display.stat title="MRR" value="€42,500" desc="+12.4% ce mois-ci" />
                        </x-daisy::ui.layout.card>
                    </x-daisy::ui.layout.editable-grid-item>

                    <x-daisy::ui.layout.editable-grid-item id="release-notes" type="list" :x="4" :y="0" :w="8" :h="3">
                        <x-daisy::ui.layout.card title="Release notes" class="h-full card-border">
                            <p class="text-sm opacity-70">Le widget peut être déplacé et redimensionné.</p>
                        </x-daisy::ui.layout.card>
                    </x-daisy::ui.layout.editable-grid-item>
                </x-daisy::ui.layout.editable-grid>
            </div>
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

    <x-daisy::docs.sections.custom id="items" title="Rendu via items">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>Utilisez <code>items</code> quand la grille est stockée en base ou générée par un builder.</span>
            </div>

            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <x-daisy::ui.layout.editable-grid
                    :editable="false"
                    :static="true"
                    :columns="8"
                    :cell-height="72"
                    :gap="10"
                    :items="[
                        [
                            'id' => 'notes',
                            'type' => 'list',
                            'x' => 0,
                            'y' => 0,
                            'w' => 4,
                            'h' => 3,
                            'content' => new \Illuminate\Support\HtmlString('<div class=&quot;rounded-box border border-base-content/10 bg-base-50 p-4 text-sm&quot;><div class=&quot;font-medium mb-2&quot;>Team priorities</div><p class=&quot;opacity-70&quot;>Builder, docs et revue package.</p></div>'),
                        ],
                        [
                            'id' => 'release',
                            'type' => 'stat',
                            'x' => 4,
                            'y' => 0,
                            'w' => 4,
                            'h' => 2,
                            'meta' => ['section' => 'release'],
                            'content' => new \Illuminate\Support\HtmlString('<div class=&quot;rounded-box border border-base-content/10 bg-base-50 p-4 text-sm&quot;><div class=&quot;font-medium&quot;>Release checklist</div><p class=&quot;opacity-70&quot;>Assets, inventaire, tests ciblés.</p></div>'),
                        ],
                    ]"
                />
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$itemsCode"
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

    <x-daisy::docs.sections.custom id="readonly" title="Lecture seule">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>Utilisez <code>:editable="false"</code> ou <code>:static="true"</code> pour afficher la grille sans interaction.</span>
            </div>

            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <x-daisy::ui.layout.editable-grid :editable="false" :static="true" :columns="6" :cell-height="72">
                    <x-daisy::ui.layout.editable-grid-item id="summary" :x="0" :y="0" :w="3" :h="2">
                        <x-daisy::ui.layout.card title="Read only" class="h-full card-border">
                            <p class="text-sm opacity-70">Aucune interaction utilisateur.</p>
                        </x-daisy::ui.layout.card>
                    </x-daisy::ui.layout.editable-grid-item>
                </x-daisy::ui.layout.editable-grid>
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$readonlyCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="220px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
