<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MyRequestController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\MissingPersonController;
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

Route::get('/missing-people', [MissingPersonController::class, 'index'])->name('missing-people.index');
Route::get('/missing-people/create', [MissingPersonController::class, 'create'])->name('missing-people.create');
Route::post('/missing-people', [MissingPersonController::class, 'store'])->name('missing-people.store');
Route::post('/missing-people/{id}/found', [MissingPersonController::class, 'markFound'])->name('missing-people.found');

Route::get('/my-requests', [MyRequestController::class, 'index'])->name('my-requests.index');
Route::get('/my-requests/search', [MyRequestController::class, 'search'])->name('my-requests.search');
Route::post('/my-requests/{id}/verify', [MyRequestController::class, 'verify'])->name('my-requests.verify');
Route::post('/my-requests/{id}/not-received', [MyRequestController::class, 'reportNotReceived'])->name('my-requests.not-received');

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminProfileController;

Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::put('/admin/requests/{id}', [AdminController::class, 'updateRequest'])->name('admin.requests.update');
    Route::delete('/admin/requests/{id}', [AdminController::class, 'destroyRequest'])->name('admin.requests.destroy');
    Route::put('/admin/missing-people/{id}', [AdminController::class, 'updateMissingPerson'])->name('admin.missing.update');
    Route::delete('/admin/missing-people/{id}', [AdminController::class, 'destroyMissingPerson'])->name('admin.missing.destroy');

    Route::get('/admin/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::patch('/admin/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');

    Route::resource('/admin/users', \App\Http\Controllers\AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

Route::get('/lang/{locale}', [LanguageController::class, 'switch'])->name('lang.switch');
