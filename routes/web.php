<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController; 

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('todo', TodoController::class)->except(['show']);

    Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');

    Route::patch('/todo/{id}/complete', [TodoController::class, 'markComplete'])->name('todo.complete');
    Route::patch('/todo/{id}/incomplete', [TodoController::class, 'markIncomplete'])->name('todo.incomplete');

    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::delete('/todo/delete/completed', [TodoController::class, 'destroyCompleted'])->name('todo.destroyCompleted');

    Route::resource('category', CategoryController::class)->except(['show']);

    Route::middleware('admin')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::patch('/user/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('user.makeAdmin');
        Route::patch('/user/{user}/remove-admin', [UserController::class, 'removeAdmin'])->name('user.removeAdmin');
    });
});

Route::get('/pzn', function (){
    return "Hello Programmer Zaman Now";
});

require __DIR__.'/auth.php';

