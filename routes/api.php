<?php

use App\Http\Resources\TodayTaskResource;
use App\Http\Resources\UpcomingResource;
use App\Models\Today;
use App\Models\Upcoming;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//** UPCOMING */
/**
 * Add new task
 */
Route::post('/upcoming', function (Request $request) {
    return Upcoming::create([
        'title' =>  $request->title,
        'taskId' => $request->taskId,
        'waiting' => $request->waiting,
        'user_id' => $request->user_id,
    ]);
});

/**
 * Update upcoming task
 */
Route::put('/upcoming/{id}', function ($id, Request $request) {
    $upcomingTask = Upcoming::findOrFail($id);
    $upcomingTask->update($request->all());
    $upcomingTask->save();
});

/**
 * Delete upcoming task
 */
Route::delete('/upcoming/{taskId}', function ($taskId) {
    DB::table('upcomings')->where('taskId', $taskId)->delete();
    return 204;
});

//** TODAY */
/**
 * Add today task
 */
Route::post('/dailytask', function (Request $request) {
    return Today::create([
        'title' => $request->title,
        'taskId' => $request->taskId,
        'user_id' => $request->user_id,
    ]);
});

/**
 * Update today task
 */
Route::put('/dailytask/{id}', function ($id, Request $request) {
    $todayTask = Today::findOrFail($id);
    $todayTask->update($request->all());
    $todayTask->save();
});

/**
 * Delete today task
 */
Route::delete('dailytask/{taskId}', function ($taskId) {
    DB::table('todays')->where('taskId', $taskId)->delete();
    return 204;
});
