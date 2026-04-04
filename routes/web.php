<?php

use App\Http\Controllers\DemoApiController;
use App\Http\Controllers\TemplateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (config('daisy-kit.docs.enabled')) {
        $prefix = (string) config('daisy-kit.docs.prefix', 'docs');

        return redirect('/'.ltrim($prefix, '/'));
    }

    return view('welcome');
});

Route::get('/demo', function () {
    return view('daisy-dev::demo.ui.index');
})->name('demo');

Route::get('/demo/api/calendar-events', [DemoApiController::class, 'calendarEvents'])->name('demo.calendar.events');
Route::get('/demo/api/tree-children', [DemoApiController::class, 'treeChildren'])->name('demo.tree.children');
Route::get('/demo/api/tree-search', [DemoApiController::class, 'treeSearch'])->name('demo.tree.search');
Route::get('/demo/api/select-options', [DemoApiController::class, 'selectOptions'])->name('demo.select.options');
Route::post('/demo/api/chat/send', [DemoApiController::class, 'chatSend'])->name('demo.chat.send');
Route::post('/demo/api/chat/typing', [DemoApiController::class, 'chatTyping'])->name('demo.chat.typing');
Route::get('/demo/api/chat/messages/{conversationId}', [DemoApiController::class, 'chatMessages'])->name('demo.chat.messages');

Route::prefix('templates')->name('templates.')->group(function () {
    Route::prefix('auth')->name('auth.')->group(function () {
        Route::view('/login-simple', 'daisy::templates.auth.login-simple')->name('login-simple');
        Route::view('/login-split', 'daisy::templates.auth.login-split')->name('login-split');
        Route::view('/register-simple', 'daisy::templates.auth.register-simple')->name('register-simple');
        Route::view('/register-split', 'daisy::templates.auth.register-split')->name('register-split');
        Route::view('/forgot-password', 'daisy::templates.auth.forgot-password')->name('forgot-password');
        Route::view('/reset-password', 'daisy::templates.auth.reset-password')->name('reset-password');
        Route::view('/two-factor', 'daisy::templates.auth.two-factor')->name('two-factor');
        Route::view('/verify-email', 'daisy::templates.auth.verify-email')->name('verify-email');
        Route::view('/resend-verification', 'daisy::templates.auth.resend-verification')->name('resend-verification');
    });

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::view('/view', 'daisy::templates.profile.profile-view')->name('view');
        Route::view('/edit', 'daisy::templates.profile.profile-edit')->name('edit');
        Route::view('/settings', 'daisy::templates.profile.profile-settings')->name('settings');
    });

    Route::prefix('communication')->name('communication.')->group(function () {
        Route::get('/chat', [TemplateController::class, 'chat'])->name('chat');
        Route::get('/notification-center', [TemplateController::class, 'notificationCenter'])->name('notification-center');
    });

    Route::prefix('layouts')->name('layouts.')->group(function () {
        Route::view('/navbar', 'daisy-dev::demo.templates.test-navbar')->name('navbar');
        Route::view('/sidebar', 'daisy-dev::demo.templates.test-sidebar')->name('sidebar');
        Route::view('/navbar-sidebar', 'daisy-dev::demo.templates.test-navbar-sidebar')->name('navbar-sidebar');
        Route::view('/grid-layout', 'daisy-dev::demo.templates.test-grid-layout')->name('grid-layout');
        Route::view('/crud-layout', 'daisy-dev::demo.templates.test-crud-layout')->name('crud-layout');
        Route::view('/footer', 'daisy-dev::demo.templates.test-footer')->name('footer');
        Route::view('/grid', 'daisy-dev::demo.templates.test-grid')->name('grid');
        Route::view('/navbar-footer', 'daisy-dev::demo.templates.test-navbar-footer')->name('navbar-footer');
        Route::view('/navbar-grid-footer', 'daisy-dev::demo.templates.test-navbar-grid-footer')->name('navbar-grid-footer');
    });

    Route::prefix('documentation')->name('documentation.')->group(function () {
        Route::get('/changelog', [TemplateController::class, 'changelog'])->name('changelog');
    });

    Route::prefix('forms')->name('forms.')->group(function () {
        Route::view('/wizard', 'daisy-dev::demo.templates.forms.form-wizard')->name('wizard');
        Route::view('/tabs', 'daisy-dev::demo.templates.forms.form-with-tabs')->name('tabs');
        Route::view('/inline', 'daisy-dev::demo.templates.forms.form-inline')->name('inline');
    });
});

$docsPrefix = (string) config('daisy-kit.docs.prefix', 'docs');

Route::prefix($docsPrefix)->group(function () {
    Route::get('/', function () {
        return view('daisy-dev::docs.index');
    })->name('daisy.docs.index');

    Route::get('/templates', function () {
        return view('daisy-dev::docs.templates.index');
    })->name('daisy.docs.templates');

    Route::get('/templates/{category}/{template}', function (string $category, string $template) {
        $view = "daisy-dev::docs.templates.$category.$template";
        abort_unless(view()->exists($view), 404);

        return view($view);
    })->where(['category' => '[A-Za-z0-9\-_]+', 'template' => '[A-Za-z0-9\-_]+'])
        ->name('daisy.docs.template');

    Route::get('/{category}/{component}', function (string $category, string $component) {
        $errorTemplates = ['empty-state', 'error', 'loading-state', 'maintenance'];

        if ($category === 'errors' && in_array($component, $errorTemplates, true)) {
            $templateView = "daisy-dev::docs.templates.errors.$component";
            if (view()->exists($templateView)) {
                return view($templateView);
            }
        }

        $componentView = "daisy-dev::docs.components.$category.$component";
        abort_unless(view()->exists($componentView), 404);

        return view($componentView, ['category' => $category, 'component' => $component]);
    })->where(['category' => '[A-Za-z0-9\-_]+', 'component' => '[A-Za-z0-9\-_]+'])
        ->name('daisy.docs.component');
});
