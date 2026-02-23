<?php

namespace App\Exports;

use App\Models\GeneralTransaction;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class JournalsExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function query()
    {
        return GeneralTransaction::with(['cashAccount', 'category', 'user'])
            ->whereNull('wakaf_donor_id')
            ->orderByDesc('date');
    }

    public function headings(): array
    {
        return ['Tanggal', 'Tipe', 'Kategori', 'Akun Kas', 'Jumlah', 'Keterangan', 'Status', 'Pencatat'];
    }

    public function map($tx): array
    {
        return [
            $tx->date?->format('Y-m-d'),
            $tx->type === 'in' ? 'Pemasukan' : 'Pengeluaran',
            $tx->category->name ?? '-',
            $tx->cashAccount->name ?? '-',
            $tx->amount,
            $tx->description ?? '-',
            $tx->status === 'valid' ? 'Valid' : 'Void',
            $tx->user->name ?? '-',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true]]];
    }
}
