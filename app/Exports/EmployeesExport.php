<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return Employee::orderBy('name');
    }

    public function headings(): array
    {
        return ['NIP', 'Nama Lengkap', 'Jabatan', 'Tipe', 'Status'];
    }

    public function map($employee): array
    {
        return [
            $employee->nip ?? '-',
            $employee->name,
            $employee->position,
            $employee->type === 'guru' ? 'Guru' : 'Staff',
            $employee->status === 'aktif' ? 'Aktif' : 'Nonaktif',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
