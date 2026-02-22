<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambah kolom Data Orang Tua di tabel students
     * dan kolom Wali Kelas di tabel classrooms.
     * Ref: MH As-Saodah Brief > Master Data.md
     */
    public function up(): void
    {
        // Gap 1: Data Orang Tua/Wali & No. WhatsApp
        Schema::table('students', function (Blueprint $table) {
            $table->string('parent_name')->nullable()->after('status');
            $table->string('parent_phone')->nullable()->after('parent_name');
            $table->text('address')->nullable()->after('parent_phone');
        });

        // Gap 2: Wali Kelas
        Schema::table('classrooms', function (Blueprint $table) {
            $table->string('wali_kelas')->nullable()->after('name');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['parent_name', 'parent_phone', 'address']);
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropColumn('wali_kelas');
        });
    }
};
