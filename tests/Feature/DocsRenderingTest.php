<?php

use App\Helpers\ComponentScanner;
use App\Helpers\DocsHelper;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

it('renders docs index page', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $componentCount = count(ComponentScanner::readCached()['components'] ?? []);
    $res = $this->get('/docs');
    $res->assertSuccessful();
    $res->assertSee('Documentation', false);
    $res->assertSee('/docs/components', false);
    $res->assertSee('Couverture complète', false);
    $res->assertSee('Composants publics', false);
    $res->assertSee('Templates publics', false);
    $res->assertSee('Documentés', false);
    $res->assertSee('Partiellement documentés', false);
    $res->assertSee('Non documentés', false);
    $res->assertSee('Aucun composant partiel', false);
    $res->assertSee('Aucun composant manquant', false);
    $res->assertSee('Getting Started', false);
    $res->assertSee('composer require art35rennes/laravel-daisy-kit', false);
    $res->assertSee('php artisan vendor:publish --tag=daisy-config', false);
    $res->assertSee('php artisan vendor:publish --tag=daisy-assets', false);
    $res->assertSee('x-daisy::layout.app', false);
    $res->assertSee('x-daisy::ui.feedback.alert', false);
    $res->assertSee('Livewire 4.3', false);
    $res->assertSee((string) $componentCount, false);
    $res->assertSee('33', false);
    $res->assertSee('Parcours rapides', false);
    $res->assertSee('Démo UI', false);
    $res->assertSee('/docs/data-display/table', false);
    $res->assertSee('/docs/forms/builder', false);
    $res->assertSee('/docs/templates/auth/login-simple', false);
    $res->assertSee('Audit et trajectoire', false);
    $res->assertSee('Problèmes traités par impact', false);
    $res->assertSee('Structure cible', false);
    $res->assertSee('Layouts', false);
    $res->assertSee('/docs/layout/grid-layout', false);
    $res->assertSee('Feedback', false);
    $res->assertSee('/docs/feedback/alert', false);
    $res->assertSee('Navigation', false);
    $res->assertSee('/docs/navigation/menu', false);
    $res->assertSee('Auth', false);
    $res->assertSee('/docs/templates/auth/login-simple', false);
    $res->assertSee('CRUD', false);
    $res->assertSee('/docs/layout/crud-layout', false);
    $res->assertSee('Recommandations finales', false);
    $res->assertSee('Pages docs non couvertes', false);
    $res->assertSee('Contrat public implicite', false);
    $res->assertSee('Démos interactives faillibles', false);
    $res->assertSee('Assets package publiés', false);
    $res->assertSee('références Vite vérifiées; 0 fichier manquant.', false);
    $res->assertSee('Advanced Usage', false);
    $res->assertSee('Documenter tout bug confirmé côté package Daisy Kit à la source', false);
});

it('renders the component index page linked from the docs home', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $componentCount = count(ComponentScanner::readCached()['components'] ?? []);

    $res = $this->get('/docs/components');

    $res->assertSuccessful();
    $res->assertSee('Composants UI', false);
    $res->assertSee('Contrat public', false);
    $res->assertSee('Alias publics', false);
    $res->assertSee('Entrées recommandées', false);
    $res->assertSee("active · {$componentCount}", false);
    $res->assertSee('Modules JS', false);
    $res->assertSee('27', false);
    $res->assertSee('Rechercher dans les composants', false);
    $res->assertSee('Filtre par nom, alias public, catégorie, tag ou module JS.', false);
    $res->assertSee("{$componentCount} composants affichés sur {$componentCount}.", false);
    $res->assertSee('x-daisy::ui.data-display.table', false);
    $res->assertSee('x-daisy::forms.builder', false);
    $res->assertSee('Alias public :', false);
    $res->assertSee('Vue package :', false);
    $res->assertSee('/docs/data-display/file-preview-trigger', false);
    $res->assertSee('/docs/utilities/truncate-text', false);
});

