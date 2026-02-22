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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique()->nullable();
            $table->string('nis')->nullable();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->enum('category', ['reguler', 'yatim', 'kurang_mampu'])->default('reguler');
            $table->foreignId('classroom_id')->nullable()->constrained('classrooms')->nullOnDelete();
            $table->enum('status', ['calon_siswa', 'aktif', 'lulus', 'pindah', 'nonaktif'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
