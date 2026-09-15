@php
    $configuration = json_encode([
        'application' => ['name' => 'Daisy Kit', 'environment' => 'staging', 'locales' => ['en', 'fr']],
        'editor' => [
            'theme' => 'inherit',
            'features' => ['search' => true, 'completion' => true, 'lineWrapping' => false],
            'languages' => ['json', 'javascript', 'php'],
        ],
        'projects' => [
            ['name' => 'Documentation', 'members' => ['Ada', 'Grace'], 'settings' => ['public' => true, 'reviewRequired' => false]],
            ['name' => 'Customer portal', 'members' => ['Linus', 'Margaret'], 'settings' => ['public' => false, 'reviewRequired' => true]],
        ],
        'notifications' => ['email' => ['enabled' => true, 'digest' => 'weekly'], 'channels' => ['releases', 'reviews']],
    ], JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    $javascript = <<<'JS'
const projects = [
    { name: "Documentation", hours: [2, 4, 3], archived: false },
    { name: "Customer portal", hours: [5, 2, 6], archived: false },
    { name: "Prototype", hours: [1, 2], archived: true },
];

function summarizeProject(project) {
    const totalHours = project.hours.reduce((total, hours) => {
        return total + hours;
    }, 0);

    return {
        name: project.name,
        totalHours,
        summary: `${project.name}: ${totalHours} hours`,
    };
}

function activeProjectSummaries(items) {
    return items
        .filter((project) => !project.archived)
        .map((project) => summarizeProject(project));
}

const summaries = activeProjectSummaries(projects);
console.table(summaries);
JS;
    $php = <<<'PHP'
<?php

namespace App\Services;

final class ReleaseSummary
{
    /**
     * @param  list<array{title: string, published: bool, tags: list<string>}>  $releases
     * @return list<array{title: string, tags: string}>
     */
    public function published(array $releases): array
    {
        return collect($releases)
            ->filter(fn (array $release): bool => $release['published'])
            ->map(fn (array $release): array => [
                'title' => $release['title'],
                'tags' => implode(', ', $release['tags']),
            ])
            ->values()
            ->all();
    }
}
PHP;
    $blade = <<<'BLADE'
<x-daisy-kit::code-editor
    name="configuration"
    label="Application configuration"
    filename="settings.json"
    language="json"
    :value="$configuration"
    :nonce="Vite::cspNonce()"
/>
BLADE;
    $imports = <<<'JS'
import '@daisy-kit/code-editor.css';
import { mountAll, getInstance } from '@daisy-kit/code-editor.js';

mountAll();
const editor = getInstance(document.querySelector('[data-daisy-kit-module="code-editor"]'));
const code = editor.getValue();
JS;
@endphp

@extends('layouts.docs', ['title' => 'Code Editor - Laravel Daisy Kit'])

@section('content')
    <article class="max-w-5xl">
        <p class="text-sm font-medium uppercase tracking-widest text-base-content/70">Module</p>
        <h1 class="mt-3 text-4xl font-bold tracking-tight">Code Editor</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-base-content/75">Read, search and edit code in your application’s theme. Language support loads when needed, with native form submission and keyboard navigation.</p>
        <section class="mt-10 space-y-6" aria-label="Interactive examples">
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Edit application configuration</h2>
                <p class="my-3 text-sm text-base-content/70">Explore nested objects and arrays. Place the cursor inside a project, then fold the other blocks to keep that project in view. Format code aligns the whole document; Undo restores its previous layout. Expand editor and Collapse editor switch between in-page sizes. Suggest and Ctrl+Space open completions, including keys already present in the document. When you press Enter between existing JSON properties or array items, the editor can insert a missing comma; it does not guess unfinished values.</p>
                <form>
                    <x-daisy-kit::code-editor name="configuration" label="Application configuration" filename="settings.json" language="json" :value="$configuration" :required="true" :nonce="Vite::cspNonce()" />
                    <button class="btn btn-sm mt-4" type="reset">Reset configuration</button>
                </form>
            </section>
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5">
                <h2 class="text-xl font-semibold">Write JavaScript with local assistance</h2>
                <p class="my-3 text-sm text-base-content/70">Try typing an opening parenthesis, bracket, brace or quote in the appropriate code context: the editor inserts its closing partner. Press Enter inside a block to indent the next line. Select a repeated word and open search, or fold a function while editing another one. Tab moves to the next control.</p>
                <form>
                    <x-daisy-kit::code-editor name="project_summary" label="Project summary script" filename="projects.js" language="javascript" :value="$javascript" :nonce="Vite::cspNonce()" />
                    <button class="btn btn-sm mt-4" type="reset">Reset script</button>
                </form>
            </section>
            <section class="min-w-0 rounded-box border border-base-300 bg-base-100 p-5" data-theme="dark">
                <h2 class="text-xl font-semibold">Read-only Laravel code in a local theme</h2>
                <p class="my-3 text-sm text-base-content/70">Inspect a PHP service with a Laravel collection pipeline. This compact toolbar keeps only Search, Copy and Expand editor; folding remains available in the gutter. The editor inherits its own dark DaisyUI theme.</p>
                <x-daisy-kit::code-editor label="Release summary service" filename="ReleaseSummary.php" language="php" :value="$php" :read-only="true" :toolbar-actions="['search', 'copy', 'expand']" :nonce="Vite::cspNonce()" />
            </section>
        </section>
        <section class="mt-10"><h2 class="text-2xl font-semibold">Blade usage</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Blade usage"><code>{{ $blade }}</code></pre></section>
        <section class="mt-10"><h2 class="text-2xl font-semibold">Module imports</h2><pre class="code-sample mt-4 overflow-x-auto" tabindex="0" aria-label="Module imports"><code>{{ $imports }}</code></pre></section>
        <section class="mt-10 space-y-3">
            <h2 class="text-2xl font-semibold">Options and integration</h2>
            <p>Use read-only, disabled, required, line-numbers, line-wrapping, tab-size, toolbar and status-bar to configure the control. Pass toolbar-actions to select visible buttons, an empty array to hide them all, or toolbar=false to hide the whole toolbar. Commands remain available through the facade.</p>
            <p>Labels and CodeMirror phrases follow the Laravel locale, with English and French included. Set the application locale to fr for French search, completion, folding and status text. Override labels or phrases per instance when needed; explicit overrides take priority over the locale defaults.</p>
            <p>Supported languages: text, php, html, css, javascript, typescript, json, markdown, sql and yaml. Blade directives are not parsed separately. Saving and business validation remain in your application.</p>
            <p>Use getValue, setValue, getState, setLanguage, setReadOnly, setLineWrapping, focus, undo, redo, openSearch, copy, format, setExpanded and complete on the mounted instance. foldAll, unfoldAll, foldOthers and unfoldOthers control code sections; the other-block actions preserve the block at the cursor and its parents. setValue resets history. Change events use daisy-kit:code-editor:change with value and origin.</p>
            <p>Format code loads its formatter on demand and works locally in your browser. The format method returns a Promise of a boolean, preserves Undo history and reports invalid syntax without replacing your document. Formatting is unavailable for plain text and read-only content.</p>
            <p>For CSP, pass the response nonce and authorize it in style-src. The component does not require inline scripts. Customize the editor height through the --code-editor-height CSS property in your stylesheet.</p>
        </section>
    </article>
@endsection
