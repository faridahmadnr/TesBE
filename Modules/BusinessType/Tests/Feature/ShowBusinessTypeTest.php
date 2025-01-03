<?php

use Modules\BusinessType\Services\BusinessTypeService;

use function Pest\Laravel\get;

beforeEach(fn () => $this->businessTypeService = app(BusinessTypeService::class));

test('fail: should failed to show business type as guest', function () {
    $businessType = $this->businessTypeService->first();

    $response = get(route('api.v1.business-types.show', $businessType->hashId));
    $response->assertForbidden();
});

test('fail: should failed to show business type as registered member', function () {
    loginAsMember();
    $businessType = $this->businessTypeService->first();

    $response = get(route('api.v1.business-types.show', $businessType->hashId));
    $response->assertForbidden();
});

test('pass: should success show business types as admin', function () {
    loginAsAdmin();

    $businessType = $this->businessTypeService->first();

    $response = get(route('api.v1.business-types.show', $businessType->hashId));
    $response->assertStatus(200)
        ->assertJson([
            'apiVersion' => '1.0',
            'data' => [
                'id' => $businessType->hashId,
                'name' => $businessType->name,
            ],
        ]);
});
