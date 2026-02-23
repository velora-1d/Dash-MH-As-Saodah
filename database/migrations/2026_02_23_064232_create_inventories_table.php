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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_code')->unique()->nullable();
            $table->string('name');
            $table->string('category')->index(); // Elektronik, Mebeul, Buku, dll.
            $table->string('location')->nullable();
            $table->integer('quantity')->default(0);
            $table->enum('condition', ['Baik', 'Rusak Ringan', 'Rusak Berat'])->default('Baik');
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->date('acquire_date')->nullable();
            $table->text('notes')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
