<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route_name');
            $table->text('icon_svg');
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');
            $table->json('roles'); // ['kepsek', 'admin', 'operator',dsb]
            $table->integer('order_index')->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('group_name')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
