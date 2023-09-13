<?php

use App\Http\Controllers\BlockController;
use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomeController::class)->name('home');


//crear cuenta
Route::get('/crear-cuenta', [RegisterController::class, 'index'] )->name('register');
Route::post('/crear-cuenta', [RegisterController::class, 'store'] );

//login
Route::get('/login', [LoginController::class, 'index'] )->name('login');
Route::post('/login', [LoginController::class, 'store'] );

//logout
Route::post('/logout',[LogoutController::class, 'store'])->name('logout');

//perfil
Route::get('/editar-perfil', [PerfilController::class, 'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class, 'store'])->name('perfil.store');

//imagenes
Route::post('/imagenes', [ImagenController::class, 'store'])->name('imagenes.store');

//crud de posts
Route::get('/posts/create', [PostController::class, 'create'] )->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/{user:username}', [PostController::class, 'index'] )->name('post.index');
Route::get('{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

//comentarios
Route::post('{user:username}/posts/{post}', [ComentarioController::class, 'store'])->name('comentarios.store');

//likes
Route::post('/post/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/post/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

//follow
Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');

//bloqueos
Route::post('/{user:username}/block', [BlockController::class, 'store'])->name('users.block');
Route::delete('/{user:username}/unblock', [BlockController::class, 'destroy'])->name('users.unblock');





