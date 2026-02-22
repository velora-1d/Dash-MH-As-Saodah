<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Classroom;

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
            'nik' => 'nullable|string|max:20',
            'no_kk' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'category' => 'required|in:reguler,yatim,kurang_mampu',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:aktif,lulus,pindah,nonaktif',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
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
            'nik' => 'nullable|string|max:20',
            'no_kk' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'gender' => 'required|in:L,P',
            'category' => 'required|in:reguler,yatim,kurang_mampu',
            'classroom_id' => 'nullable|exists:classrooms,id',
            'status' => 'required|in:aktif,lulus,pindah,nonaktif',
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $student->update($validated);

        return redirect()->route('students.index')->with('success', 'Data Master Siswa berhasil diperbarui.');
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Data Siswa tersebut berhasil dihapus dari sistem.');
    }
}
