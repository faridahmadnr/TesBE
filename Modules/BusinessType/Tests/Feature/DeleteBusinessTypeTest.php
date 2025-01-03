<?php

use Modules\BusinessType\Services\BusinessTypeService;

use function Pest\Laravel\deleteJson;
use function Pest\Laravel\postJson;

beforeEach(fn () => $this->businessTypeService = app(BusinessTypeService::class));

describe('guest', function () {
    test('fail: should failed to destroy business type as guest', function () {
        $businessType = $this->businessTypeService->first();

        $response = deleteJson(route('api.v1.business-types.destroy', $businessType->hashId));
        $response->assertUnauthorized();
    });

    test('fail: should failed to force delete business type as guest', function () {
        $businessType = $this->businessTypeService->first();

        $response = deleteJson(route('api.v1.business-types.delete', $businessType->hashId));
        $response->assertUnauthorized();
    });

    test('fail: should failed to restore business type as guest', function () {
        $businessType = $this->businessTypeService->first();

        $response = postJson(route('api.v1.business-types.restore', $businessType->hashId));
        $response->assertUnauthorized();
    });
});

describe('member', function () {
    test('fail: should failed to destroy business type as registered member', function () {
        loginAsMember();
        $businessType = $this->businessTypeService->first();

        $response = deleteJson(route('api.v1.business-types.destroy', $businessType->hashId));
        $response->assertForbidden();
    });

    test('fail: should failed to force delete business type as registered member', function () {
        loginAsMember();
        $businessType = $this->businessTypeService->first();

        $response = deleteJson(route('api.v1.business-types.delete', $businessType->hashId));
        $response->assertForbidden();
    });

    test('fail: should failed to restore business type as registered member', function () {
        loginAsMember();
        $businessType = $this->businessTypeService->first();

        $response = postJson(route('api.v1.business-types.restore', $businessType->hashId));
        $response->assertForbidden();
    });
});

describe('admin', function () {
    test('pass: should success delete business types as admin', function () {
        loginAsAdmin();

        $businessType = $this->businessTypeService->first();

        $response = deleteJson(route('api.v1.business-types.destroy', $businessType->hashId));

        $response->assertStatus(200)
            ->assertJson([
                'apiVersion' => '1.0',
                'data' => [
                    'id' => $businessType->hashId,
                    'name' => $businessType->name,
                ],
            ]);
    });

    test('pass: should success force delete business types as admin', function () {
        loginAsAdmin();

        $businessType = $this->businessTypeService->first();

        $response = deleteJson(route('api.v1.business-types.delete', $businessType->hashId));

        $response->assertStatus(200)
            ->assertJson([
                'apiVersion' => '1.0',
                'data' => [
                    'id' => $businessType->hashId,
                    'name' => $businessType->name,
                ],
            ]);
    });

    test('pass: should success restore business types as admin', function () {
        loginAsAdmin();

        $businessType = $this->businessTypeService->first();

        $response = postJson(route('api.v1.business-types.restore', $businessType->hashId));

        $response->assertStatus(200)
            ->assertJson([
                'apiVersion' => '1.0',
                'data' => [
                    'id' => $businessType->hashId,
                    'name' => $businessType->name,
                ],
            ]);
    });

});
