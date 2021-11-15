<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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

//Resource 는 이름이 이미 지정되어있는 상태이므로 이름을 지정하지 않아도 됨.
Route::resource('/posts', PostsController::class)->middleware(['auth']);

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::delete('posts/image/{id}', [PostsController::class, 'deleteImage'])->middleware(['auth']);

Route::post('/like/{post}', [LikesController::class, 'store'])->middleware(['auth'])->name('like.store');

Route::get('comments/{post}', [CommentsController::class, 'index'])->name('comments.index');

// add comment
Route::post('/comments/{post_id}', [CommentsController::class, 'store'])->name('comments.store');

// edit comment
Route::patch('/comments/{comment_id}', [CommentsController::class, 'update'])->name('comments.update');

// delete comment
Route::delete('/comments/{comment_id}', [CommentsController::class, 'destroy'])->name('comments.delete');

require __DIR__.'/auth.php';
