<?php

use Modules\BusinessType\Services\BusinessTypeService;

use function Pest\Laravel\putJson;

beforeEach(fn () => $this->businessTypeService = app(BusinessTypeService::class));

test('fail: should failed to update business type as guest', function () {
    $businessType = $this->businessTypeService->first();

    $response = putJson(route('api.v1.business-types.update', $businessType->hashId), [
        'name' => fake()->name(),
    ]);
    $response->assertUnauthorized();
});

test('fail: should failed to update business type as registered member', function () {
    loginAsMember();
    $businessType = $this->businessTypeService->first();

    $response = putJson(route('api.v1.business-types.update', $businessType->hashId), [
        'name' => fake()->name(),
    ]);
    $response->assertForbidden();
});

test('pass: should success update business types as admin', function () {
    loginAsAdmin();

    $businessType = $this->businessTypeService->first();

    $name = fake()->name();
    $response = putJson(route('api.v1.business-types.update', $businessType->hashId), [
        'name' => $name,
    ]);

    $response->assertStatus(200)
        ->assertJson([
            'apiVersion' => '1.0',
            'data' => [
                'id' => $businessType->hashId,
                'name' => $name,
            ],
        ]);
});
