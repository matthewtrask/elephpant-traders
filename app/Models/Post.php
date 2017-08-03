<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    protected $table = 'postings';

    public function seller() : BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function wanted()
    {
        return $this->hasMany(Wanted::class, 'seller_id', 'seller_id');
    }

    public function scopeById($query, int $id)
    {
       return $query->where('id', $id);
    }
}
