<x-daisy::layout.app title="Blueprint examples" :container="true">
    <div class="py-8">
        <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
            <div class="space-y-1">
                <h1 class="text-3xl font-bold">Blueprint examples</h1>
                <p class="max-w-3xl text-sm text-base-content/70">
                    Template avancé prêt à intégrer : workflow éditable, workflow readonly, schéma de données et pipeline d’intégration.
                </p>
            </div>

            <a href="{{ url('/docs/templates/advanced/blueprint') }}" class="btn btn-ghost btn-sm">Documentation</a>
        </div>

        <x-daisy::templates.advanced.blueprint
            :show-header="false"
            name-prefix="demo_blueprint"
            workflow-height="560px"
            example-height="420px"
        />
    </div>
</x-daisy::layout.app>
