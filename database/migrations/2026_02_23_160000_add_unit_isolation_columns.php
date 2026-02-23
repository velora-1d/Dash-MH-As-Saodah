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
        $tables = [
            'academic_years' => ['entity_id', 'unit_id'],
            'students' => ['entity_id', 'unit_id'],
            'classrooms' => ['unit_id', 'academic_year_id'],
            'general_transactions' => ['entity_id', 'unit_id'],
            'infaq_bills' => ['entity_id', 'unit_id'],
            'infaq_payments' => ['entity_id', 'unit_id'],
            'ppdb_registrations' => ['entity_id', 'unit_id'],
            're_registrations' => ['entity_id', 'unit_id'],
            'student_savings_mutations' => ['entity_id', 'unit_id'],
            'employees' => ['entity_id', 'unit_id'],
            'payrolls' => ['entity_id', 'unit_id'],
            'inventories' => ['entity_id', 'unit_id'],
            'inventory_logs' => ['entity_id', 'unit_id'],
        ];

        foreach ($tables as $tableName => $columns) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName, $columns) {
                if (in_array('entity_id', $columns) && !Schema::hasColumn($tableName, 'entity_id')) {
                    $table->foreignId('entity_id')->nullable()->after('id')->constrained('entities')->onDelete('cascade');
                }
                
                $afterColumn = Schema::hasColumn($tableName, 'entity_id') ? 'entity_id' : 'id';
                
                if (in_array('unit_id', $columns) && !Schema::hasColumn($tableName, 'unit_id')) {
                    $table->foreignId('unit_id')->nullable()->after($afterColumn)->constrained('units')->onDelete('set null');
                }

                if ($tableName === 'classrooms' && !Schema::hasColumn($tableName, 'academic_year_id')) {
                    $table->foreignId('academic_year_id')->nullable()->after('unit_id')->constrained('academic_years')->onDelete('set null');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'inventory_logs', 'inventories', 'payrolls', 'employees',
            'student_savings_mutations', 're_registrations', 'ppdb_registrations',
            'infaq_payments', 'infaq_bills', 'general_transactions', 
            'classrooms', 'students', 'academic_years'
        ];

        foreach ($tables as $tableName) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName) {
                if ($tableName === 'classrooms') {
                    if (Schema::hasColumn($tableName, 'academic_year_id')) {
                        $table->dropForeign(['academic_year_id']);
                        $table->dropColumn('academic_year_id');
                    }
                    if (Schema::hasColumn($tableName, 'unit_id')) {
                        $table->dropForeign(['unit_id']);
                        $table->dropColumn('unit_id');
                    }
                } elseif ($tableName === 'academic_years') {
                    if (Schema::hasColumn($tableName, 'unit_id')) {
                        $table->dropForeign(['unit_id']);
                        $table->dropColumn('unit_id');
                    }
                    if (Schema::hasColumn($tableName, 'entity_id')) {
                        $table->dropForeign(['entity_id']);
                        $table->dropColumn('entity_id');
                    }
                } else {
                    if (Schema::hasColumn($tableName, 'unit_id')) {
                        $table->dropForeign(['unit_id']);
                        $table->dropColumn('unit_id');
                    }
                    if (Schema::hasColumn($tableName, 'entity_id')) {
                        $table->dropForeign(['entity_id']);
                        $table->dropColumn('entity_id');
                    }
                }
            });
        }
    }
};
