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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        Log::info($request->getUri(), [
            'method' => $request->getMethod(),
            'payload' => $request->all(),
            'headers' => $request->headers->all(),
        ]);

        $response = $next($request);
        $requestId = Str::uuid();
        $response->headers->set('X-Request-Id', $requestId);

        activity('request')
            ->withProperties([
                'uri' => $request->getUri(),
                'method' => $request->getMethod(),
                'request_body' => $request->all(),
                'response' => $response->getContent(),
                // 'ip_address' => $request->ip(),
            ])
            ->event('route')
            ->log($requestId);

        return $response;
    }
}
