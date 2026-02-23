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
        // For PostgreSQL, changing enum to string doesn't automatically drop the check constraint.
        // We need to drop it manually.
        if (config('database.default') === 'pgsql') {
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_role_check');
            DB::statement('ALTER TABLE users DROP CONSTRAINT IF EXISTS users_status_check');
        }

        Schema::table('users', function (Blueprint $table) {
            // Add phone column if not exists
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            
            // Convert role from enum to string to support more roles like 'owner'
            // and set a default role for new registrations.
            $table->string('role')->default('operator')->change();
            
            // Standardize status to English as per the seeder's expectation ('active')
            $table->string('status')->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            // Reverting role/status to enum is complex and potentially destructive, 
            // so we'll leave them as string in down() as well if needed.
        });
    }
};
