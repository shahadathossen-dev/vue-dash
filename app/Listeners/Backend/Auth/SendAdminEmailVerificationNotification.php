<?php

namespace App\Listeners\Backend\Auth;

use App\Models\Backend\User;
use App\Events\Backend\NewAdminApproved;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\Backend\NewAdminVerificationNotification;

class SendAdminEmailVerificationNotification
{
    public $notifiable;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(User $notifiable)
    {
        $this->notifiable = $notifiable;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewAdminApproved $event)
    {
        if ($event->user instanceof MustVerifyEmail && ! $event->user->hasVerifiedEmail()) {
            $event->user->notify(new NewAdminVerificationNotification($event->user));
        }
    }
}
