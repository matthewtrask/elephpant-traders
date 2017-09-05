<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Wanted extends Model
{
    protected $table = 'wanted';

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
}
