<?php

use App\Http\Controllers\web\CommentController;
use App\Http\Controllers\web\LikesController;
use App\Http\Controllers\web\PostController;
use App\Http\Controllers\web\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(PostController::class)->group(function () {

    //--------HomePage-----
    Route::get('/', 'index')->name('home');
    Route::get('/top-posts', 'index')->name('top-posts');

    //----Displaying & Making Posts --------
    Route::get('/posts/create', 'create')->middleware(['auth'])->name('posts.create');
    Route::post('/posts', 'store')->middleware(['auth'])->name('posts.store');
    Route::get('/posts/{post}', 'show')->middleware(['auth']);
    Route::get('/posts/{post}/edit', 'edit')->middleware(['auth','can:delete,post'])->name('posts.edit');
    Route::patch('/posts/{post}', 'update')->middleware(['auth','can:update,post'])->name('posts.update');
    Route::delete('/posts/{post}', 'destroy')->middleware(['auth','can:delete,post'])->name('posts.destroy');
});

    //-------- Users & UsersProfile ------
Route::controller(UserController::class)->group(function () {
    Route::get('/{user:username}/profile',  'show')->name('user.show')->middleware(['auth']);
});

    //------ Liking Posts & Comment ---------
Route::controller(LikesController::class)->group(function () {
    Route::post('/posts/{post}/like', 'store' )->middleware(['auth'])->name('post.like');
    Route::delete('/posts/{post}/like', 'destroy' )->middleware(['auth'])->name('post.unlike');
    Route::post('/comments/{comment}/like', 'store' )->middleware(['auth'])->name('comment.like');
    Route::delete('/comments/{comment}/like', 'destroy' )->middleware(['auth'])->name('comment.unlike');
});


Route::controller(CommentController::class)->group(function () {
    Route::post('/comments', 'store' )->middleware(['auth'])->name('post.comment');
    Route::delete('/comments/{comment}', 'destroy' )->middleware(['auth, can:delete'])->name('post.comment.destroy');
});



require __DIR__.'/auth.php';
