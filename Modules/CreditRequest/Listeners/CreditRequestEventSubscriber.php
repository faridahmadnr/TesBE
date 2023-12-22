<?php

namespace Modules\CreditRequest\Listeners;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Events\Dispatcher;
use Mail;
use Modules\CreditRequest\Emails\CreditRequestConfirmedMail;
use Modules\CreditRequest\Events\CreditRequestApproved;
use Modules\CreditRequest\Events\CreditRequestConfirmed;
use Modules\CreditRequest\Events\CreditRequestPending;
use Modules\CreditRequest\Events\CreditRequestRedirected;
use Modules\CreditRequest\Events\CreditRequestRejected;

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

    public function onPending(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR ditunda oleh :causer.name dengan alasan :properties.remark');
    }

    public function onRejected(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR ditolak oleh :causer.name dengan alasan :properties.remark');
    }

    public function onApproved(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR disetujui oleh :causer.name dengan plafond yang diterima sebesar :properties.remark');
    }

    public function onRedirected(CreditRequestConfirmed $event)
    {
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR dialihkan oleh :causer.name');
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            CreditRequestConfirmed::class => 'onConfirmed',
            CreditRequestPending::class => 'onPending',
            CreditRequestRejected::class => 'onRejected',
            CreditRequestApproved::class => 'onApproved',
            CreditRequestRedirected::class => 'onRedirected',
        ];
    }
}
