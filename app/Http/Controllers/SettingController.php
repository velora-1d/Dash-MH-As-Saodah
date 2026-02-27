<?php

namespace App\Http\Controllers;

use App\Models\SchoolSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = SchoolSetting::first() ?? new SchoolSetting();
        $users = User::latest()->paginate(10);
        return view('settings.index', compact('setting', 'users'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'headmaster_name' => 'nullable|string|max:255',
            'headmaster_nip' => 'nullable|string|max:50',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Ambil record pertama, atau buat baru jika belum ada
        $setting = SchoolSetting::first();
        if (!$setting) {
            $setting = SchoolSetting::create($request->only(['name', 'address', 'phone', 'email', 'headmaster_name', 'headmaster_nip']));
        }

        $data = $request->only(['name', 'address', 'phone', 'email', 'headmaster_name', 'headmaster_nip']);

        if ($request->hasFile('logo')) {
            // Hapus logo lama jika ada
            if ($setting->logo_path) {
                Storage::disk('public')->delete($setting->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('school', 'public');
        }

        $setting->update($data);

        return back()->with('success', 'Profil sekolah berhasil diperbarui.');
    }

    public function createUser()
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            abort(403);
        }
        return view('settings.users.create');
    }

    public function storeUser(Request $request)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:kepsek,bendahara,operator,admin',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 'aktif',
        ]);

        return redirect()->route('settings.index')->with('success', 'User baru berhasil ditambahkan.');
    }

    public function editUser(User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            abort(403);
        }
        return view('settings.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:kepsek,bendahara,operator,admin',
        ]);

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        // Mencegah perubahan role pada akun sendiri agar tidak hilang akses
        if ($user->id !== Auth::id()) {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('settings.index')->with('success', 'User berhasil diperbarui.');
    }

    public function toggleUserStatus(User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            abort(403);
        }

        if ($user->id === Auth::id()) {
            return back()->with('error', 'Anda tidak dapat menonaktifkan akun sendiri.');
        }

        $user->status = $user->status === 'aktif' ? 'nonaktif' : 'aktif';
        $user->save();

        return back()->with('success', 'Status user berhasil diubah.');
    }
    
    public function resetPassword(Request $request, User $user)
    {
        if (!in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin'])) {
            abort(403);
        }

        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Password user berhasil di-reset.');
    }

    /**
     * Hapus semua data operasional sistem (Wipe Data).
     * Khusus untuk role Super Admin.
     */
    public function wipeAllData(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->role !== 'superadmin') {
            abort(403, 'Akses ditolak. Hanya Super Admin yang dapat melakukan tindakan ini.');
        }

        $request->validate([
            'confirmation' => 'required|string',
        ]);

        if ($request->confirmation !== 'KONFIRMASI HAPUS SEMUA DATA') {
            return back()->with('error', 'Konfirmasi teks tidak sesuai. Data gagal dihapus.');
        }

        // --- SISTEM AUTO-BACKUP SEBELUM PENGHAPUSAN ---
        try {
            $filename = 'AUTO_WIPE_BACKUP_' . date('Y_m_d_His') . '.sql';
            $backupPath = storage_path('app/backups');
            if (!file_exists($backupPath)) {
                mkdir($backupPath, 0755, true);
            }
            $filePath = $backupPath . '/' . $filename;

            $dbHost     = env('DB_HOST', '127.0.0.1');
            $dbPort     = env('DB_PORT', '5432');
            $dbDatabase = env('DB_DATABASE');
            $dbUsername = env('DB_USERNAME');
            $dbPassword = env('DB_PASSWORD');

            $command = "PGPASSWORD=\"{$dbPassword}\" pg_dump -h {$dbHost} -p {$dbPort} -U {$dbUsername} -d {$dbDatabase} --clean --if-exists --no-owner > \"{$filePath}\"";
            
            $output = null;
            $resultCode = null;
            exec($command, $output, $resultCode);

            if ($resultCode !== 0 || !file_exists($filePath) || filesize($filePath) === 0) {
                 \Illuminate\Support\Facades\Log::error("Auto Backup Pre-Wipe Failed. Error Code: " . $resultCode); // Silently log, do not block wipe.
            } else {
                 \Illuminate\Support\Facades\Log::info("Auto Backup Pre-Wipe Success: " . $filePath);
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Auto Backup Pre-Wipe Exception: ' . $e->getMessage());
        }
        // --- END SISTEM AUTO-BACKUP ---

        try {
            \Illuminate\Support\Facades\DB::transaction(function () {
                $tables = [
                    'academic_years',
                    'classrooms',
                    'students',
                    'infaq_bills',
                    'infaq_payments',
                    'general_transactions',
                    'student_savings_mutations',
                    'ppdb_registrations',
                    're_registrations',
                    'employees',
                    'salary_components',
                    'employee_salaries',
                    'payrolls',
                    'payroll_details',
                    'inventories',
                    'inventory_logs',
                    'audit_logs',
                    'wakaf_donors',
                    'wakaf_purposes',
                    'registration_payments',
                    'web_heroes',
                    'web_facilities',
                    'web_achievements',
                    'web_posts',
                    'web_teachers'
                ];

                $existingTables = [];
                foreach ($tables as $table) {
                    if (\Illuminate\Support\Facades\Schema::hasTable($table)) {
                        $existingTables[] = $table;
                    }
                }

                if (!empty($existingTables)) {
                    $tableList = implode(', ', $existingTables);
                    // Gunakan TRUNCATE CASCADE karena PostgreSQL tidak memakai konsep SET FOREIGN_KEY_CHECKS=0 dari MySQL.
                    \Illuminate\Support\Facades\DB::statement("TRUNCATE TABLE {$tableList} CASCADE;");
                }
            });

            // Bersihkan Cache setelah data di-wipe
            \Illuminate\Support\Facades\Cache::flush();
            \Illuminate\Support\Facades\Artisan::call('cache:clear');

            return redirect()->route('settings.index')->with('success', 'SELURUH DATA OPERASIONAL BERHASIL DIHAPUS. Sistem sekarang bersih kembali.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
}
