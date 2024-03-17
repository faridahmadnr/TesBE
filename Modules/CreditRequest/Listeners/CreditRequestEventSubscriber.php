<?php

namespace Modules\CreditRequest\Listeners;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Events\Dispatcher;
use Mail;
use Modules\CreditRequest\Emails\CreditRequestApprovedMail;
use Modules\CreditRequest\Emails\CreditRequestConfirmedMail;
use Modules\CreditRequest\Emails\CreditRequestPendingMail;
use Modules\CreditRequest\Emails\CreditRequestRedirectedMail;
use Modules\CreditRequest\Emails\CreditRequestRejectedMail;
use Modules\CreditRequest\Entities\CreditRequestHistory;
use Modules\CreditRequest\Events\CreditRequestApproved;
use Modules\CreditRequest\Events\CreditRequestConfirmed;
use Modules\CreditRequest\Events\CreditRequestCreated;
use Modules\CreditRequest\Events\CreditRequestDeleted;
use Modules\CreditRequest\Events\CreditRequestDestroyed;
use Modules\CreditRequest\Events\CreditRequestPending;
use Modules\CreditRequest\Events\CreditRequestRedirected;
use Modules\CreditRequest\Events\CreditRequestRejected;
use Modules\CreditRequest\Events\CreditRequestRestored;
use Modules\CreditRequest\Events\CreditRequestUpdated;

class CreditRequestEventSubscriber implements ShouldHandleEventsAfterCommit
{
    public function onCreated(CreditRequestCreated $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR telah dibuat oleh '.$event->creditRequest->creator->name.'.',
        ]));

        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dibuat oleh :causer.name.');
    }

    public function onUpdated(CreditRequestUpdated $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR telah diperbarui oleh '.$event->creditRequest->creator->name.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah diperbarui oleh :causer.name.');
    }

    public function onDeleted(CreditRequestDeleted $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR telah dihapus oleh '.$event->creditRequest->creator->name.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dihapus oleh :causer.name.');
    }

    public function onDestroyed(CreditRequestDestroyed $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR telah dihapus permanen oleh '.$event->creditRequest->creator->name.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dihapus permanen oleh :causer.name.');
    }

    public function onRestored(CreditRequestRestored $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR telah dikembalikan oleh '.$event->creditRequest->creator->name.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dikembalikan oleh :causer.name.');
    }

    public function onConfirmed(CreditRequestConfirmed $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR telah dikonfirmasi oleh '.$event->creditRequest->creator->name.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR telah dikonfirmasi oleh :causer.name.');

        Mail::to($event->creditRequest->user->email)
            ->queue(new CreditRequestConfirmedMail($event->creditRequest));
    }

    public function onPending(CreditRequestPending $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR ditunda oleh '.$event->creditRequest->creator->name.' dengan alasan '.$event->creditRequest->remark.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR ditunda oleh :causer.name dengan alasan :properties.remark');

        Mail::to($event->creditRequest->user->email)
            ->queue(new CreditRequestPendingMail($event->creditRequest));
    }

    public function onRejected(CreditRequestRejected $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR ditolak oleh '.$event->creditRequest->creator->name.' dengan alasan '.$event->creditRequest->remark.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR ditolak oleh :causer.name dengan alasan :properties.remark');

        Mail::to($event->creditRequest->user->email)
            ->queue(new CreditRequestRejectedMail($event->creditRequest));
    }

    public function onApproved(CreditRequestApproved $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR disetujui oleh '.$event->creditRequest->creator->name.' dengan plafond yang diterima sebesar '.$event->creditRequest->remark.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR disetujui oleh :causer.name dengan plafond yang diterima sebesar :properties.remark');

        Mail::to($event->creditRequest->user->email)
            ->queue(new CreditRequestApprovedMail($event->creditRequest));
    }

    public function onRedirected(CreditRequestRedirected $event)
    {
        $event->creditRequest->histories()->save(new CreditRequestHistory([
            'status' => $event->creditRequest->status,
            'description' => 'Pengajuan KUR dialihkan oleh '.$event->creditRequest->creator->name.'.',
        ]));
        activity('creditRequest')
            ->performedOn($event->creditRequest)
            ->withProperties($event->creditRequest)
            ->log('Pengajuan KUR dialihkan oleh :causer.name');

        Mail::to($event->creditRequest->user->email)
            ->queue(new CreditRequestRedirectedMail($event->creditRequest));
    }

    public function subscribe(Dispatcher $events): array
    {
        return [
            CreditRequestConfirmed::class => 'onConfirmed',
            CreditRequestPending::class => 'onPending',
            CreditRequestRejected::class => 'onRejected',
            CreditRequestApproved::class => 'onApproved',
            CreditRequestRedirected::class => 'onRedirected',
            CreditRequestCreated::class => 'onCreated',
            CreditRequestUpdated::class => 'onUpdated',
            CreditRequestDeleted::class => 'onDeleted',
            CreditRequestDestroyed::class => 'onDestroyed',
            CreditRequestRestored::class => 'onRestored',
        ];
    }
}
