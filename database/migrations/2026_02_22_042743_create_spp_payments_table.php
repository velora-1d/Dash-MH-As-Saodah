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
        Schema::create('spp_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spp_bill_id')->constrained('spp_bills')->onDelete('restrict');
            $table->foreignId('cash_account_id')->constrained('cash_accounts')->onDelete('restrict');
            $table->foreignId('user_id')->constrained('users')->onDelete('restrict');
            $table->decimal('amount', 15, 2)->default(0);
            $table->date('payment_date');
            $table->string('status')->default('active'); // active, void
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spp_payments');
    }
};