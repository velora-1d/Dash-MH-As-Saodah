<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                            Riwayat Slip Gaji / Payroll
                        </h2>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">Pemantauan rekapitulasi bukti gaji bulanan seluruh pegawai.</p>
                    </div>
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('hr.payroll.components') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #3b82f6; background: #fff; border-radius: 0.5rem; text-decoration: none; transition: transform 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
                            Master Komponen
                        </a>
                        <a href="{{ route('hr.payroll.employee_salaries') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.3); border-radius: 0.5rem; text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            Atur Gaji Pegawai
                        </a>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Area Generate Payroll Baru -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Terbitkan Slip Gaji Bulanan Secara Otomatis</h4>
            </div>
            <div style="padding: 1.5rem;">
                <form action="{{ route('hr.payroll.generate') }}" method="POST" style="display: flex; gap: 1rem; align-items: flex-end; flex-wrap: wrap;">
                    @csrf
                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Tahun Ajaran Aktif</label>
                        <select name="academic_year_id" required style="width: 200px; padding: 0.625rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; cursor: pointer;">
                            <option value="">Pilih Tahun Ajaran...</option>
                            @foreach ($academicYears as $ay)
                                <option value="{{ $ay->id }}">{{ $ay->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Periode Bulan</label>
                        <select name="month" required style="width: 200px; padding: 0.625rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; cursor: pointer;">
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ date('n') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                            @endfor
                        </select>
                    </div>

                    <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onsubmit="return confirm('Proses akan merencanakan Slip Gaji untuk bulan yang dipilih?');">
                        Generate Semua Slip (Aktif)
                    </button>
                </form>
            </div>
        </div>

        <!-- Area Riwayat Penggajian -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">Log Histori Penggajian</h4>
                <!-- Filter Form Optional -->
                <form action="{{ route('hr.payroll.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
                    <select name="month" style="padding: 0.5rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; cursor: pointer;">
                        <option value="">Semua Bulan</option>
                        @for($i=1; $i<=12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                        @endfor
                    </select>
                    <button type="submit" style="padding: 0.5rem 1rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 600; color: #475569; cursor: pointer;">Filter</button>
                </form>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Kode / Tanggal</th>
                            <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Pegawai</th>
                            <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Pendapatan</th>
                            <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Potongan</th>
                            <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Net (THP)</th>
                            <th style="padding: 1rem 1.25rem; text-align: right; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Cetak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payrolls as $pay)
                        <tr style="transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                            <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                <div style="font-weight: 600; color: #334155; font-size: 0.8125rem;">SLIP-{{ str_pad($pay->id, 5, '0', STR_PAD_LEFT) }}</div>
                                <div style="font-size: 0.7rem; color: #94a3b8; margin-top: 0.125rem;">{{ \Carbon\Carbon::create()->month($pay->month)->translatedFormat('F') }} - {{ $pay->academicYear->name }}</div>
                            </td>
                            <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                <div style="font-weight: 600; color: #0f172a; font-size: 0.875rem;">{{ $pay->employee->name }}</div>
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.125rem;">{{ ucfirst($pay->employee->type) }}</div>
                            </td>
                            <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                <div style="font-size: 0.8125rem; font-weight: 500; color: #10b981;">+ Rp {{ number_format($pay->total_earnings, 0, ',', '.') }}</div>
                            </td>
                            <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                <div style="font-size: 0.8125rem; font-weight: 500; color: #ef4444;">- Rp {{ number_format($pay->total_deductions, 0, ',', '.') }}</div>
                            </td>
                            <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                <div style="font-size: 0.875rem; font-weight: 700; color: #3b82f6;">Rp {{ number_format($pay->net_salary, 0, ',', '.') }}</div>
                            </td>
                            <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                <a href="{{ route('hr.payroll.print', $pay->id) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 0.5rem; color: #3b82f6; background: #eff6ff; border: 1px solid #bfdbfe; cursor: pointer; transition: all 0.2s ease;" title="Cetak Slip">
                                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8;">
                                <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 50%; background: #f1f5f9; margin-bottom: 1rem;">
                                    <svg style="width: 24px; height: 24px; color: #cbd5e1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                </div>
                                <p style="font-size: 0.875rem; margin: 0;">Belum ada riwayat penggajian diterbitkan.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($payrolls->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                {{ $payrolls->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
