<?php

it('opens and hydrates the host Blueprint inspector in the real bundle', function () {
    config()->set('daisy-kit.auto_assets', true);
    config()->set('daisy-kit.use_vite', false);

    $editor = '#demo-blueprint-release';
    $page = visit('/templates/advanced/blueprint');

    $page->assertSee('Workflow de publication')
        ->assertNoJavascriptErrors()
        ->assertScript('document.querySelectorAll('.json_encode($editor).').length', 1)
        ->assertScript('document.querySelector(\'script[type="module"]\').src.startsWith(location.origin)', true)
        ->assertScript('document.querySelectorAll('.json_encode($editor.' [data-blueprint-nodes] > [data-blueprint-node-id]').').length', 5)
        ->wait(1)
        ->click($editor.' [data-blueprint-action="arrange"]')
        ->assertScript(
            'function() { const blueprint = document.querySelector('.json_encode($editor).'); blueprint.__daisyBlueprint.openInspector({ type: "node", id: "review" }); return blueprint.querySelector("[data-blueprint-inspector]").open; }',
            true,
        )
        ->assertScript('document.querySelector('.json_encode($editor.' [data-blueprint-field="owner"]').').value', 'Camille')
        ->assertNoJavascriptErrors()
        ->assertNoConsoleLogs();
});