it('filters the component index by name alias category tag or js module', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $componentCount = count(ComponentScanner::readCached()['components'] ?? []);

    $filtered = $this->get('/docs/components?q=alert-dismiss');

    $filtered->assertSuccessful();
    $filtered->assertSee('value="alert-dismiss"', false);
    $filtered->assertSee('Module JS : <code>alert-dismiss</code>', false);
    $filtered->assertSee("1 composant affiché sur {$componentCount}.", false);
    $filtered->assertSee('/docs/feedback/alert', false);
    $filtered->assertDontSee('Alias public : <code>x-daisy::ui.data-display.table</code>', false);

    $missing = $this->get('/docs/components?q=aucun-composant');

    $missing->assertSuccessful();
    $missing->assertSee('value="aucun-composant"', false);
    $missing->assertSee("0 composant affiché sur {$componentCount}.", false);
    $missing->assertSee('Aucun composant trouvé', false);
});

it('renders the template index page with public contracts and previews', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $res = $this->get('/docs/templates');

    $res->assertSuccessful();
    $res->assertSee('Templates', false);
    $res->assertSee('Contrat templates', false);
    $res->assertSee('Templates publics', false);
    $res->assertSee('Réutilisables', false);
    $res->assertSee('Exemples', false);
    $res->assertSee('Previews', false);
    $res->assertSee('Les templates layout du package se rendent maintenant directement via <code>view()</code>', false);
    $res->assertSee('Les boutons <code>Voir</code> pointent donc vers les routes de preview officielles de la démo.', false);
    $res->assertSee('33', false);
    $res->assertSee('14', false);
    $res->assertSee('19', false);
    $res->assertSee('21', false);
    $res->assertSee('x-daisy::templates.auth.login-simple', false);
    $res->assertSee('daisy::templates.form.builder', false);
    $res->assertSee('templates.forms.builder', false);
    $res->assertSee('/docs/templates/auth/login-simple', false);
    $res->assertSee('/docs/templates/form/builder', false);
});

it('links every template card to an accessible documentation page', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $response = $this->get('/docs/templates');
    $response->assertSuccessful();

    preg_match_all('/href="(?<href>\/docs\/templates\/[^"]+)"/', $response->getContent(), $matches);

    $brokenLinks = collect($matches['href'])
        ->unique()
        ->reject(fn (string $href): bool => $this->get($href)->isSuccessful())
        ->values()
        ->all();

    expect($brokenLinks)->toBeEmpty('Broken template documentation links: '.implode(', ', $brokenLinks));
});

it('links every previewable template card to an accessible preview route', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $response = $this->get('/docs/templates');
    $response->assertSuccessful();

    preg_match_all('/href="(?<href>(?:https?:\/\/[^"]+)?\/templates\/[^"]+)"/', $response->getContent(), $matches);

    $previewLinks = collect($matches['href'])->unique()->values();
    $brokenLinks = $previewLinks
        ->reject(fn (string $href): bool => $this->get($href)->isSuccessful())
        ->values()
        ->all();

    expect($previewLinks)->toHaveCount(21);
    expect($brokenLinks)->toBeEmpty('Broken template preview links: '.implode(', ', $brokenLinks));
});

it('exposes package layout templates through official preview routes', function () {
    collect([
        '/templates/layouts/footer',
        '/templates/layouts/grid',
        '/templates/layouts/navbar',
        '/templates/layouts/navbar-footer',
        '/templates/layouts/navbar-grid-footer',
    ])->each(fn (string $href) => $this->get($href)->assertSuccessful());
});

it('renders a component page (button)', function () {
    Config::set('daisy-kit.docs.enabled', true);
    Config::set('app.locale', 'en');
    $res = $this->get('/docs/inputs/button');
    $res->assertSuccessful();
    $res->assertSee('Button', false);
});

