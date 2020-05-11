<?php

namespace App\Listeners\Backend;

use App\Models\Backend\User;
use App\Events\Backend\NewAdminCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notifications\Backend\NewAdminCreatedNotification;

class SeekApprovalNotification
{
    public $notifiable;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewAdminCreated $event)
    {
        $this->notifiable = User::role('Super Admin')->first();
        $this->notifiable->notify(new NewAdminCreatedNotification($event->user));
    }
}
