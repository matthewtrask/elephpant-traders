<?php

namespace App\Listeners;

use App\Events\SendAcceptedEmail;
use App\Mail\ElephpantBuyerTradeAccepted;
use App\Mail\ElephpantSellerTradeAccepted;
use App\Models\Trade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

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
        $trade = Trade::find($event->tradeId());

        Mail::to($trade->buyer->email)->send(new ElephpantBuyerTradeAccepted($trade));
        Mail::to($trade->seller->email)->send(new ElephpantSellerTradeAccepted($trade));
    }
}
