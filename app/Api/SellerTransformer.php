<?php
/**
 * Created by PhpStorm.
 * User: trask
 * Date: 8/2/17
 * Time: 3:09 PM
 */

namespace App\Http\Controllers\Api;


use App\Api\PostTransformer;
use App\User;
use League\Fractal\TransformerAbstract;

class SellerTransformer extends TransformerAbstract
{
    protected $availableIncludes  = [
        'posts',
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

    private function image($user)
    {
        if ($user->image === '') {
            $user->image = '/img/default_user.png';
        }

        return $user->image;
    }
}