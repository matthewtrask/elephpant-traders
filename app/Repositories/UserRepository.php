<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
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
        $user = new User();
        $user->name = $data->getName();
        $user->email = $data->getEmail();
        $user->twitter = $data->getTwitter();
        $user->password = bcrypt($data->getPassword());

        return $user->save();
    }

    public function edit($data)
    {

    }

    public function destroy(int $id)
    {

    }
}