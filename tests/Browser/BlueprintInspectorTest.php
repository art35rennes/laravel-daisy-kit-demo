<?php

it('edits integrator fields and preserves Blueprint history in the real bundle', function () {
    config()->set('daisy-kit.auto_assets', true);
    config()->set('daisy-kit.use_vite', false);

    $page = visit('/templates/advanced/blueprint');
    $editor = '[data-module="blueprint"]:has([name="demo_blueprint_release"])';
    $autosaveEditor = '[data-module="blueprint"]:has([name="demo_blueprint_autosave"])';

    $page->assertSee('Workflow de publication')
        ->assertNoJavascriptErrors()
        ->assertScript('document.querySelectorAll('.json_encode($editor).').length', 1)
        ->assertScript('document.querySelector(\'script[type="module"]\').src.startsWith(location.origin)', true)
        ->assertScript('document.querySelectorAll('.json_encode($editor.' [data-blueprint-nodes] > [data-blueprint-node-id]').').length', 5)
        ->click($editor.' [data-blueprint-nodes] > [data-blueprint-node-id="review"]')
        ->wait(1)
        ->fill($editor.' [data-blueprint-field="owner"]', 'Grace')
        ->fill($editor.' [data-blueprint-field="sla_hours"]', '6')
        ->select($editor.' [data-blueprint-field="priority"]', 'critical')
        ->uncheck($editor.' [data-blueprint-field="requires_review"]')
        ->fill($editor.' [data-module="multi-select"] [data-role="input"]', 'social')
        ->click($editor.' [data-module="multi-select"] [role="option"]')
        ->type($editor.' .code-editor .cm-content', '$exists(content.slug)')
        ->type($editor.' trix-editor', 'Validation finale')
        ->select($editor.' [name="category"]', 'approval')
        ->click($editor.' [data-blueprint-action="save"]')
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").data.owner',
            'Grace',
        )
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").data.opaque_reference',
            'EDITORIAL-42',
        )
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").category',
            'approval',
        )
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").data.channels.includes("social")',
            true,
        );

    $page->fill($editor.' [data-blueprint-field="owner"]', 'Discarded')
        ->click($editor.' [data-blueprint-inspector] [data-blueprint-action="close-inspector"]')
        ->assertScript('document.querySelector('.json_encode($editor.' [data-blueprint-discard-dialog]').').open', true)
        ->click($editor.' [data-blueprint-action="discard-changes"]')
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").data.owner',
            'Grace',
        )
        ->click($editor.' [data-blueprint-action="undo"]')
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").data.owner',
            'Camille',
        )
        ->click($editor.' [data-blueprint-action="redo"]')
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_release"]\').value).nodes.find(node => node.id === "review").data.owner',
            'Grace',
        );

    $page->click($autosaveEditor.' [data-blueprint-nodes] > [data-blueprint-node-id="review"]')
        ->fill($autosaveEditor.' [data-blueprint-field="owner"]', 'Autosaved owner')
        ->wait(1)
        ->assertScript(
            'JSON.parse(document.querySelector(\'[name="demo_blueprint_autosave"]\').value).nodes.find(node => node.id === "review").data.owner',
            'Autosaved owner',
        )
        ->assertNoJavascriptErrors()
        ->assertNoConsoleLogs();
});