it('renders the table documentation with the current component API', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $res = $this->get('/docs/data-display/table');

    $res->assertSuccessful();
    $res->assertSee('x-daisy::ui.data-display.table', false);
    $res->assertSee('mode=&quot;server&quot;', false);
    $res->assertSee('endpoint=&quot;{{ route(', false);
    $res->assertSee('persist-state=&quot;url&quot;', false);
    $res->assertSee('data-table-filter="active_only"', false);
    $res->assertSee('Détails, sous-lignes et liens', false);
    $res->assertSee('Édition inline et filtres dates', false);
    $res->assertSee('row-detail=&quot;inline&quot;', false);
    $res->assertSee('sub-rows-key=&quot;children&quot;', false);
    $res->assertSee('column-resizing', false);
    $res->assertSee('edit-endpoint=&quot;{{ route(', false);
    $res->assertSee('edit-mode=&quot;row&quot;', false);
    $res->assertSee('date-range', false);
    $res->assertSee('<code>searchMode</code>', false);
    $res->assertSee('<code>rowDetail</code>', false);
    $res->assertSee('<code>editable</code>', false);
    $res->assertSee('<code>linkPolicy</code>', false);
    $res->assertDontSee('x-daisy::ui.advanced.table', false);
});

it('renders the datatable migration documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $res = $this->get('/docs/data-display/datatable');

    $res->assertSuccessful();
    $res->assertSee('x-daisy::ui.data-display.datatable', false);
    $res->assertSee('x-daisy::ui.data-display.table', false);
    $res->assertSee('retiré', false);
});

it('renders the updated code editor and tree view documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $codeEditor = $this->get('/docs/advanced/code-editor');
    $codeEditor->assertSuccessful();
    $codeEditor->assertSee('name="payload"', false);
    $codeEditor->assertSee('theme="dark"', false);

    $treeView = $this->get('/docs/advanced/tree-view');
    $treeView->assertSuccessful();
    $treeView->assertSee('data-indeterminate="true"', false);
    $treeView->assertSee('aria-checked="mixed"', false);
});

it('renders the leaflet GIS and measurement documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $response = $this->get('/docs/media/leaflet');

    $response->assertSuccessful();
    $response->assertSee('SIG & mesures');
    $response->assertSee('basemaps', false);
    $response->assertSee('Plan clair', false);
    $response->assertSee('Plan couleur', false);
    $response->assertSee('Plan sans libellés', false);
    $response->assertSee('Contraste sombre', false);
    $response->assertSee('overlays', false);
    $response->assertSee('layerControl', false);
    $response->assertSee('lockedOverlays', false);
    $response->assertSee('Couche active', false);
    $response->assertSee('name="geometry"', false);
    $response->assertSee('daisy:leaflet:change', false);
    $response->assertSee('daisy:leaflet:measure', false);
    $response->assertSee('daisy:leaflet:object-created', false);
    $response->assertSee('daisy:leaflet:zone-select', false);
    $response->assertSee('daisy:leaflet:selection-details', false);
    $response->assertSee('daisy:leaflet:draw-layer-change', false);
    $response->assertSee('daisy:leaflet:geolocation:success', false);
    $response->assertSee('exportGeoJSON', false);
    $response->assertSee('destroy()', false);
    $response->assertSee('contenu maîtrisé par l', false);
    $response->assertSee('objectTypes', false);
    $response->assertSee('objectTypes[].style', false);
    $response->assertSee('draw.styles', false);
    $response->assertSee('groupedToolbar', false);
    $response->assertSee('actionBadge', false);
    $response->assertSee('selectionDetails', false);
    $response->assertSee('drawLayers', false);
    $response->assertSee('getSelectionDetails', false);
    $response->assertSee('showSelectionDetails', false);
    $response->assertSee('startGeolocation', false);
    $response->assertSee('maxLabels', false);
    $response->assertSee('Borne incendie', false);
    $response->assertSee('Conduite AEP', false);
    $response->assertSee('Zone de travaux', false);
    $response->assertSee('iconSvg', false);
    $response->assertSee('markerSvg', false);
    $response->assertSee('mesure traçable');
});

