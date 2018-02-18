<?php

namespace App\Listeners;

use App\Events\SendTradeEmail;
use App\Mail\ElephpantTradeOffer;
use App\Models\Trade;
use Illuminate\Support\Facades\Mail;

class SendTradeEmailHandler
{
    /**
     * @var Trade
     */
    private $trade;

    public function __construct(Trade $trade)
    {
        $this->trade = $trade;
    }
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
        $trade = $this->trade->byId($event->tradeId())->first();

        Mail::to($trade->seller->email)->send(new ElephpantTradeOffer($trade));
    }
}
