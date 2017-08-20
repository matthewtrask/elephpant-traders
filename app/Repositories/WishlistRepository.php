<?php

namespace App\Repositories;

use App\Models\Wanted;

class WishlistRepository
{
    /**
     * @var Wanted
     */
    private $wanted;

    public function __construct(Wanted $wanted)
    {
        $this->wanted = $wanted;
    }

    public function create($data, $userId)
    {
        $wanted = new Wanted();
        $wanted->seller_id = $userId;
        $wanted->elephpant = $data->getElephpant();
        $wanted->desire = $data->getDesireLevel();

        return $wanted->save();
    }

    public function delete($request)
    {
        return $this->wanted->find($request->id)->delete();
    }
}