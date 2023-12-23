<?php

use Tests\FeatureTestCase;

uses(FeatureTestCase::class);

use function Pest\Laravel\{get};

test('should get bank list', function () {
    get('/api/v1/banks')
        ->assertStatus(200)
        ->assertJson([
            'apiVersion' => '1.0',
            'data' => [],
        ]);
});
