<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\NewsController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/profile', [ProfileController::class, 'index']);
Route::get('/profile/{id}', [ProfileController::class, 'show']);
Route::get('/organization', [OrganizationController::class, 'index']);
Route::get('/agenda', [AgendaController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);
