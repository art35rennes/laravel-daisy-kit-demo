{{-- Hover gallery (daisyUI 5.1+) : survol horizontal pour prévisualiser plusieurs images. --}}
<section class="space-y-6 rounded-box bg-base-200 p-6">
    <h2 class="text-lg font-medium">Hover gallery</h2>
    <p class="text-sm text-base-content/70 max-w-2xl">
        Passez la souris horizontalement sur l’image pour faire défiler les vues (produit, lookbook, etc.).
    </p>

    <div class="flex flex-wrap gap-8">
        <div class="space-y-2">
            <p class="text-xs font-medium uppercase opacity-60">Prop <code class="kbd kbd-sm">images</code></p>
            <x-daisy::ui.media.hover-gallery
                maxWidth="max-w-60"
                :images="[
                    ['src' => 'https://picsum.photos/seed/hg1/400/300', 'alt' => 'Vue 1'],
                    ['src' => 'https://picsum.photos/seed/hg2/400/300', 'alt' => 'Vue 2'],
                    ['src' => 'https://picsum.photos/seed/hg3/400/300', 'alt' => 'Vue 3'],
                    ['src' => 'https://picsum.photos/seed/hg4/400/300', 'alt' => 'Vue 4'],
                ]"
            />
        </div>

        <div class="space-y-2">
            <p class="text-xs font-medium uppercase opacity-60">Dans une carte</p>
            <div class="card card-sm bg-base-100 card-border max-w-60 shadow">
                <x-daisy::ui.media.hover-gallery :maxWidth="''" class="w-full max-w-none">
                    <img src="https://picsum.photos/seed/card1/400/300" alt="A" loading="lazy" />
                    <img src="https://picsum.photos/seed/card2/400/300" alt="B" loading="lazy" />
                    <img src="https://picsum.photos/seed/card3/400/300" alt="C" loading="lazy" />
                </x-daisy::ui.media.hover-gallery>
                <div class="card-body gap-1">
                    <h3 class="card-title text-base justify-between">
                        Casquette
                        <span class="font-normal">32&nbsp;€</span>
                    </h3>
                    <p class="text-sm text-base-content/70">Survolez la photo pour voir les coloris.</p>
                </div>
            </div>
        </div>
    </div>
</section>
