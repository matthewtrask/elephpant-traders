<?php

namespace App\Api;

use App\Models\Wanted;
use League\Fractal\TransformerAbstract;

class WantedTransformer extends TransformerAbstract
{
    public function transform(Wanted $wanted)
    {
        return [
            'sellerId' => $wanted->seller_id,
            'elephpant' => $wanted->elephpant,
            'posted' => $wanted->created_at,
        ];
    }
}