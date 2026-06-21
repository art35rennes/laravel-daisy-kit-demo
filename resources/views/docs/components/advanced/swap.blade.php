@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'advanced';
    $name = 'swap';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'variants', 'label' => 'Variantes'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Échange" 
    category="advanced" 
    name="swap"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Échange" 
            subtitle="Échange entre deux éléments au clic."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="swap">
        <x-slot:preview>
            <x-daisy::ui.advanced.swap class="text-2xl">
                <x-slot:on>🌙</x-slot:on>
                <x-slot:off>☀️</x-slot:off>
            </x-daisy::ui.advanced.swap>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.advanced.swap class="text-2xl">
    <x-slot:on>🌙</x-slot:on>
    <x-slot:off>☀️</x-slot:off>
</x-daisy::ui.advanced.swap>';
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

    <x-daisy::docs.sections.variants name="swap">
        <x-slot:preview>
            <div class="space-y-4">
                <div>
                    <p class="text-sm font-semibold mb-2">Rotation</p>
                    <x-daisy::ui.advanced.swap :rotate="true" class="text-2xl">
                        <x-slot:on>✓</x-slot:on>
                        <x-slot:off>✗</x-slot:off>
                    </x-daisy::ui.advanced.swap>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">Flip</p>
                    <x-daisy::ui.advanced.swap :flip="true" class="text-2xl">
                        <x-slot:on>ON</x-slot:on>
                        <x-slot:off>OFF</x-slot:off>
                    </x-daisy::ui.advanced.swap>
                </div>
                <div>
                    <p class="text-sm font-semibold mb-2">Avec images</p>
                    <x-daisy::ui.advanced.swap>
                        <x-slot:on>
                            <img src="https://picsum.photos/100/100?random=1" class="h-20 w-20 rounded-box object-cover" alt="Image active" />
                        </x-slot:on>
                        <x-slot:off>
                            <img src="https://picsum.photos/100/100?random=2" class="h-20 w-20 rounded-box object-cover" alt="Image inactive" />
                        </x-slot:off>
                    </x-daisy::ui.advanced.swap>
                </div>
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $variantsCode = '{{-- Rotation --}}
<x-daisy::ui.advanced.swap :rotate="true">
    <x-slot:on>✓</x-slot:on>
    <x-slot:off>✗</x-slot:off>
</x-daisy::ui.advanced.swap>

{{-- Flip --}}
<x-daisy::ui.advanced.swap :flip="true">
    <x-slot:on>ON</x-slot:on>
    <x-slot:off>OFF</x-slot:off>
</x-daisy::ui.advanced.swap>

{{-- Avec images --}}
<x-daisy::ui.advanced.swap>
    <x-slot:on><img src="active.jpg" alt="Image active" /></x-slot:on>
    <x-slot:off><img src="inactive.jpg" alt="Image inactive" /></x-slot:off>
</x-daisy::ui.advanced.swap>';
            @endphp
            <x-daisy::ui.advanced.code-editor 
                language="blade" 
                :value="$variantsCode"
                :readonly="true"
                :showToolbar="false"
                :showFoldAll="false"
                :showUnfoldAll="false"
                :showFormat="false"
                :showCopy="true"
                height="350px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.variants>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
