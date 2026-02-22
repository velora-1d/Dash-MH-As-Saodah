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
        Schema::create('general_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('transaction_categories');
            $table->foreignId('cash_account_id')->constrained('cash_accounts');
            $table->enum('type', ['in', 'out']);
            $table->decimal('amount', 15, 2);
            $table->date('date');
            $table->text('description')->nullable();
            $table->enum('status', ['valid', 'void'])->default('valid');
            $table->foreignId('user_id')->constrained('users'); // pencatat
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_transactions');
    }
};
