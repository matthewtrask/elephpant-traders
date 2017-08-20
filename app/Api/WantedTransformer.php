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
            'elephpant' => $wanted->elephpant,
            'desire' => $this->desireLevel($wanted->desire),
            'posted' => $wanted->created_at,
        ];
    }

    private function desireLevel($level)
    {
        if ($level === 1) {
           return 'Meh';
        } else if ($level === 2) {
            return 'Mild';
        } else if ($level === 3) {
            return 'Interested';
        } else if ($level === 4) {
            return 'Definitely';
        } else {
            return 'Absolutely';
        }
    }
}