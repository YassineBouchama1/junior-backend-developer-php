<?php

namespace App\Services;

use App\Models\Thread;
use App\Models\User;
use App\Traits\ThreadScopeTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ThreadRetrievalService
{
    use ThreadScopeTrait; //bring all methods from  trait Thread

    // This function retieves threads for a user with pagination.
    public function retrieveThreads($user, int $perPage = 10): LengthAwarePaginator
    {
        // Start building the query to find threads.
        $query = Thread::query();

        // Filter threads based on the user location
        //params : query & user location
        $query = $this->scopeByLocation($query, $user->location);


        // Order threads by the number of likes
        $query = $this->scopeByLikes($query);

        // Order threads by creation date
        $query = $this->scopeOrderByDate($query);

        // Return the paginated results
        return $query->paginate($perPage);
    }
}
