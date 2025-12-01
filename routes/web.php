<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia\Inertia::render('Welcome');
})->name('home');

Route::get('/request-help', [RequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

Route::get('/donor/requests', [DonorController::class, 'index'])->name('donor.index');
Route::post('/donor/requests/{id}/accept', [DonorController::class, 'accept'])->name('donor.accept');
Route::get('/donor/requests/{id}/complete', [DonorController::class, 'complete'])->name('donor.complete');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::delete('/admin/requests/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');
