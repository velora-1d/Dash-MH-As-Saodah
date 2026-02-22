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
            $table->decimal('infaq_nominal', 15, 2)->default(0)->after('name');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->enum('infaq_status', ['bayar', 'gratis', 'subsidi'])->default('bayar')->after('status');
            $table->decimal('infaq_nominal', 15, 2)->nullable()->after('infaq_status');
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
