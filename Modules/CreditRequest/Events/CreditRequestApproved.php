<?php

namespace Modules\CreditRequest\Events;

use Illuminate\Queue\SerializesModels;
use Modules\CreditRequest\Entities\CreditRequest;

class CreditRequestApproved
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(
        public CreditRequest $creditRequest
    ) {
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
