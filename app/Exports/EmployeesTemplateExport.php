<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EmployeesTemplateExport implements WithHeadings, ShouldAutoSize, WithStyles
{
    public function headings(): array
    {
        return [
            'NIP', 'Nama Lengkap *', 'Jabatan *', 'Tipe (guru/staff) *', 'Status (aktif/nonaktif) *',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true, 'color' => ['rgb' => '1e40af']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => 'dbeafe']]]];
    }
}
