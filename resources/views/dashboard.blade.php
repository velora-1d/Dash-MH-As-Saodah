<x-app-layout>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .anim-hero { animation: fadeIn 0.5s ease-out both; }
        .anim-card-1 { animation: fadeInUp 0.4s ease-out 0.1s both; }
        .anim-card-2 { animation: fadeInUp 0.4s ease-out 0.18s both; }
        .anim-card-3 { animation: fadeInUp 0.4s ease-out 0.26s both; }
        .anim-card-4 { animation: fadeInUp 0.4s ease-out 0.34s both; }
        .anim-card-5 { animation: fadeInUp 0.4s ease-out 0.42s both; }
        .anim-section { animation: fadeInUp 0.5s ease-out 0.5s both; }
        .anim-chart { animation: fadeInUp 0.5s ease-out 0.6s both; }
        .kpi-card:hover .kpi-icon { transform: scale(1.1); }
        .kpi-icon { transition: transform 0.25s ease; }
    </style>

    <div class="space-y-6">
        <!-- Hero Header -->
        <div class="anim-hero" style="background: linear-gradient(135deg, #312e81 0%, #1e1b4b 50%, #0f172a 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.03); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.1); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.15);">
                            <svg style="width: 22px; height: 22px; color: #f59e0b;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Halo, {{ Auth::user()->name }}!</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.5); margin-top: 0.125rem;">Selamat datang di Panel Administrasi MI As-Saodah.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; background: rgba(255,255,255,0.08); padding: 0.375rem; border-radius: 0.625rem; border: 1px solid rgba(255,255,255,0.12);">
                        <form action="{{ route('dashboard') }}" method="GET" style="display: flex; align-items: center;">
                            <select name="academic_year_id" onchange="this.form.submit()" style="font-size: 0.75rem; font-weight: 600; color: #fff; border: none; background: transparent; padding: 0.5rem 2rem 0.5rem 0.75rem; cursor: pointer; outline: none; -webkit-appearance: none; appearance: none;">
                                <option value="" style="color: #1e293b;">Semua Tahun Ajaran</option>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}" style="color: #1e293b;" {{ (request('academic_year_id') == $year->id) || ($year->is_active && !request()->has('academic_year_id')) ? 'selected' : '' }}>
                                        {{ $year->name }} {{ $year->semester ? '('.ucfirst($year->semester).')' : '' }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 1rem;">

            <!-- KPI 1: Total Siswa Aktif -->
            <div class="kpi-card anim-card-1" style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden; transition: box-shadow 0.25s ease, transform 0.25s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(99,102,241,0.12)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none'; this.style.transform=''">
                <div style="position: absolute; right: -16px; bottom: -16px; width: 80px; height: 80px; background: #eef2ff; border-radius: 50%; opacity: 0.5;"></div>
                <div style="position: relative; z-index: 1;">
                    <div class="kpi-icon" style="width: 40px; height: 40px; background: #e0e7ff; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem;">
                        <svg style="width: 20px; height: 20px; color: #6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Total Siswa Aktif</p>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0.25rem 0 0 0;">{{ $totalSiswa }}</p>
                    <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; font-size: 0.6875rem; color: #64748b;">
                        <span>Putra: <strong style="color: #6366f1;">{{ $totalSiswaPa }}</strong></span>
                        <span>Putri: <strong style="color: #f59e0b;">{{ $totalSiswaPi }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- KPI 2: Pendaftar PPDB -->
            @if (in_array(auth()->user()->role, ['kepsek', 'operator', 'admin', 'superadmin']))
            <div class="kpi-card anim-card-2" style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden; transition: box-shadow 0.25s ease, transform 0.25s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(14,165,233,0.12)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none'; this.style.transform=''">
                <div style="position: absolute; right: -16px; bottom: -16px; width: 80px; height: 80px; background: #e0f2fe; border-radius: 50%; opacity: 0.5;"></div>
                <div style="position: relative; z-index: 1;">
                    <div class="kpi-icon" style="width: 40px; height: 40px; background: #e0f2fe; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem;">
                        <svg style="width: 20px; height: 20px; color: #0ea5e9;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Pendaftar PPDB</p>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0.25rem 0 0 0;">{{ $ppdbPending + $ppdbDiterima }}</p>
                    <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; font-size: 0.6875rem; color: #64748b;">
                        <span>Pending: <strong style="color: #0ea5e9;">{{ $ppdbPending }}</strong></span>
                        <span>Diterima: <strong style="color: #10b981;">{{ $ppdbDiterima }}</strong></span>
                    </div>
                </div>
            </div>
            @endif

            @if (in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin']))
            <!-- KPI 3: Pemasukan Bulan Ini -->
            <div class="kpi-card anim-card-3" style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden; transition: box-shadow 0.25s ease, transform 0.25s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(16,185,129,0.12)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none'; this.style.transform=''">
                <div style="position: absolute; right: -16px; bottom: -16px; width: 80px; height: 80px; background: #d1fae5; border-radius: 50%; opacity: 0.5;"></div>
                <div style="position: relative; z-index: 1;">
                    <div class="kpi-icon" style="width: 40px; height: 40px; background: #d1fae5; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem;">
                        <svg style="width: 20px; height: 20px; color: #10b981;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Pemasukan Bulan Ini</p>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.25rem; color: #1e293b; margin: 0.25rem 0 0 0;">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</p>
                    <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; font-size: 0.6875rem; color: #64748b;">
                        <span>Data Real</span>
                        <strong style="color: #10b981;">Bulan Ini</strong>
                    </div>
                </div>
            </div>

            <!-- KPI 4: Kepatuhan Infaq -->
            <div class="kpi-card anim-card-4" style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden; transition: box-shadow 0.25s ease, transform 0.25s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(245,158,11,0.12)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none'; this.style.transform=''">
                <div style="position: absolute; right: -16px; bottom: -16px; width: 80px; height: 80px; background: #fef3c7; border-radius: 50%; opacity: 0.5;"></div>
                <div style="position: relative; z-index: 1;">
                    <div class="kpi-icon" style="width: 40px; height: 40px; background: #fef3c7; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem;">
                        <svg style="width: 20px; height: 20px; color: #f59e0b;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Kepatuhan Lunas Infaq</p>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0.25rem 0 0 0;">{{ $kepatuhanPa + $kepatuhanPi }}</p>
                    <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; font-size: 0.6875rem; color: #64748b;">
                        <span>PA: <strong style="color: #10b981;">{{ $kepatuhanPa }}</strong></span>
                        <span>PI: <strong style="color: #f59e0b;">{{ $kepatuhanPi }}</strong></span>
                    </div>
                </div>
            </div>

            <!-- KPI 5: Tunggakan Infaq -->
            <div class="kpi-card anim-card-5" style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; position: relative; overflow: hidden; transition: box-shadow 0.25s ease, transform 0.25s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(244,63,94,0.12)'; this.style.transform='translateY(-3px)'" onmouseout="this.style.boxShadow='none'; this.style.transform=''">
                <div style="position: absolute; right: -16px; bottom: -16px; width: 80px; height: 80px; background: #ffe4e6; border-radius: 50%; opacity: 0.5;"></div>
                <div style="position: relative; z-index: 1;">
                    <div class="kpi-icon" style="width: 40px; height: 40px; background: #ffe4e6; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; margin-bottom: 0.75rem;">
                        <svg style="width: 20px; height: 20px; color: #f43f5e;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Siswa Menunggak Infaq</p>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #f43f5e; margin: 0.25rem 0 0 0;">{{ $tunggakanPa + $tunggakanPi }}</p>
                    <div style="margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; font-size: 0.6875rem; color: #64748b;">
                        <span>PA: <strong style="color: #f43f5e;">{{ $tunggakanPa }} (Rp{{ number_format($tunggakanPaRp, 0, ',', '.') }})</strong></span>
                        <span>PI: <strong style="color: #f43f5e;">{{ $tunggakanPi }} (Rp{{ number_format($tunggakanPiRp, 0, ',', '.') }})</strong></span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Tabel Tunggakan -->
        @if (in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin']))
        <div class="anim-section" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">

            <!-- Tunggakan PA -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Siswa Menunggak (PA)</h4>
                    </div>
                    <span style="font-size: 0.6875rem; color: #94a3b8;">Perhatian khusus untuk putra</span>
                </div>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Bln</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswaMenunggakPa as $siswa)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b; max-width: 140px;">{{ $siswa->name }}</td>
                                <td style="padding: 0.75rem 1.5rem;"><span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $siswa->kelas }}</span></td>
                                <td style="padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #475569;">{{ $siswa->bulan }} Bulan</td>
                                <td style="padding: 0.75rem 1.5rem; text-align: right; font-size: 0.8125rem; font-weight: 700; color: #f43f5e;">Rp{{ number_format($siswa->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">Tidak ada antrean tunggakan putra saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tunggakan PI -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Siswi Menunggak (PI)</h4>
                    </div>
                    <span style="font-size: 0.6875rem; color: #94a3b8;">Perhatian khusus untuk putri</span>
                </div>
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Bln</th>
                                <th style="padding: 0.75rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($siswaMenunggakPi as $siswi)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b; max-width: 140px;">{{ $siswi->name }}</td>
                                <td style="padding: 0.75rem 1.5rem;"><span style="font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fef3c7; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $siswi->kelas }}</span></td>
                                <td style="padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #475569;">{{ $siswi->bulan }} Bulan</td>
                                <td style="padding: 0.75rem 1.5rem; text-align: right; font-size: 0.8125rem; font-weight: 700; color: #f43f5e;">Rp{{ number_format($siswi->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">Tidak ada antrean tunggakan putri saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- Charts -->
        <div class="anim-chart" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">

            @if (in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin']))
            <!-- Chart 1: Tren Arus Kas -->
            <div style="grid-column: span 2; background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%;"></div>
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Tren Arus Kas Tahunan</h4>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">Perbandingan Pendapatan vs Pengeluaran dalam Setahun</p>
                    </div>
                </div>
                <div style="padding: 1.5rem; flex: 1; min-height: 300px; position: relative;">
                    <canvas id="cashflowChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Sumber Pemasukan -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Sumber Pemasukan</h4>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">Proporsi sumber dana operasional utama</p>
                    </div>
                </div>
                <div style="padding: 1.5rem; flex: 1; min-height: 250px; position: relative; display: flex; justify-content: center; align-items: center;">
                    <canvas id="sourceChart"></canvas>
                </div>
            </div>

            <!-- Chart 3: Kepatuhan Infaq per Kelas -->
            <div style="grid-column: span 2; background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Kepatuhan Infaq per Kelas</h4>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">Persentase Lunas dari Kelas 1 s/d Kelas 6</p>
                    </div>
                </div>
                <div style="padding: 1.5rem; flex: 1; min-height: 300px; position: relative;">
                    <canvas id="complianceChart"></canvas>
                </div>
            </div>
            @endif

            @if (in_array(auth()->user()->role, ['kepsek', 'operator', 'admin', 'superadmin']))
            <!-- Chart 4: PPDB -->
            @if (auth()->user()->role === 'operator')
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column; grid-column: span 3;">
            @else
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; display: flex; flex-direction: column;">            
            @endif
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Pendaftar PPDB</h4>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">Rekap per status persetujuan</p>
                    </div>
                </div>
                <div style="padding: 1.5rem; flex: 1; min-height: 250px; position: relative; display: flex; justify-content: center; align-items: center;">
                    <canvas id="ppdbChart"></canvas>
                </div>
            </div>
            @endif
        </div>
    </div>

    <?php
    $dashboardStore = json_encode([
        'cashflow' => $chartCashflow ?? [],
        'source' => $chartSource ?? [],
        'compliance' => $chartCompliance ?? [],
        'ppdbDiterima' => $ppdbDiterima ?? 0,
        'ppdbPending' => $ppdbPending ?? 0
    ]);
    ?>
    <script id="dashboard-store" type="application/json">
        {!! $dashboardStore !!}
    </script>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const storeEl = document.getElementById('dashboard-store');
            if (!storeEl) return;
            const store = JSON.parse(storeEl.textContent);

            const cashflowData = store.cashflow;
            const sourceData = store.source;
            const complianceData = store.compliance;

            const ctxCashflow = document.getElementById('cashflowChart');
            if (ctxCashflow && cashflowData.labels) {
                new Chart(ctxCashflow, {
                    type: 'bar',
                    data: {
                        labels: cashflowData.labels,
                        datasets: [
                            { label: 'Pemasukan (Rp)', data: cashflowData.in, backgroundColor: '#10b981', borderRadius: 4 },
                            { label: 'Pengeluaran (Rp)', data: cashflowData.out, backgroundColor: '#f43f5e', borderRadius: 4 },
                        ]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { y: { beginAtZero: true } } }
                });
            }

            const ctxSource = document.getElementById('sourceChart');
            if (ctxSource && sourceData.labels) {
                new Chart(ctxSource, {
                    type: 'doughnut',
                    data: { labels: sourceData.labels, datasets: [{ data: sourceData.data, backgroundColor: sourceData.colors, borderWidth: 0, cutout: '65%' }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
                });
            }

            const ctxComp = document.getElementById('complianceChart');
            if (ctxComp && complianceData.labels) {
                new Chart(ctxComp, {
                    type: 'bar',
                    data: {
                        labels: complianceData.labels,
                        datasets: [
                            { label: 'Lunas', data: complianceData.lunas, backgroundColor: '#10b981' },
                            { label: 'Menunggak', data: complianceData.nunggak, backgroundColor: '#f43f5e' }
                        ]
                    },
                    options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } }, scales: { x: { stacked: true }, y: { stacked: true } } }
                });
            }

            const ctxPpdb = document.getElementById('ppdbChart');
            if (ctxPpdb) {
                new Chart(ctxPpdb, {
                    type: 'pie',
                    data: { labels: ['Diterima', 'Menunggu', 'Ditolak'], datasets: [{ data: [store.ppdbDiterima, store.ppdbPending, 0], backgroundColor: ['#10b981', '#0ea5e9', '#f43f5e'], borderWidth: 0 }] },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
