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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sign = $request->header('X-Sign');
        $signTimestamp = $request->header('X-Sign-Timestamp');

        if (! $this->isValidTimestamp($signTimestamp)) {
            return response()->json([
                'errors' => [
                    'code' => 401,
                    'message' => 'Invalid timestamp',
                ],
                'message' => 'Invalid timestamp',
            ], 401);
        }

        $backendSign = $this->generateBackendSignature(
            $request,
            $signTimestamp
        );
        // Log::info("Frontend: $sign From backend: $backendSign");
        if ($sign !== $backendSign) {
            return response()->json([
                'errors' => [
                    'code' => 401,
                    'message' => 'Invalid signature',
                ],
                'message' => 'Invalid signature',
            ], 401);
        }

        return $next($request);
    }

    private function isValidTimestamp($timestamp)
    {
        if ($timestamp && (time() - $timestamp <= 5)) {
            return true;
        }

        return false;
    }

    private function generateBackendSignature(Request $request, $timestamp)
    {
        $md5 = md5(json_encode([
            'url' => rawurlencode($request->url()),
            'method' => $request->method(),
            'requestId' => $request->header('X-Request-Id', ''),
            'xsrfToken' => md5($request->header('X-Xsrf-Token', '')),
            'timestamp' => $timestamp,
        ]));
        $string = $request->method().$request->url().$timestamp.$md5;

        Log::info($request->url());
        $hash = hash_hmac('SHA256', $string, config('app.key'));

        return base64_encode($hash);
    }
}
