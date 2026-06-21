@php
    use App\Helpers\DocsHelper;

    $category = 'advanced';
    $name = 'blueprint';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Composant'],
        ['id' => 'template', 'label' => 'Template'],
        ['id' => 'contract', 'label' => 'Contrat JSON'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $templateCode = <<<'CODE'
<x-daisy::templates.advanced.blueprint
    name-prefix="demo"
    workflow-height="560px"
    example-height="420px"
/>
CODE;

    $customTemplateCode = <<<'CODE'
<x-daisy::templates.advanced.blueprint
    :workflow-node-types="$workflowNodeTypes"
    :workflow-value="$workflowValue"
    :schema-node-types="$schemaNodeTypes"
    :schema-value="$schemaValue"
    :integration-node-types="$integrationNodeTypes"
    :integration-value="$integrationValue"
/>
CODE;

    $componentCode = <<<'CODE'
<x-daisy::ui.advanced.blueprint
    name="workflow"
    mode="workflow"
    height="520px"
    :node-types="$nodeTypes"
    :value="$workflow"
/>
CODE;

    $contractCode = json_encode([
        'version' => 1,
        'nodes' => [
            [
                'id' => 'source-1',
                'type' => 'source',
                'label' => 'Source',
                'position' => ['x' => 40, 'y' => 80],
                'data' => ['connector' => 'Stripe'],
            ],
        ],
        'edges' => [
            [
                'id' => 'edge-1',
                'source' => 'source-1',
                'sourcePort' => 'rows',
                'target' => 'sink-1',
                'targetPort' => 'in',
                'data' => [],
            ],
        ],
        'viewport' => ['x' => 0, 'y' => 0, 'zoom' => 1],
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    $nodeTypesCode = json_encode([
        [
            'type' => 'source',
            'label' => 'Source',
            'category' => 'Integration',
            'description' => 'Reads rows from an external connector.',
            'outputs' => [['key' => 'rows', 'label' => 'Rows', 'kind' => 'dataset', 'multiple' => true]],
            'defaults' => ['connector' => 'Stripe'],
        ],
        [
            'type' => 'sink',
            'label' => 'Sink',
            'category' => 'Integration',
            'description' => 'Writes rows to a target system.',
            'inputs' => [['key' => 'in', 'label' => 'In', 'kind' => 'dataset']],
            'defaults' => ['target' => 'warehouse.orders'],
        ],
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

<x-daisy::docs.page
    title="Blueprint"
    category="advanced"
    name="blueprint"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="Blueprint"
            subtitle="Éditeur visuel de graphes et workflows basé sur Rete.js v2."
            jsModule="blueprint"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="blueprint">
        <x-slot:preview>
            <x-daisy::ui.advanced.blueprint
                name="docs_blueprint_component"
                mode="workflow"
                height="420px"
                :node-types="[
                    [
                        'type' => 'source',
                        'label' => 'Source',
                        'category' => 'Demo',
                        'outputs' => [['key' => 'rows', 'label' => 'Rows', 'kind' => 'dataset', 'multiple' => true]],
                    ],
                    [
                        'type' => 'sink',
                        'label' => 'Destination',
                        'category' => 'Demo',
                        'inputs' => [['key' => 'in', 'label' => 'In', 'kind' => 'dataset']],
                    ],
                ]"
                :value="[
                    'version' => 1,
                    'nodes' => [
                        ['id' => 'source-1', 'type' => 'source', 'label' => 'Source', 'position' => ['x' => 80, 'y' => 100], 'data' => []],
                        ['id' => 'sink-1', 'type' => 'sink', 'label' => 'Destination', 'position' => ['x' => 420, 'y' => 120], 'data' => []],
                    ],
                    'edges' => [
                        ['id' => 'edge-1', 'source' => 'source-1', 'sourcePort' => 'rows', 'target' => 'sink-1', 'targetPort' => 'in', 'data' => []],
                    ],
                    'viewport' => ['x' => 0, 'y' => 0, 'zoom' => 1],
                ]"
            />
        </x-slot:preview>
        <x-slot:code>
            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$componentCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="220px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="template" title="Template d’exemples">
        <div class="not-prose space-y-6">
            <div class="alert alert-info alert-soft">
                <span>Le smoke Blueprint est maintenant disponible comme template public. Il couvre workflow éditable, workflow readonly, schéma de données et pipeline d’intégration.</span>
            </div>

            <x-daisy::templates.advanced.blueprint
                name-prefix="docs_blueprint"
                workflow-height="560px"
                example-height="420px"
            />

            <div class="grid gap-4 lg:grid-cols-2">
                <div>
                    <p class="mb-2 text-sm font-semibold">Utilisation rapide</p>
                    <x-daisy::ui.advanced.code-editor
                        language="blade"
                        :value="$templateCode"
                        :readonly="true"
                        :showToolbar="false"
                        :showFoldAll="false"
                        :showUnfoldAll="false"
                        :showFormat="false"
                        :showCopy="true"
                        height="180px"
                    />
                </div>
                <div>
                    <p class="mb-2 text-sm font-semibold">Graphes personnalisés</p>
                    <x-daisy::ui.advanced.code-editor
                        language="blade"
                        :value="$customTemplateCode"
                        :readonly="true"
                        :showToolbar="false"
                        :showFoldAll="false"
                        :showUnfoldAll="false"
                        :showFormat="false"
                        :showCopy="true"
                        height="180px"
                    />
                </div>
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.custom id="contract" title="Contrat JSON">
        <div class="not-prose grid gap-4 lg:grid-cols-2">
            <div>
                <p class="mb-2 text-sm font-semibold">Graphe sérialisé</p>
                <x-daisy::ui.advanced.code-editor
                    language="json"
                    :value="$contractCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="360px"
                />
            </div>
            <div>
                <p class="mb-2 text-sm font-semibold">Catalogue de nœuds</p>
                <x-daisy::ui.advanced.code-editor
                    language="json"
                    :value="$nodeTypesCode"
                    :readonly="true"
                    :showToolbar="false"
                    :showFoldAll="false"
                    :showUnfoldAll="false"
                    :showFormat="false"
                    :showCopy="true"
                    height="360px"
                />
            </div>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
