<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
       

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth']);
// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard');
// });

// Login Routes (Public)
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index')->middleware('role:admin');
    Route::get('/dashboard-siswa', function () {
        return view('dashboardSiswa.index');
    })->name('dashboard.siswa')->middleware('role:siswa');
    Route::get('/aspirasi', [App\Http\Controllers\AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [App\Http\Controllers\AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi/store', [App\Http\Controllers\AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{id}/edit', [App\Http\Controllers\AspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{id}/update', [App\Http\Controllers\AspirasiController::class, 'update'])->name('aspirasi.update');
    Route::get('/aspirasi/{id}', [App\Http\Controllers\AspirasiController::class, 'show'])->name('aspirasi.show');
    Route::get('/aspirasi/{id}/edit-status', [App\Http\Controllers\AspirasiController::class, 'editStatus'])->name('aspirasi.editStatus')->middleware('role:admin');
    Route::put('/aspirasi/{id}/update-status', [App\Http\Controllers\AspirasiController::class, 'updateStatus'])->name('aspirasi.updateStatus')->middleware('role:admin');
    // Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
    // Admin - User Management
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    });

    Route::get('/aktivitas', [App\Http\Controllers\AktivitasController::class, 'index'])->name('aktivitas.index');
    Route::get('/dashboard-siswa', [App\Http\Controllers\SiswaController::class, 'index'])->name('dashboard.siswa');
    Route::post('/siswa/import', [App\Http\Controllers\SiswaController::class, 'import'])->name('siswa.import');
    Route::get('/archive', [App\Http\Controllers\AspirasiController::class, 'archive'])->name('archive.index');
    Route::post('/archive/{id}/aspirasi', [App\Http\Controllers\AspirasiController::class, 'archiveAspirasi'])->name('archive.aspirasi');
    Route::delete('/unarchive/{id}/aspirasi', [App\Http\Controllers\AspirasiController::class, 'unarchiveAspirasi'])->name('unarchive.aspirasi');
});

