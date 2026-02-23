<?php

namespace App\Imports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class EmployeesImport implements ToModel, WithHeadingRow, WithValidation, SkipsEmptyRows
{
    public function model(array $row)
    {
        return new Employee([
            'nip'      => $row['nip'] ?? null,
            'name'     => $row['nama_lengkap'],
            'position' => $row['jabatan'],
            'type'     => $row['tipe_gurustaff'] ?? 'guru',
            'status'   => $row['status_aktifnonaktif'] ?? 'aktif',
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required|string|max:255',
            'jabatan'      => 'required|string|max:255',
        ];
    }
}
