<?php

use Modules\BusinessType\Entities\BusinessType;

use function Pest\Laravel\postJson;

describe('not admin', function () {
    test('fail: should failed to create business types list as guest', function () {
        $response = postJson(route('api.v1.business-types.index'), [
            'name' => 'Test',
        ]);
        $response->assertUnauthorized();
    });
    test('fail: should failed to create business types list as registered member', function () {
        loginAsMember();
        $response = postJson(route('api.v1.business-types.index'), [
            'name' => 'Test',
        ]);
        $response->assertForbidden();
    });
});

test('pass: should success create business types as admin', function () {
    loginAsAdmin();

    $name = fake()->name();
    $response = postJson(route('api.v1.business-types.index'), [
        'name' => $name,
    ]);

    $businessType = BusinessType::select('id')->where('name', $name)->first();

    $response->assertStatus(200)
        ->assertJson([
            'apiVersion' => '1.0',
            'data' => [
                'id' => $businessType->hashId,
                'name' => $name,
            ],
        ]);
});

test('fail: should trigger validation when create business types without name as admin', function () {
    loginAsAdmin();

    $response = postJson(route('api.v1.business-types.index'));

    $response->assertStatus(422)
        ->assertJson([
            'apiVersion' => '1.0',
            'type' => 'ValidationException',
            'code' => 422,
            'errors' => [
                'name' => [
                    'The name field is required.',
                ],
            ],
            'message' => 'The name field is required.',
        ]);
});
