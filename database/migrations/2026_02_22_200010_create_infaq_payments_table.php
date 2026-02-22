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
        Schema::create('infaq_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_id')->constrained('infaq_bills');
            $table->foreignId('cash_account_id')->nullable()->constrained('cash_accounts');
            $table->enum('payment_method', ['tunai', 'transfer', 'tabungan']);
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infaq_payments');
    }
};
