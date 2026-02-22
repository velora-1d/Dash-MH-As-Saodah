<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        $classrooms = Classroom::orderBy('level')->get();
        return view('master-data.classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        return view('master-data.classrooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name',
            'level' => 'required|integer|min:1|max:6',
            'wali_kelas' => 'nullable|string|max:255',
        ]);

        Classroom::create([
            'name' => $request->name,
            'level' => $request->level,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('classrooms.index')->with('success', 'Data Kelas berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Classroom $classroom)
    {
        return view('master-data.classrooms.edit', compact('classroom'));
    }

    public function update(Request $request, Classroom $classroom)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:classrooms,name,' . $classroom->id,
            'level' => 'required|integer|min:1|max:6',
            'wali_kelas' => 'nullable|string|max:255',
        ]);

        $classroom->update([
            'name' => $request->name,
            'level' => $request->level,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('classrooms.index')->with('success', 'Data Kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom)
    {
        if ($classroom->students()->count() > 0) {
             return redirect()->route('classrooms.index')->with('error', 'Tidak dapat menghapus kelas, masih ada siswa terdaftar.');
        }

        $classroom->delete();
        return redirect()->route('classrooms.index')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
