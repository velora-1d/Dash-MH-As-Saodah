<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('classrooms', function (Blueprint $table) {
            if (!Schema::hasColumn('classrooms', 'infaq_nominal')) {
                $table->decimal('infaq_nominal', 15, 2)->default(0)->after('name');
            }
        });

        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'infaq_status')) {
                $table->enum('infaq_status', ['bayar', 'gratis', 'subsidi'])->default('bayar')->after('status');
            }
            if (!Schema::hasColumn('students', 'infaq_nominal')) {
                $table->decimal('infaq_nominal', 15, 2)->nullable()->after('infaq_status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['infaq_status', 'infaq_nominal']);
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropColumn('infaq_nominal');
        });
    }
};
