<?php

namespace App\Api;

use League\Fractal\TransformerAbstract;

class TokenTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'IncludeUser',
    ];

    public function transform(string $token)
    {
        return [
            'token' => $token,
        ];
    }
}