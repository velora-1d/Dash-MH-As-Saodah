<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambah index pada kolom yang sering di-query dan soft deletes ke tabel utama.
     */
    public function up(): void
    {
        // Index pada students
        Schema::table('students', function (Blueprint $table) {
            $table->softDeletes();
            $table->index('classroom_id');
            $table->index('gender');
            $table->index('status');
        });

        // Index pada infaq_bills (SPP)
        Schema::table('infaq_bills', function (Blueprint $table) {
            $table->index('student_id');
            $table->index('status');
            $table->index(['student_id', 'status']);
        });

        // Index pada infaq_payments
        Schema::table('infaq_payments', function (Blueprint $table) {
            $table->index('bill_id');
            $table->index('date');
        });

        // Index pada general_transactions
        Schema::table('general_transactions', function (Blueprint $table) {
            $table->softDeletes();
            $table->index('type');
            $table->index('date');
            $table->index('category_id');
        });

        // Index pada student_savings_mutations
        Schema::table('student_savings_mutations', function (Blueprint $table) {
            $table->index('student_id');
            $table->index('type');
        });

        // Index pada ppdb_registrations
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->index('academic_year_id');
            $table->index('status');
        });

        // Index pada re_registrations
        Schema::table('re_registrations', function (Blueprint $table) {
            $table->index(['academic_year_id', 'status']);
            $table->index('student_id');
        });

        // Index pada employees
        Schema::table('employees', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Rollback migrasi.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['classroom_id']);
            $table->dropIndex(['gender']);
            $table->dropIndex(['status']);
        });

        Schema::table('infaq_bills', function (Blueprint $table) {
            $table->dropIndex(['student_id']);
            $table->dropIndex(['status']);
            $table->dropIndex(['student_id', 'status']);
        });

        Schema::table('infaq_payments', function (Blueprint $table) {
            $table->dropIndex(['bill_id']);
            $table->dropIndex(['date']);
        });

        Schema::table('general_transactions', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->dropIndex(['type']);
            $table->dropIndex(['date']);
            $table->dropIndex(['category_id']);
        });

        Schema::table('student_savings_mutations', function (Blueprint $table) {
            $table->dropIndex(['student_id']);
            $table->dropIndex(['type']);
        });

        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->dropIndex(['academic_year_id']);
            $table->dropIndex(['status']);
        });

        Schema::table('re_registrations', function (Blueprint $table) {
            $table->dropIndex(['academic_year_id', 'status']);
            $table->dropIndex(['student_id']);
        });

        Schema::table('employees', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
