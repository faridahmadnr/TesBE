<?php

namespace Tests\Feature\Middleware;

use App\Http\Middleware\VerifySignature;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Class VerifySignatureMiddlewareTest.
 */
class VerifySignatureMiddlewareTest extends TestCase
{
    public function test_it_should_error_if_header_x_sign_timestamp_is_missing()
    {
        $request = Request::create(route('api.v1.banks.index'));

        $next = function () {
            return response('This is a secret place');
        };

        $middleware = new VerifySignature();
        $response = $middleware->handle($request, $next);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'message' => 'Invalid timestamp',
            'code' => 400,
        ]), $response->getContent());
    }

    public function test_it_should_error_if_header_x_sign_is_missing()
    {
        $request = Request::create(route('api.v1.banks.index'));
        $request->headers->set('X-Sign-Timestamp', (string) time());

        $next = function () {
            return response('This is a secret place');
        };

        $middleware = new VerifySignature();
        $response = $middleware->handle($request, $next);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'message' => 'Invalid signature',
            'code' => 400,
        ]), $response->getContent());
    }

    public function test_it_should_error_if_x_sign_is_different(): void
    {
        $request = Request::create(route('api.v1.banks.index'));
        $request->headers->set('X-Sign-Timestamp', (string) time());
        $request->headers->set('X-Request-Id', 'fake-request-id');
        $request->headers->set('X-Xsrf-Token', 'fake');
        $request->headers->set('X-Sign', 'invalid-secret');

        $next = function () {
            return response('This is a secret place');
        };

        $middleware = new VerifySignature();

        $response = $middleware->handle($request, $next);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertEquals(json_encode([
            'message' => 'Invalid signature',
            'code' => 400,
        ]), $response->getContent());
    }

    public function test_it_should_success_with_correct_header(): void
    {
        $request = Request::create(route('api.v1.banks.index'));
        $request->headers->set('X-Sign-Timestamp', (string) time());
        $request->headers->set('X-Request-Id', 'fake-request-id');
        $request->headers->set('X-Xsrf-Token', 'fake');

        $next = function () {
            return response('This is a secret place');
        };

        $middleware = new VerifySignature();

        $secret = $middleware->generateBackendSignature($request, $request->headers->get('X-Sign-Timestamp'));

        $request->headers->set('X-Sign', $secret);

        $response = $middleware->handle($request, $next);

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $this->assertEquals('This is a secret place', $response->getContent());
    }
}
