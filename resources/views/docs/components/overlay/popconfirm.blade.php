@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'overlay';
    $name = 'popconfirm';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'behavior', 'label' => 'Module JS'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Confirmation" 
    category="overlay" 
    name="popconfirm"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Confirmation" 
            subtitle="Confirmation via popover."
            jsModule="popconfirm"
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="popconfirm">
        <x-slot:preview>
            <x-daisy::ui.overlay.popconfirm message="Voulez-vous vraiment supprimer cet élément ?">
                <x-slot:trigger>
                    <x-daisy::ui.inputs.button color="error">Supprimer</x-daisy::ui.inputs.button>
                </x-slot:trigger>
            </x-daisy::ui.overlay.popconfirm>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.overlay.popconfirm message="Voulez-vous vraiment supprimer cet élément ?">
    <x-slot:trigger>
        <x-daisy::ui.inputs.button color="error">Supprimer</x-daisy::ui.inputs.button>
    </x-slot:trigger>
</x-daisy::ui.overlay.popconfirm>';
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
                height="200px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.custom id="behavior" title="Événements et modes" class="mt-10">
        <div class="not-prose space-y-3 text-sm text-base-content/80">
            <p>
                Chargement paresseux depuis <code class="kbd kbd-xs">resources/js/popconfirm.js</code> lorsque des nœuds
                <code class="kbd kbd-xs">[data-popconfirm]</code> ou <code class="kbd kbd-xs">[data-popconfirm-modal]</code> sont présents.
            </p>
            <div class="overflow-x-auto rounded-box border border-base-300">
                <table class="table table-sm">
                    <thead>
                        <tr><th>Événement</th><th>Quand</th></tr>
                    </thead>
                    <tbody>
                        <tr><td><code class="kbd kbd-xs">popconfirm:confirm</code></td><td>L’utilisateur valide (boutons avec <code class="kbd kbd-xs">data-popconfirm-action="confirm"</code>).</td></tr>
                        <tr><td><code class="kbd kbd-xs">popconfirm:cancel</code></td><td>Annulation ou fermeture équivalente.</td></tr>
                    </tbody>
                </table>
            </div>
            <p>
                Mode inline : racine <code class="kbd kbd-xs">data-popconfirm</code>, déclencheur <code class="kbd kbd-xs">.popconfirm-trigger</code>, panneau <code class="kbd kbd-xs">.popconfirm-panel</code>.
                Mode dialogue : déclencheur <code class="kbd kbd-xs">data-popconfirm-modal</code> pointant vers une modale ; actions avec <code class="kbd kbd-xs">data-popconfirm-modal-target</code>.
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
