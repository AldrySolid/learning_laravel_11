<?php

use App\Http\Controllers\My\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'web', 'prefix' => 'my'], function () {
    Route::controller(PostController::class)->group(
        function () {
            Route::post('/posts/store', 'store')->name('my.posts.store');
            Route::get('/posts/index', 'index')->name('my.posts.index');
            Route::get('/posts/create', 'create')->name('my.posts.create');
            Route::get('/posts/show/{post}', 'show');
            Route::get('/posts/edit/{post}', 'edit')->name('my.posts.edit');
            Route::post('/posts/update/{post}', 'update')->name('my.posts.update');
            Route::delete('/posts/destroy/{post}', 'destroy')->name('my.posts.destroy');
        }
    );
});


