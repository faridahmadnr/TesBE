<?php

use App\Exceptions\GeneralException;
use Illuminate\Http\Request;

it('can be instantiated with a message and code', function () {
    $message = 'Test message';
    $code = 100;
    $exception = new GeneralException($message, $code);

    expect($exception)->toBeInstanceOf(GeneralException::class);
    expect($exception->getMessage())->toBe($message);
    expect($exception->getCode())->toBe($code);
});

it('renders a JSON response for API requests', function () {
    $message = 'Test message';
    $code = 100;
    $exception = new GeneralException($message, $code);

    // Mocking a request to simulate API call
    $request = mock(Request::class);
    $request->shouldReceive('is')->with('api/*')->andReturn(true);

    // You would typically mock the response() helper function here
    // Since Pest is based on PHPUnit, you could use PHPUnit mocking functions or Laravel's built-in facades

    $response = $exception->render($request);

    // Assert the response is a JsonResponse
    expect($response)->toBeInstanceOf(Illuminate\Http\JsonResponse::class);

    // Assert the status code and contents of the response
    expect($response->getStatusCode())->toBe(400);
    expect($response->getData(true))->toMatchArray([
        'apiVersion' => '1.0',
        'error' => [
            'code' => $code,
            'message' => $message,
        ],
        'message' => $message,
    ]);
});
