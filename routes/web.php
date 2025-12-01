<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MyRequestController;
use App\Http\Controllers\RequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Inertia\Inertia::render('Welcome');
})->name('home');

Route::get('/request-help', [RequestController::class, 'create'])->name('requests.create');
Route::post('/requests', [RequestController::class, 'store'])->name('requests.store');

Route::get('/donor/requests', [DonorController::class, 'index'])->name('donor.index');
Route::post('/donor/requests/{id}/accept', [DonorController::class, 'accept'])->name('donor.accept');
Route::post('/donor/requests/{id}/delivering', [DonorController::class, 'delivering'])->name('donor.delivering');
Route::get('/donor/requests/{id}/complete', [DonorController::class, 'complete'])->name('donor.complete');

Route::get('/my-requests', [MyRequestController::class, 'index'])->name('my-requests.index');
Route::get('/my-requests/search', [MyRequestController::class, 'search'])->name('my-requests.search');
Route::post('/my-requests/{id}/verify', [MyRequestController::class, 'verify'])->name('my-requests.verify');
Route::post('/my-requests/{id}/not-received', [MyRequestController::class, 'reportNotReceived'])->name('my-requests.not-received');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::delete('/admin/requests/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');
