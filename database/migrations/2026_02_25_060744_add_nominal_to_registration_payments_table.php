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
        Schema::table('registration_payments', function (Blueprint $table) {
            $table->decimal('fee_amount', 15, 2)->nullable()->after('is_fee_paid');
            $table->decimal('books_amount', 15, 2)->nullable()->after('is_books_received');
            $table->decimal('uniform_amount', 15, 2)->nullable()->after('is_uniform_received');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('registration_payments', function (Blueprint $table) {
            $table->dropColumn(['fee_amount', 'books_amount', 'uniform_amount']);
        });
    }
};
