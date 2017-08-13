<?php

namespace App;

use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userId() : int
    {
        return (int) $this->id;
    }

    public function email() : string
    {
        return $this->email;
    }

    public function scopeFindByEmail($query, string $email)
    {
        $query->where('email', '=', $email);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'seller_id', 'id');
    }
}
