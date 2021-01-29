<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\UserPostController;
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
// Login User
Route::get('/login',[LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'store']);

//Logout
Route::get('/', function(){
   return view('home');
})->name('home');

Route::post('/logout',[LogoutController::class,'store'])->name('logout');

// Register User
Route::get('/register',[RegisterController::class,'index'])->name('register');
Route::post('/register',[RegisterController::class,'store']);
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

//Posts
Route::get('/posts',[PostController::class,'index'])->name('posts');
Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');
Route::post('/posts',[PostController::class,'store']);
Route::delete('/posts/{post}/destroy',[PostController::class,'destroy'])->name('posts.destroy');

// Like and Unlike
Route::post('/posts/{post}/like',[PostLikeController::class,'store'])->name('posts.likes');
Route::delete('/posts/{post}/like',[PostLikeController::class,'destroy'])->name('posts.likes');

// Click on the post and show the all posts and all related post of the users
Route::get('/users/{user:username}/posts',[UserPostController::class,'index'])->name('users.posts');
