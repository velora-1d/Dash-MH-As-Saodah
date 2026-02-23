<?php

namespace App\Http\Controllers\Tabungan;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\StudentSaving;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TabunganController extends Controller
{
    /**
     * Halaman utama: Daftar siswa + saldo tabungan.
     */
    public function index(Request $request)
    {
        $classrooms = Classroom::orderBy('level')->orderBy('name')->get();
        $classroomId = $request->query('classroom_id');

        $query = Student::where('status', 'aktif')
            ->with('classroom')
            ->orderBy('name');

        if ($classroomId) {
            $query->where('classroom_id', $classroomId);
        }

        $students = $query->get()->map(function ($student) {
            $student->balance = StudentSaving::getBalance($student->id);
            return $student;
        });

        return view('tabungan.index', compact('students', 'classrooms', 'classroomId'));
    }

    /**
     * Halaman detail mutasi per siswa.
     */
    public function show(Student $student)
    {
        $mutations = StudentSaving::where('student_id', $student->id)
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $balance = StudentSaving::getBalance($student->id);

        return view('tabungan.show', compact('student', 'mutations', 'balance'));
    }

    /**
     * Form setoran / penarikan.
     */
    public function create(Student $student)
    {
        $balance = StudentSaving::getBalance($student->id);
        return view('tabungan.create', compact('student', 'balance'));
    }

    /**
     * Simpan transaksi setoran / penarikan.
     */
    public function store(Request $request, Student $student)
    {
        $request->validate([
            'type' => 'required|in:in,out',
            'amount' => 'required|numeric|min:1000',
            'date' => 'required|date',
            'description' => 'nullable|string|max:500',
        ]);

        $type = $request->type;
        $amount = $request->amount;

        // Validasi saldo cukup untuk penarikan
        if ($type === 'out') {
            $balance = StudentSaving::getBalance($student->id);
            if ($amount > $balance) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Saldo tidak mencukupi! Saldo saat ini: Rp ' . number_format($balance, 0, ',', '.'));
            }
        }

        StudentSaving::create([
            'student_id' => $student->id,
            'type' => $type,
            'amount' => $amount,
            'date' => $request->date,
            'description' => $request->description,
            'status' => 'active',
            'user_id' => Auth::id(),
        ]);

        $label = $type === 'in' ? 'Setoran' : 'Penarikan';
        return redirect()->route('tabungan.show', $student->id)
            ->with('success', $label . ' sebesar Rp ' . number_format($amount, 0, ',', '.') . ' berhasil dicatat.');
    }

    /**
     * Void transaksi (batal / kesalahan entri).
     */
    public function void(StudentSaving $mutation)
    {
        if ($mutation->status === 'void') {
            return redirect()->back()->with('error', 'Transaksi ini sudah di-void sebelumnya.');
        }

        // Jika void penarikan, pastikan tidak membuat saldo negatif di masa depan
        // Jika void setoran, pastikan saldo tidak negatif setelah void
        if ($mutation->type === 'in') {
            $currentBalance = StudentSaving::getBalance($mutation->student_id);
            if ($currentBalance < $mutation->amount) {
                return redirect()->back()->with('error', 'Tidak bisa void setoran ini karena saldo sudah terpakai.');
            }
        }

        $mutation->update(['status' => 'void']);

        return redirect()->route('tabungan.show', $mutation->student_id)
            ->with('success', 'Transaksi berhasil di-void.');
    }
}
