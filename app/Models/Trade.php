<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Query\Builder;

class Trade extends Model
{
    protected $table = 'trades';

    public function seller() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'seller_id');
    }

    public function buyer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'id', 'buyer_id');
    }

    public function scopeAccepted(Builder $query) : Builder
    {
        return $query->where('accepted', '=', 1);
    }

    public function scopeNotAccepted(Builder $query) : Builder
    {
        return $query->where('accepted', '=', 0);
    }

    public function scopeCompleted(Builder $query) : Builder
    {
        return $query->where('received', '=', 1);
    }

    public function scopeNotCompleted(Builder $query) : Builder
    {
        return $query->where('received', '=', 0);
    }

    public function scopeAcceptedAt(Builder $query)
    {
        return $query->where('accepted_at', '=', null);
    }
}
