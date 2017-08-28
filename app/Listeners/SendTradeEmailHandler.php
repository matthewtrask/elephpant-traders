<?php

namespace App\Listeners;

use App\Events\SendTradeEmail;
use App\Mail\ElephpantTradeOffer;
use App\Models\Trade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendTradeEmailHandler
{

    /**
     * Handle the event.
     *
     * @param  SendTradeEmail  $event
     * @return void
     */
    public function handle(SendTradeEmail $event)
    {
        $this->sendEmail($event);
    }

    private function sendEmail($event)
    {
        $trade = Trade::find($event->tradeId());

        Mail::to($trade->seller->email)->send(new ElephpantTradeOffer($trade));
    }
}
