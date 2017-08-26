<?php

namespace App\Listeners;

use App\Events\SendAcceptedEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAcceptanceEmailHandler
{
    /**
     * Handle the event.
     *
     * @param  SendAcceptedEmail  $event
     * @return void
     */
    public function handle(SendAcceptedEmail $event)
    {
        $this->sendMailer($event);
    }

    private function sendMailer($event)
    {

    }
}
