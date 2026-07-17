<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController; // Tambahkan controller ini
use Illuminate\Support\Facades\Route;

// Halaman depan (Welcome) bawaan Laravel
Route::get('/', function () {
    return view('welcome');
});

// Halaman Dashboard Utama & Fitur CRUD (Hanya bisa dibuka JIKA sudah Login)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

    // KODE TAMBAHAN: Mengembalikan rute profile yang dicari oleh layout Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';