@php
    use App\Helpers\DocsHelper;

    $prefix = config('daisy-kit.docs.prefix', 'docs');
    $navItems = DocsHelper::getTemplateNavigationItems($prefix);
    $sections = [
        ['id' => 'intro', 'label' => 'Introduction'],
        ['id' => 'preview', 'label' => 'Preview'],
        ['id' => 'usage', 'label' => 'Usage'],
        ['id' => 'api', 'label' => 'API'],
    ];

    $basicUsage = <<<'CODE'
<x-daisy::templates.reporting.operations-dashboard
    detailed-url="/interventions"
    terrain-url="/interventions?scope=terrain"
    office-url="/interventions?scope=office"
    management-url="/indicateurs"
/>
CODE;

    $customUsage = <<<'CODE'
<x-daisy::templates.reporting.operations-dashboard
    title="Accueil"
    subtitle="Vue d’ensemble de vos enquêtes"
    brand="SUEZ"
    product="ECA3"
    perimeter="Agence Bretagne Sud"
    period="01/06/2026 - 16/06/2026"
    contract="Tous les contrats"
    survey-type="Tous (ANC / RAC)"
    user-name="Sophie Martin"
    user-role="Secrétaire technique"
/>
CODE;
@endphp

<x-daisy::layout.docs title="Operations dashboard" :sidebarItems="$navItems" :sections="$sections" :currentRoute="request()->path()">
    <x-slot:navbar>
        <x-daisy::ui.overlay.dropdown label="Templates" buttonClass="btn btn-sm btn-ghost" end>
            <li><a href="/{{ $prefix }}">Docs</a></li>
            <li><a href="{{ route('demo') }}">Démo</a></li>
            <li><a href="/{{ $prefix }}/templates" class="menu-active">Templates</a></li>
        </x-daisy::ui.overlay.dropdown>
    </x-slot:navbar>

    <section id="intro">
        <h1>Operations dashboard</h1>
        <p class="text-base-content/70">
            Template de reporting opérationnel pour piloter des enquêtes ou interventions avec filtres,
            KPI cards, sections terrain/bureau/gestion, graphiques et accès rapides.
        </p>
        <div class="mt-4 grid gap-3 md:grid-cols-2">
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Vue</h3>
                <p class="mt-1 text-sm text-base-content/70"><code>{{ "view('daisy::templates.reporting.operations-dashboard')" }}</code></p>
            </div>
            <div class="rounded-box border border-base-300 bg-base-100 p-4">
                <h3 class="font-semibold">Alias composant</h3>
                <p class="mt-1 text-sm text-base-content/70"><code>&lt;x-daisy::templates.reporting.operations-dashboard /&gt;</code></p>
            </div>
        </div>
    </section>

    <section id="preview" class="mt-10">
        <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
            <h2>Preview</h2>
            <a href="{{ route('templates.reporting.operations-dashboard') }}" class="btn btn-primary btn-sm">Voir en pleine page</a>
        </div>

        <x-daisy::templates.reporting.operations-dashboard
            detailed-url="/interventions"
            terrain-url="/interventions?scope=terrain"
            office-url="/interventions?scope=office"
            management-url="/indicateurs"
        />
    </section>

    <section id="usage" class="mt-10">
        <h2>Usage</h2>
        <div class="grid gap-4 lg:grid-cols-2">
            <div>
                <h3 class="text-base font-semibold">Utilisation rapide</h3>
                <div class="mockup-code mt-3">
                    <pre data-prefix=""><code>{{ $basicUsage }}</code></pre>
                </div>
            </div>
            <div>
                <h3 class="text-base font-semibold">Personnalisation du contexte</h3>
                <div class="mockup-code mt-3">
                    <pre data-prefix=""><code>{{ $customUsage }}</code></pre>
                </div>
            </div>
        </div>
    </section>

    <section id="api" class="mt-10">
        <h2>API</h2>
        <div class="overflow-x-auto rounded-box border border-base-300 bg-base-100">
            <table class="table">
                <thead>
                    <tr>
                        <th>Prop</th>
                        <th>Rôle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td><code>title</code>, <code>subtitle</code></td><td>Titre et sous-titre de page.</td></tr>
                    <tr><td><code>brand</code>, <code>product</code></td><td>Signal de marque et nom d’application dans la navigation.</td></tr>
                    <tr><td><code>perimeter</code>, <code>period</code>, <code>contract</code>, <code>surveyType</code></td><td>Valeurs affichées dans la barre de filtres.</td></tr>
                    <tr><td><code>detailedUrl</code>, <code>terrainUrl</code>, <code>officeUrl</code>, <code>managementUrl</code></td><td>Liens vers les listes et indicateurs détaillés.</td></tr>
                    <tr><td><code>userName</code>, <code>userRole</code></td><td>Identité affichée dans la topbar.</td></tr>
                </tbody>
            </table>
        </div>
    </section>
</x-daisy::layout.docs>
