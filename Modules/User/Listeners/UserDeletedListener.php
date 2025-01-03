<?php

namespace Modules\User\Listeners;

use Illuminate\Contracts\Queue\ShouldQueueAfterCommit;
use Modules\User\Entities\User;
use Modules\User\Events\UserDeleted;

class UserDeletedListener implements ShouldQueueAfterCommit
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        public User $user
    ) {
    }

    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle(UserDeleted $event)
    {
        /** @var User $user */
        $user = $event->user;
        $user->creditRequest()->delete();
    }
}
