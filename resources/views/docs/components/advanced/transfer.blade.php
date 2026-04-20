@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'transfer';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'dnd', 'label' => 'Drag and drop'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);

    $baseCode = <<<'CODE'
<x-daisy::ui.advanced.transfer
    titleSource="Utilisateurs disponibles"
    titleTarget="Utilisateurs sélectionnés"
    :search="true"
    :source="[
        ['data' => 'Alice Martin'],
        ['data' => 'Bob Dupont'],
        ['data' => 'Claire Bernard'],
    ]"
    :target="[
        ['data' => 'Sophie Blanc'],
    ]"
/>
CODE;

    $dndCode = <<<'CODE'
<x-daisy::ui.advanced.transfer
    titleSource="Backlog"
    titleTarget="Sprint en cours"
    :sortable="true"
    :dragAndDrop="true"
    :handle="true"
    buttonsMode="icon"
    buttonsVariant="outline"
    :source="[
        ['data' => 'Refonte landing page', 'customId' => 'landing'],
        ['data' => 'Corriger les exports CSV', 'customId' => 'csv'],
    ]"
    :target="[
        ['data' => 'Publier les charts', 'customId' => 'charts'],
    ]"
/>
CODE;
@endphp

<x-daisy::docs.page 
    title="Transfert" 
    category="advanced" 
    name="transfer"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Transfert" 
            subtitle="Transfert d'éléments entre deux listes avec sélection multiple."
            jsModule="transfer"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="transfer">
        <x-slot:preview>
            <x-daisy::ui.advanced.transfer
                titleSource="Utilisateurs disponibles"
                titleTarget="Utilisateurs sélectionnés"
                :search="true"
                :source="[
                    ['data' => 'Alice Martin'],
                    ['data' => 'Bob Dupont'],
                    ['data' => 'Claire Bernard'],
                ]"
                :target="[
                    ['data' => 'Sophie Blanc'],
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
                height="250px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="dnd" title="Drag and drop">
        <div class="not-prose space-y-4">
            <div class="alert alert-info alert-soft">
                <span>Activez <code>dragAndDrop</code>, <code>sortable</code> et <code>handle</code> pour permettre le réordonnancement visuel des deux listes.</span>
            </div>

            <div class="rounded-box border border-base-content/10 bg-base-100 p-4">
                <x-daisy::ui.advanced.transfer
                    titleSource="Backlog"
                    titleTarget="Sprint en cours"
                    :sortable="true"
                    :dragAndDrop="true"
                    :handle="true"
                    buttonsMode="icon"
                    buttonsVariant="outline"
                    :source="[
                        ['data' => 'Refonte landing page', 'customId' => 'landing'],
                        ['data' => 'Corriger les exports CSV', 'customId' => 'csv'],
                    ]"
                    :target="[
                        ['data' => 'Publier les charts', 'customId' => 'charts'],
                    ]"
                />
            </div>

            <x-daisy::ui.advanced.code-editor
                language="blade"
                :value="$dndCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="280px"
            />
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
