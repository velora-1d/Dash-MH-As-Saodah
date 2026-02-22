<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Repositories\Contracts\StudentRepositoryInterface::class ,
            \App\Repositories\Eloquent\StudentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\ClassroomRepositoryInterface::class ,
            \App\Repositories\Eloquent\ClassroomRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\AcademicYearRepositoryInterface::class ,
            \App\Repositories\Eloquent\AcademicYearRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\CashAccountRepositoryInterface::class ,
            \App\Repositories\Eloquent\CashAccountRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\SppBillRepositoryInterface::class ,
            \App\Repositories\Eloquent\SppBillRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\SppPaymentRepositoryInterface::class ,
            \App\Repositories\Eloquent\SppPaymentRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\GeneralTransactionRepositoryInterface::class ,
            \App\Repositories\Eloquent\GeneralTransactionRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\StudentSavingRepositoryInterface::class ,
            \App\Repositories\Eloquent\StudentSavingRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\AuditLogRepositoryInterface::class ,
            \App\Repositories\Eloquent\AuditLogRepository::class
        );
        $this->app->bind(
            \App\Repositories\Contracts\TransactionCategoryRepositoryInterface::class ,
            \App\Repositories\Eloquent\TransactionCategoryRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    //
    }
}