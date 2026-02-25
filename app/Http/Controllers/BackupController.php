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
        $command = "PGPASSWORD=\"{$dbPassword}\" pg_dump -h {$dbHost} -p {$dbPort} -U {$dbUsername} -d {$dbDatabase} --no-owner > \"{$filePath}\"";

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
}
