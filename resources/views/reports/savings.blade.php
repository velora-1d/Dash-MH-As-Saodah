<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0284c7 0%, #0369a1 50%, #075985 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <a href="{{ route('reports.index') }}" style="font-size: 0.75rem; font-weight: 500; color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.15s ease;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Laporan</a>
                                <svg style="width: 0.75rem; height: 0.75rem; color: rgba(255,255,255,0.5);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                <span style="font-size: 0.75rem; font-weight: 700; color: #fff;">Tabungan & Mutasi</span>
                            </div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Rekap Mutasi Tabungan Siswa</h2>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        <button type="button" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #059669; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#f0fdf4'; this.style.borderColor='#a7f3d0'" onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(255,255,255,0.3)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export Excel
                        </button>
                        <button type="button" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #e11d48; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#fff1f2'; this.style.borderColor='#fecdd3'" onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(255,255,255,0.3)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            Cetak Buku Tabungan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Parameter Pencarian</h4>
            </div>
            <form action="{{ route('reports.savings') }}" method="GET" style="padding: 1.5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tanggal Awal</label>
                    <input type="date" name="start_date" value="{{ request('start_date', now()->startOfMonth()->format('Y-m-d')) }}" style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ request('end_date', now()->format('Y-m-d')) }}" style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">NIS / Nama Siswa</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Jenis Transaksi</label>
                    <select name="type" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua (Deposit & Withdrawal)</option>
                        <option value="deposit" {{ request('type') === 'deposit' ? 'selected' : '' }}>Setoran Tabungan</option>
                        <option value="withdrawal" {{ request('type') === 'withdrawal' ? 'selected' : '' }}>Penarikan & Potongan</option>
                    </select>
                </div>
                <div>
                    <button type="submit" style="width: 100%; display: inline-flex; justify-content: center; align-items: center; padding: 0.625rem 1rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0284c7, #0369a1); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Mutasi Tabungan</h4>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tanggal & Waktu</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Pihak Terkait (Siswa)</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Deskripsi/Catatan</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tipe Transaksi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b;">23 Feb 2026 09:30</td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #e0f2fe, #bae6fd); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #0369a1;">A</div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">Ahmad Dahlan</p>
                                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;"><span style="color: #6366f1; font-weight: 600;">Kelas 1A</span></p>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-size: 0.8125rem; color: #64748b; margin: 0;">Setoran Tunai via Bendahara Sekolah</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                    SETORAN
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: right;">
                                <span style="font-weight: 700; font-size: 0.8125rem; color: #059669;">+ Rp50.000</span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b;">22 Feb 2026 14:15</td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #e0f2fe, #bae6fd); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #0369a1;">S</div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">Siti Aminah</p>
                                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;"><span style="color: #6366f1; font-weight: 600;">Kelas 1A</span></p>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-size: 0.8125rem; color: #64748b; margin: 0;">Potongan Otomatis Tagihan Infaq Bulan Februari</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">
                                    PENARIKAN
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: right;">
                                <span style="font-weight: 700; font-size: 0.8125rem; color: #e11d48;">- Rp150.000</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; font-size: 0.8125rem; color: #94a3b8;">
                Menampilkan halaman 1 dari 1
            </div>
        </div>
    </div>
</x-app-layout>
