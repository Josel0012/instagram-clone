<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Mail\NewUserWelcomeMail;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/email', function () {
    return new NewUserWelcomeMail();
});
Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);


Route::get('/', [App\Http\Controllers\PostsController::class, 'index']);

Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);

// Route::post('/p', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');
Route::post('/p', [App\Http\Controllers\PostsController::class, 'store']);
Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profiles.show');

Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profiles.edit');

Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profiles.update');
