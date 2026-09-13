<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

final class DocumentationContentSecurityPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        $nonce = Vite::useCspNonce();

        /** @var Response $response */
        $response = $next($request);

        $imageSources = config('services.openstreetmap.tiles_enabled')
            ? "'self' data: blob: https://tile.openstreetmap.org https://*.basemaps.cartocdn.com"
            : "'self' data: blob:";

        $styleAttributes = in_array($request->route('module'), ['signature', 'transfer-list'], true)
            ? "'unsafe-inline'"
            : "'none'";

        $scriptSources = str_contains((string) $response->headers->get('Content-Type'), 'text/html')
            ? "'self' 'nonce-{$nonce}'"
            : "'self'";

        $response->headers->set('Content-Security-Policy', "default-src 'none'; base-uri 'none'; object-src 'none'; script-src {$scriptSources}; style-src 'self'; style-src-attr {$styleAttributes}; img-src {$imageSources}; connect-src 'self'; worker-src 'self' blob:; frame-src 'self'; form-action 'self'");
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}