it('renders the new charts documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $line = $this->get('/docs/charts/line');
    $line->assertSuccessful();
    $line->assertSee('x-daisy::charts.line', false);
    $line->assertSee('data-daisy-chart="1"', false);

    $sparkline = $this->get('/docs/charts/sparkline');
    $sparkline->assertSuccessful();
    $sparkline->assertSee('x-daisy::charts.sparkline', false);
    $sparkline->assertSee('Pipeline', false);
});

it('renders the form kit and choice card documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $builder = $this->get('/docs/forms/builder');
    $builder->assertSuccessful();
    $builder->assertSee('data-form-builder-livewire', false);
    $builder->assertDontSee('data-builder-editor-modal', false);
    $builder->assertSee('x-daisy::forms.builder', false);
    $builder->assertSee('FormFieldCatalog', false);
    $builder->assertSee('lead-capture-docs', false);
    $builder->assertSee('Cliquez sur une ligne du plan pour la sélectionner', false);

    $viewer = $this->get('/docs/forms/viewer');
    $viewer->assertSuccessful();
    $viewer->assertSee('data-module="form-viewer"', false);
    $viewer->assertSee('data-form-schema', false);
    $viewer->assertSee('Modes de soumission', false);
    $viewer->assertSee('validate-on', false);
    $viewer->assertSee('window.DaisyFormViewer', false);
    $viewer->assertSee('runtime.setValue', false);
    $viewer->assertSee('daisy-form:ready', false);
    $viewer->assertSee('daisy-form:submit', false);

    $choiceCards = $this->get('/docs/inputs/choice-card-group');
    $choiceCards->assertSuccessful();
    $choiceCards->assertSee('name="plan_docs"', false);
    $choiceCards->assertSee('Choice card group', false);
});

it('renders the interactive form kit demo pages', function () {
    $index = $this->get('/templates/forms/form-kit');
    $index->assertSuccessful();
    $index->assertSee('Builder + preview', false);
    $index->assertSee('Viewers autonomes', false);

    $builder = $this->get('/templates/forms/form-kit-builder');
    $builder->assertSuccessful();
    $builder->assertSee('data-module="form-viewer"', false);
    $builder->assertSee('data-form-builder-livewire', false);
    $builder->assertDontSee('data-builder-editor-modal', false);

    $viewers = $this->get('/templates/forms/form-kit-viewers');
    $viewers->assertSuccessful();
    $viewers->assertSee('Viewer édition autonome', false);
    $viewers->assertSee('Viewer lecture seule', false);
    $viewers->assertSee('data-module="form-viewer"', false);
    $viewers->assertDontSee('data-form-builder-livewire', false);
});

it('renders the blueprint template preview with layout assets', function () {
    $template = $this->get('/templates/advanced/blueprint');

    $template->assertSuccessful();
    $template->assertSee('<html', false);
    $template->assertSee('<head>', false);
    $template->assertSee('</body>', false);
    $template->assertSee('data-module="blueprint"', false);
    $template->assertSee('Workflow de publication', false);
    $template->assertSee('name="demo_blueprint_release"', false);
    $template->assertSee('data-mode="edit"', false);
    $template->assertSee('data-direction="TB"', false);
    $template->assertSee('data-blueprint-node-categories', false);
    $template->assertSee('"eligibility_rule":"$exists(content.title)"', false);
    $template->assertSee('data-blueprint-inspector', false);
    $template->assertSee('data-blueprint-inspector-content', false);
    $template->assertSee('"opaque_reference":"EDITORIAL-42"', false);
    $template->assertSee('Soumettre une version', false);
    $template->assertSee('name="demo_blueprint_autosave"', false);
    $template->assertSee('Seconde instance synchronisée', false);
    $template->assertSee('Aperçu lecture seule', false);
    $template->assertSee('name="demo_blueprint_release_view"', false);
    $template->assertSee('data-mode="view"', false);
    $template->assertSee('Récupérer le workflow synchronisé', false);
    $template->assertSee('Enregistrer', false);
    $template->assertDontSee('Internal Server Error', false);
    $template->assertDontSee('TypeError', false);
});

