<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\AcademicYear;
use App\Models\WebSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PpdbRegistrationController extends Controller
{
    /**
     * Handle online registration from external website (Next.js).
     * Menerima semua field Dapodik (40+ field) secara lengkap.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // === Wajib ===
            'unit_id' => 'required|exists:units,id',
            'entity_id' => 'required|exists:entities,id',
            'student_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',

            // === Data Siswa (Opsional) ===
            'birth_date' => 'nullable|date',
            'birth_place' => 'nullable|string|max:255',
            'nik' => 'nullable|string|max:20',
            'no_kk' => 'nullable|string|max:20',
            'religion' => 'nullable|string|max:50',
            'family_status' => 'nullable|string|max:50',
            'sibling_count' => 'nullable|integer|min:0',
            'child_position' => 'nullable|integer|min:1',
            'village' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'residence_type' => 'nullable|in:Orang tua,Kerabat,Kos,Lainnya',
            'transportation' => 'nullable|in:Jalan kaki,Motor,Jemputan Sekolah,Kendaraan Umum,Lainnya',
            'student_phone' => 'nullable|string|max:20',
            'previous_school' => 'nullable|string|max:255',

            // === Data Periodik ===
            'height' => 'nullable|integer|min:50|max:200',
            'weight' => 'nullable|integer|min:10|max:150',
            'distance_to_school' => 'nullable|string|max:50',
            'travel_time' => 'nullable|integer|min:0',

            // === Data Ayah ===
            'father_name' => 'nullable|string|max:255',
            'father_birth_place' => 'nullable|string|max:255',
            'father_birth_date' => 'nullable|date',
            'father_nik' => 'nullable|string|max:20',
            'father_education' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:255',

            // === Data Ibu ===
            'mother_name' => 'nullable|string|max:255',
            'mother_birth_place' => 'nullable|string|max:255',
            'mother_birth_date' => 'nullable|date',
            'mother_nik' => 'nullable|string|max:20',
            'mother_education' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:255',

            // === Penghasilan ===
            'parent_income' => 'nullable|string|max:50',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',

            // === Data Wali ===
            'guardian_name' => 'nullable|string|max:255',
            'guardian_birth_place' => 'nullable|string|max:255',
            'guardian_birth_date' => 'nullable|date',
            'guardian_nik' => 'nullable|string|max:20',
            'guardian_education' => 'nullable|string|max:100',
            'guardian_occupation' => 'nullable|string|max:255',
            'guardian_address' => 'nullable|string',
            'guardian_phone' => 'nullable|string|max:20',

            // === Lampiran ===
            'attachments' => 'nullable|array',

            // === Catatan ===
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $activeYear = AcademicYear::where('is_active', true)->first();

            if (!$activeYear) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Tahun ajaran aktif tidak ditemukan'
                ], 400);
            }

            // Cek apakah PPDB masih dibuka
            $ppdbIsOpen = WebSetting::getValue('ppdb_is_open', '0');
            if ($ppdbIsOpen !== '1') {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pendaftaran PPDB saat ini sedang ditutup'
                ], 403);
            }

            $registration = DB::transaction(function () use ($request, $activeYear) {
                $count = PpdbRegistration::withoutGlobalScopes()
                    ->where('academic_year_id', $activeYear->id)
                    ->count() + 1;

                $regNumber = 'PPDB-' . date('Y') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

                // Semua field yang diisi dari request
                $data = $request->only([
                    'entity_id', 'unit_id',
                    'student_name', 'gender', 'birth_date', 'birth_place',
                    'nik', 'no_kk', 'religion',
                    'family_status', 'sibling_count', 'child_position',
                    'village', 'district', 'address',
                    'residence_type', 'transportation', 'student_phone',
                    'previous_school',
                    'height', 'weight', 'distance_to_school', 'travel_time',
                    'father_name', 'father_birth_place', 'father_birth_date',
                    'father_nik', 'father_education', 'father_occupation',
                    'mother_name', 'mother_birth_place', 'mother_birth_date',
                    'mother_nik', 'mother_education', 'mother_occupation',
                    'parent_income', 'parent_name', 'parent_phone',
                    'guardian_name', 'guardian_birth_place', 'guardian_birth_date',
                    'guardian_nik', 'guardian_education', 'guardian_occupation',
                    'guardian_address', 'guardian_phone',
                    'attachments', 'notes',
                ]);

                $data['academic_year_id'] = $activeYear->id;
                $data['registration_number'] = $regNumber;
                $data['status'] = 'pending';
                $data['registration_source'] = 'online';
                $data['registered_at'] = now();

                return PpdbRegistration::create($data);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran online berhasil diterima',
                'data' => [
                    'registration_number' => $registration->registration_number,
                    'student_name' => $registration->student_name,
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses pendaftaran: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * POST /api/web/ppdb/upload-attachment
     * Upload file lampiran dokumen (Akta, KK, Ijazah, dll).
     */
    public function uploadAttachment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // Max 5MB
            'type' => 'required|string|in:akta,kk,ktp_ortu,ijazah,pip,foto,lainnya',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $file = $request->file('file');
            $type = $request->input('type');
            $filename = $type . '_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('ppdb-attachments', $filename, 'public');

            return response()->json([
                'status' => 'success',
                'message' => 'File berhasil diunggah',
                'data' => [
                    'type' => $type,
                    'path' => $path,
                    'url' => asset('storage/' . $path),
                    'original_name' => $file->getClientOriginalName(),
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengunggah file: ' . $e->getMessage()
            ], 500);
        }
    }
}
