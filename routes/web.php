<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\UserController;
use App\Exports\KeluargaExport;
use Maatwebsite\Excel\Facades\Excel;

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route for listing users
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    // Route for creating a new user
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    // Route for storing a new user
    Route::post('/admin/users', [UserController::class, 'store'])->name('admin.users.store');
    // Route for editing an existing user
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    // Route for updating an existing user
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    // Route for deleting a user
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

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
});



Route::get('/keluarga/export/{id}', function ($id) {
    return Excel::download(new KeluargaExport($id), 'keluarga_'.$id.'.xlsx');
})->name('keluarga.export');

Route::get('/keluarga', [KeluargaController::class, 'index'])->name('keluarga');
Route::get('/keluarga/create', [KeluargaController::class, 'create'])->name('keluarga.create');
Route::post('/keluarga', [KeluargaController::class, 'store'])->name('keluarga.store');
Route::get('/keluarga/{id}', [KeluargaController::class, 'show']);

// Tambahan rute untuk edit, update, dan destroy
Route::get('/keluarga/{id}/edit', [KeluargaController::class, 'edit'])->name('keluarga.edit');
Route::put('/keluarga/{id}', [KeluargaController::class, 'update'])->name('keluarga.update');
Route::delete('/keluarga/{id}', [KeluargaController::class, 'destroy'])->name('keluarga.destroy');


require __DIR__.'/auth.php';
