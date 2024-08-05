<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/login', [AuthController::class, 'login']);
Route::group(['middleware' => 'jwt.auth', 'prefix' => 'auth'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::apiResources(
    [
        'categories' => CategoryController::class,
        'comments'   => CommentController::class,
        'profiles'   => ProfileController::class,
        'roles'      => RoleController::class,
        'tags'       => TagController::class,
        'users'      => UserController::class,
    ]
);

// API Постов публичное
Route::apiResource('posts', PostController::class);

// API Постов закрыто jwt
//Route::apiResource('posts', PostController::class)
//     ->middleware(['jwt.auth', IsAdminMiddleware::class]);
