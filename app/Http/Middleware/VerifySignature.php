<?php

namespace App\Http\Middleware;

use App\Exceptions\GeneralException;
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
        $isProduction = config('app.env') === 'production';
        $sign = $request->header('X-Sign');
        $signTimestamp = $request->header('X-Sign-Timestamp');

        if (! $this->isValidTimestamp($signTimestamp)) {
            if (! $isProduction) {
                throw new GeneralException(
                    message: 'Invalid timestamp',
                    code: 401
                );
            }

            throw new GeneralException(
                message: 'Forbidden',
                code: 403
            );
        }

        $backendSign = $this->generateBackendSignature(
            $request,
            $signTimestamp
        );
        // Log::info("Frontend: $sign From backend: $backendSign");
        if ($sign !== $backendSign) {
            if (! $isProduction) {
                throw new GeneralException(
                    message: 'Invalid signature',
                    code: 401
                );
            }

            throw new GeneralException(
                message: 'Forbidden',
                code: 403
            );
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
