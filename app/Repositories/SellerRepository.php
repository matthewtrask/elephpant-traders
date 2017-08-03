<?php
/**
 * Created by PhpStorm.
 * User: trask
 * Date: 8/2/17
 * Time: 1:22 PM
 */

namespace App\Http\Controllers\Api;


use App\User;
use Illuminate\Database\Eloquent\Collection;

class SellerRepository
{
    /**
     * @param User $user
     */
    private $user;

    public function _construct(User $user)
    {
        $this->user = $user;
    }

    public function get() : Collection
    {
        return $this->user->all();
    }

    public function fetch(int $id) : User
    {
        return User::find($id);
    }

    public function create($data)
    {

    }

    public function edit($data)
    {

    }

    public function destroy(int $id)
    {

    }
}