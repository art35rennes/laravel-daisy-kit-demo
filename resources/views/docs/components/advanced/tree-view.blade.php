@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'tree-view';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'states', 'label' => 'États'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Vue arborescente" 
    category="advanced" 
    name="tree-view"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Vue arborescente" 
            subtitle="Vue arborescente hiérarchique pour afficher des structures de données imbriquées."
            jsModule="treeview"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="tree-view">
        <x-slot:preview>
            @php
                $data = [
                    [
                        'id' => 1,
                        'label' => 'Dossier racine',
                        'state' => 'mixed',
                        'children' => [
                            [
                                'id' => 2,
                                'label' => 'Sous-dossier',
                                'children' => [
                                    ['id' => 3, 'label' => 'Fichier 1', 'checked' => true],
                                    ['id' => 4, 'label' => 'Fichier 2'],
                                ],
                            ],
                            ['id' => 5, 'label' => 'Fichier 3'],
                        ],
                    ],
                ];
            @endphp
            <x-daisy::ui.advanced.tree-view selection="multiple" :data="$data" />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = <<<'CODE'
<x-daisy::ui.advanced.tree-view :data="[
    [
        'id' => 1,
        'label' => 'Dossier racine',
        'state' => 'mixed',
        'children' => [
            [
                'id' => 2,
                'label' => 'Sous-dossier',
                'children' => [
                    ['id' => 3, 'label' => 'Fichier 1', 'checked' => true],
                    ['id' => 4, 'label' => 'Fichier 2'],
                ],
            ],
            ['id' => 5, 'label' => 'Fichier 3'],
        ],
    ],
]" />
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor 
                language="blade" 
                :value="$baseCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="300px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="states" title="États">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>
                    Le composant reconnaît désormais l’état mixte explicite via <code>state =&gt; 'mixed'</code> et les alias <code>checked</code>
                    souvent renvoyés par des APIs. Le rendu sérialise alors l’état en <code>data-indeterminate="true"</code>.
                </span>
            </div>

            <div class="rounded-box border border-base-content/5 bg-base-100 p-4">
                <x-daisy::ui.advanced.tree-view
                    selection="multiple"
                    :data="[
                        [
                            'id' => 'docs',
                            'label' => 'Documentation',
                            'checked' => true,
                            'children' => [
                                ['id' => 'readme', 'label' => 'README.md', 'checked' => true],
                                ['id' => 'notes', 'label' => 'Notes.md'],
                            ],
                        ],
                        [
                            'id' => 'sandbox',
                            'label' => 'Sandbox',
                            'state' => 'mixed',
                            'children' => [
                                ['id' => 'draft', 'label' => 'Draft.md', 'checked' => true],
                                ['id' => 'todo', 'label' => 'Todo.md'],
                            ],
                        ],
                    ]"
                />
            </div>

            @php
                $statesCode = <<<'CODE'
<x-daisy::ui.advanced.tree-view
    selection="multiple"
    :data="[
        [
            'id' => 'docs',
            'label' => 'Documentation',
            'checked' => true,
            'children' => [
                ['id' => 'readme', 'label' => 'README.md', 'checked' => true],
                ['id' => 'notes', 'label' => 'Notes.md'],
            ],
        ],
        [
            'id' => 'sandbox',
            'label' => 'Sandbox',
            'state' => 'mixed',
            'children' => [
                ['id' => 'draft', 'label' => 'Draft.md', 'checked' => true],
                ['id' => 'todo', 'label' => 'Todo.md'],
            ],
        ],
    ]"
/>
CODE;
            @endphp
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$statesCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="320px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
