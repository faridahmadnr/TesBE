<?php

namespace Modules\CreditRequest\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\CreditRequest\Entities\CreditRequest;

class CreditRequestRedirectedMail extends Mailable implements ShouldQueue
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
            view: 'creditrequest::mail.credit-request-redirected',
            with: [
                'fullname' => $this->creditRequest->user->name,
                'registrationNumber' => $this->creditRequest->registration_number,
                'gender' => '',
                'phone' => '',
                'email' => '',
                'regencyName' => '',
                'districtName' => '',
                'village' => '',
                'address' => '',
                'businessName' => '',
                'businessType' => '',
                'businessPermit' => '',
                'businessTin' => '',
                'amount' => 'Rp'.number_format(0000, 0, ',', '.'),
                'termin' => '',
                'bankName' => '',
            ]
        );
    }
}
