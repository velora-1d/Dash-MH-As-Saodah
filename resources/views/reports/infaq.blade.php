<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.25rem;">
                                <a href="{{ route('reports.index') }}" style="font-size: 0.75rem; font-weight: 500; color: rgba(255,255,255,0.7); text-decoration: none; transition: color 0.15s ease;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,0.7)'">Laporan</a>
                                <svg style="width: 0.75rem; height: 0.75rem; color: rgba(255,255,255,0.5);" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                <span style="font-size: 0.75rem; font-weight: 700; color: #fff;">Infaq & SPP</span>
                            </div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Laporan Infaq Pembangunan</h2>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        <button type="button" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #059669; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#f0fdf4'; this.style.borderColor='#a7f3d0'" onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(255,255,255,0.3)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Export Excel
                        </button>
                        <button type="button" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #e11d48; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#fff1f2'; this.style.borderColor='#fecdd3'" onmouseout="this.style.background='#fff'; this.style.borderColor='rgba(255,255,255,0.3)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            Cetak PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Parameter Pencarian</h4>
            </div>
            <form action="{{ route('reports.infaq') }}" method="GET" style="padding: 1.5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; align-items: end;">
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tahun Ajaran</label>
                    <select name="academic_year_id" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua Angkatan</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Kelas</label>
                    <select name="classroom_id" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua Kelas</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Bulan</label>
                    <select name="month" style="width: 100%; box-sizing: border-box;">
                        <option value="">Laporan Tahunan</option>
                        @foreach([1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'] as $key => $name)<option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Status</label>
                    <select name="status" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Menunggak</option>
                    </select>
                </div>
                <div>
                    <button type="submit" style="width: 100%; display: inline-flex; justify-content: center; align-items: center; padding: 0.625rem 1rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #d97706, #b45309); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
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
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Data Laporan</h4>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nomor Induk</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Bulan Tagihan</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kategori JKP</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b;">12345678</td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #b45309;">C</div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">Contoh Siswa Lunas</p>
                                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;"><span style="color: #6366f1; font-weight: 600;">Kelas 1A</span></p>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">Juli 2026</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #64748b; font-weight: 500;">
                                Keluarga Mampu
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                    LUNAS
                                </span>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b;">09876543</td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #b45309;">C</div>
                                    <div>
                                        <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">Contoh Siswa Nunggak</p>
                                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;"><span style="color: #6366f1; font-weight: 600;">Kelas 1A</span></p>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">Juli 2026</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #64748b; font-weight: 500;">
                                Yatim Piatu (Gratis)
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">
                                    MENUNGGAK
                                </span>
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
