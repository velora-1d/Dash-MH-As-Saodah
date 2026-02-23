<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #4f46e5 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Pusat Pelaporan</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Navigasi pusat untuk seluruh laporan keuangan dan operasional sekolah.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
            
            <!-- Infaq & SPP -->
            <a href="{{ route('reports.infaq') }}" style="text-decoration: none; display: block; outline: none;" class="group">
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; height: 100%; transition: all 0.2s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='#f59e0b'; this.style.boxShadow='0 4px 6px -1px rgba(245, 158, 11, 0.1), 0 2px 4px -1px rgba(245, 158, 11, 0.06)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0;">Infaq & SPP</h3>
                    </div>
                    <p style="font-size: 0.8125rem; color: #64748b; line-height: 1.5; margin: 0;">Laporan tagihan bulanan dan rekapitulasi penerimaan infaq/spp berdasarkan kelas dan angkatan.</p>
                </div>
            </a>

            <!-- Tabungan Siswa -->
            <a href="{{ route('reports.savings') }}" style="text-decoration: none; display: block; outline: none;" class="group">
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; height: 100%; transition: all 0.2s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='#0ea5e9'; this.style.boxShadow='0 4px 6px -1px rgba(14, 165, 233, 0.1), 0 2px 4px -1px rgba(14, 165, 233, 0.06)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #e0f2fe, #bae6fd); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: #0284c7;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0;">Tabungan Siswa</h3>
                    </div>
                    <p style="font-size: 0.8125rem; color: #64748b; line-height: 1.5; margin: 0;">Rekap mutasi masuk dan keluar tabungan siswa, lengkap dengan riwayat pemotongan infaq otomatis.</p>
                </div>
            </a>

            <!-- Daftar Ulang & Buku -->
            <a href="{{ route('reports.registration') }}" style="text-decoration: none; display: block; outline: none;" class="group">
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; height: 100%; transition: all 0.2s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='#10b981'; this.style.boxShadow='0 4px 6px -1px rgba(16, 185, 129, 0.1), 0 2px 4px -1px rgba(16, 185, 129, 0.06)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: #059669;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0;">PPDB & Buku</h3>
                    </div>
                    <p style="font-size: 0.8125rem; color: #64748b; line-height: 1.5; margin: 0;">Pengecekan kelulusan administrasi pendaftaran siswa baru dan biaya daftar ulang serta pembelian.</p>
                </div>
            </a>

            <!-- Jurnal Kas -->
            <a href="{{ route('reports.cash-flow') }}" style="text-decoration: none; display: block; outline: none;" class="group">
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; height: 100%; transition: all 0.2s ease; position: relative; overflow: hidden;" onmouseover="this.style.borderColor='#8b5cf6'; this.style.boxShadow='0 4px 6px -1px rgba(139, 92, 246, 0.1), 0 2px 4px -1px rgba(139, 92, 246, 0.06)';" onmouseout="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none';">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                        <div style="width: 48px; height: 48px; background: linear-gradient(135deg, #ede9fe, #ddd6fe); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center;">
                            <svg style="width: 24px; height: 24px; color: #6d28d9;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                        </div>
                        <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0;">Arus Kas</h3>
                    </div>
                    <p style="font-size: 0.8125rem; color: #64748b; line-height: 1.5; margin: 0;">Konsolidasi seluruh transaksi penerimaan dan pengeluaran dana BOS/Operasional setiap bulan kalender.</p>
                </div>
            </a>

        </div>
    </div>
</x-app-layout>
