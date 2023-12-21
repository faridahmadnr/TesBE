<?php

namespace Modules\CreditRequest\Listeners;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Events\Dispatcher;
use Mail;
use Modules\CreditRequest\Emails\CreditRequestConfirmedMail;
use Modules\CreditRequest\Events\CreditRequestConfirmed;

class CreditRequestEventSubscriber implements ShouldHandleEventsAfterCommit
{
    public function onCreated(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dibuat oleh :causer.name.');
    }

    public function onUpdated(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah diperbarui oleh :causer.name.');
    }

    public function onDeleted(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dihapus oleh :causer.name.');
    }

    public function onConfirmed(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dikonfirmasi oleh :causer.name.');

        Mail::to($event->creditRequest->user->email)
            ->queue(new CreditRequestConfirmedMail($event->creditRequest));
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            CreditRequestConfirmed::class => 'onConfirmed',
        ];
    }
}
