<?php

namespace App\Http\Controllers\HR;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\SalaryComponent;
use App\Models\EmployeeSalary;
use App\Models\Payroll;
use App\Models\PayrollDetail;
use App\Models\AcademicYear;

class PayrollController extends Controller
{
    /**
     * Tampilkan riwayat pembuatan slip gaji (payrolls).
     */
    public function index(Request $request)
    {
        $query = Payroll::with(['employee', 'academicYear']);
        
        if ($request->filled('month')) {
            $query->where('month', $request->month);
        }
        
        if ($request->filled('academic_year_id')) {
            $query->where('academic_year_id', $request->academic_year_id);
        }

        $payrolls = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        $academicYears = AcademicYear::orderBy('name', 'desc')->get();

        return view('hr.payroll.index', compact('payrolls', 'academicYears'));
    }

    /**
     * Manajemen Komponen Gaji (Master Data Pendapatan & Potongan).
     */
    public function components()
    {
        $components = SalaryComponent::orderBy('type')->orderBy('name')->get();
        return view('hr.payroll.components', compact('components'));
    }

    public function storeComponent(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:earning,deduction',
        ]);

        SalaryComponent::create($request->all());
        return redirect()->route('hr.payroll.components')->with('success', 'Komponen gaji baru ditambahkan.');
    }

    public function destroyComponent($id)
    {
        $component = SalaryComponent::findOrFail($id);
        $component->delete();
        return redirect()->route('hr.payroll.components')->with('success', 'Komponen dihapus.');
    }

    /**
     * Pengaturan Nominal Gaji Baku Karyawan.
     */
    public function employeeSalaries(Request $request)
    {
        $query = Employee::with('salaryComponents')->where('status', 'aktif');
        if ($request->filled('search')) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        $employees = $query->paginate(10)->withQueryString();
        $components = SalaryComponent::orderBy('type')->orderBy('name')->get();

        return view('hr.payroll.employee_salaries', compact('employees', 'components'));
    }

    public function updateEmployeeSalary(Request $request, $employeeId)
    {
        $request->validate([
            'components' => 'required|array',
            'components.*' => 'numeric|min:0',
        ]);

        $employee = Employee::findOrFail($employeeId);
        
        foreach ($request->components as $componentId => $nominal) {
            if ($nominal > 0) {
                EmployeeSalary::updateOrCreate(
                    ['employee_id' => $employee->id, 'salary_component_id' => $componentId],
                    ['nominal' => $nominal]
                );
            } else {
                EmployeeSalary::where('employee_id', $employee->id)
                    ->where('salary_component_id', $componentId)
                    ->delete();
            }
        }

        return redirect()->route('hr.payroll.employee_salaries')->with('success', 'Pengaturan gaji untuk ' . $employee->name . ' diperbarui.');
    }

    /**
     * Generate Slip Gaji Bulanan Masal/Spesifik.
     */
    public function generate(Request $request)
    {
        $request->validate([
            'academic_year_id' => 'required|exists:academic_years,id',
            'month' => 'required|integer|min:1|max:12',
            'employee_id' => 'nullable|exists:employees,id', // Kosong berarti semua guru/staf aktif
        ]);

        $query = Employee::with(['salaryComponents.salaryComponent'])->where('status', 'aktif');
        if ($request->filled('employee_id')) {
            $query->where('id', $request->employee_id);
        }

        $employees = $query->get();
        $generatedCount = 0;
        $skippedCount = 0;

        foreach ($employees as $employee) {
            // Validasi: jangan generate slip jika tidak ada komponen gaji yang diisi
            $activeSalaryComponents = $employee->salaryComponents->filter(fn($s) => $s->nominal > 0);
            if ($activeSalaryComponents->isEmpty()) {
                $skippedCount++;
                continue; // Lewati pegawai tanpa pengaturan gaji
            }

            // Cek apakah slip bulan/tahun tersebut sudah terbuat. Jika draft bisa ditimpa, jika paid abaikan.
            $existingPayroll = Payroll::where('employee_id', $employee->id)
                ->where('academic_year_id', $request->academic_year_id)
                ->where('month', $request->month)
                ->first();

            if ($existingPayroll && $existingPayroll->status !== 'draft') {
                continue; // Sudah paid atau void, lompati.
            }

            if ($existingPayroll) {
                $existingPayroll->details()->delete(); // Hapus riwayat detail lama
                $payroll = $existingPayroll;
            } else {
                $payroll = new Payroll();
            }

            $totalEarning = 0;
            $totalDeduction = 0;

            $payroll->employee_id = $employee->id;
            $payroll->academic_year_id = $request->academic_year_id;
            $payroll->month = $request->month;
            $payroll->status = 'draft';
            $payroll->save();

            foreach ($activeSalaryComponents as $empSal) {
                $payroll->details()->create([
                    'component_name' => $empSal->salaryComponent->name,
                    'type' => $empSal->salaryComponent->type,
                    'nominal' => $empSal->nominal,
                ]);

                if ($empSal->salaryComponent->type === 'earning') {
                    $totalEarning += $empSal->nominal;
                } else {
                    $totalDeduction += $empSal->nominal;
                }
            }

            $payroll->total_earnings = $totalEarning;
            $payroll->total_deductions = $totalDeduction;
            $payroll->net_salary = $totalEarning - $totalDeduction;
            $payroll->save();
            $generatedCount++;
        }

        $message = "Proses Generate Gaji Bulanan Selesai ($generatedCount Diterbitkan).";
        if ($skippedCount > 0) {
            $message .= " $skippedCount pegawai dilewati karena belum ada pengaturan gaji.";
        }

        return redirect()->route('hr.payroll.index')->with('success', $message);
    }

    /**
     * Tampilkan form Edit Nominal Gaji Manual (Khusus Draft)
     */
    public function edit($id)
    {
        $payroll = Payroll::with(['employee', 'academicYear', 'details'])->findOrFail($id);
        
        if ($payroll->status !== 'draft') {
            return redirect()->route('hr.payroll.index')->with('error', 'Hanya slip gaji berstatus draft yang dapat diedit nominalnya.');
        }

        // Ambil master komponen untuk form tambah manual jika ada
        $components = SalaryComponent::orderBy('type')->orderBy('name')->get();

        return view('hr.payroll.edit', compact('payroll', 'components'));
    }

    /**
     * Hitung ulang dan simpan perubahan Nominal Detail Slip Gaji
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'components' => 'array',
            'components.*' => 'numeric|min:0',
        ]);

        $payroll = Payroll::with('details')->findOrFail($id);

        if ($payroll->status !== 'draft') {
            return redirect()->route('hr.payroll.index')->with('error', 'Hanya slip gaji berstatus draft yang dapat disimpan perubahannya.');
        }

        $totalEarning = 0;
        $totalDeduction = 0;

        // Loop inputan dari user dan sesuaikan nominal PayrollDetail
        if ($request->has('components')) {
            foreach ($request->components as $detailId => $nominal) {
                if ($nominal >= 0) {
                    $detail = PayrollDetail::where('payroll_id', $payroll->id)->where('id', $detailId)->first();
                    if ($detail) {
                        $detail->nominal = $nominal;
                        $detail->save();

                        if ($detail->type === 'earning') {
                            $totalEarning += $nominal;
                        } else {
                            $totalDeduction += $nominal;
                        }
                    }
                }
            }
        }

        // Update total kalkulasi di tabel induk
        $payroll->total_earnings = $totalEarning;
        $payroll->total_deductions = $totalDeduction;
        $payroll->net_salary = $totalEarning - $totalDeduction;
        // Simpan field deskripsi/catatan misal ada
        if ($request->has('description')) {
            $payroll->description = $request->description;
        }
        $payroll->save();

        return redirect()->route('hr.payroll.index')->with('success', 'Riwayat Gaji ' . $payroll->employee->name . ' berhasi diperbarui.');
    }

    /**
     * Hapus Riwayat Gaji (Khusus Draft)
     */
    public function destroy($id)
    {
        $payroll = Payroll::findOrFail($id);

        if ($payroll->status !== 'draft') {
            return redirect()->route('hr.payroll.index')->with('error', 'Gagal: Slip gaji yang sudah terbayar tidak boleh dihapus begitu saja.');
        }

        $payroll->details()->delete();
        $payroll->delete();

        return redirect()->route('hr.payroll.index')->with('success', 'Riwayat log gaji (' . $payroll->employee->name . ') berhasil dihapus.');
    }

    /**
     * Mode Cetak (Print View) Halaman Slip Gaji Tunggal.
     */
    public function print($id)
    {
        $payroll = Payroll::with(['employee', 'academicYear', 'details'])->findOrFail($id);
        return view('hr.payroll.print', compact('payroll'));
    }
}

