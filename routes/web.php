<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

//Auth
Route::get('auth/register', [AuthController::class, 'registrationPage'])->name('registration');
Route::post('auth/register', [AuthController::class, 'register'])->name('registration');
Route::get('auth/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');
Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');

//posts
Route::get('/', [PostController::class, 'index'])->name('posts');
Route::post('/posts/store', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/{post}/update', [PostController::class, 'update'])->name('posts.update');
Route::delete('/posts/{post}/delete', [PostController::class, 'delete'])->name('posts.delete');
