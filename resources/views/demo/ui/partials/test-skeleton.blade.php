<!-- Skeleton -->
<section class="space-y-4 bg-base-200 p-6 rounded-box">
    <h2 class="text-lg font-medium">Skeleton</h2>
    <div class="flex items-center gap-4">
        <x-daisy::ui.feedback.skeleton width="w-24" height="h-6" />
        <x-daisy::ui.feedback.skeleton width="w-36" height="h-6" />
        <x-daisy::ui.feedback.skeleton width="w-16" height="h-16" rounded="full" />
    </div>

    <!-- Circle with content -->
    <div class="flex w-52 flex-col gap-4">
        <div class="flex items-center gap-4">
            <x-daisy::ui.feedback.skeleton width="w-16" height="h-16" class="shrink-0" rounded="full" />
            <div class="flex flex-col gap-4 w-full">
                <x-daisy::ui.feedback.skeleton width="w-20" height="h-4" />
                <x-daisy::ui.feedback.skeleton width="w-28" height="h-4" />
            </div>
        </div>
        <x-daisy::ui.feedback.skeleton height="h-32" class="w-full" />
    </div>

    <!-- Rectangle with content -->
    <div class="flex w-52 flex-col gap-4">
        <x-daisy::ui.feedback.skeleton height="h-32" class="w-full" />
        <x-daisy::ui.feedback.skeleton width="w-28" height="h-4" />
        <x-daisy::ui.feedback.skeleton height="h-4" class="w-full" />
        <x-daisy::ui.feedback.skeleton height="h-4" class="w-full" />
    </div>

    <!-- Variante texte (daisyUI 5.5+) -->
    <div class="space-y-2">
        <p class="text-sm font-medium text-base-content/80">Variante <code class="kbd kbd-sm">text</code> (lignes de texte)</p>
        <div class="flex max-w-md flex-col gap-2">
            <x-daisy::ui.feedback.skeleton variant="text" class="h-4 w-full" />
            <x-daisy::ui.feedback.skeleton variant="text" class="h-4 w-[92%]" />
            <x-daisy::ui.feedback.skeleton variant="text" class="h-4 w-[78%]" />
        </div>
    </div>
</section>


