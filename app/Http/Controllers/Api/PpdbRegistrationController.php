<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PpdbRegistrationController extends Controller
{
    /**
     * Handle online registration from external website.
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required|exists:units,id',
            'entity_id' => 'required|exists:entities,id',
            'student_name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'previous_school' => 'nullable|string|max:255',
            'address' => 'nullable|string',
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

            $registration = DB::transaction(function () use ($request, $activeYear) {
                $count = PpdbRegistration::withoutGlobalScopes()
                    ->where('academic_year_id', $activeYear->id)
                    ->count() + 1;

                $regNumber = 'PPDB-' . date('Y') . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

                return PpdbRegistration::create([
                    'entity_id' => $request->entity_id,
                    'unit_id' => $request->unit_id,
                    'academic_year_id' => $activeYear->id,
                    'registration_number' => $regNumber,
                    'student_name' => $request->student_name,
                    'gender' => $request->gender,
                    'parent_name' => $request->parent_name,
                    'parent_phone' => $request->parent_phone,
                    'previous_school' => $request->previous_school,
                    'address' => $request->address,
                    'status' => 'pending',
                    'registration_source' => 'online',
                    'registered_at' => now(),
                ]);
            });

            return response()->json([
                'status' => 'success',
                'message' => 'Pendaftaran online berhasil diterima',
                'data' => [
                    'registration_number' => $registration->registration_number
                ]
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal memproses pendaftaran: ' . $e->getMessage()
            ], 500);
        }
    }
}
