<?php

namespace App\Api;

use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user, $token)
    {
        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}