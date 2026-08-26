<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class DocumentationController extends Controller
{
    /**
     * @var array<string, array{title: string, description: string, component: string, daisyUiUrl: string, assets: list<string>}>
     */
    private const MODULES = [
        'forms' => ['title' => 'Forms', 'description' => 'Render a schema with the viewer, or opt into the Livewire builder.', 'component' => 'x-daisy-kit::forms.viewer', 'daisyUiUrl' => 'https://daisyui.com/components/input/', 'assets' => ['resources/js/daisy-kit/forms-viewer.js', 'resources/js/daisy-kit/forms-builder.js']],
        'table' => ['title' => 'Table', 'description' => 'Present deterministic records in an accessible data table.', 'component' => 'x-daisy-kit::table', 'daisyUiUrl' => 'https://daisyui.com/components/table/', 'assets' => ['resources/js/daisy-kit/table.js']],
        'tree' => ['title' => 'Tree', 'description' => 'Explore nested, deterministic fixture data.', 'component' => 'x-daisy-kit::tree', 'daisyUiUrl' => 'https://daisyui.com/components/menu/', 'assets' => ['resources/js/daisy-kit/tree.js']],
        'blueprint' => ['title' => 'Blueprint', 'description' => 'Inspect a compact graph fixture without host-level visual wrappers.', 'component' => 'x-daisy-kit::blueprint', 'daisyUiUrl' => 'https://daisyui.com/components/badge/', 'assets' => ['resources/js/daisy-kit/blueprint.js']],
        'file-preview' => ['title' => 'File Preview', 'description' => 'Preview a deterministic file descriptor safely in the browser.', 'component' => 'x-daisy-kit::file-preview', 'daisyUiUrl' => 'https://daisyui.com/components/loading/', 'assets' => ['resources/js/daisy-kit/file-preview.js']],
        'map' => ['title' => 'Map', 'description' => 'Mount a map module with a deterministic coordinate fixture.', 'component' => 'x-daisy-kit::map', 'daisyUiUrl' => 'https://daisyui.com/components/alert/', 'assets' => ['resources/js/daisy-kit/map.js']],
    ];

    public function overview(): View
    {
        return view('docs.overview', ['modules' => self::MODULES]);
    }

    public function installation(): View
    {
        return view('docs.installation');
    }

    public function module(string $module): View
    {
        abort_unless(array_key_exists($module, self::MODULES), 404);

        return view("docs.modules.{$module}", ['module' => self::MODULES[$module], 'moduleAssets' => self::MODULES[$module]['assets'], 'slug' => $module]);
    }

    /**
     * @return array<string, array{title: string, description: string, component: string, daisyUiUrl: string, assets: list<string>}>
     */
    public static function modules(): array
    {
        return self::MODULES;
    }
}
