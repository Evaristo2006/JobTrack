<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ApplicationsController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\InterviewsController;
use App\Http\Controllers\Admin\GoalsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


// Página inicial pública
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Rotas autenticadas
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard/Home - ROTA PRINCIPAL
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home.index');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin - CRUD
    Route::resources([
        'users' => UsersController::class,
        'applications' => ApplicationsController::class,
        'statuses' => StatusController::class,
        'interviews' => InterviewsController::class,
        'goals' => GoalsController::class,
    ]);
});

// Autenticação
require __DIR__.'/auth.php';
