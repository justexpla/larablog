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
    $user = \App\Models\User::find(2);
    dd($user->blackList);
});
