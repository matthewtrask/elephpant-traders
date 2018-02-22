<?php

namespace App\Api;

use App\Models\Post;
use League\Fractal\TransformerAbstract;

class CountTransformer extends TransformerAbstract
{
    public function transform(Post $post)
    {
        return [
            'pendingTradeCount' => $post->pendingTradeCount(),
            'completedTradeCount' => $post->completedTradeCount(),
            'totalElephpant' => $post->totalElephpants(),
        ];
    }
}