<?php

namespace App\Exports;

use App\Models\SppBill;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InfaqExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return SppBill::with(['student.classroom', 'academicYear'])
            ->orderByDesc('created_at');
    }

    public function headings(): array
    {
        return ['Tahun Ajaran', 'Bulan', 'Nama Siswa', 'Kelas', 'Nominal', 'Status'];
    }

    public function map($bill): array
    {
        $months = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                   7 => 'Jul', 8 => 'Agt', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'];
        return [
            $bill->academicYear->name ?? '-',
            $months[$bill->month] ?? $bill->month,
            $bill->student->name ?? '-',
            $bill->student->classroom->name ?? '-',
            $bill->nominal,
            ucfirst(str_replace('_', ' ', $bill->status)),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
