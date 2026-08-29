<?php

use App\Http\Controllers\DemoFixtureController;
use App\Http\Controllers\DocumentationController;
use App\Http\Middleware\DocumentationContentSecurityPolicy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;

Route::middleware(DocumentationContentSecurityPolicy::class)->group(function (): void {
    Route::get('/fixtures/table', [DemoFixtureController::class, 'table'])->name('fixtures.table');
    Route::get('/fixtures/table-unavailable', [DemoFixtureController::class, 'unavailableTable'])->name('fixtures.table-unavailable');
    Route::get('/fixtures/tree', [DemoFixtureController::class, 'tree'])->name('fixtures.tree');
    Route::get('/fixtures/preview.wav', [DemoFixtureController::class, 'audio'])->name('fixtures.audio');
    Route::get('/fixtures/{fixture}', [DemoFixtureController::class, 'show'])
        ->whereIn('fixture', ['forms', 'blueprint', 'file-preview', 'map'])
        ->name('fixtures.show');

    Route::get('/demo', function (): RedirectResponse {
        return redirect()->route('docs.overview');
    })->name('docs.legacy-demo');

    Route::get('/', [DocumentationController::class, 'overview'])->name('docs.overview');
    Route::get('/installation', [DocumentationController::class, 'installation'])->name('docs.installation');
    Route::get('/{module}', [DocumentationController::class, 'module'])
        ->whereIn('module', array_keys(DocumentationController::modules()))
        ->name('docs.module');
});
