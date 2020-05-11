<?php

namespace App\Providers;

use App\Events\NewMessage;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Events\Backend\NewAdminCreated;
use App\Events\Backend\NewAdminApproved;
use App\Listeners\SendNewMessageNotification;
use App\Listeners\Backend\SeekApprovalNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\Backend\Auth\SendAdminEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        NewAdminCreated::class => [
            SeekApprovalNotification::class,
        ],

        NewAdminApproved::class => [
            SendAdminEmailVerificationNotification::class,
        ],

        NewMessage::class => [
            SendNewMessageNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
