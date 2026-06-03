@php
    use App\Helpers\DocsHelper;
    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $category = 'feedback';
    $name = 'skeleton';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple de base'],
        ['id' => 'patterns', 'label' => 'Patterns'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page 
    title="Squelette" 
    category="feedback" 
    name="skeleton"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro 
            title="Squelette" 
            subtitle="Placeholder de chargement."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="skeleton">
        <x-slot:preview>
            <div class="space-y-2">
                <x-daisy::ui.feedback.skeleton width="300" height="20" />
                <x-daisy::ui.feedback.skeleton width="250" height="20" />
                <x-daisy::ui.feedback.skeleton width="200" height="20" />
            </div>
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.feedback.skeleton width="300" height="20" />
<x-daisy::ui.feedback.skeleton width="250" height="20" />
<x-daisy::ui.feedback.skeleton width="200" height="20" />';
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

    <x-daisy::docs.sections.custom id="patterns" title="Composition utile" class="mt-10">
        <div class="not-prose space-y-4">
            <p class="text-sm text-base-content/80">
                Combinez plusieurs squelettes dans une carte ou une liste pour simuler la structure finale ; évitez un bloc unique trop large qui « pulse » sans repères visuels.
            </p>
            <div class="rounded-box border border-base-300 bg-base-100 p-4 shadow-sm">
                <div class="flex gap-4">
                    <x-daisy::ui.feedback.skeleton rounded="full" width="w-12" height="h-12" />
                    <div class="grow space-y-2">
                        <x-daisy::ui.feedback.skeleton height="h-3.5" />
                        <x-daisy::ui.feedback.skeleton height="h-3.5" width="w-4/5" />
                        <x-daisy::ui.feedback.skeleton height="h-3.5" width="w-3/5" />
                    </div>
                </div>
            </div>
            <p class="text-xs text-base-content/65">
                Les props <code class="kbd kbd-xs">width</code> et <code class="kbd kbd-xs">height</code> concatènent des utilitaires Tailwind (ex. <code class="kbd kbd-xs">w-full</code>, <code class="kbd kbd-xs">h-4</code>) ; utilisez <code class="kbd kbd-xs">rounded</code> pour les avatars circulaires.
            </p>
        </div>
    </x-daisy::docs.sections.custom>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
