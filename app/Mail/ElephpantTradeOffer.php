<?php

namespace App\Mail;

use App\Models\Trade;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ElephpantTradeOffer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Trade
     */
    public $trade;

    public function __construct(Trade $trade)
    {
        $this->trade = $trade;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('trade@elephpanttrades.com')->markdown('emails.trade');
    }
}
