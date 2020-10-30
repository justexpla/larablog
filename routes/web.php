<?php

use App\Http\Controllers\CommentaryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostsController;
use App\Http\Controllers\UserProfileController;
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

Route::post('/post/commentary/create', [CommentaryController::class, 'store'])
    ->name('post.commentary.create');
Route::get('/post/commentary/create', [CommentaryController::class, 'store']);
Route::post('/post/commentary/storeImage', [CommentaryController::class, 'storeImage'])
    ->name('post.commentary.storeImage');

Route::resource('post', PostController::class)
    ->except(['index'])
    ->names('posts');

Route::get('/', [PostController::class, 'index'])
    ->name('posts.index');

Route::group(['prefix' => '/user/', 'as' => 'user.'] , function () {
    Route::get('/{user}', [UserProfileController::class, 'show'])->name('show');
    Route::get('/{user}/edit', [UserProfileController::class, 'edit'])->name('edit');
    Route::put('/{user}/edit', [UserProfileController::class, 'update'])->name('update');

    Route::get('/{user}/posts', [UserPostsController::class, 'index'])->name('posts.index');
});

/**
 * Настройки
 */
Route::group(['prefix' => 'settings'], function () {
    Route::resource('blacklist', \App\Http\Controllers\Settings\BlackListController::class)
        ->names('settings.blacklist')
        ->only(['index', 'destroy', 'store']);
});

Auth::routes();

Route::get('/test', function () {

});

Route::post('/test1', function () {
    $path = request()->file('file')->storeAs('public', request('key'));

    return response($path, 204);
});
