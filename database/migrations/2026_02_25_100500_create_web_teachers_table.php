<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('web_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('position')->nullable(); // Guru Kelas 1, Kepala Madrasah, dst
            $table->string('photo_url')->nullable();
            $table->text('bio')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('web_teachers');
    }
};
