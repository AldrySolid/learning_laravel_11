<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
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
        Route::post('/posts/store', 'store')->name('posts.store');
        Route::get('/posts/index', 'index')->name('posts.index');
        Route::get('/posts/create', 'create')->name('posts.create');
        Route::get('/posts/show/{post}', 'show');
        Route::get('/posts/edit/{post}', 'edit')->name('posts.edit');
        Route::get('/posts/show/{post}', 'show')->name('posts.show');
        Route::post('/posts/update/{post}', 'update')->name('posts.update');
        Route::delete('/posts/destroy/{post}', 'destroy')->name('posts.destroy');

        Route::post('/posts/{post}/comments', 'commentStore')->name('posts.comments.store');
        Route::post('/posts/{post}/comments/{parent_comment_id}', 'childCommentStore')->name('posts.childComments.store');
    }
);

Route::controller(ArticleController::class)->group(
    function () {
        Route::post('/articles/store', 'store')->name('articles.store');
        Route::get('/articles/index', 'index')->name('articles.index');
        Route::get('/articles/create', 'create')->name('articles.create');
        Route::get('/articles/show/{post}', 'show');
        Route::get('/articles/update/{post}', 'update');
        Route::get('/articles/destroy/{post}', 'destroy');
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

require __DIR__.'/my.php';
require __DIR__.'/auth.php';
