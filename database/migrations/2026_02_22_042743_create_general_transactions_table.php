<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('general_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('restrict');
            $table->foreignId('category_id')->nullable()->constrained('transaction_categories')->onDelete('set null');
            $table->foreignId('cash_account_id')->constrained('cash_accounts')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->enum('type', ['income', 'expense']);
            $table->decimal('amount', 15, 2)->default(0);
            $table->date('transaction_date');
            $table->string('description')->nullable();
            $table->string('status')->default('active'); // active, void
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