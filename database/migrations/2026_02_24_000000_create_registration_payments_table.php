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
        Schema::create('registration_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('entity_id')->constrained('entities');
            $table->foreignId('unit_id')->constrained('units');
            $table->foreignId('academic_year_id')->constrained('academic_years');

            // Relasi Polimorfik (PpdbRegistration atau ReRegistration)
            $table->string('registrationable_type');
            $table->unsignedBigInteger('registrationable_id');

            // Status biaya pendaftaran
            $table->boolean('is_fee_paid')->default(false);
            $table->boolean('is_books_paid')->default(false);
            $table->boolean('is_books_received')->default(false);
            $table->boolean('is_uniform_paid')->default(false);
            $table->boolean('is_uniform_received')->default(false);

            $table->timestamps();

            $table->index(['registrationable_type', 'registrationable_id'], 'reg_payments_morph_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registration_payments');
    }
};
