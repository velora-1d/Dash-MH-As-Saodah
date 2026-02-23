<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_savings_mutations', function (Blueprint $table) {
            $table->enum('status', ['active', 'void'])->default('active')->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('student_savings_mutations', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
