<?php

use Illuminate\Http\Request;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [CrudController::class, 'index'])->middleware(['verified'])->name('dashboard');
    Route::post('/enviar-form', [CrudController::class, 'store'])->middleware(['verified']);
    Route::get('/dashboard/editar/{id}', [CrudController::class, 'edit'])->name('editar');
    Route::get('/dashboard/atualizar/{id}', [CrudController::class, 'update'])->name('atualizar');
    Route::delete('/dashboard/excluir/{id}', [CrudController::class, 'destroy'])->name('excluir');
    Route::get('/dashboard', [CrudController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('dashboard');

    Route::post('/enviar-form', [CrudController::class, 'store']);

    Route::post('/dashboard/atualizar/{id}', [CrudController::class, 'update'])
        ->name('atualizar');

    Route::delete('/dashboard/excluir/{id}', [CrudController::class, 'destroy'])
        ->name('excluir');

    Route::get('/dashboard/usuarios-json', [CrudController::class, 'getUsersJson']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
