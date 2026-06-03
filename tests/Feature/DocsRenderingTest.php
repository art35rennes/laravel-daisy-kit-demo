<?php

use App\Helpers\DocsHelper;
use Illuminate\Support\Facades\Config;

it('renders docs index page', function () {
    Config::set('daisy-kit.docs.enabled', true);
    $res = $this->get('/docs');
    $res->assertSuccessful();
    $res->assertSee('Documentation', false);
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
    $builder->assertSee('data-builder-editor-modal', false);
    $builder->assertSee('x-daisy::forms.builder', false);
    $builder->assertSee('FormFieldCatalog', false);
    $builder->assertSee('lead-capture-docs', false);

    $viewer = $this->get('/docs/forms/viewer');
    $viewer->assertSuccessful();
    $viewer->assertSee('data-module="form-viewer"', false);
    $viewer->assertSee('data-form-schema', false);
    $viewer->assertSee('Modes de soumission', false);
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
    $builder->assertSee('data-builder-editor-modal', false);

    $viewers = $this->get('/templates/forms/form-kit-viewers');
    $viewers->assertSuccessful();
    $viewers->assertSee('Viewer édition autonome', false);
    $viewers->assertSee('Viewer lecture seule', false);
    $viewers->assertSee('data-module="form-viewer"', false);
    $viewers->assertDontSee('data-form-builder-livewire', false);
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
