<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Vercoutere\LaravelMjml\MjmlMailable;

class DailyBackupDatabaseMail extends MjmlMailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Daily Backup Database',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.daily-backup-database',
            with: [
                'downloadUrl' => $this->generateBackupUrl(),
            ]
        );
    }

    private function generateBackupUrl()
    {
        return route('download', [\Str::random(32)]);
    }
}
