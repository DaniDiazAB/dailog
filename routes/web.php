<?php

use App\Http\Controllers\ListaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('users.profile');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::get('/posts/publish', function () {
        return view('posts.publish');
    })->name('posts.publish');
    
    Route::get('/posts/aviso', function () {
        return view('posts.aviso');
    })->name('posts.aviso');
    
    Route::post('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/users/profile/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/miperfil', [UserController::class, 'getId'])->name('users.profile');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/descubre', [PostController::class, 'descubre'])->name('descubre.index');
    Route::get('/feed', [PostController::class, 'feed'])->name('feed.index');
    Route::post('/agregar-lista/{postId}', [ListaController::class, 'agregarLista'])->name('lista.store');
    Route::post('/agregar-amigo/{userId}', [UserController::class, 'agregarAmigo'])->name('users.amistad');
    Route::get('{tipo}', [ListaController::class, 'tipo'])->name('lista.tipo');
    Route::get('/categoria/{nombreCategoria}', [PostController::class, 'conseguirCategoria'])->name('posts.categoria');
    Route::get('/dashboard/posts', [PostController::class, 'todosMisPosts'])->name('dashboard');
});
