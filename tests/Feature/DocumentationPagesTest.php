<?php

use App\Http\Controllers\DocumentationController;
use App\Http\Middleware\DocumentationContentSecurityPolicy;
use Composer\InstalledVersions;
use Illuminate\Http\Request;
use Laravel\Boost\Services\BrowserLogger;

dataset('documentation-pages', [
    ['/', 'Laravel Daisy Kit'],
    ['/installation', 'Installation'],
    ['/copyable', 'Copyable'],
    ['/combobox', 'Combobox'],
    ['/signature', 'Signature'],
    ['/truncate', 'Truncate'],
    ['/scrollspy', 'Scrollspy'],
    ['/transfer-list', 'Transfer List'],
    ['/code-editor', 'Code Editor'],
    ['/wysiwyg', 'WYSIWYG'],
    ['/table', 'Table'],
    ['/tree', 'Tree'],
    ['/blueprint', 'Blueprint'],
    ['/file-preview', 'File Preview'],
    ['/map', 'Map'],
]);

it('serves every documented module page', function (string $uri, string $heading): void {
    $styleAttributes = in_array($uri, ['/signature', '/transfer-list', '/wysiwyg'], true) ? "'unsafe-inline'" : "'none'";

    $response = $this->get($uri)
        ->assertOk()
        ->assertSee($heading);

    preg_match("/script-src 'self' 'nonce-([^']+)'/", $response->headers->get('Content-Security-Policy'), $nonce);

    expect($nonce)->toHaveKey(1);

    $styleSources = in_array($uri, ['/code-editor', '/wysiwyg'], true) ? "'self' 'nonce-{$nonce[1]}'" : "'self'";

    $response->assertHeader('Content-Security-Policy', "default-src 'none'; base-uri 'none'; object-src 'none'; script-src 'self' 'nonce-{$nonce[1]}'; style-src {$styleSources}; style-src-attr {$styleAttributes}; img-src 'self' data: blob:; connect-src 'self'; worker-src 'self' blob:; frame-src 'self'; form-action 'self'");
})->with('documentation-pages');

it('authorizes Boost browser logging with the documentation CSP nonce', function (): void {
    expect(config('boost.browser_logs_watcher'))->toBeTrue();

    $response = app(DocumentationContentSecurityPolicy::class)->handle(
        Request::create('/'),
        fn () => response('<html><head>'.BrowserLogger::getScript().'</head></html>')
            ->header('Content-Type', 'text/html'),
    );

    preg_match('/<script\b[^>]*\bid="browser-logger-active"[^>]*>/', $response->getContent(), $scriptTag);
    preg_match('/\bnonce="([^"]+)"/', $scriptTag[0] ?? '', $nonce);

    expect($nonce)->toHaveKey(1)
        ->and($response->headers->get('Content-Security-Policy'))
        ->toContain("script-src 'self' 'nonce-{$nonce[1]}'");
});

it('documents the v6 VCS installation and official Vite alias', function (): void {
    $this->get('/installation')
        ->assertOk()
        ->assertSee('^6.0')
        ->assertSee(InstalledVersions::getPrettyVersion('art35rennes/laravel-daisy-kit'))
        ->assertSee(InstalledVersions::getReference('art35rennes/laravel-daisy-kit'))
        ->assertSee('v6 removes Forms Viewer/Builder')
        ->assertSee('https://github.com/art35rennes/laravel-daisy-kit')
        ->assertSee('@daisy-kit')
        ->assertSee('copyable');
});

it('documents the optional Copyable icon and transient visual feedback', function (): void {
    $this->get('/copyable')
        ->assertOk()
        ->assertSee('data-daisy-kit-copyable-icon', false)
        ->assertSee('data-daisy-kit-copyable-feedback', false)
        ->assertSee('Invoice reference copied.')
        ->assertSee('showIcon=false')
        ->assertSee('showFeedback=true');
});

it('demonstrates rich Combobox suggestions and its renderer facade', function (): void {
    $this->get('/combobox')
        ->assertOk()
        ->assertSee('grace.hopper@example.test')
        ->assertSee('Infrastructure')
        ->assertSee('setOptionRenderer(renderer)')
        ->assertSee('max-suggestions', false);
});

it('exposes exactly the thirteen v6 modules without the retired Forms page', function (): void {
    expect(array_keys(DocumentationController::modules()))->toEqualCanonicalizing([
        'wysiwyg', 'code-editor', 'table', 'tree', 'blueprint', 'file-preview', 'map', 'copyable', 'combobox',
        'signature', 'truncate', 'scrollspy', 'transfer-list',
    ]);

    $this->get('/forms')->assertNotFound();
});

it('provides the response nonce to Trix before its module scripts', function (): void {
    $response = $this->get('/wysiwyg');

    preg_match("/style-src 'self' 'nonce-([^']+)'/", $response->headers->get('Content-Security-Policy'), $nonce);

    $response->assertSeeInOrder(['name="trix-csp-nonce" content="'.$nonce[1].'"', '<script'], false)
        ->assertSee('name="article_body"', false)
        ->assertSee('Published article');

    $this->get('/code-editor')->assertDontSee('name="trix-csp-nonce"', false);
});
