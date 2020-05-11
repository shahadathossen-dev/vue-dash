<?php

namespace App\Notifications\Backend;

use Carbon\Carbon;
use App\Models\Backend\User;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewAdminVerificationNotification extends Notification
{
    use Queueable;

    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        return (new MailMessage)
            ->greeting(Lang::get('Hello '.$notifiable->fname.'!'))
            ->subject(Lang::get('Verify Email Address'))
            ->line(
                "Welcome to ". str_replace('-', ' ', config('app.name'))." family."
            )
            ->line(
                'An admin account has just been created for you.'
            )
            ->line(Lang::get('To verify your email address and to create your password please click the given link below.'))
            ->level('success')
            ->action(
                Lang::get('Verify Email Address'),
                $this->verificationUrl($notifiable)
                // route('verifyEmail', ['email' => $this->user->email, 'verify_token' => $this->user->verify_token])
            )
            ->line(Lang::get('If you did not create an account, no further action is required.'));

    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'admin.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                // 'verify_token' => $notifiable->verify_token
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
