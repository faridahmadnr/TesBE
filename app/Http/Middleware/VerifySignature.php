<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifySignature
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $isDebug = config('app.debug');
        $sign = $request->header('X-Sign');
        $signTimestamp = $request->header('X-Sign-Timestamp');

        // return $next($request);
        if (! $this->isValidTimestamp($signTimestamp)) {
            if ($isDebug) {
                return response()->json([
                    'message' => 'Invalid timestamp',
                    'code' => 400,
                ], 400);
            }

            return response()->json([
                'message' => 'Forbidden',
                'code' => 403,
            ], 403);
        }

        $backendSign = $this->generateBackendSignature(
            $request,
            $signTimestamp
        );
        // Log::info("Frontend: $sign From backend: $backendSign");
        if ($sign !== $backendSign) {
            if ($isDebug) {
                return response()->json([
                    'message' => 'Invalid signature',
                    'code' => 400,
                ], 400);
            }

            return response()->json([
                'message' => 'Forbidden',
                'code' => 403,
            ], 403);
        }

        return $next($request);
    }

    public function isValidTimestamp($timestamp)
    {
        if ($timestamp && (time() - $timestamp <= 5)) {
            return true;
        }

        return false;
    }

    public function generateBackendSignature(Request $request, $timestamp)
    {
        // skipcq: PHP-A1004
        $md5 = md5(json_encode([
            'url' => rawurlencode($request->url()),
            'method' => $request->method(),
            'requestId' => $request->header('X-Request-Id', ''),
            'xsrfToken' => md5($request->header('X-Xsrf-Token', '')), // skipcq: PHP-A1004
            'timestamp' => $timestamp,
        ]));
        $string = $request->method().$request->url().$timestamp.$md5;

        Log::info($request->url());
        $hash = hash_hmac('SHA256', $string, config('app.key'));

        return base64_encode($hash);
    }
}
