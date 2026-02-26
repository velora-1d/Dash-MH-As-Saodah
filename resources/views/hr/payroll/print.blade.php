<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Slip Gaji - {{ $payroll->employee->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            color: #1e293b;
            margin: 0;
            padding: 2rem;
            background: #f8fafc;
        }
        .slip-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 2.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .header h1 {
            margin: 0 0 0.5rem 0;
            color: #0f172a;
            font-size: 1.5rem;
        }
        .header p {
            margin: 0;
            color: #64748b;
            font-size: 0.875rem;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            margin-bottom: 2rem;
            font-size: 0.875rem;
        }
        .info-item strong {
            display: inline-block;
            width: 120px;
            color: #475569;
        }
        .payroll-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        .detail-section h3 {
            font-size: 1rem;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 0.5rem;
            margin-bottom: 1rem;
        }
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }
        .item-name {
            color: #475569;
        }
        .item-value.plus {
            color: #10b981;
            font-weight: 500;
        }
        .item-value.minus {
            color: #ef4444;
            font-weight: 500;
        }
        .total-row {
            display: flex;
            justify-content: space-between;
            padding-top: 0.75rem;
            margin-top: 0.75rem;
            border-top: 1px dashed #cbd5e1;
            font-weight: 700;
            font-size: 0.9375rem;
        }
        .net-salary {
            margin-top: 2rem;
            padding: 1.5rem;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 0.5rem;
            text-align: center;
        }
        .net-salary h2 {
            margin: 0;
            color: #1d4ed8;
            font-size: 1.875rem;
        }
        .net-salary p {
            margin: 0.5rem 0 0 0;
            color: #3b82f6;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
        }
        .footer {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            text-align: center;
            font-size: 0.875rem;
        }
        .signature-box {
            margin-top: 4rem;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .slip-container {
                box-shadow: none;
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="slip-container">
        <div class="header">
            <h1>MI As-Saodah</h1>
            <p>Bukti Pembayaran Gaji Karyawan</p>
        </div>

        <div class="info-grid">
            <div class="info-left">
                <div class="info-item"><strong>Nama Pegawai</strong>: {{ $payroll->employee->name }}</div>
                <div class="info-item"><strong>Jabatan / Tipe</strong>: {{ $payroll->employee->position }} ({{ ucfirst($payroll->employee->type) }})</div>
                <div class="info-item"><strong>NIP</strong>: {{ $payroll->employee->nip ?? '-' }}</div>
            </div>
            <div class="info-right">
                <div class="info-item"><strong>No. Slip</strong>: SLIP-{{ str_pad($payroll->id, 5, '0', STR_PAD_LEFT) }}</div>
                <div class="info-item"><strong>Bulan</strong>: {{ \Carbon\Carbon::create()->month($payroll->month)->translatedFormat('F') }}</div>
                <div class="info-item"><strong>Tahun Ajaran</strong>: {{ $payroll->academicYear->name }}</div>
            </div>
        </div>

        <div class="payroll-details">
            <!-- Pendapatan -->
            <div class="detail-section">
                <h3>Pendapatan</h3>
                @php $hasEarnings = false; @endphp
                @foreach ($payroll->details->where('type', 'earning') as $detail)
                    @php $hasEarnings = true; @endphp
                    <div class="item-row">
                        <span class="item-name">{{ $detail->component_name }}</span>
                        <span class="item-value plus">Rp {{ number_format($detail->nominal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                @if (!$hasEarnings)
                    <div class="item-row" style="color: #94a3b8; font-style: italic;">Tidak ada pendapatan khusus.</div>
                @endif
                <div class="total-row">
                    <span>Total Pendapatan</span>
                    <span style="color: #10b981;">Rp {{ number_format($payroll->total_earnings, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Potongan -->
            <div class="detail-section">
                <h3>Potongan</h3>
                @php $hasDeductions = false; @endphp
                @foreach ($payroll->details->where('type', 'deduction') as $detail)
                    @php $hasDeductions = true; @endphp
                    <div class="item-row">
                        <span class="item-name">{{ $detail->component_name }}</span>
                        <span class="item-value minus">Rp {{ number_format($detail->nominal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
                @if (!$hasDeductions)
                    <div class="item-row" style="color: #94a3b8; font-style: italic;">Tidak ada potongan bulan ini.</div>
                @endif
                <div class="total-row">
                    <span>Total Potongan</span>
                    <span style="color: #ef4444;">Rp {{ number_format($payroll->total_deductions, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="net-salary">
            <p>Penerimaan Bersih (Take Home Pay)</p>
            <h2>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</h2>
        </div>

        <div class="footer">
            <div>
                Penerima,
                <div class="signature-box">
                    <strong>{{ $payroll->employee->name }}</strong>
                </div>
            </div>
            <div>
                Mengetahui / Membayarkan,
                <br>
                {{ date('d F Y') }}
                <div class="signature-box">
                    <strong>( Bendahara / HR )</strong>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
