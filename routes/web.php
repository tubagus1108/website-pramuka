<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BuletinController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KirimBeritaController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PesanBuperController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/profile/{slug}', [ProfileController::class, 'show']);
Route::get('/organization', [OrganizationController::class, 'index']);
Route::get('/organization/{slug}', [OrganizationController::class, 'show']);
Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/agenda/{id}', [AgendaController::class, 'show']);
Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/{slug}', [NewsController::class, 'show']);
Route::get('/materials', [MaterialController::class, 'index']);
Route::get('/materials/{slug}', [MaterialController::class, 'show']);

// 3 Menu Baru
Route::get('/buletin', [BuletinController::class, 'index']);
Route::get('/pesan-buper', [PesanBuperController::class, 'index']);
Route::get('/kirim-berita', [KirimBeritaController::class, 'index']);
Route::post('/kirim-berita', [KirimBeritaController::class, 'store']);
