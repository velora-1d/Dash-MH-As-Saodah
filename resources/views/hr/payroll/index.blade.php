<x-app-layout>
    <style>
        .payroll-tab { padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 600; border: none; cursor: pointer; border-radius: 0.5rem 0.5rem 0 0; transition: all 0.2s ease; background: transparent; color: #64748b; border-bottom: 2px solid transparent; }
        .payroll-tab.active { background: #fff; color: #3b82f6; border-bottom: 2px solid #3b82f6; }
        .payroll-tab:hover:not(.active) { color: #334155; background: #f8fafc; }
        .payroll-panel { display: none; }
        .payroll-panel.active { display: block; }
        .payroll-input { width: 100%; padding: 0.5rem 0.75rem 0.5rem 2.25rem; font-size: 0.8125rem; font-weight: 500; color: #334155; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; transition: all 0.2s; }
        .payroll-input:focus { border-color: #3b82f6 !important; box-shadow: 0 0 0 2px rgba(59,130,246,0.1) !important; }
    </style>

    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0;">
                            Manajemen Penggajian
                        </h2>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">Kelola komponen, atur gaji, generate slip, dan pantau riwayat — semua dalam satu halaman.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab Navigation -->
        <div style="background: #f1f5f9; border-radius: 0.75rem; padding: 0.25rem; display: flex; gap: 0.25rem;">
            <button class="payroll-tab active" onclick="switchTab('riwayat')" id="tab-riwayat">
                <span style="display: inline-flex; align-items: center; gap: 0.375rem;">
                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    Generate & Riwayat
                </span>
            </button>
            <button class="payroll-tab" onclick="switchTab('atur-gaji')" id="tab-atur-gaji">
                <span style="display: inline-flex; align-items: center; gap: 0.375rem;">
                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    Atur Gaji Pegawai
                </span>
            </button>
            <button class="payroll-tab" onclick="switchTab('komponen')" id="tab-komponen">
                <span style="display: inline-flex; align-items: center; gap: 0.375rem;">
                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Master Komponen
                </span>
            </button>
        </div>

        {{-- ============================================================ --}}
        {{-- TAB 1: GENERATE & RIWAYAT SLIP GAJI --}}
        {{-- ============================================================ --}}
        <div class="payroll-panel active" id="panel-riwayat">
            <!-- Area Generate Payroll Baru -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%; margin-bottom: 1.5rem;">
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
                        <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onclick="return confirm('Proses akan menerbitkan Slip Gaji untuk bulan yang dipilih?');">
                            Generate Semua Slip (Aktif)
                        </button>
                    </form>
                </div>
            </div>

            <!-- Area Riwayat Penggajian -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">Log Histori Penggajian</h4>
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
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Status</th>
                                <th style="padding: 1rem 1.25rem; text-align: right; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Aksi</th>
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
                                <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                    @if($pay->status === 'paid')
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #ecfdf5; color: #10b981;">Dibayar</span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #fef3c7; color: #d97706;">Draft</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; text-align: right; min-width: 140px;">
                                    @if($pay->status === 'draft')
                                        <a href="{{ route('hr.payroll.edit', $pay->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 0.5rem; color: #10b981; background: #ecfdf5; border: 1px solid #a7f3d0; cursor: pointer; transition: all 0.2s ease; margin-right: 0.25rem;" title="Edit Nominal">
                                            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </a>
                                        <form action="{{ route('hr.payroll.destroy', $pay->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slip gaji ini secara permanen?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 0.5rem; color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; cursor: pointer; transition: all 0.2s ease; margin-right: 0.25rem;" title="Hapus">
                                                <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('hr.payroll.print', $pay->id) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 0.5rem; color: #3b82f6; background: #eff6ff; border: 1px solid #bfdbfe; cursor: pointer; transition: all 0.2s ease;" title="Cetak Slip">
                                        <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8;">
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

                @if ($payrolls->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                    {{ $payrolls->links() }}
                </div>
                @endif
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- TAB 2: ATUR GAJI PEGAWAI (INLINE) --}}
        {{-- ============================================================ --}}
        <div class="payroll-panel" id="panel-atur-gaji">
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">Pengaturan Gaji Tetap Per Pegawai</h4>
                        <p style="font-size: 0.75rem; color: #64748b; margin: 0.25rem 0 0;">Nominal yang diset di sini menjadi patokan saat Generate Slip Gaji.</p>
                    </div>
                </div>

                <div style="padding: 1.5rem;">
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        @forelse ($employees as $employee)
                        <div style="border: 1px solid #e2e8f0; border-radius: 0.75rem; overflow: hidden;">
                            <div style="padding: 1rem 1.25rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h5 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">{{ $employee->name }}</h5>
                                    <p style="font-size: 0.75rem; color: #64748b; margin-top: 0.125rem;">{{ ucfirst($employee->type) }} - {{ $employee->position }}</p>
                                </div>
                            </div>
                            
                            <form action="{{ route('hr.payroll.employee_salaries.update', $employee->id) }}" method="POST" style="padding: 1.25rem;">
                                @csrf
                                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.25rem;">
                                    @foreach ($components as $comp)
                                        @php
                                            $empSalNominal = $employee->salaryComponents->where('salary_component_id', $comp->id)->first()->nominal ?? 0;
                                        @endphp
                                        <div style="display: flex; flex-direction: column; gap: 0.375rem;">
                                            <label style="font-size: 0.75rem; font-weight: 600; color: #475569; display: flex; justify-content: space-between;">
                                                {{ $comp->name }}
                                                @if ($comp->type === 'earning')
                                                <span style="font-size: 0.65rem; padding: 0.125rem 0.375rem; border-radius: 0.25rem; background: #ecfdf5; color: #10b981;">+</span>
                                                @else
                                                <span style="font-size: 0.65rem; padding: 0.125rem 0.375rem; border-radius: 0.25rem; background: #fef2f2; color: #ef4444;">-</span>
                                                @endif
                                            </label>
                                            <div class="fi-money-wrap">
                                                <span class="fi-money-prefix">Rp</span>
                                                <input type="text" inputmode="numeric"
                                                    class="fi-input fi-money-input salary-nominal"
                                                    data-comp-id="{{ $comp->id }}"
                                                    value="{{ $empSalNominal > 0 ? number_format($empSalNominal, 0, ',', '.') : '0' }}"
                                                    autocomplete="off">
                                                <input type="hidden" name="components[{{ $comp->id }}]" value="{{ floatval($empSalNominal) }}">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div style="margin-top: 1.25rem; display: flex; justify-content: flex-end;">
                                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: #3b82f6; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">
                                        Perbarui Data Rekap
                                    </button>
                                </div>
                            </form>
                        </div>
                        @empty
                        <div style="text-align: center; padding: 3rem 0;">
                            <p style="font-size: 0.875rem; color: #64748b; margin: 0;">Tidak ada pegawai aktif ditemukan. Tambahkan pegawai terlebih dahulu di menu Kepegawaian.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- TAB 3: MASTER KOMPONEN GAJI --}}
        {{-- ============================================================ --}}
        <div class="payroll-panel" id="panel-komponen">
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; align-items: start;">
                
                <!-- Form Tambah Komponen -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Tambah Komponen Baru</h4>
                    </div>
                    <form action="{{ route('hr.payroll.components.store') }}" method="POST" style="padding: 1.5rem;">
                        @csrf
                        <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Nama Komponen</label>
                                <input type="text" name="name" placeholder="Misal: Tunjangan Transport" required style="width: 100%; padding: 0.625rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; transition: border-color 0.15s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Jenis (Sifat)</label>
                                <select name="type" required style="width: 100%; padding: 0.625rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; background: #fff; cursor: pointer;">
                                    <option value="earning">Pendapatan / Menambah (+)</option>
                                    <option value="deduction">Potongan / Mengurangi (-)</option>
                                </select>
                            </div>
                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;">
                                Simpan Parameter
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Daftar Komponen -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Master Komponen Gaji</h4>
                    </div>
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                            <thead>
                                <tr style="background: #f8fafc;">
                                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Nama Komponen</th>
                                    <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase;">Tipe</th>
                                    <th style="padding: 1rem 1.25rem; text-align: right; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase; width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($components as $item)
                                <tr style="transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                    <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                        <div style="font-weight: 600; color: #334155; font-size: 0.875rem;">{{ $item->name }}</div>
                                    </td>
                                    <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                        @if ($item->type === 'earning')
                                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #ecfdf5; color: #10b981;">Pendapatan / Plus</span>
                                        @else
                                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #fef2f2; color: #ef4444;">Potongan / Minus</span>
                                        @endif
                                    </td>
                                    <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                        <form action="{{ route('hr.payroll.components.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komponen ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 0.5rem; color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; cursor: pointer; transition: all 0.2s ease;" title="Hapus">
                                                <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8;">
                                        <p style="font-size: 0.875rem; margin: 0;">Belum ada Data Komponen. Tambahkan di form sebelah kiri.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab Switching
        function switchTab(tabName) {
            document.querySelectorAll('.payroll-tab').forEach(function(t) { t.classList.remove('active'); });
            document.querySelectorAll('.payroll-panel').forEach(function(p) { p.classList.remove('active'); });
            document.getElementById('tab-' + tabName).classList.add('active');
            document.getElementById('panel-' + tabName).classList.add('active');
        }

        // Format Ribuan untuk semua input nominal gaji
        document.addEventListener('DOMContentLoaded', function() {
            function formatRibuan(val) {
                var num = String(val).replace(/\D/g, '');
                return num.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            document.querySelectorAll('.salary-nominal').forEach(function(el) {
                var hiddenInput = el.closest('.fi-money-wrap') 
                    ? el.closest('.fi-money-wrap').querySelector('input[type="hidden"]') 
                    : el.parentElement.querySelector('input[type="hidden"]');
                el.addEventListener('input', function() {
                    var raw = el.value.replace(/\D/g, '');
                    el.value = formatRibuan(raw);
                    if (hiddenInput) hiddenInput.value = raw;
                });
            });
        });
    </script>
</x-app-layout>
