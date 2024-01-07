<?php

use Modules\BusinessType\Services\BusinessTypeService;
use Modules\BusinessType\Transformers\BusinessTypeCollection;

use function Pest\Laravel\{get};

// beforeEach(fn () => $this->businessTypes = BusinessType::factory()->count(20)->create());

test('pass: should get business types list as admin', function () {
    loginAsAdmin();

    $businessTypeService = app(BusinessTypeService::class);

    $businessTypes = new BusinessTypeCollection($businessTypeService->getAll());

    $response = get(route('api.v1.business-types.index'));
    $response->assertStatus(200)
        ->assertJson([
            'apiVersion' => '1.0',
            'data' => json_decode(json_encode($businessTypes), true),
        ]);
});

test('pass: should get business types list as guest', function () {
    $businessTypeService = app(BusinessTypeService::class);
    $businessTypes = new BusinessTypeCollection($businessTypeService->getAll());

    $response = get(route('api.v1.business-types.index'));
    $response->assertSuccessful()
        ->assertStatus(200)
        ->assertJson([
            'apiVersion' => '1.0',
            'data' => json_decode(json_encode($businessTypes), true),
        ]);
});
