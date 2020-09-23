<?php

use App\Http\Controllers\PostController;
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

/*Route::group([], function () {
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.detail');
    Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/post/edit/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/post/create', [PostController::class, 'store'])->name('posts.store');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
});*/

Route::resource('post', PostController::class)
    ->except(['index'])
    ->names('posts');
Route::get('/', [PostController::class, 'index'])
    ->name('posts.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
