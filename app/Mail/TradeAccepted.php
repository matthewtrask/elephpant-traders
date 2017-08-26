<?php

namespace App\Mail;

use App\Models\Trade;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TradeAccepted extends Mailable
{
    use Queueable, SerializesModels;

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
        return $this->from('trade@elephpanttrade.com')->view('emails.trade-accepted');
    }
}
