<?php
/**
 * Created by PhpStorm.
 * User: trask
 * Date: 8/20/17
 * Time: 11:13 AM
 */

namespace App\Repositories;


use App\Models\Trade;

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

        return $trade->save();
    }
}
