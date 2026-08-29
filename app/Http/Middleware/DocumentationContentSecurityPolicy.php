<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class DocumentationContentSecurityPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $imageSources = config('services.openstreetmap.tiles_enabled')
            ? "'self' data: blob: https://tile.openstreetmap.org https://*.basemaps.cartocdn.com"
            : "'self' data: blob:";

        $response->headers->set('Content-Security-Policy', "default-src 'none'; base-uri 'none'; object-src 'none'; script-src 'self'; style-src 'self'; style-src-attr 'none'; img-src {$imageSources}; connect-src 'self'; worker-src 'self' blob:; frame-src 'self'; form-action 'self'");
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        return $response;
    }
}