it('renders the reporting operations dashboard docs and preview', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $docs = $this->get('/docs/templates/reporting/operations-dashboard');
    $docs->assertSuccessful();
    $docs->assertSee('Operations dashboard', false);
    $docs->assertSee('x-daisy::templates.reporting.operations-dashboard', false);
    $docs->assertSee('templates.reporting.operations-dashboard', false);
    $docs->assertSee('Terrain', false);
    $docs->assertSee('data-daisy-chart="1"', false);
    $docs->assertDontSee('data-reporting-chart', false);
    $docs->assertDontSee('No data available', false);

    $preview = $this->get('/templates/reporting/operations-dashboard');
    $preview->assertSuccessful();
    $preview->assertSee('<html', false);
    $preview->assertSee('Terrain', false);
    $preview->assertSee('Bureau', false);
    $preview->assertSee('Gestion', false);
    $preview->assertSee('data-daisy-chart="1"', false);
    $preview->assertDontSee('data-reporting-chart', false);
    $preview->assertDontSee('No data available', false);
    $preview->assertDontSee('Internal Server Error', false);
});

it('renders the form kit template documentation page', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $response = $this->get('/docs/templates/form/form-kit');

    $response->assertSuccessful();
    $response->assertSee('Form Kit (démo applicative)', false);
    $response->assertSee('resources/views/demo/templates/forms/form-kit-builder.blade.php', false);
    $response->assertSee('resources/views/demo/templates/forms/form-kit-viewers.blade.php', false);
});

it('renders the token input and section nav documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $tokenInput = $this->get('/docs/inputs/token-input');
    $tokenInput->assertSuccessful();
    $tokenInput->assertSee('data-module="token-input"', false);
    $tokenInput->assertSee('name="recipients[]"', false);
    $tokenInput->assertSee('data-suggestions=', false);

    $multiSelect = $this->get('/docs/inputs/multi-select');
    $multiSelect->assertSuccessful();
    $multiSelect->assertSee('data-module="multi-select"', false);
    $multiSelect->assertSee('name="countries[]"', false);
    $multiSelect->assertSee(route('demo.select.options'), false);

    $sectionNav = $this->get('/docs/navigation/section-nav');
    $sectionNav->assertSuccessful();
    $sectionNav->assertSee('data-section-nav', false);
    $sectionNav->assertSee('data-section-nav-button', false);
    $sectionNav->assertSee('fixed top-6 right-6', false);
});

it('renders the editable grid documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $grid = $this->get('/docs/layout/editable-grid');
    $grid->assertSuccessful();
    $grid->assertSee('data-module="editable-grid"', false);
    $grid->assertSee('grid-stack daisy-editable-grid', false);
    $grid->assertSee('responsive', false);
    $grid->assertSee('Team priorities', false);

    $item = $this->get('/docs/layout/editable-grid-item');
    $item->assertSuccessful();
    $item->assertSee('gs-x="4"', false);
    $item->assertSee('data-meta=', false);
});

it('renders the form kit builder and viewer documentation', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $docs = $this->get('/docs/templates/form/form-builder');
    $docs->assertSuccessful();
    $docs->assertSee('Form builder', false);
    $docs->assertSee('x-daisy::templates.form.builder', false);
    $docs->assertSee('x-daisy::forms.viewer', false);
    $docs->assertSee('data-module="form-builder"', false);
    $docs->assertSee('data-module="form-viewer"', false);

    $template = $this->get('/templates/forms/builder');
    $template->assertSuccessful();
    $template->assertSee('data-module="form-builder"', false);
    $template->assertSee('data-module="form-viewer"', false);
});

