<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class BackupController extends Controller
{
    /**
     * Membuat dan mendownload backup database PostgreSQL.
     */
    public function download()
    {
        // 1. Tentukan nama file backup
        $filename = 'backup_mhas_saodah_' . date('Y_m_d_His') . '.sql';
        
        // 2. Pastikan direktori backup ada
        $backupPath = storage_path('app/backups');
        if (!file_exists($backupPath)) {
            mkdir($backupPath, 0755, true);
        }
        
        $filePath = $backupPath . '/' . $filename;

        // 3. Ambil konfigurasi database dari environment
        $dbHost     = env('DB_HOST', '127.0.0.1');
        $dbPort     = env('DB_PORT', '5432');
        $dbDatabase = env('DB_DATABASE', 'mh_assaodah');
        $dbUsername = env('DB_USERNAME', 'root');
        $dbPassword = env('DB_PASSWORD', 'password');

        // 4. Siapkan perintah pg_dump (Pastikan pg_dump terinstal di server)
        // Format: PGPASSWORD=password pg_dump -h host -p port -U username -d database > file.sql
        $command = "PGPASSWORD=\"{$dbPassword}\" pg_dump -h {$dbHost} -p {$dbPort} -U {$dbUsername} -d {$dbDatabase} --clean --if-exists --no-owner > \"{$filePath}\"";

        try {
            // 5. Eksekusi perintah menggunakan proses bash
            // Menggunakan shell_exec karena lebih mudah untuk export env variable seperti PGPASSWORD dalam satu baris terminal Linux
            $output = null;
            $resultCode = null;
            exec($command, $output, $resultCode);

            if ($resultCode !== 0) {
                Log::error("Proses pg_dump gagal. Command: {$command}");
                return back()->with('error', 'Gagal membuat file backup database (Error Code: ' . $resultCode . '). Pastikan `pg_dump` terinstall di server.');
            }

            // 6. Cek apakah file benar-benar terbuat dan tidak kosong
            if (!file_exists($filePath) || filesize($filePath) === 0) {
                return back()->with('error', 'File backup gagal dibuat atau kosong.');
            }

            // 7. Kembalikan response download dan hapus file setelahnya (bisa dimatikan hapusnya jika ingin disimpan di server)
            return Response::download($filePath)->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Backup Database Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem saat melakukan backup: ' . $e->getMessage());
        }
    }

    /**
     * Memulihkan (Restore) database dari file backup .sql yang diunggah.
     * Khusus Super Admin.
     */
    public function restore(Request $request)
    {
        $user = \Illuminate\Support\Facades\Auth::user();

        if ($user->role !== 'superadmin') {
            abort(403, 'Akses ditolak. Hanya Super Admin yang dapat melakukan tindakan ini.');
        }

        $request->validate([
            'sql_file' => 'required|file',
            'confirmation' => 'required|string',
        ]);

        if ($request->confirmation !== 'KONFIRMASI RESTORE DATA') {
            return back()->with('error', 'Konfirmasi teks tidak sesuai. Restore dibatalkan.');
        }

        $file = $request->file('sql_file');
        
        // Cek ekstensi (MIME type bervariasi bergantung OS)
        if ($file->getClientOriginalExtension() !== 'sql') {
            return back()->with('error', 'File yang diunggah harus berformat .sql (database backup).');
        }

        try {
            // Gunakan path absolut ke file sementara dari PHP upload
            $filePath = escapeshellarg($file->getRealPath());

            $dbHost     = env('DB_HOST', '127.0.0.1');
            $dbPort     = env('DB_PORT', '5432');
            $dbDatabase = escapeshellarg(env('DB_DATABASE', 'mh_assaodah'));
            $dbUsername = escapeshellarg(env('DB_USERNAME', 'root'));
            $dbPassword = env('DB_PASSWORD', 'password');

            // Eksekusi pemulihan data menggunakan CLI psql
            $command = "PGPASSWORD=\"{$dbPassword}\" psql -h {$dbHost} -p {$dbPort} -U {$dbUsername} -d {$dbDatabase} -f {$filePath}";
            
            $output = null;
            $resultCode = null;
            exec($command, $output, $resultCode);

            // Karena psql sering memunculkan warning sebagai error (misal NOTICE: table doesn't exist), 
            // kita harus memastikan eksekusinya benar-benar fail secara fatal sebelum di stop.
            // Namun return code psql biasanya tetap 0 unless syntax sangat fatal, atau ON_ERROR_STOP di set.
            if ($resultCode > 2) {
                Log::error("Proses psql restore error. Command: {$command}");
                return back()->with('error', 'Terjadi kesalahan fatal saat melakukan restore. Silakan periksa log.');
            }

            // Bersihkan Cache setelah restore untuk menyegarkan statistik Dashboard
            \Illuminate\Support\Facades\Cache::flush();
            \Illuminate\Support\Facades\Artisan::call('cache:clear');

            return redirect()->route('settings.index')->with('success', 'DATABASE BERHASIL DIRESTORE. Sistem berjalan normal dengan dataset terbaru dari file backup.');

        } catch (\Exception $e) {
            Log::error('Restore Database Error: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan sistem saat melakukan restore: ' . $e->getMessage());
        }
    }
}
