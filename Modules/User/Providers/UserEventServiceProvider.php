<?php

namespace Modules\User\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\User\Events\UserDeleted;
use Modules\User\Listeners\UserDeletedListener;

class UserEventServiceProvider extends ServiceProvider
{
    protected $listen = [
        UserDeleted::class => [
            UserDeletedListener::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];
}
