<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\AcademicYearController;
use App\Http\Controllers\MasterData\ClassroomController;
use App\Http\Controllers\MasterData\StudentController;
use App\Http\Controllers\MasterData\TransactionCategoryController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    // Master Data
    Route::resource('master-data/academic-years', AcademicYearController::class)->except('show');
    Route::resource('master-data/classrooms', ClassroomController::class)->except('show');
    Route::resource('master-data/students', StudentController::class);
    Route::resource('master-data/transaction-categories', TransactionCategoryController::class)->except('show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