it('renders every public component currently present in the inventory cache', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $manifest = require base_path('bootstrap/cache/daisy-components.php');
    $missing = [];

    foreach ($manifest['components'] ?? [] as $component) {
        $category = $component['category'] ?? '';
        $name = $component['name'] ?? '';

        if ($category === '' || $name === '') {
            continue;
        }

        $response = $this->get("/docs/{$category}/{$name}");

        if ($response->status() === 404) {
            $missing[] = "{$category}/{$name}";

            continue;
        }

        $response->assertSee('Contrat d’usage', false);
        $response->assertSee('Alias public', false);
        $response->assertSee('Cas d’usage', false);
        $response->assertSee('États visuels', false);
        $response->assertSee('Exemples copiables', false);
        $response->assertSee('Accessibilité et pièges', false);
        $response->assertSee('Responsabilités hôte', false);
    }

    expect($missing)->toBeEmpty('Missing docs pages: '.implode(', ', $missing));
})->group('docs');

it('keeps every public component documentation page minimally useful', function () {
    $manifest = require base_path('bootstrap/cache/daisy-components.php');
    $issues = [];

    foreach ($manifest['components'] ?? [] as $component) {
        $category = $component['category'] ?? '';
        $name = $component['name'] ?? '';
        $view = $component['view'] ?? '';
        $jsModule = $component['jsModule'] ?? null;

        if ($category === '' || $name === '') {
            continue;
        }

        $path = resource_path("views/docs/components/{$category}/{$name}.blade.php");

        if (! file_exists($path)) {
            $issues[] = "{$category}/{$name}: missing file";

            continue;
        }

        $contents = file_get_contents($path);
        $alias = 'x-daisy::'.str_replace('daisy::components.', '', $view);
        $hasExample = str_contains($contents, 'docs.sections.example')
            || str_contains($contents, '<x-slot:preview>');

        if (! str_contains($contents, 'docs.sections.intro')) {
            $issues[] = "{$category}/{$name}: missing intro section";
        }

        if (! $hasExample) {
            $issues[] = "{$category}/{$name}: missing example section";
        }

        if (! str_contains($contents, 'docs.sections.api')) {
            $issues[] = "{$category}/{$name}: missing API section";
        }

        if ($view !== '' && ! str_contains($contents, $alias)) {
            $issues[] = "{$category}/{$name}: missing public alias {$alias}";
        }

        if ($jsModule && ! str_contains($contents, $jsModule)) {
            $issues[] = "{$category}/{$name}: missing JS module {$jsModule}";
        }
    }

    expect($issues)->toBeEmpty('Documentation quality issues: '.implode(', ', $issues));
})->group('docs');

it('keeps every template documentation page previewable and copyable', function () {
    $templatesByCategory = DocsHelper::getTemplatesByCategory();
    $issues = [];

    $readTemplateDocs = function (string $path): string {
        $contents = file_get_contents($path);

        if (preg_match("/@include\\('daisy-dev::([^']+)'\\)/", $contents, $matches) !== 1) {
            return $contents;
        }

        $includedPath = resource_path('views/'.str_replace('.', '/', $matches[1]).'.blade.php');

        if (! file_exists($includedPath)) {
            return $contents;
        }

        return $contents."\n".file_get_contents($includedPath);
    };

    foreach ($templatesByCategory as $categoryId => $category) {
        foreach ($category['templates'] ?? [] as $template) {
            $name = $template['name'] ?? '';

            if ($name === '') {
                continue;
            }

            $path = resource_path("views/docs/templates/{$categoryId}/{$name}.blade.php");
            $key = "{$categoryId}/{$name}";

            if (! file_exists($path)) {
                $issues[] = "{$key}: missing file";

                continue;
            }

            $contents = $readTemplateDocs($path);
            $hasCopyableUsage = str_contains($contents, 'code-editor')
                || str_contains($contents, '<code')
                || str_contains($contents, 'x-daisy::');

            if (! $hasCopyableUsage) {
                $issues[] = "{$key}: missing copyable usage";
            }

            $routeName = $template['route'] ?? null;

            if ($routeName && Route::has($routeName) && ! str_contains($contents, $routeName)) {
                $issues[] = "{$key}: missing preview route {$routeName}";
            }

            $component = $template['component'] ?? null;
            $view = $template['view'] ?? null;

            if ($component && ! str_contains($contents, $component) && ! str_contains($contents, 'x-daisy::'.str_replace('daisy::', '', $component))) {
                $issues[] = "{$key}: missing component contract {$component}";
            }

            if (! $component && $view && ! str_contains($contents, $view)) {
                $issues[] = "{$key}: missing view contract {$view}";
            }
        }
    }

    expect($issues)->toBeEmpty('Template documentation quality issues: '.implode(', ', $issues));
})->group('docs');

