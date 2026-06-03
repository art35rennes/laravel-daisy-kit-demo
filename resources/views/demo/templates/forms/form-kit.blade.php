<x-daisy::layout.navbar-layout title="Form Kit">
    <div class="mx-auto flex w-full max-w-7xl flex-col gap-6 px-4 py-6">
        <header class="space-y-2">
            <div class="flex flex-wrap items-center gap-2">
                <h1 class="text-2xl font-semibold">Form Kit</h1>
                <span class="badge badge-primary badge-outline">Démo applicative</span>
                <span class="badge badge-outline">Schema 1.0</span>
            </div>
            <p class="max-w-4xl text-base-content/80">
                La démo est séparée en deux templates pour clarifier les rôles : authoring du schéma d’un côté, usages viewer autonomes de l’autre.
            </p>
        </header>

        <section class="grid gap-4 lg:grid-cols-2">
            <x-daisy::ui.layout.card bordered compact>
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold">Builder + preview</h2>
                        <p class="text-sm text-base-content/70">Template d’authoring Livewire avec le vrai viewer en preview intégrée.</p>
                    </div>
                    <span class="badge badge-primary badge-outline">builder</span>
                </div>
                <a href="{{ route('templates.forms.form-kit-builder') }}" class="btn btn-primary btn-sm">Ouvrir le template builder</a>
            </x-daisy::ui.layout.card>

            <x-daisy::ui.layout.card bordered compact>
                <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold">Viewers autonomes</h2>
                        <p class="text-sm text-base-content/70">Template séparé avec viewer édition et viewer lecture seule sur le même schéma.</p>
                    </div>
                    <span class="badge badge-success badge-outline">viewer</span>
                </div>
                <a href="{{ route('templates.forms.form-kit-viewers') }}" class="btn btn-primary btn-sm">Ouvrir le template viewers</a>
            </x-daisy::ui.layout.card>
        </section>
    </div>
</x-daisy::layout.navbar-layout>
