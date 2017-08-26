<?php

namespace App\Api;

use App\Models\Trade;
use League\Fractal\TransformerAbstract;

class TradeTransformer extends TransformerAbstract
{
    public function transform(Trade $trade)
    {
        return [
            'id' => $trade->id,
            'elephpant' => $trade->elephpant->title,
            'buyer' => $trade->buyer->name,
            'approved' => $trade->accepted ? 'Yes' : 'No',
            'received' => $trade->received ? 'Yes' : 'No',
            'approvedAt' => $trade->accepted_at,
        ];
    }
}