it('documents the file preview trigger and truncate text public components', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $trigger = $this->get('/docs/data-display/file-preview-trigger');
    $trigger->assertSuccessful();
    $trigger->assertSee('x-daisy::ui.data-display.file-preview-trigger', false);
    $trigger->assertSee('data-file-preview-trigger', false);
    $trigger->assertSee('disabledWhenUnavailable', false);

    $truncate = $this->get('/docs/utilities/truncate-text');
    $truncate->assertSuccessful();
    $truncate->assertSee('x-daisy::ui.utilities.truncate-text', false);
    $truncate->assertSee('data-module="truncate-text"', false);
    $truncate->assertSee('tooltipOnlyWhenTruncated', false);
});

it('renders the ordered list and transfer documentation with the updated API', function () {
    Config::set('daisy-kit.docs.enabled', true);

    $orderedList = $this->get('/docs/layout/ordered-list');
    $orderedList->assertSuccessful();
    $orderedList->assertSee('data-module="ordered-list"', false);
    $orderedList->assertSee('name="roadmap_order"', false);

    $transfer = $this->get('/docs/advanced/transfer');
    $transfer->assertSuccessful();
    $transfer->assertSee('data-drag-and-drop="true"', false);
    $transfer->assertSee('data-transfer-handle', false);
    $transfer->assertSee('customId', false);
});

it('does not return 404 for any component documentation page', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $prefix = config('daisy-kit.docs.prefix', 'docs');

    $navigationItems = DocsHelper::getNavigationItems($prefix);
    $failedComponents = [];

    foreach ($navigationItems as $category) {
        foreach ($category['children'] ?? [] as $component) {
            $href = $component['href'] ?? '';
            if ($href === '') {
                continue;
            }

            // Extraire le chemin depuis l'href (ex: /docs/inputs/button)
            $path = parse_url($href, PHP_URL_PATH);
            if ($path === null) {
                continue;
            }

            $response = $this->get($path);

            if ($response->status() === 404) {
                $failedComponents[] = $path;
            }
        }
    }

    if (! empty($failedComponents)) {
        $message = 'Les pages suivantes retournent 404 : '.implode(', ', $failedComponents);
        expect($failedComponents)->toBeEmpty($message);
    }

    expect($failedComponents)->toBeEmpty();
})->group('docs');

it('renders documentation for the newly inventoried components', function () {
    $this->get('/docs/advanced/calendar-vanilla')
        ->assertSuccessful()
        ->assertSee('x-daisy::ui.advanced.calendar-vanilla', false)
        ->assertSee('data-calendar-vanilla="1"', false)
        ->assertSee('value-separator', false);

    $this->get('/docs/navigation/sidebar')
        ->assertSuccessful()
        ->assertSee('Réduction et recherche', false)
        ->assertSee('storage-key', false)
        ->assertSee('searchable', false);

    $this->get('/docs/advanced/aura')
        ->assertSuccessful()
        ->assertSee('x-daisy::ui.advanced.aura', false)
        ->assertSee('aura-rainbow', false);

    $this->get('/docs/inputs/otp')
        ->assertSuccessful()
        ->assertSee('x-daisy::ui.inputs.otp', false)
        ->assertSee('autocomplete="one-time-code"', false);

    $this->get('/docs/navigation/megamenu')
        ->assertSuccessful()
        ->assertSee('x-daisy::ui.navigation.megamenu', false)
        ->assertSee('megamenu-wide', false)
        ->assertSee('docs-megamenu-products', false)
        ->assertSee('Produits', false);
})->group('docs');
