<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'postings';

    protected $dates = ['deleted_at'];

    public function seller() : BelongsTo
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }

    public function wanted() : HasMany
    {
        return $this->hasMany(Wanted::class, 'seller_id', 'seller_id');
    }

    public function trade() : HasMany
    {
        return $this->hasMany(Trade::class, 'post_id', 'id');
    }

    public function scopeById($query, int $id)
    {
        return $query->where('id', $id);
    }

    public function newPost() : bool
    {
        $week = new Carbon;

        $week->subWeek()->toDateString();

        $date = $this->created_at;

        if ($date > $week) {
            return true;
        }

        return false;
    }

    public function pendingTradeCount()
    {
        return $this->trade()->pending()->count();
    }

    public function completedTradeCount()
    {
        return $this->trade()->completed()->count();
    }

    public function totalElephpants()
    {
        return $this->count();
    }
}
