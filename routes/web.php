<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\PostLike\PostLikeController;
use App\Http\Controllers\UserPost\UserPostController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

// Route::get('/users/{user}', [UserPostController::class, 'index'])->name('users.posts');

Route::get('/users/{user:username}/posts', [UserPostController::class, 'index'])->name('users.posts');
    // ->middleware('auth');
// the /register the actual path which I am
// going to put over browser as url
// here name->('register') defines the link which
// I am going to put over in the href attribute
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

// Route::get('/posts', function () {
//     return view('welcome');
//     return view('posts.index');
// });


// as it is the exact same URI it's going to 
// inherit this so no need to type name('posts')
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::post('/posts', [PostController::class, 'store']);
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('/', function(){
    return view('home.index');
})->name('home');


// Route::post('/posts/{id}/likes', [PostLikeController::class, 'store'])->name('posts.likes');

// we are sending the post model
Route::post('/posts/{post}/likes', [PostLikeController::class, 'store'])->name('posts.likes');

Route::delete('/posts/{post}/likes', [PostLikeController::class, 'destroy'])->name('posts.likes');