<?php

namespace App\Api;

use App\Models\Wanted;
use League\Fractal\TransformerAbstract;

class WantedTransformer extends TransformerAbstract
{
    public function transform(Wanted $wanted)
    {
        return [
            'id' => $wanted->id,
            'sellerId' => $wanted->seller_id,
            'poster' => $wanted->seller->name(),
            'elephpant' => $wanted->elephpant,
            'desire' => $this->desireLevel($wanted->desire),
            'posted' => $wanted->created_at,
        ];
    }

    private function desireLevel($level)
    {
        if ($level === 1) {
            return 'Meh';
        } elseif ($level === 2) {
            return 'Mild';
        } elseif ($level === 3) {
            return 'Interested';
        } elseif ($level === 4) {
            return 'Definitely';
        } else {
            return 'Absolutely';
        }
    }
}
