<?php

use App\Http\Controllers\ThreadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require __DIR__ . '/auth.php';


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});





Route::group(['prefix' => 'threads', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', [ThreadController::class, 'getThreads']);
});
