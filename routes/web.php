<?php

use App\Http\Resources\TodayTaskResource;
use App\Http\Resources\UpcomingResource;
use App\Models\Upcoming;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });
//** USER */
Route::get('/user', function () {
    $user = Auth::user();
    return $user;
});

//** UPCOMING */
/**
 * Get all upcomings tasks
 */
Route::get('/upcoming', function () {
    $user_id = Auth::user()->id;
    $upcoming = DB::table('upcomings')->where('user_id', $user_id)->get();
    return UpcomingResource::collection($upcoming);
});

//** TODAY */
/**
 * Today task
 */
Route::get('dailytask', function () {
    $user_id = Auth::user()->id;
    $todayTasks = DB::table('todays')->where('user_id', $user_id)->get();
    return TodayTaskResource::collection($todayTasks);
});


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
