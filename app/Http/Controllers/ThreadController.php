<?php

namespace App\Http\Controllers;

use App\Http\Resources\ThreadResource;
use App\Services\ThreadRetrievalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    private $threadRetrievalService;


    // automaticly instant ThreadRetrievalService
    public function __construct(ThreadRetrievalService $threadRetrievalService)
    {
        $this->threadRetrievalService = $threadRetrievalService;
    }


    // This Functon Pre Filtred We can Make User CHange FIlters By Passing Querys Throught Url
    public function getThreads(Request $request)
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Get the number of threads per page from the request
        // Default 5
        $perPage = $request->query('per_page', 5);

        // Use the service to retrieve threads  with pagination
        $threads = $this->threadRetrievalService->retrieveThreads($user, $perPage);

        // Reeturn the retrieved threads as JSON
        return response()->json([
            'threads' => ThreadResource::collection($threads->items()),
            'current_page' => $threads->currentPage(),
            'total_pages' => $threads->lastPage(),
        ]);
    }
}
