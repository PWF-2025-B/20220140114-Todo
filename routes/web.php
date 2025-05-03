<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // ✅ Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ✅ Todo routes (menggunakan resource kecuali show)
    Route::resource('todo', TodoController::class)->except(['show']);

    // ✅ Route eksplisit untuk Edit & Update Todo
    Route::get('/todo/{id}/edit', [TodoController::class, 'edit'])->name('todo.edit');
    Route::put('/todo/{id}', [TodoController::class, 'update'])->name('todo.update');

    // ✅ Complete & Incomplete Todo
    Route::patch('/todo/{id}/complete', [TodoController::class, 'markComplete'])->name('todo.complete');
    Route::patch('/todo/{id}/incomplete', [TodoController::class, 'markIncomplete'])->name('todo.incomplete');

    // ✅ DELETE TODO
    Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');
    Route::delete('/todo/delete/completed', [TodoController::class, 'destroyCompleted'])->name('todo.destroyCompleted');

    // ✅ User Routes (khusus untuk admin)
    Route::middleware('admin')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::patch('/user/{user}/make-admin', [UserController::class, 'makeAdmin'])->name('user.makeAdmin');
        Route::patch('/user/{user}/remove-admin', [UserController::class, 'removeAdmin'])->name('user.removeAdmin');
    });
});

require __DIR__.'/auth.php';
