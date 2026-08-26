<?php

use App\Http\Controllers\DocumentationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DocumentationController::class, 'overview'])->name('docs.overview');
Route::get('/installation', [DocumentationController::class, 'installation'])->name('docs.installation');
Route::get('/{module}', [DocumentationController::class, 'module'])
    ->whereIn('module', array_keys(DocumentationController::modules()))
    ->name('docs.module');
