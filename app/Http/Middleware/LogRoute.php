<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Log;
use Symfony\Component\HttpFoundation\Response;

class LogRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        $requestId = Str::uuid();
        $response->headers->set('X-Request-Id', $requestId);

        Log::info('{ip_address} {method} {uri}', [
            'ip_address' => $request->ip(),
            'method' => $request->getMethod(),
            'uri' => $request->fullUrl(),
            'payload' => $request->all(),
            'headers' => $request->headers->all(),
            'request_id' => $requestId,
        ]);

        return $response;
    }
}
