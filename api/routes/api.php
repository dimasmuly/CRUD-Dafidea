<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::resource('posts', PostController::class)->only(['index', 'show']);
Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('posts', PostController::class)->only(['store', 'update', 'destroy']);
    Route::put('/comments/{comment}', [CommentController::class, 'update']);
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
