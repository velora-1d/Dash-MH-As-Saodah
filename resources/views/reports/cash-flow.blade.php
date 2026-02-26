<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 50%, #4c1d95 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <a href="{{ route('reports.index') }}" style="font-size: 0.75rem; font-weight: 500; color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.15s ease;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Laporan</a>
                                <svg style="width: 0.75rem; height: 0.75rem; color: rgba(255,255,255,0.5);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                <span style="font-size: 0.75rem; font-weight: 700; color: #fff;">Jurnal Kas</span>
                            </div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Laporan Arus Kas Operasional</h2>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        <button type="button" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #059669; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#f0fdf4'; this.style.borderColor='#a7f3d0'" onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(255,255,255,0.3)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export Excel
                        </button>
                        <button type="button" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #e11d48; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#fff1f2'; this.style.borderColor='#fecdd3'" onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(255,255,255,0.3)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            Cetak Laporan
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Parameter Pencarian</h4>
            </div>
            <form action="{{ route('reports.cash-flow') }}" method="GET" style="padding: 1.5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Bulan Pelaporan</label>
                    <select name="month" style="width: 100%; box-sizing: border-box;">
                        @foreach ([1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'] as $key => $name)<option value="{{ $key }}" {{ request('month', now()->month) == $key ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tahun Laporan</label>
                    <select name="year" style="width: 100%; box-sizing: border-box;">
                        @php $currentYear = now()->year; @endphp
                        @for($y = $currentYear; $y >= $currentYear - 5; $y--)
                            <option value="{{ $y }}" {{ request('year', $currentYear) == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Jenis Arus Kas</label>
                    <select name="type" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua (Pemasukan & Pengeluaran)</option>
                        <option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>Pemasukan (Debit)</option>
                        <option value="expense" {{ request('type') === 'expense' ? 'selected' : '' }}>Pengeluaran (Kredit)</option>
                    </select>
                </div>
                <div>
                    <button type="submit" style="width: 100%; display: inline-flex; justify-content: center; align-items: center; padding: 0.625rem 1rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6d28d9, #4c1d95); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Summary Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem;">
            <!-- Pemasukan -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 0.6875rem; font-weight: 700; color: #6366f1; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">Total Pemasukan (Bulan Ini)</h3>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 1.5rem; color: #1e293b; margin: 0;">Rp 0</p>
                </div>
                <div style="width: 48px; height: 48px; background: #eef2ff; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 24px; height: 24px; color: #6366f1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" /></svg>
                </div>
            </div>

            <!-- Pengeluaran -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 0.6875rem; font-weight: 700; color: #e11d48; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">Total Pengeluaran (Bulan Ini)</h3>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 1.5rem; color: #1e293b; margin: 0;">Rp 0</p>
                </div>
                <div style="width: 48px; height: 48px; background: #fff1f2; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 24px; height: 24px; color: #e11d48;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" /></svg>
                </div>
            </div>

            <!-- Saldo -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between;">
                <div>
                    <h3 style="font-size: 0.6875rem; font-weight: 700; color: #059669; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.25rem 0;">Saldo Kas Berjalan</h3>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 900; font-size: 1.5rem; color: #1e293b; margin: 0;">Rp 0</p>
                </div>
                <div style="width: 48px; height: 48px; background: #ecfdf5; border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                    <svg style="width: 24px; height: 24px; color: #059669;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Data Transaksi Arus Kas</h4>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tanggal Transaksi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Akun & Label</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Keterangan / Deskripsi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tipe</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b;">23 Feb 2026</td>
                            <td style="padding: 1rem 1.5rem;">
                                <span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.625rem; border-radius: 999px;">Dana BOS</span>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-size: 0.8125rem; color: #64748b; margin: 0;">Penerimaan Dana BOS Tahap I</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                    DEBIT (Masuk)
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: right;">
                                <span style="font-weight: 700; font-size: 0.8125rem; color: #6366f1;">Rp 15.000.000</span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b;">24 Feb 2026</td>
                            <td style="padding: 1rem 1.5rem;">
                                <span style="font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; padding: 0.25rem 0.625rem; border-radius: 999px;">Listrik & Internet</span>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-size: 0.8125rem; color: #64748b; margin: 0;">Pembayaran Tagihan Listrik PLN Bulan Feb</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">
                                    KREDIT (Keluar)
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: right;">
                                <span style="font-weight: 700; font-size: 0.8125rem; color: #e11d48;">- Rp 450.000</span>
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
