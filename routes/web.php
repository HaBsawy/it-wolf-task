<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\AuthBloggerController;
use App\Http\Controllers\BloggerController;
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'home'])->name('index');
Route::get('posts/topic/{topic}', [PostController::class, 'topic'])->name('posts.topic');


Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('blogger/login', [AuthBloggerController::class, 'login'])->name('blogger.login');
        Route::get('admin/login', [AuthAdminController::class, 'login'])->name('admin.login');

        Route::post('blogger/login', [AuthBloggerController::class, 'postLogin'])->name('blogger.postLogin');
        Route::post('admin/login', [AuthAdminController::class, 'postLogin'])->name('admin.postLogin');
    });

    Route::post('blogger/logout', [AuthBloggerController::class, 'logout'])->middleware('auth:blogger')
        ->name('blogger.logout');
    Route::post('admin/logout', [AuthAdminController::class, 'logout'])->middleware('auth:admin')
        ->name('admin.logout');
});

Route::group(['middleware' => 'auth:admin,blogger'], function () {
    Route::delete('posts/force-delete/{post}', [PostController::class, 'forceDelete'])->name('posts.forceDelete');
    Route::resource('posts', 'PostController')->except(['create', 'store', 'show']);
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('bloggers/data', [BloggerController::class, 'data'])->name('bloggers.data');
    Route::resource('bloggers', 'BloggerController')->only(['index', 'create', 'store']);
});

Route::group(['middleware' => 'auth:blogger'], function () {
    Route::post('posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
    Route::resource('posts', 'PostController')->only(['create', 'store']);
});

Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('bloggers/{blogger}', [BloggerController::class, 'show'])->name('bloggers.show');

