{{-- Effets daisyUI 5.5+ : hover-3d, text-rotate --}}
<section class="space-y-8 rounded-box bg-base-200 p-6">
    <div>
        <h2 class="text-lg font-medium">Effets motion (daisyUI 5.5+)</h2>
        <p class="mt-1 text-sm text-base-content/70 max-w-2xl">
            <strong class="font-medium text-base-content">Hover 3D</strong> incline légèrement le contenu au survol.
            <strong class="font-medium text-base-content">Text rotate</strong> fait défiler des mots dans une phrase.
        </p>
    </div>

    <div class="grid gap-8 lg:grid-cols-2">
        <div class="space-y-3">
            <p class="text-xs font-medium uppercase opacity-60">Hover 3D — carte produit</p>
            <x-daisy::ui.advanced.hover-3d class="max-w-sm">
                <a href="#" class="card card-border bg-base-100 shadow block overflow-hidden rounded-box">
                    <figure class="aspect-[4/3] overflow-hidden">
                        <img src="https://picsum.photos/seed/h3d/600/450" alt="Produit" class="h-full w-full object-cover" loading="lazy" />
                    </figure>
                    <div class="card-body gap-1">
                        <h3 class="card-title text-base">Lampe bureau</h3>
                        <p class="text-sm text-base-content/70">Survolez pour l’effet de profondeur.</p>
                    </div>
                </a>
            </x-daisy::ui.advanced.hover-3d>
        </div>

        <div class="space-y-3">
            <p class="text-xs font-medium uppercase opacity-60">Text rotate — accroche</p>
            <div class="rounded-box border border-base-300 bg-base-100 p-6 shadow">
                <p class="text-xl font-semibold leading-snug md:text-2xl">
                    Nous aidons les équipes à
                    <x-daisy::ui.advanced.text-rotate
                        class="text-primary font-bold"
                        innerClass="justify-items-start"
                        :words="['livrer', 'itérer', 'grandir']"
                    />
                    plus vite.
                </p>
            </div>
        </div>
    </div>
</section>
