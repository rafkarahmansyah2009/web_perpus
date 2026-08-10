<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\CatalogController;
use App\Http\Controllers\Public\AnnouncementController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Member;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/katalog', [CatalogController::class, 'index'])->name('katalog');
Route::get('/katalog/{id}', [CatalogController::class, 'show'])->name('katalog.show');
Route::get('/pengumuman', [AnnouncementController::class, 'index'])->name('pengumuman');
Route::get('/pengumuman/{slug}', [AnnouncementController::class, 'show'])->name('pengumuman.show');

// Member
Route::middleware(['auth', 'role:siswa,guru'])->prefix('member')->name('member.')->group(function () {
    Route::get('/dashboard', [Member\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/pinjaman', [Member\LoanController::class, 'index'])->name('pinjaman');
    Route::post('/pinjaman', [Member\LoanController::class, 'store'])->name('pinjaman.store');
    Route::post('/pinjaman/{id}/perpanjang', [Member\LoanController::class, 'perpanjang'])->name('pinjaman.perpanjang');
    Route::get('/profil', [Member\ProfileController::class, 'edit'])->name('profil');
    Route::put('/profil', [Member\ProfileController::class, 'update'])->name('profil.update');
});

// Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/buku', Admin\BookController::class);
    Route::post('/buku/import', [Admin\BookController::class, 'import'])->name('buku.import');
    Route::resource('/anggota', Admin\MemberController::class);
    Route::get('/peminjaman', [Admin\LoanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/{id}', [Admin\LoanController::class, 'show'])->name('peminjaman.show');
    Route::post('/peminjaman/{id}/konfirmasi', [Admin\LoanController::class, 'konfirmasi'])->name('peminjaman.konfirmasi');
    Route::post('/peminjaman/{id}/kembalikan', [Admin\LoanController::class, 'kembalikan'])->name('peminjaman.kembalikan');
    Route::get('/denda', [Admin\FineController::class, 'index'])->name('denda.index');
    Route::post('/denda/{id}/lunas', [Admin\FineController::class, 'lunas'])->name('denda.lunas');
    Route::get('/laporan', [Admin\ReportController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [Admin\ReportController::class, 'exportPdf'])->name('laporan.export-pdf');
    Route::get('/laporan/export-excel', [Admin\ReportController::class, 'exportExcel'])->name('laporan.export-excel');
});
