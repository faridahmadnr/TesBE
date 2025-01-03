<?php

namespace Tests;

use App\Http\Middleware\LogRoute;
use App\Http\Middleware\VerifySignature;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class FeatureTestCase extends BaseTestCase
{
    use CreatesApplication, LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('module:migrate-fresh --seed');

        $this->withoutMiddleware(VerifySignature::class);
        $this->withoutMiddleware(LogRoute::class);
    }
}
