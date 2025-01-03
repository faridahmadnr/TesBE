<?php

namespace Modules\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;
use Modules\User\Entities\User;

class VerifyEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return $this->buildMailMessage($verificationUrl);
    }

    /**
     * Get the verify email notification mail message for the given URL.
     *
     * @param  string  $url
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    protected function buildMailMessage($url)
    {
        $subject = Lang::get('Verify Email Address').' | '.Config::get('app.name');

        return (new MailMessage)
            ->subject($subject)
            ->view('user::mail.verify-email', [
                'bannerText' => Lang::get('Verify Email Address'),
                'bannerImage' => asset('images/icons/lock.png'),
                'contents' => [
                    'Halo',
                    'Silahkan klik tombol di bawah ini untuk melakukan verifikasi surel anda.',
                ],
                'buttonText' => Lang::get('Verify Email Address'),
                'buttonUrl' => $url,
                'footerText' => 'Silahkan abaikan surel ini jika anda tidak melakukan permintaan ini.',
            ]);
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        $user = User::find($notifiable->getKey());
        $url = URL::temporarySignedRoute(
            'api.v1.auth.verify-email',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $user->hashId,
                'hash' => sha1($notifiable->getEmailForVerification()),  // skipcq: PHP-A1004
            ]
        );

        $url = str_replace('/api/v1', '', $url);
        $url = \Str::replace(Config::get('app.url'), Config::get('app.frontend_url'), $url);

        return $url;
    }
}
