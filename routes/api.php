<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\AcademicYearController;
use App\Http\Controllers\Api\CashAccountController;
use App\Http\Controllers\Api\TransactionCategoryController;
use App\Http\Controllers\Api\GeneralTransactionController;
use App\Http\Controllers\Api\StudentSavingController;
use App\Http\Controllers\Api\SppBillController;
use App\Http\Controllers\Api\SppPaymentController;
use App\Http\Controllers\Api\DashboardController;

Route::middleware(['auth:sanctum', 'entity.context'])->name('api.')->group(function () {
    // Dashboard Agregasi - Bisa diakses pimpinan, bendahara, admin, super_admin
    Route::get('dashboard/summary', [DashboardController::class, 'summary'])->name('dashboard.summary');

    // Master Data (hanya admin & super_admin)
    Route::middleware('role:admin,super_admin')->group(function () {
        Route::apiResource('students', StudentController::class);
        Route::apiResource('classrooms', ClassroomController::class);
        Route::apiResource('academic-years', AcademicYearController::class);
        Route::apiResource('cash-accounts', CashAccountController::class);
        Route::apiResource('transaction-categories', TransactionCategoryController::class);
    });

    // Transaksi (bisa diatur oleh bendahara, super_admin)
    Route::middleware('role:bendahara,super_admin')->group(function () {
        Route::apiResource('general-transactions', GeneralTransactionController::class);
        Route::apiResource('student-savings', StudentSavingController::class);
        Route::apiResource('spp-bills', SppBillController::class);
        Route::apiResource('spp-payments', SppPaymentController::class);
    });
});

// Route Pendaftaran PPDB Online (Public)
Route::post('ppdb/register', [\App\Http\Controllers\Api\PpdbRegistrationController::class, 'register'])->name('api.ppdb.register');