<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Classroom;
use App\Exports\StudentsExport;
use App\Exports\StudentsTemplateExport;
use App\Imports\StudentsImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        // Mengecualikan Pendaftar PPDB (calon_siswa)
        $query = Student::with('classroom')->where('status', '!=', 'calon_siswa');
        
        if ($request->has('search') && $request->search != '') {
            $search = strtolower($request->search);
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nisn) LIKE ?', ["%{$search}%"])
                  ->orWhereRaw('LOWER(nis) LIKE ?', ["%{$search}%"]);
            });
        }
        
        if ($request->has('classroom_id') && $request->classroom_id != '') {
            $query->where('classroom_id', $request->classroom_id);
        }
        
        $students = $query->orderBy('name')->paginate(15)->withQueryString();
        $classrooms = Classroom::orderBy('level')->get();
        
        return view('master-data.students.index', compact('students', 'classrooms'));
    }

    public function create()
    {
        $classrooms = Classroom::orderBy('level')->get();
        return view('master-data.students.create', compact('classrooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nisn' => 'nullable|string|unique:students,nisn|max:20',
            'nis' => 'nullable|string|unique:students,nis|max:20',
            'nik' => 'nullable|string|unique:students,nik|max:20',
            'no_kk' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'category' => 'required|in:reguler,yatim,kurang_mampu',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:aktif,lulus,pindah,nonaktif',
            'infaq_status' => 'required|in:bayar,gratis,subsidi',
            'infaq_nominal' => 'nullable|numeric|min:0',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',

            // Dapodik Fields
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'family_status' => 'nullable|string|max:50',
            'sibling_count' => 'nullable|integer|min:0',
            'child_position' => 'nullable|integer|min:1',
            'religion' => 'nullable|string|max:50',
            'village' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'residence_type' => 'nullable|in:Orang tua,Kerabat,Kos,Lainnya',
            'transportation' => 'nullable|in:Jalan kaki,Motor,Jemputan Sekolah,Kendaraan Umum,Lainnya',
            'student_phone' => 'nullable|string|max:20',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
            'distance_to_school' => 'nullable|string|max:50',
            'travel_time' => 'nullable|integer|min:0',
            'father_name' => 'nullable|string|max:255',
            'father_birth_place' => 'nullable|string|max:255',
            'father_birth_date' => 'nullable|date',
            'father_nik' => 'nullable|string|max:20',
            'father_education' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:255',
            'mother_birth_place' => 'nullable|string|max:255',
            'mother_birth_date' => 'nullable|date',
            'mother_nik' => 'nullable|string|max:20',
            'mother_education' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'parent_income' => 'nullable|string|max:50',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_birth_place' => 'nullable|string|max:255',
            'guardian_birth_date' => 'nullable|date',
            'guardian_nik' => 'nullable|string|max:20',
            'guardian_education' => 'nullable|string|max:100',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_address' => 'nullable|string|max:500',
            'guardian_phone' => 'nullable|string|max:20',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Data Master Siswa berhasil ditambahkan.');
    }

    public function show(Student $student)
    {
        return view('master-data.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $classrooms = Classroom::orderBy('level')->get();
        return view('master-data.students.edit', compact('student', 'classrooms'));
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'nisn' => 'nullable|string|max:20|unique:students,nisn,' . $student->id,
            'nis' => 'nullable|string|max:20|unique:students,nis,' . $student->id,
            'nik' => 'nullable|string|max:20|unique:students,nik,' . $student->id,
            'no_kk' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'category' => 'required|in:reguler,yatim,kurang_mampu',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:aktif,lulus,pindah,nonaktif',
            'infaq_status' => 'required|in:bayar,gratis,subsidi',
            'infaq_nominal' => 'nullable|numeric|min:0',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',

            // Dapodik Fields
            'birth_place' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
            'family_status' => 'nullable|string|max:50',
            'sibling_count' => 'nullable|integer|min:0',
            'child_position' => 'nullable|integer|min:1',
            'religion' => 'nullable|string|max:50',
            'village' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'residence_type' => 'nullable|in:Orang tua,Kerabat,Kos,Lainnya',
            'transportation' => 'nullable|in:Jalan kaki,Motor,Jemputan Sekolah,Kendaraan Umum,Lainnya',
            'student_phone' => 'nullable|string|max:20',
            'height' => 'nullable|integer|min:0',
            'weight' => 'nullable|integer|min:0',
            'distance_to_school' => 'nullable|string|max:50',
            'travel_time' => 'nullable|integer|min:0',
            'father_name' => 'nullable|string|max:255',
            'father_birth_place' => 'nullable|string|max:255',
            'father_birth_date' => 'nullable|date',
            'father_nik' => 'nullable|string|max:20',
            'father_education' => 'nullable|string|max:100',
            'father_occupation' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:255',
            'mother_birth_place' => 'nullable|string|max:255',
            'mother_birth_date' => 'nullable|date',
            'mother_nik' => 'nullable|string|max:20',
            'mother_education' => 'nullable|string|max:100',
            'mother_occupation' => 'nullable|string|max:100',
            'parent_income' => 'nullable|string|max:50',
            'guardian_name' => 'nullable|string|max:255',
            'guardian_birth_place' => 'nullable|string|max:255',
            'guardian_birth_date' => 'nullable|date',
            'guardian_nik' => 'nullable|string|max:20',
            'guardian_education' => 'nullable|string|max:100',
            'guardian_occupation' => 'nullable|string|max:100',
            'guardian_address' => 'nullable|string|max:500',
            'guardian_phone' => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Data Master Siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data Siswa tersebut berhasil dihapus dari sistem.');
    }

    public function export()
    {
        return Excel::download(new StudentsExport, 'data-siswa-' . date('Y-m-d') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            Excel::import(new StudentsImport, $request->file('file'));
            return back()->with('success', 'Data siswa berhasil diimpor dari file Excel.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $errorMsg = 'Gagal impor. Periksa baris: ';
            foreach ($failures as $failure) {
                $errorMsg .= 'Baris ' . $failure->row() . ' (' . implode(', ', $failure->errors()) . '), ';
            }
            return back()->with('error', rtrim($errorMsg, ', '));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat impor: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        return Excel::download(new StudentsTemplateExport, 'template-import-siswa.xlsx');
    }
}
