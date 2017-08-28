<?php

namespace App\Listeners;

use App\Events\SendDeclineEmail;
use App\Mail\ElephpantTradeDeclineEmail;
use App\Models\Trade;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendDeclineEmailHandler
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
     * @param  SendDeclineEmail  $event
     * @return void
     */
    public function handle(SendDeclineEmail $event)
    {
        $this->sendDeclineEmail($event);
    }

    private function sendDeclineEmail($event)
    {
        $trade = $this->trade->find($event->tradeId());

        Mail::to($trade->buyer->email)->send(new ElephpantTradeDeclineEmail($trade));
    }
}
