<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

trait ThreadScopeTrait
{
    public function scopeByLocation(Builder $query, $userLocation)
    {

        // Get the currentlyu user AUth id
        $currentUserId = Auth::id();

        // This a basic location filtering
        return $query->join('users', 'threads.user_id', '=', 'users.id')
            ->where('users.location', $userLocation)
            ->where('threads.user_id', '!=', $currentUserId);
    }

    public function scopeByLikes(Builder $query)
    {
        // Implement sorting based on likes count
        return $query->orderBy('likes_count', 'desc');
    }

    public function scopeOrderByDate(Builder $query)
    {
        // Order by created_at in descending order
        // latest
        return $query->orderBy('threads.created_at', 'desc');
    }
}
