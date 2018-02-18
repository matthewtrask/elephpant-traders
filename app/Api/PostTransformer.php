<?php

namespace App\Api;

use App\Models\Post;
use App\Models\Wanted;
use League\Fractal\TransformerAbstract;

class PostTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
     'wanted'
    ];

    public function transform(Post $post)
    {
        return [
            'id' => $post->id,
            'sellerId' => $post->seller_id,
            'title' => $post->title,
            'seller' => $post->seller->name,
            'description' => $post->description,
            'image' => 'https://s3.amazonaws.com/elephpant-swap/' . $post->image_link,
            'posted' => $post->created_at,
            'newPost' => $post->newPost(),
        ];
    }

    public function includeWanted(Post $post)
    {
        return $this->collection($post->wanted, new WantedTransformer());
    }
}
