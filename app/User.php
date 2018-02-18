<?php

namespace App;

use App\Models\Post;
use App\Models\Trade;
use App\Models\Wanted;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function userId() : UserId
    {
        return new UserId($this->id);
    }

    public function email() : string
    {
        return $this->email;
    }

    public function scopeFindByEmail($query, string $email)
    {
        $query->where('email', '=', $email);
    }

    public function posts() : HasMany
    {
        return $this->hasMany(Post::class, 'seller_id', 'id');
    }

    public function wishlist() : HasMany
    {
        return $this->hasMany(Wanted::class, 'seller_id', 'id');
    }

    public function postings()
    {
        return $this->hasMany(Trade::class, 'seller_id', 'id');
    }
}
