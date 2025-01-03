<?php

namespace Modules\CreditRequest\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\CreditRequest\Entities\CreditRequest;

class CreditRequestPendingMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public CreditRequest $creditRequest
    ) {
        $this->afterCommit();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address('notifikasi.kurdiy@gmail.com', 'KUR JOGJA'),
            subject: 'Info Pengajuan Dana KUR',
            // replyTo: [
            //     new Address('taylor@example.com', 'Taylor Otwell'),
            // ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'creditrequest::mail.credit-request-pending',
            with: [
                'fullname' => $this->creditRequest->user->name,
                'registrationNumber' => $this->creditRequest->registration_number,
                'gender' => $this->creditRequest->user->member->gender ?? '-',
                'phone' => $this->creditRequest->user->member->phone ?? '-',
                'email' => $this->creditRequest->user->email ?? '-',
                'regencyName' => $this->creditRequest->regency->name ?? '-',
                'districtName' => $this->creditRequest->district->name ?? '-',
                'village' => $this->creditRequest->village ?? '-',
                'address' => $this->creditRequest->business_address ?? '-',
                'businessType' => $this->creditRequest->businessType->name ?? '-',
                'businessPermit' => $this->creditRequest->businessPermit->name ?? '-',
                'businessTin' => $this->creditRequest->business_tin ?? '-',
                'amount' => 'Rp'.number_format($this->creditRequest->amount, 0, ',', '.'),
                'termin' => $this->creditRequest->termin->name ?? '-',
                'bankName' => $this->creditRequest->bank->name ?? '-',
                'remark' => $this->creditRequest->remark ?? '-',
            ]
        );
    }
}
