<?php

namespace App\Http\Controllers\MasterData;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    public function index()
    {
        $academicYears = AcademicYear::orderByDesc('name')->get();
        return view('master-data.academic-years.index', compact('academicYears'));
    }

    public function create()
    {
        return view('master-data.academic-years.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semester' => 'required|in:ganjil,genap',
            'is_active' => 'boolean'
        ]);

        if ($request->is_active) {
            AcademicYear::where('is_active', true)->update(['is_active' => false]);
        }

        AcademicYear::create([
            'name' => $request->name,
            'semester' => $request->semester,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()->route('academic-years.index')->with('success', 'Data Tahun Ajaran berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(AcademicYear $academicYear)
    {
        return view('master-data.academic-years.edit', compact('academicYear'));
    }

    public function update(Request $request, AcademicYear $academicYear)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'semester' => 'required|in:ganjil,genap',
            'is_active' => 'boolean'
        ]);

        if ($request->is_active) {
            AcademicYear::where('id', '!=', $academicYear->id)
                ->update(['is_active' => false]);
        }

        $academicYear->update([
            'name' => $request->name,
            'semester' => $request->semester,
            'is_active' => $request->is_active ?? false,
        ]);

        return redirect()->route('academic-years.index')->with('success', 'Data Tahun Ajaran berhasil diperbarui.');
    }

    public function destroy(AcademicYear $academicYear)
    {
        $academicYear->delete();
        return redirect()->route('academic-years.index')->with('success', 'Data Tahun Ajaran berhasil dihapus.');
    }
}
