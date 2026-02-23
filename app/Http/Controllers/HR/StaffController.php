<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the staff.
     */
    public function index(Request $request)
    {
        $query = Employee::where('type', 'staf');

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

        $staffs = $query->orderBy('name')->paginate(10)->withQueryString();

        return view('hr.staff.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new staff.
     */
    public function create()
    {
        return view('hr.staff.create');
    }

    /**
     * Store a newly created staff in storage.
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
            'type'     => 'staf',
        ]);

        return redirect()->route('hr.staff.index')->with('success', 'Data Staf berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $staff)
    {
        return view('hr.staff.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified staff.
     */
    public function edit(Employee $staff)
    {
        if ($staff->type !== 'staf') {
            abort(404);
        }
        return view('hr.staff.edit', compact('staff'));
    }

    /**
     * Update the specified staff in storage.
     */
    public function update(Request $request, Employee $staff)
    {
        if ($staff->type !== 'staf') {
            abort(404);
        }

        $request->validate([
            'nip'      => 'nullable|string|max:255|unique:employees,nip,' . $staff->id,
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'status'   => 'required|in:aktif,nonaktif',
        ]);

        $staff->update([
            'nip'      => $request->nip,
            'name'     => $request->name,
            'position' => $request->position,
            'status'   => $request->status,
        ]);

        return redirect()->route('hr.staff.index')->with('success', 'Data Staf berhasil diperbarui.');
    }

    /**
     * Remove the specified staff from storage.
     */
    public function destroy(Employee $staff)
    {
        if ($staff->type !== 'staf') {
            abort(404);
        }

        $staff->delete();
        return redirect()->route('hr.staff.index')->with('success', 'Data Staf berhasil dihapus.');
    }
}
