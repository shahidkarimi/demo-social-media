<?php

use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/user/{id}/{slug?}', [ProfileController::class, 'index'])->name('user.profile');
Route::get('/follow-status/{id}', [ProfileController::class, 'followStatus']);
Route::get('/follow-unfollow/{id}/{status}', [ProfileController::class, 'DoAction']);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/post/{user_id?}', [PostController::class, 'index']);
Route::post('/post', [PostController::class, 'post']);
Route::get('/feed/{id}', [PostController::class, 'show'])->name('feed.show');
Route::delete('/post/{post}', [PostController::class, 'delete']);

//Notifications
Route::get('notification', [NotificationController::class, 'index'])->name('notification.index');


//Like
Route::post('/like/{type}/{id}/like', [LikeController::class, 'like']);
Route::get('/like/{type}/{id}/count', [LikeController::class, 'count']);
