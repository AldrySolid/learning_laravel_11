<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CategoryController::class)->group(
    function () {
        Route::get('/categories/store', 'store');
        Route::get('/categories/index', 'index');
        Route::get('/categories/show/{category}', 'show');
        Route::get('/categories/update/{category}', 'update');
        Route::get('/categories/destroy/{category}', 'destroy');
    }
);

Route::controller(CommentController::class)->group(
    function () {
        Route::get('/comments/store', 'store');
        Route::get('/comments/index', 'index');
        Route::get('/comments/show/{comment}', 'show');
        Route::get('/comments/update/{comment}', 'update');
        Route::get('/comments/destroy/{comment}', 'destroy');
    }
);

Route::controller(PostController::class)->group(
    function () {
        Route::get('/posts/store', 'store');
        Route::get('/posts/index', 'index');
        Route::get('/posts/show/{post}', 'show');
        Route::get('/posts/update/{post}', 'update');
        Route::get('/posts/destroy/{post}', 'destroy');
    }
);

Route::controller(ProfileController::class)->group(
    function () {
        Route::get('/profiles/store', 'store');
        Route::get('/profiles/index', 'index');
        Route::get('/profiles/show/{profile}', 'show');
        Route::get('/profiles/update/{profile}', 'update');
        Route::get('/profiles/destroy/{profile}', 'destroy');
    }
);

Route::controller(RoleController::class)->group(
    function () {
        Route::get('/roles/store', 'store');
        Route::get('/roles/index', 'index');
        Route::get('/roles/show/{role}', 'show');
        Route::get('/roles/update/{role}', 'update');
        Route::get('/roles/destroy/{role}', 'destroy');
    }
);

Route::controller(TagController::class)->group(
    function () {
        Route::get('/tags/store', 'store');
        Route::get('/tags/index', 'index');
        Route::get('/tags/show/{tag}', 'show');
        Route::get('/tags/update/{tag}', 'update');
        Route::get('/tags/destroy/{tag}', 'destroy');
    }
);

Route::controller(UserController::class)->group(
    function () {
        Route::get('/users/store', 'store');
        Route::get('/users/index', 'index');
        Route::get('/users/show/{user}', 'show');
        Route::get('/users/update/{user}', 'update');
        Route::get('/users/destroy/{user}', 'destroy');
    }
);
