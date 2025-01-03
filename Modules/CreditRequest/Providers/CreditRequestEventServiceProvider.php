<?php

namespace Modules\CreditRequest\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\CreditRequest\Listeners\CreditRequestEventSubscriber;

class CreditRequestEventServiceProvider extends ServiceProvider
{
    protected $listen = [];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        CreditRequestEventSubscriber::class,
    ];
}
