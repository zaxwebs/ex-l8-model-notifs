<?php

use App\Models\Post;
use App\Models\User;
use App\Notifications\PostLiked;
use App\Notifications\PostCommented;
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
    return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('simulation/like', function () {
    // notify current user
    Auth::user()->notify(new PostLiked(Post::inRandomOrder()->first(), User::inRandomOrder()->first()));
    return redirect('home');
})->middleware('auth');

Route::get('simulation/comment', function () {
    // notify current user
    Auth::user()->notify(new PostCommented(Post::inRandomOrder()->first(), User::inRandomOrder()->first()));
    return redirect('home');
})->middleware('auth');