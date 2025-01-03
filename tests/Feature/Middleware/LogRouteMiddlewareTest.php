<?php

namespace Tests\Feature\Middleware;

use App\Http\Middleware\LogRoute;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Http\Request;
use Log;
use Tests\TestCase;

/**
 * Class LogRouteMiddlewareTest.
 */
class LogRouteMiddlewareTest extends TestCase
{
    use WithoutMiddleware;

    public function test_it_should_write_log_on_route_accessed()
    {
        $request = Request::create(route('api.v1.banks.index'));

        $next = function () {
            return response('This is a secret place');
        };

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message, $context) {
                $this->assertEquals('{ip_address} {method} {uri}', $message);
                $this->assertEquals('127.0.0.1', $context['ip_address']);
                $this->assertEquals('GET', $context['method']);
                $this->assertEquals(route('api.v1.banks.index'), $context['uri']);
                $this->assertIsArray($context['payload']);
                $this->assertIsArray($context['headers']);
                $this->assertTrue(is_string((string) $context['request_id']));

                return true;
            });

        $middleware = new LogRoute();
        $response = $middleware->handle($request, $next);

        $this->assertNotNull($response->headers->get('X-Request-Id'));

    }
}
