<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TabelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth', 'verified'])->name('dashboard');

// menu
Route::get('/menu/add', function () {
    return view('components.pop-up-add-edit-menu');
});
Route::post('/menu/add', [MenuController::class, 'add_menu'])->name('menu.add');
Route::get('/menu/update/{id_menu}', [MenuController::class, 'edit_menu'])->name('menu.edit');
Route::put('/menu/update/{id_menu}', [MenuController::class, 'update_menu'])->name('menu.update');
Route::post('/menu/delete', [MenuController::class, 'delete_menu'])->name('menu.delete');

// tabel
Route::get('/tabel', [TabelController::class,'index'])->name('tabel');
Route::get('/tabel/add', function () {
    return view('components.pop-up-add-update-tabel');
});
Route::post('/tabel/add', [TabelController::class, 'add_tabel'])->name('tabel.add');
Route::post('/tabel/delete', [TabelController::class, 'delete_tabel'])->name('tabel.delete');
Route::get('/tabel/update', [TabelController::class, 'edit_tabel'])->name('tabel.edit');
Route::put('/tabel/update', [TabelController::class, 'update_tabel'])->name('tabel.update');

// update profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
