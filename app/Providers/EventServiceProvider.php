<?php

namespace App\Providers;

use App\Events\SendAcceptedEmail;
use App\Events\SendTradeEmail;
use App\Listeners\SendAcceptanceEmailHandler;
use App\Listeners\SendTradeEmailHandler;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SendTradeEmail::class => [
            SendTradeEmailHandler::class
        ],
        SendAcceptedEmail::class => [
            SendAcceptanceEmailHandler::class
        ]
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
