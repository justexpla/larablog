<?php

use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;

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

Route::post('/post/load', [PostController::class, 'load'])
    ->name('post.load');  #ajax
Route::post('/post/commentary/create', [CommentaryController::class, 'store'])
    ->name('post.commentary.create');
Route::get('/post/commentary/create', [CommentaryController::class, 'store'])
    ;

Route::resource('post', PostController::class)
    ->except(['index'])
    ->names('posts');

Route::get('/', [PostController::class, 'index'])
    ->name('posts.index');

Route::group(['prefix' => '/user/'] , function () {
    Route::get('/{user}', [UserProfileController::class, 'show'])->name('user.show');
    Route::post('/{user}/load', [UserProfileController::class, 'load'])->name('user.posts.load');   #ajax
    Route::get('/{user}/edit', [UserProfileController::class, 'edit'])->name('user.edit');
    Route::put('/{user}/edit', [UserProfileController::class, 'update'])->name('user.update');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


if (env('APP_DEBUG') === 'true') {
    Route::get('/test', function () {
        $commentary = \App\Models\Commentary::find(1);
        dd($commentary->post, $commentary->user);
    });
}
