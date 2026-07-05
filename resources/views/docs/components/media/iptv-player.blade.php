@php
    use App\Helpers\DocsHelper;

    $category = 'media';
    $name = 'iptv-player';
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'base', 'label' => 'Exemple'],
        ['id' => 'api', 'label' => 'API'],
    ];
    $props = DocsHelper::getComponentProps($category, $name);
@endphp

<x-daisy::docs.page
    title="IPTV Player"
    category="media"
    name="iptv-player"
    type="component"
    :sections="$sections"
>
    <x-slot:intro>
        <x-daisy::docs.sections.intro
            title="IPTV Player"
            subtitle="Lecteur vidéo responsive pour flux supervisés, preview média ou sources live."
        />
    </x-slot:intro>

    <x-daisy::docs.sections.example name="iptv-player">
        <x-slot:preview>
            <x-daisy::ui.media.iptv-player
                src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4"
                title="Canal inspection"
                status="Source de démo"
                live
                muted
            />
        </x-slot:preview>
        <x-slot:code>
            @php
                $baseCode = '<x-daisy::ui.media.iptv-player
    src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4"
    title="Canal inspection"
    status="Source de démo"
    live
    muted
/>';
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
                height="260px"
            />
        </x-slot:code>
    </x-daisy::docs.sections.example>

    <x-daisy::docs.sections.api :category="$category" :name="$name" />
</x-daisy::docs.page>
