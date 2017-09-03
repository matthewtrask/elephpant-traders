<?php
/**
 * Created by PhpStorm.
 * User: trask
 * Date: 8/2/17
 * Time: 3:09 PM
 */

namespace App\Http\Controllers\Api;

use App\Api\PostTransformer;
use App\Api\TradeTransformer;
use App\Api\WantedTransformer;
use App\User;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    protected $availableIncludes  = [
        'posts',
        'wishlist',
        'trades',
    ];

    public function transform(User $user)
    {
        return [
            'id' => $user->userId(),
            'name' => $user->name,
            'twitter' => $user->twitter,
            'image' => $this->image($user),
            'elephpantCount' => $user->posts->count(),
        ];
    }

    public function includePosts(User $user)
    {
        return $this->collection($user->posts, new PostTransformer());
    }

    public function includeWishlist(User $user)
    {
        return $this->collection($user->wishlist, new WantedTransformer());
    }

    public function includeTrades(User $user)
    {
        return $this->collection($user->postings, new TradeTransformer());
    }

    private function image($user)
    {
        if ($user->image === '' || is_null($user->image)) {
            $user->image = '/img/default_user.png';
        }

        return $user->image;
    }
}
