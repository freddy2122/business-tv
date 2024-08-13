<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index']);
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'envoyerEmail'])->name('envoyer.email');
Route::get('/about', [UserController::class, 'about'])->name('about');
Route::get('/blog', [UserController::class, 'blog'])->name('blog');
Route::get('/detail-blog', [UserController::class, 'detail_blog'])->name('detail_blog');
Route::get('/video-details/{slug}', [AdminController::class, 'show'])->name('news.details');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// web.php


Route::middleware(['auth'])->group(function () {
    Route::post('/post-comment', [CommentController::class, 'store'])->name('post-comment');
    Route::get('/comments/{newsItem}', [CommentController::class, 'index'])->name('get-comments');
    Route::get('/comments/{newsId}/{offset}/{limit}', [CommentController::class, 'getComments']);
    Route::get('/users/edit/{id}', [AdminController::class, 'edit_user'])->name('users.edit');
    Route::put('/users/update/{id}', [AdminController::class, 'update_user'])->name('users.update');

});


Route::middleware(['auth', 'rule:admin'])->prefix('admin')->group(function () {
    Route::get('/list-user', [AdminController::class, 'list_user'])->name('list_user');
    Route::get('/list-actuality', [AdminController::class, 'list_actuality'])->name('list_actuality');
    Route::get('/list-comments', [AdminController::class, 'showComments'])->name('showComments');
    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/users/{user}/change-role', [AdminController::class, 'changeRole'])->name('changeRole');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('delete_user');
    Route::delete('/comments/{id}', [AdminController::class, 'delete_comment'])->name('delete_comment');

    Route::get('/news/create', [AdminController::class, 'create'])->name('news.create');
    Route::post('/news', [AdminController::class, 'store'])->name('news.store');

    Route::get('/news/{news}/edit', [AdminController::class, 'edit'])->name('news.edit');
    Route::post('/news/{news}/update', [AdminController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [AdminController::class, 'delete_news'])->name('news.destroy');
});
