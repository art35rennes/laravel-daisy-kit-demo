<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class DocumentationController extends Controller
{
    /**
     * @var array<string, array{title: string, description: string, component: string, daisyUiUrl: string}>
     */
    private const MODULES = [
        'forms' => ['title' => 'Forms', 'description' => 'Render a schema with the viewer, or opt into the Livewire builder.', 'component' => 'x-daisy-kit::forms.viewer', 'daisyUiUrl' => 'https://daisyui.com/components/input/'],
        'table' => ['title' => 'Table', 'description' => 'Present deterministic records in an accessible data table.', 'component' => 'x-daisy-kit::table', 'daisyUiUrl' => 'https://daisyui.com/components/table/'],
        'tree' => ['title' => 'Tree', 'description' => 'Explore nested, deterministic fixture data.', 'component' => 'x-daisy-kit::tree', 'daisyUiUrl' => 'https://daisyui.com/components/menu/'],
        'blueprint' => ['title' => 'Blueprint', 'description' => 'Inspect a compact graph fixture without host-level visual wrappers.', 'component' => 'x-daisy-kit::blueprint', 'daisyUiUrl' => 'https://daisyui.com/components/badge/'],
        'file-preview' => ['title' => 'File Preview', 'description' => 'Preview a deterministic file descriptor safely in the browser.', 'component' => 'x-daisy-kit::file-preview', 'daisyUiUrl' => 'https://daisyui.com/components/loading/'],
        'map' => ['title' => 'Map', 'description' => 'Mount a map module with a deterministic coordinate fixture.', 'component' => 'x-daisy-kit::map', 'daisyUiUrl' => 'https://daisyui.com/components/alert/'],
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

        return view("docs.modules.{$module}", ['module' => self::MODULES[$module], 'slug' => $module]);
    }

    /**
     * @return array<string, array{title: string, description: string, component: string, daisyUiUrl: string}>
     */
    public static function modules(): array
    {
        return self::MODULES;
    }
}
