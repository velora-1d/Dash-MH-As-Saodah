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

    // Mutasi & Kenaikan Kelas
    Route::get('master-data/mutations', [\App\Http\Controllers\MasterData\MutationController::class, 'index'])->name('mutations.index');
    Route::post('master-data/mutations/execute', [\App\Http\Controllers\MasterData\MutationController::class, 'execute'])->name('mutations.execute');

    // Infaq / SPP
    Route::get('infaq/bills', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'index'])->name('infaq.bills.index');
    Route::get('infaq/bills/generate', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'createGenerate'])->name('infaq.bills.generate.create');
    Route::post('infaq/bills/generate', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'storeGenerate'])->name('infaq.bills.generate.store');
    Route::post('infaq/bills/{sppBill}/void', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'void'])->name('infaq.bills.void');
    Route::post('infaq/bills/{sppBill}/revert', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'revert'])->name('infaq.bills.revert');
    Route::get('infaq/payments/{bill}/create', [\App\Http\Controllers\Infaq\InfaqPaymentController::class, 'create'])->name('infaq.payments.create');
    Route::post('infaq/payments/{bill}', [\App\Http\Controllers\Infaq\InfaqPaymentController::class, 'store'])->name('infaq.payments.store');

    // Tabungan Siswa
    Route::get('tabungan', [\App\Http\Controllers\Tabungan\TabunganController::class, 'index'])->name('tabungan.index');
    Route::get('tabungan/{student}', [\App\Http\Controllers\Tabungan\TabunganController::class, 'show'])->name('tabungan.show');
    Route::get('tabungan/{student}/create', [\App\Http\Controllers\Tabungan\TabunganController::class, 'create'])->name('tabungan.create');
    Route::post('tabungan/{student}', [\App\Http\Controllers\Tabungan\TabunganController::class, 'store'])->name('tabungan.store');
    Route::post('tabungan/mutation/{mutation}/void', [\App\Http\Controllers\Tabungan\TabunganController::class, 'void'])->name('tabungan.void');

    // Modul Wakaf & Donasi (Non-SPP, Rekening Terikat)
    Route::group(['prefix' => 'wakaf', 'as' => 'wakaf.'], function () {
        Route::get('/', [WakafController::class, 'index'])->name('index');
        Route::get('/create', [WakafController::class, 'create'])->name('create');
        Route::post('/', [WakafController::class, 'store'])->name('store');
        Route::get('/donors', [WakafController::class, 'donors'])->name('donors');
        Route::get('/purposes', [WakafController::class, 'purposes'])->name('purposes');
        Route::post('/purposes', [WakafController::class, 'storePurpose'])->name('purposes.store');
        Route::delete('/purposes/{purpose}', [WakafController::class, 'destroyPurpose'])->name('purposes.destroy');
        Route::post('/{transaction}/void', [WakafController::class, 'void'])->name('void');
    });

    // Modul Kas & Jurnal Umum (Pemasukan BOS/Bantuan & Pengeluaran Operasional)
    Route::group(['prefix' => 'journal', 'as' => 'journal.'], function () {
        Route::get('/', [\App\Http\Controllers\Journal\CashJournalController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Journal\CashJournalController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Journal\CashJournalController::class, 'store'])->name('store');
        Route::get('/categories', [\App\Http\Controllers\Journal\CashJournalController::class, 'categories'])->name('categories');
        Route::post('/categories', [\App\Http\Controllers\Journal\CashJournalController::class, 'storeCategory'])->name('categories.store');
        Route::delete('/categories/{category}', [\App\Http\Controllers\Journal\CashJournalController::class, 'destroyCategory'])->name('categories.destroy');
        Route::post('/{transaction}/void', [\App\Http\Controllers\Journal\CashJournalController::class, 'void'])->name('void');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
