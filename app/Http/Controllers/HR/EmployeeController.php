<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeesExport;
use App\Exports\EmployeesTemplateExport;
use App\Imports\EmployeesImport;
use Maatwebsite\Excel\Facades\Excel;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the teachers.
     */
    public function index(Request $request)
    {
        $query = Employee::where('type', 'guru');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('position', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $teachers = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('hr.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        return view('hr.teachers.create');
    }

    /**
     * Store a newly created teacher in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'      => 'nullable|string|max:255|unique:employees,nip',
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        Employee::create([
            'nip'      => $request->nip,
            'name'     => $request->name,
            'position' => $request->position,
            'status'   => $request->status,
            'type'     => 'guru',
        ]);

        return redirect()->route('hr.teachers.index')->with('success', 'Data Guru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $teacher)
    {
        // Parameter di routing mungkin mengirimkan object $teacher, namun namanya di-binding default Employee
        // Kita cukup mem-bypass ke edit atau nampilkan detail
        return view('hr.teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified teacher.
     */
    public function edit(Employee $teacher)
    {
        if ($teacher->type !== 'guru') {
            abort(404);
        }
        return view('hr.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    public function update(Request $request, Employee $teacher)
    {
        if ($teacher->type !== 'guru') {
            abort(404);
        }

        $request->validate([
            'nip'      => 'nullable|string|max:255|unique:employees,nip,' . $teacher->id,
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        $teacher->update([
            'nip'      => $request->nip,
            'name'     => $request->name,
            'position' => $request->position,
            'status'   => $request->status,
        ]);

        return redirect()->route('hr.teachers.index')->with('success', 'Data Guru berhasil diperbarui.');
    }

    /**
     * Remove the specified teacher from storage.
     */
    public function destroy(Employee $teacher)
    {
        if ($teacher->type !== 'guru') {
            abort(404);
        }

        $teacher->delete();
        return redirect()->route('hr.teachers.index')->with('success', 'Data Guru berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new EmployeesExport, 'data-guru-' . date('Y-m-d') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            Excel::import(new EmployeesImport, $request->file('file'));
            return back()->with('success', 'Data guru berhasil diimpor dari file Excel.');
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
        return Excel::download(new EmployeesTemplateExport, 'template-import-guru.xlsx');
    }
}
