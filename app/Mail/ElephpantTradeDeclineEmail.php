<?php

namespace App\Mail;

use App\Models\Trade;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ElephpantTradeDeclineEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $trade;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        return $this->from('hello@elephpanttrade.com')->markdown('emails.trade-decline');
    }
}
