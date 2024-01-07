<?php

use App\Traits\Tests\PaginatesResponses;
use Illuminate\Http\JsonResponse;
use Modules\BusinessType\Entities\BusinessType;
use Modules\BusinessType\Http\Controllers\API\V1\BusinessTypeController;
use Modules\BusinessType\Services\BusinessTypeService;

uses(PaginatesResponses::class);

beforeEach(function () {
    $this->businessTypeService = \Mockery::mock(BusinessTypeService::class);
    $this->businessTypeController = new BusinessTypeController($this->businessTypeService);
});

afterEach(function () {
    \Mockery::close();
});

test('constructor creates an instance of BusinessTypeController', function () {
    expect($this->businessTypeController)->toBeInstanceOf(BusinessTypeController::class);
});

test('index returns a JsonResponse with status code 200 and data key', function () {
    $paginatedItems = $this->createPaginatedResponse(
        modelClass: BusinessType::class,
    );

    $this->businessTypeService
        ->shouldReceive('getAll')
        ->once()
        ->andReturn($paginatedItems);

    $response = $this->businessTypeController->index();

    expect($response)->toBeInstanceOf(JsonResponse::class);
    expect($response->getStatusCode())->toBe(200);

    $responseData = json_decode($response->getContent(), true);
    expect($responseData)->toHaveKey('data');
});
