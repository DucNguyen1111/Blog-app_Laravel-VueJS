<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Comment;
use App\Models\Post;
use Cloudinary\Transformation\Rotate;
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

Route::post('/register', [UserController::class, 'register'])->middleware('duplicateAccount');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware("authentication");

Route::middleware(['authentication'])->group(function () {
    Route::post('/create', [PostController::class, 'create']);
    Route::patch('/post/{id}', [PostController::class, 'update']);
    Route::delete('/post/{id}', [PostController::class, 'destroy']);
    Route::get('/posts', [PostController::class, 'getAll']);
    Route::post('/comment', [CommentController::class, 'create']);
    Route::get('/post/{id}', [PostController::class, 'getPost']);
    Route::get('/owner', [UserController::class, 'getOwner']);
    Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
    Route::patch('/comment/{id}', [CommentController::class, 'updateComment']);
});
