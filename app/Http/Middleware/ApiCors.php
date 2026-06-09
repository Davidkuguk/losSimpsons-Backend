<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiCors
{
    /**
     * Add CORS headers to every API response, including preflight requests.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->is('api/*')) {
            return $next($request);
        }

        if ($request->isMethod('OPTIONS')) {
            return response('', 204)->withHeaders($this->headers($request));
        }

        $response = $next($request);

        foreach ($this->headers($request) as $header => $value) {
            $response->headers->set($header, $value);
        }

        return $response;
    }

    /**
     * Build the CORS headers expected by the Angular app hosted on Render.
     */
    private function headers(Request $request): array
    {
        return [
            'Access-Control-Allow-Origin' => $request->headers->get('Origin', '*'),
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => $request->headers->get('Access-Control-Request-Headers', 'Content-Type, X-Requested-With, Authorization, Accept'),
            'Access-Control-Max-Age' => '86400',
            'Vary' => 'Origin, Access-Control-Request-Method, Access-Control-Request-Headers',
        ];
    }
}
