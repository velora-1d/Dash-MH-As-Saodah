<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('general_transactions', function (Blueprint $table) {
            $table->foreignId('wakaf_donor_id')->nullable()->after('user_id')->constrained('wakaf_donors')->nullOnDelete();
            $table->foreignId('wakaf_purpose_id')->nullable()->after('wakaf_donor_id')->constrained('wakaf_purposes')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('general_transactions', function (Blueprint $table) {
            $table->dropForeign(['wakaf_donor_id']);
            $table->dropForeign(['wakaf_purpose_id']);
            $table->dropColumn(['wakaf_donor_id', 'wakaf_purpose_id']);
        });
    }
};
