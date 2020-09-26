<?php

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

/*Route::group([], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.detail');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/post/edit/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/post/create', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});*/

Route::post('/post/load', [PostController::class, 'load'])->name('post.load');  #ajax
Route::resource('post', PostController::class)
    ->except(['index'])
    ->names('posts');
Route::get('/', [PostController::class, 'index'])
    ->name('posts.index');

Route::group(['prefix' => '/user/'] , function () {
    Route::get('/{user}', [UserProfileController::class, 'show'])->name('user.show');
    Route::post('/{user}/load', [UserProfileController::class, 'load'])->name('user.posts.load');   #ajax
    Route::get('/{user}/edit', [UserProfileController::class, 'edit'])->name('user.edit');
    Route::post('/{user}/edit', [UserProfileController::class, 'update'])->name('user.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
