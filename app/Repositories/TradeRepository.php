<?php

namespace App\Repositories;

use App\Models\Trade;
use Carbon\Carbon;

class TradeRepository
{
    /**
     * @var Trade
     */
    private $trade;

    public function __construct(Trade $trade)
    {
        $this->trade = $trade;
    }

    public function getAllTrades()
    {
        return $this->trade->all();
    }

    public function getAcceptedTrades()
    {
        return $this->trade->accepted()->get();
    }

    public function getPendingTrades()
    {
        //
    }

    public function create($data, $user)
    {
        $trade = new Trade();
        $trade->post_id = $data->getPostId();
        $trade->seller_id = $data->getSellerId();
        $trade->buyer_id = $user->userId();
        $trade->accepted = 0;
        $trade->received = 0;
        $trade->accepted_at = null;

        $trade->save();

        return $trade->id;
    }

    public function approveTrade($postId)
    {
        $trade = $this->trade->find($postId)->first();
        $trade->accepted_at = Carbon::now();
        $trade->accepted = 1;
        $trade->save();
    }
}
