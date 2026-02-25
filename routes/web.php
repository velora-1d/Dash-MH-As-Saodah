<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Wakaf\WakafController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterData\AcademicYearController;
use App\Http\Controllers\MasterData\ClassroomController;
use App\Http\Controllers\MasterData\StudentController;
use App\Http\Controllers\MasterData\TransactionCategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HR\EmployeeController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {

    // =============================================
    // PENERIMAAN SISWA (Kepsek, Admin, Operator)
    // =============================================

    // PPDB (Penerimaan Peserta Didik Baru)
    Route::group(['prefix' => 'ppdb', 'as' => 'ppdb.'], function () {
        Route::get('/', [\App\Http\Controllers\Ppdb\PpdbController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Ppdb\PpdbController::class, 'create'])->name('create');
        Route::post('/', [\App\Http\Controllers\Ppdb\PpdbController::class, 'store'])->name('store');
        Route::get('/export', [\App\Http\Controllers\Ppdb\PpdbController::class, 'export'])->name('export');
        Route::get('/{ppdb}', [\App\Http\Controllers\Ppdb\PpdbController::class, 'show'])->name('show');

        // Approve/Reject/Convert hanya untuk kepsek & admin
        Route::middleware('role:kepsek,admin')->group(function () {
            Route::post('/{ppdb}/approve', [\App\Http\Controllers\Ppdb\PpdbController::class, 'approve'])->name('approve');
            Route::post('/{ppdb}/reject', [\App\Http\Controllers\Ppdb\PpdbController::class, 'reject'])->name('reject');
            Route::post('/{ppdb}/reset', [\App\Http\Controllers\Ppdb\PpdbController::class, 'reset'])->name('reset');
            Route::post('/{ppdb}/convert', [\App\Http\Controllers\Ppdb\PpdbController::class, 'convertToStudent'])->name('convert');
        });
    });

    // Daftar Ulang Siswa
    Route::group(['prefix' => 're-registration', 'as' => 're-registration.'], function () {
        Route::get('/', [\App\Http\Controllers\ReRegistration\ReRegistrationController::class, 'index'])->name('index');
        Route::post('/generate', [\App\Http\Controllers\ReRegistration\ReRegistrationController::class, 'generate'])->name('generate');
        Route::post('/{reRegistration}/confirm', [\App\Http\Controllers\ReRegistration\ReRegistrationController::class, 'confirm'])->name('confirm');
        Route::post('/{reRegistration}/not-registered', [\App\Http\Controllers\ReRegistration\ReRegistrationController::class, 'markNotRegistered'])->name('not-registered');
    });

    // Quick Payment Toggle (PPDB & Daftar Ulang — tracking biaya, buku, seragam)
    Route::post('/quick-payment/{registrationPayment}/toggle', [\App\Http\Controllers\QuickPaymentController::class, 'toggle'])->name('quick-payment.toggle');

    // =============================================
    // MASTER DATA (Kepsek, Admin, Operator)
    // =============================================
    Route::resource('master-data/academic-years', AcademicYearController::class)->except('show');
    Route::resource('master-data/classrooms', ClassroomController::class)->except('show');
    // Export/Import/Template Siswa (HARUS sebelum resource agar tidak terganggu wildcard)
    Route::get('master-data/students/export', [\App\Http\Controllers\MasterData\StudentController::class, 'export'])->name('students.export');
    Route::get('master-data/students/template', [\App\Http\Controllers\MasterData\StudentController::class, 'downloadTemplate'])->name('students.template');
    Route::post('master-data/students/import', [\App\Http\Controllers\MasterData\StudentController::class, 'import'])->name('students.import');
    Route::resource('master-data/students', StudentController::class);
    Route::resource('master-data/transaction-categories', TransactionCategoryController::class)->except('show');

    // Mutasi & Kenaikan Kelas
    Route::get('master-data/mutations', [\App\Http\Controllers\MasterData\MutationController::class, 'index'])->name('mutations.index');
    Route::post('master-data/mutations/execute', [\App\Http\Controllers\MasterData\MutationController::class, 'execute'])->name('mutations.execute');

    // =============================================
    // KEUANGAN & TAGIHAN (Kepsek, Bendahara, Admin)
    // =============================================
    Route::middleware('role:kepsek,bendahara,admin,operator')->group(function () {
        // Infaq / SPP
        Route::get('infaq/bills', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'index'])->name('infaq.bills.index');
        Route::get('infaq/bills/generate', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'createGenerate'])->name('infaq.bills.generate.create');
        Route::post('infaq/bills/generate', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'storeGenerate'])->name('infaq.bills.generate.store');
        Route::post('infaq/bills/{sppBill}/void', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'void'])->name('infaq.bills.void');
        Route::post('infaq/bills/{sppBill}/revert', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'revert'])->name('infaq.bills.revert');
        Route::get('infaq/payments/{bill}/create', [\App\Http\Controllers\Infaq\InfaqPaymentController::class, 'create'])->name('infaq.payments.create');
        Route::post('infaq/payments/{bill}', [\App\Http\Controllers\Infaq\InfaqPaymentController::class, 'store'])->name('infaq.payments.store');
        Route::get('infaq/bills/export', [\App\Http\Controllers\Infaq\InfaqBillController::class, 'export'])->name('infaq.bills.export');

        // Quick Payment Toggle (AJAX) untuk administrasi pendaftaran
        Route::post('quick-payment/{registrationPayment}/toggle', [\App\Http\Controllers\QuickPaymentController::class, 'toggle'])->name('quick-payment.toggle');

        // Tabungan Siswa
        Route::get('tabungan', [\App\Http\Controllers\Tabungan\TabunganController::class, 'index'])->name('tabungan.index');
        Route::get('tabungan/{student}', [\App\Http\Controllers\Tabungan\TabunganController::class, 'show'])->name('tabungan.show');
        Route::get('tabungan/{student}/create', [\App\Http\Controllers\Tabungan\TabunganController::class, 'create'])->name('tabungan.create');
        Route::post('tabungan/{student}', [\App\Http\Controllers\Tabungan\TabunganController::class, 'store'])->name('tabungan.store');
        Route::post('tabungan/mutation/{mutation}/void', [\App\Http\Controllers\Tabungan\TabunganController::class, 'void'])->name('tabungan.void');

        // Modul Wakaf & Donasi
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

        // Modul Kas & Jurnal Umum
        Route::group(['prefix' => 'journal', 'as' => 'journal.'], function () {
            Route::get('/', [\App\Http\Controllers\Journal\CashJournalController::class, 'index'])->name('index');
            Route::get('/create', [\App\Http\Controllers\Journal\CashJournalController::class, 'create'])->name('create');
            Route::post('/', [\App\Http\Controllers\Journal\CashJournalController::class, 'store'])->name('store');
            Route::get('/categories', [\App\Http\Controllers\Journal\CashJournalController::class, 'categories'])->name('categories');
            Route::post('/categories', [\App\Http\Controllers\Journal\CashJournalController::class, 'storeCategory'])->name('categories.store');
            Route::delete('/categories/{category}', [\App\Http\Controllers\Journal\CashJournalController::class, 'destroyCategory'])->name('categories.destroy');
            Route::post('/{transaction}/void', [\App\Http\Controllers\Journal\CashJournalController::class, 'void'])->name('void');
            Route::get('/export', [\App\Http\Controllers\Journal\CashJournalController::class, 'export'])->name('export');
        });
    });

    // =============================================
    // KEPEGAWAIAN (Kepsek, Admin)
    // =============================================
    Route::middleware('role:kepsek,admin')->group(function () {
        Route::resource('hr/teachers', EmployeeController::class)->names('hr.teachers')->parameters([
            'teachers' => 'teacher'
        ]);
        Route::resource('hr/staff', \App\Http\Controllers\HR\StaffController::class)->names('hr.staff')->parameters([
            'staff' => 'staff'
        ]);

        // Export/Import/Template Guru
        Route::get('hr/teachers/export', [EmployeeController::class, 'export'])->name('hr.teachers.export');
        Route::get('hr/teachers/template', [EmployeeController::class, 'downloadTemplate'])->name('hr.teachers.template');
        Route::post('hr/teachers/import', [EmployeeController::class, 'import'])->name('hr.teachers.import');

        Route::group(['prefix' => 'hr/payroll', 'as' => 'hr.payroll.'], function () {
            Route::get('/', [\App\Http\Controllers\HR\PayrollController::class, 'index'])->name('index');
            Route::post('/generate', [\App\Http\Controllers\HR\PayrollController::class, 'generate'])->name('generate');
            Route::get('/{payroll}/print', [\App\Http\Controllers\HR\PayrollController::class, 'print'])->name('print');

            Route::get('/components', [\App\Http\Controllers\HR\PayrollController::class, 'components'])->name('components');
            Route::post('/components', [\App\Http\Controllers\HR\PayrollController::class, 'storeComponent'])->name('components.store');
            Route::delete('/components/{component}', [\App\Http\Controllers\HR\PayrollController::class, 'destroyComponent'])->name('components.destroy');

            Route::get('/employee-salaries', [\App\Http\Controllers\HR\PayrollController::class, 'employeeSalaries'])->name('employee_salaries');
            Route::post('/employee-salaries/{employee}', [\App\Http\Controllers\HR\PayrollController::class, 'updateEmployeeSalary'])->name('employee_salaries.update');
        });
    });

    // =============================================
    // LAPORAN (Kepsek, Bendahara)
    // =============================================
    Route::middleware('role:kepsek,bendahara')->group(function () {
        Route::group(['prefix' => 'reports', 'as' => 'reports.'], function () {
            Route::get('/', [\App\Http\Controllers\Report\ReportController::class, 'index'])->name('index');
            Route::get('/infaq', [\App\Http\Controllers\Report\ReportController::class, 'infaq'])->name('infaq');
            Route::get('/registration', [\App\Http\Controllers\Report\ReportController::class, 'registration'])->name('registration');
            Route::get('/savings', [\App\Http\Controllers\Report\ReportController::class, 'savings'])->name('savings');
            Route::get('/cash-flow', [\App\Http\Controllers\Report\ReportController::class, 'cashFlow'])->name('cash-flow');
        });
    });

    // =============================================
    // INVENTARIS (Kepsek, Admin, Operator)
    // =============================================
    Route::resource('inventory', \App\Http\Controllers\InventoryController::class)->except(['show']);

    // =============================================
    // CMS WEBSITE (Kepsek, Admin)
    // =============================================
    Route::middleware('role:superadmin,kepsek,admin')->prefix('cms')->name('cms.')->group(function () {
        // Pengaturan Website
        Route::get('settings', [\App\Http\Controllers\Cms\WebSettingController::class, 'index'])->name('settings.index');
        Route::put('settings', [\App\Http\Controllers\Cms\WebSettingController::class, 'update'])->name('settings.update');

        // Hero / Slider
        Route::resource('heroes', \App\Http\Controllers\Cms\WebHeroController::class)->except(['show']);

        // Fasilitas
        Route::resource('facilities', \App\Http\Controllers\Cms\WebFacilityController::class)->except(['show']);

        // Prestasi
        Route::resource('achievements', \App\Http\Controllers\Cms\WebAchievementController::class)->except(['show']);

        // Berita & Artikel
        Route::resource('posts', \App\Http\Controllers\Cms\WebPostController::class)->except(['show']);

        // Profil Guru
        Route::resource('teachers', \App\Http\Controllers\Cms\WebTeacherController::class)->except(['show']);
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Pengaturan & Profil (Sistem)
    Route::prefix('settings')->name('settings.')->controller(SettingController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/profile', 'updateProfile')->name('profile.update');

        // Manajemen User (Kepsek, Admin, Superadmin & Operator)
        Route::middleware('role:kepsek,admin,superadmin,operator')->group(function () {
            Route::get('/users/create', 'createUser')->name('users.create');
            Route::post('/users', 'storeUser')->name('users.store');
            Route::get('/users/{user}/edit', 'editUser')->name('users.edit');
            Route::put('/users/{user}', 'updateUser')->name('users.update');
            Route::post('/users/{user}/toggle', 'toggleUserStatus')->name('users.toggle');
            Route::post('/users/{user}/reset-password', 'resetPassword')->name('users.reset-password');

            // Manajemen Menu
            Route::resource('menus', \App\Http\Controllers\Setting\MenuController::class)->except(['show']);

            // Wipe Data (Khusus Super Admin)
            Route::post('/wipe-data', 'wipeAllData')->name('wipe-data');
        });
    });
});

require __DIR__.'/auth.php';
