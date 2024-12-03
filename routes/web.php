<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;

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
Route::get('mahasiswas', [MahasiswaController::class, 'index'])->name('mahasiswas.index');
Route::get('mahasiswas/create', [MahasiswaController::class, 'create'])->name('mahasiswas.create');
Route::post('mahasiswas', [MahasiswaController::class, 'store'])->name('mahasiswas.store');
Route::get('mahasiswas/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswas.edit');
Route::put('mahasiswas/{id}', [MahasiswaController::class, 'update'])->name('mahasiswas.update');
Route::delete('mahasiswas/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswas.destroy');
Route::get('mahasiswas/download', [MahasiswaController::class, 'downloadExcel'])->name('mahasiswas.download');


require __DIR__.'/auth.php';
