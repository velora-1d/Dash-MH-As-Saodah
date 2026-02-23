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
        // === 1. Update tabel students ===
        Schema::table('students', function (Blueprint $table) {
            // A. Identitas Murid
            if (!Schema::hasColumn('students', 'birth_place')) $table->string('birth_place')->nullable()->after('gender');
            if (!Schema::hasColumn('students', 'birth_date')) $table->date('birth_date')->nullable()->after('birth_place');
            if (!Schema::hasColumn('students', 'family_status')) $table->string('family_status')->nullable();
            if (!Schema::hasColumn('students', 'sibling_count')) $table->integer('sibling_count')->nullable();
            if (!Schema::hasColumn('students', 'child_position')) $table->integer('child_position')->nullable();
            if (!Schema::hasColumn('students', 'religion')) $table->string('religion')->nullable();
            if (!Schema::hasColumn('students', 'village')) $table->string('village')->nullable();
            if (!Schema::hasColumn('students', 'district')) $table->string('district')->nullable();
            if (!Schema::hasColumn('students', 'residence_type')) $table->enum('residence_type', ['Orang tua', 'Kerabat', 'Kos', 'Lainnya'])->nullable();
            if (!Schema::hasColumn('students', 'transportation')) $table->enum('transportation', ['Jalan kaki', 'Motor', 'Jemputan Sekolah', 'Kendaraan Umum', 'Lainnya'])->nullable();
            if (!Schema::hasColumn('students', 'student_phone')) $table->string('student_phone')->nullable();

            // B. Data Periodik
            if (!Schema::hasColumn('students', 'height')) $table->integer('height')->nullable()->comment('Tinggi badan dalam cm');
            if (!Schema::hasColumn('students', 'weight')) $table->integer('weight')->nullable()->comment('Berat badan dalam kg');
            if (!Schema::hasColumn('students', 'distance_to_school')) $table->string('distance_to_school')->nullable()->comment('< 1 km, 1-3 km, 3-5 km, 5-10 km, > 10 km');
            if (!Schema::hasColumn('students', 'travel_time')) $table->integer('travel_time')->nullable()->comment('Dalam menit');

            // C. Identitas Orang Tua
            if (!Schema::hasColumn('students', 'father_name')) $table->string('father_name')->nullable();
            if (!Schema::hasColumn('students', 'father_birth_place')) $table->string('father_birth_place')->nullable();
            if (!Schema::hasColumn('students', 'father_birth_date')) $table->date('father_birth_date')->nullable();
            if (!Schema::hasColumn('students', 'father_nik')) $table->string('father_nik')->nullable();
            if (!Schema::hasColumn('students', 'father_education')) $table->string('father_education')->nullable();
            if (!Schema::hasColumn('students', 'father_occupation')) $table->string('father_occupation')->nullable();
            if (!Schema::hasColumn('students', 'mother_name')) $table->string('mother_name')->nullable();
            if (!Schema::hasColumn('students', 'mother_birth_place')) $table->string('mother_birth_place')->nullable();
            if (!Schema::hasColumn('students', 'mother_birth_date')) $table->date('mother_birth_date')->nullable();
            if (!Schema::hasColumn('students', 'mother_nik')) $table->string('mother_nik')->nullable();
            if (!Schema::hasColumn('students', 'mother_education')) $table->string('mother_education')->nullable();
            if (!Schema::hasColumn('students', 'mother_occupation')) $table->string('mother_occupation')->nullable();
            if (!Schema::hasColumn('students', 'parent_income')) $table->string('parent_income')->nullable()->comment('< 1 jt, 1-2 jt, 2-3 jt, > 3 jt');

            // D. Wali Murid
            if (!Schema::hasColumn('students', 'guardian_name')) $table->string('guardian_name')->nullable();
            if (!Schema::hasColumn('students', 'guardian_birth_place')) $table->string('guardian_birth_place')->nullable();
            if (!Schema::hasColumn('students', 'guardian_birth_date')) $table->date('guardian_birth_date')->nullable();
            if (!Schema::hasColumn('students', 'guardian_nik')) $table->string('guardian_nik')->nullable();
            if (!Schema::hasColumn('students', 'guardian_education')) $table->string('guardian_education')->nullable();
            if (!Schema::hasColumn('students', 'guardian_occupation')) $table->string('guardian_occupation')->nullable();
            if (!Schema::hasColumn('students', 'guardian_address')) $table->text('guardian_address')->nullable();
            if (!Schema::hasColumn('students', 'guardian_phone')) $table->string('guardian_phone')->nullable();

            // Kolom lampiran di student mungkin diperlukan jika belum di input di ppdb
            if (!Schema::hasColumn('students', 'attachments')) $table->json('attachments')->nullable()->comment('Daftar file lampiran: Akta, KK, KTP, Ijazah, PIP');
        });

        // === 2. Update tabel ppdb_registrations ===
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            // A. Identitas Murid
            if (!Schema::hasColumn('ppdb_registrations', 'family_status')) $table->string('family_status')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'sibling_count')) $table->integer('sibling_count')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'child_position')) $table->integer('child_position')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'religion')) $table->string('religion')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'village')) $table->string('village')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'district')) $table->string('district')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'residence_type')) $table->enum('residence_type', ['Orang tua', 'Kerabat', 'Kos', 'Lainnya'])->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'transportation')) $table->enum('transportation', ['Jalan kaki', 'Motor', 'Jemputan Sekolah', 'Kendaraan Umum', 'Lainnya'])->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'student_phone')) $table->string('student_phone')->nullable();

            // B. Data Periodik
            if (!Schema::hasColumn('ppdb_registrations', 'height')) $table->integer('height')->nullable()->comment('Tinggi badan dalam cm');
            if (!Schema::hasColumn('ppdb_registrations', 'weight')) $table->integer('weight')->nullable()->comment('Berat badan dalam kg');
            if (!Schema::hasColumn('ppdb_registrations', 'distance_to_school')) $table->string('distance_to_school')->nullable()->comment('< 1 km, 1-3 km, 3-5 km, 5-10 km, > 10 km');
            if (!Schema::hasColumn('ppdb_registrations', 'travel_time')) $table->integer('travel_time')->nullable()->comment('Dalam menit');

            // C. Identitas Orang Tua
            if (!Schema::hasColumn('ppdb_registrations', 'father_name')) $table->string('father_name')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'father_birth_place')) $table->string('father_birth_place')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'father_birth_date')) $table->date('father_birth_date')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'father_nik')) $table->string('father_nik')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'father_education')) $table->string('father_education')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'father_occupation')) $table->string('father_occupation')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'mother_name')) $table->string('mother_name')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'mother_birth_place')) $table->string('mother_birth_place')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'mother_birth_date')) $table->date('mother_birth_date')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'mother_nik')) $table->string('mother_nik')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'mother_education')) $table->string('mother_education')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'mother_occupation')) $table->string('mother_occupation')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'parent_income')) $table->string('parent_income')->nullable()->comment('< 1 jt, 1-2 jt, 2-3 jt, > 3 jt');

            // D. Wali Murid
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_name')) $table->string('guardian_name')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_birth_place')) $table->string('guardian_birth_place')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_birth_date')) $table->date('guardian_birth_date')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_nik')) $table->string('guardian_nik')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_education')) $table->string('guardian_education')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_occupation')) $table->string('guardian_occupation')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_address')) $table->text('guardian_address')->nullable();
            if (!Schema::hasColumn('ppdb_registrations', 'guardian_phone')) $table->string('guardian_phone')->nullable();

            // Lampiran Dokumen
            if (!Schema::hasColumn('ppdb_registrations', 'attachments')) $table->json('attachments')->nullable()->comment('Daftar file lampiran: Akta, KK, KTP, Ijazah, PIP');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'birth_place', 'birth_date', 'family_status', 'sibling_count', 'child_position', 'religion', 'village', 'district', 'residence_type', 'transportation', 'student_phone',
                'height', 'weight', 'distance_to_school', 'travel_time',
                'father_name', 'father_birth_place', 'father_birth_date', 'father_nik', 'father_education', 'father_occupation',
                'mother_name', 'mother_birth_place', 'mother_birth_date', 'mother_nik', 'mother_education', 'mother_occupation',
                'parent_income',
                'guardian_name', 'guardian_birth_place', 'guardian_birth_date', 'guardian_nik', 'guardian_education', 'guardian_occupation', 'guardian_address', 'guardian_phone',
                'attachments'
            ]);
        });
        
        Schema::table('ppdb_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'family_status', 'sibling_count', 'child_position', 'religion', 'village', 'district', 'residence_type', 'transportation', 'student_phone',
                'height', 'weight', 'distance_to_school', 'travel_time',
                'father_name', 'father_birth_place', 'father_birth_date', 'father_nik', 'father_education', 'father_occupation',
                'mother_name', 'mother_birth_place', 'mother_birth_date', 'mother_nik', 'mother_education', 'mother_occupation',
                'parent_income',
                'guardian_name', 'guardian_birth_place', 'guardian_birth_date', 'guardian_nik', 'guardian_education', 'guardian_occupation', 'guardian_address', 'guardian_phone',
                'attachments'
            ]);
        });
    }
};
