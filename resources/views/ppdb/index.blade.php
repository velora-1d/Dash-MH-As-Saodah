<x-app-layout>
    <div class="space-y-6">
        <!-- Flash Messages -->
        
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Penerimaan Siswa Baru (PPDB)</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola pendaftaran siswa baru secara online maupun manual.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <a href="{{ route('ppdb.export') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Export Data PPDB ke Excel">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Export Excel
                        </a>
                        <a href="{{ route('ppdb.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Tambah Manual
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kontrol PPDB -->
        <div id="ppdb-settings-panel" style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div onclick="document.getElementById('ppdb-settings-body').style.display = document.getElementById('ppdb-settings-body').style.display === 'none' ? 'block' : 'none'; this.querySelector('.chevron').style.transform = document.getElementById('ppdb-settings-body').style.display === 'none' ? '' : 'rotate(180deg)'" style="padding: 1rem 1.5rem; display: flex; align-items: center; justify-content: space-between; cursor: pointer; background: linear-gradient(180deg, #f8fafc 0%, #fff 100%); border-bottom: 1px solid #f1f5f9;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 14px; height: 14px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; color: #1e293b; margin: 0;">Pengaturan & Rekap PPDB</h4>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0;">Atur nominal biaya, buka/tutup pendaftaran, dan lihat rekap penerimaan kas</p>
                    </div>
                </div>
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <!-- Status PPDB -->
                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.6875rem; font-weight: 700; {{ $ppdbSettings['ppdb_is_open'] === '1' ? 'background: #d1fae5; color: #047857;' : 'background: #fee2e2; color: #991b1b;' }}">
                        <span style="width: 6px; height: 6px; border-radius: 50%; {{ $ppdbSettings['ppdb_is_open'] === '1' ? 'background: #10b981;' : 'background: #ef4444;' }}"></span>
                        {{ $ppdbSettings['ppdb_is_open'] === '1' ? 'PPDB DIBUKA' : 'PPDB DITUTUP' }}
                    </span>
                    <svg class="chevron" style="width: 16px; height: 16px; color: #94a3b8; transition: transform 0.2s ease;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
            <div id="ppdb-settings-body" style="display: none; padding: 1.5rem;">
                <!-- Baris 1: Toggle + Nominal -->
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                    <!-- Toggle Buka/Tutup PPDB -->
                    <div style="background: {{ $ppdbSettings['ppdb_is_open'] === '1' ? '#f0fdf4' : '#fef2f2' }}; border: 1.5px solid {{ $ppdbSettings['ppdb_is_open'] === '1' ? '#bbf7d0' : '#fecaca' }}; border-radius: 0.75rem; padding: 1rem; text-align: center;">
                        <p style="font-size: 0.625rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 0.5rem;">Status PPDB</p>
                        <label style="position: relative; display: inline-block; width: 48px; height: 24px; cursor: pointer;">
                            <input type="checkbox" id="ppdb-toggle" {{ $ppdbSettings['ppdb_is_open'] === '1' ? 'checked' : '' }} style="display: none;" onchange="togglePpdb(this.checked)">
                            <span style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: {{ $ppdbSettings['ppdb_is_open'] === '1' ? '#10b981' : '#cbd5e1' }}; border-radius: 999px; transition: all 0.3s ease;">
                                <span style="position: absolute; top: 2px; left: {{ $ppdbSettings['ppdb_is_open'] === '1' ? '26px' : '2px' }}; width: 20px; height: 20px; background: #fff; border-radius: 50%; transition: all 0.3s ease; box-shadow: 0 1px 3px rgba(0,0,0,0.2);"></span>
                            </span>
                        </label>
                        <p style="font-size: 0.6875rem; font-weight: 700; margin: 0.375rem 0 0; {{ $ppdbSettings['ppdb_is_open'] === '1' ? 'color: #047857;' : 'color: #991b1b;' }}">{{ $ppdbSettings['ppdb_is_open'] === '1' ? 'Dibuka' : 'Ditutup' }}</p>
                    </div>
                    <!-- Biaya Pendaftaran -->
                    <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem;">
                        <p style="font-size: 0.625rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 0.375rem; display: flex; align-items: center; gap: 0.25rem;"><svg style="width:12px;height:12px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Biaya Pendaftaran</p>
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Rp</span>
                            <input type="number" id="set-ppdb-fee" value="{{ $ppdbSettings['ppdb_registration_fee'] }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1.5px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 700; color: #1e293b; background: #fff;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>
                    </div>
                    <!-- Biaya Buku -->
                    <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem;">
                        <p style="font-size: 0.625rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 0.375rem; display: flex; align-items: center; gap: 0.25rem;"><svg style="width:12px;height:12px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg> Biaya Buku / LKS</p>
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Rp</span>
                            <input type="number" id="set-books-fee" value="{{ $ppdbSettings['books_fee'] }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1.5px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 700; color: #1e293b; background: #fff;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>
                    </div>
                    <!-- Biaya Seragam -->
                    <div style="background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 0.75rem; padding: 1rem;">
                        <p style="font-size: 0.625rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 0.375rem; display: flex; align-items: center; gap: 0.25rem;"><svg style="width:12px;height:12px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg> Biaya Seragam</p>
                        <div style="display: flex; align-items: center; gap: 0.25rem;">
                            <span style="font-size: 0.75rem; color: #64748b; font-weight: 600;">Rp</span>
                            <input type="number" id="set-uniform-fee" value="{{ $ppdbSettings['uniform_fee'] }}" style="width: 100%; padding: 0.375rem 0.5rem; border: 1.5px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 700; color: #1e293b; background: #fff;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div style="display: flex; justify-content: flex-end; margin-bottom: 1.25rem;">
                    <button onclick="savePpdbSettings()" style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.5rem 1.25rem; background: linear-gradient(135deg, #0ea5e9, #0284c7); color: #fff; border: none; border-radius: 0.5rem; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.75rem; cursor: pointer; box-shadow: 0 2px 8px rgba(14,165,233,0.3); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Pengaturan
                    </button>
                </div>

                <!-- Rekap Keuangan -->
                <div style="border-top: 1.5px solid #f1f5f9; padding-top: 1.25rem;">
                    <p style="font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 0.75rem; display: flex; align-items: center; gap: 0.25rem;"><svg style="width:13px;height:13px;flex-shrink:0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg> Rekap Penerimaan Kas PPDB</p>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.75rem;">
                        <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 1px solid #bfdbfe; padding: 0.875rem; border-radius: 0.75rem; text-align: center;">
                            <p style="font-size: 0.625rem; font-weight: 600; color: #3b82f6; margin: 0;">Pendaftaran</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1rem; color: #1e40af; margin: 0.25rem 0 0;">Rp {{ number_format($paymentStats['total_fee'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.625rem; color: #64748b; margin: 0.125rem 0 0;">{{ $paymentStats['count_fee'] }} siswa lunas</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #fefce8, #fef9c3); border: 1px solid #fde68a; padding: 0.875rem; border-radius: 0.75rem; text-align: center;">
                            <p style="font-size: 0.625rem; font-weight: 600; color: #d97706; margin: 0;">Buku / LKS</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1rem; color: #92400e; margin: 0.25rem 0 0;">Rp {{ number_format($paymentStats['total_books'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.625rem; color: #64748b; margin: 0.125rem 0 0;">{{ $paymentStats['count_books'] }} siswa lunas</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #fdf2f8, #fce7f3); border: 1px solid #fbcfe8; padding: 0.875rem; border-radius: 0.75rem; text-align: center;">
                            <p style="font-size: 0.625rem; font-weight: 600; color: #db2777; margin: 0;">Seragam</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1rem; color: #9d174d; margin: 0.25rem 0 0;">Rp {{ number_format($paymentStats['total_uniform'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.625rem; color: #64748b; margin: 0.125rem 0 0;">{{ $paymentStats['count_uniform'] }} siswa lunas</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #ecfdf5, #d1fae5); border: 1px solid #a7f3d0; padding: 0.875rem; border-radius: 0.75rem; text-align: center;">
                            <p style="font-size: 0.625rem; font-weight: 600; color: #059669; margin: 0;">Total Penerimaan</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.125rem; color: #047857; margin: 0.25rem 0 0;">Rp {{ number_format($paymentStats['grand_total'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.625rem; color: #64748b; margin: 0.125rem 0 0;">Masuk ke Kas Umum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik Pendaftar -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Total Pendaftar</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0.25rem 0 0;">{{ $stats['total'] }}</p>
            </div>
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Menunggu</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #f59e0b; margin: 0.25rem 0 0;">{{ $stats['pending'] }}</p>
            </div>
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Diterima</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #10b981; margin: 0.25rem 0 0;">{{ $stats['diterima'] }}</p>
            </div>
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Ditolak</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #f43f5e; margin: 0.25rem 0 0;">{{ $stats['ditolak'] }}</p>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Pendaftar PPDB</h4>
                </div>
            </div>
            
            @php
                $feePendaftaran = (int) \App\Models\WebSetting::getValue('ppdb_registration_fee', 0);
                $feeBuku = (int) \App\Models\WebSetting::getValue('books_fee', 0);
                $feeSeragam = (int) \App\Models\WebSetting::getValue('uniform_fee', 0);
            @endphp
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">No. Registrasi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama Calon Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">L/P</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Asal Sekolah</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Sumber</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Administrasi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $index => $reg)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $registrations->firstItem() + $index }}</td>
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #0ea5e9; vertical-align: middle;">{{ $reg->registration_number }}</td>
                            <td style="padding: 1rem 1.5rem;">
                                <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $reg->student_name }}</p>
                                <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">{{ $reg->parent_name ?? '-' }}</p>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($reg->gender === 'L')
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #6366f1; background: #eef2ff;">Putra</span>
                                @else
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #ec4899; background: #fdf2f8;">Putri</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #475569; text-align: center;">{{ $reg->previous_school ?? '-' }}</td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($reg->registration_source === 'online')
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #0ea5e9; background: #f0f9ff; border: 1px solid #bae6fd;">Website</span>
                                @else
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #64748b; background: #f8fafc; border: 1px solid #e2e8f0;">Manual</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($reg->status === 'pending')
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fef3c7; border-radius: 999px;">⏳ Menunggu</span>
                                @elseif($reg->status === 'diterima')
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">✓ Diterima</span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">✗ Ditolak</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: left; vertical-align: top;">
                                @if($reg->registrationPayment)
                                <div style="display: flex; flex-direction: column; gap: 0.375rem; min-width: 140px;">
                                    @php $rp = $reg->registrationPayment; @endphp
                                    <button class="admin-badge {{ $rp->is_fee_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_fee_paid" data-amount="{{ $rp->is_fee_paid ? (int)$rp->fee_amount : $feePendaftaran }}" title="{{ $rp->is_fee_paid ? 'Lunas: Rp ' . number_format($rp->fee_amount, 0, ',', '.') : 'Harga Rekomendasi: Rp ' . number_format($feePendaftaran, 0, ',', '.') }}">
                                        <span>Daftar {!! $feePendaftaran > 0 ? "<span style='opacity:0.6'>(" . ($feePendaftaran/1000) . "k)</span>" : "" !!}</span>
                                        <span class="indicator">{!! $rp->is_fee_paid ? '&#10003;' : '&#8722;' !!}</span>
                                    </button>
                                    <div style="display: flex; gap: 0.25rem;">
                                        <button class="admin-badge {{ $rp->is_books_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_books_paid" data-amount="{{ $rp->is_books_paid ? (int)$rp->books_amount : $feeBuku }}" title="{{ $rp->is_books_paid ? 'Lunas: Rp ' . number_format($rp->books_amount, 0, ',', '.') : 'Harga Rekomendasi: Rp ' . number_format($feeBuku, 0, ',', '.') }}" style="flex:1;">
                                            <span>Buku {!! $feeBuku > 0 ? "<span style='opacity:0.6'>(" . ($feeBuku/1000) . "k)</span>" : "" !!}</span><span class="indicator">{!! $rp->is_books_paid ? '&#10003;' : '&#8722;' !!}</span>
                                        </button>
                                        <button class="admin-badge {{ $rp->is_books_received ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_books_received" title="Sudah Diambil" style="flex:1;">
                                            <span>Ambil</span><span class="indicator">{!! $rp->is_books_received ? '&#10003;' : '&#8722;' !!}</span>
                                        </button>
                                    </div>
                                    <div style="display: flex; gap: 0.25rem;">
                                        <button class="admin-badge {{ $rp->is_uniform_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_uniform_paid" data-amount="{{ $rp->is_uniform_paid ? (int)$rp->uniform_amount : $feeSeragam }}" title="{{ $rp->is_uniform_paid ? 'Lunas: Rp ' . number_format($rp->uniform_amount, 0, ',', '.') : 'Harga Rekomendasi: Rp ' . number_format($feeSeragam, 0, ',', '.') }}" style="flex:1;">
                                            <span>Baju {!! $feeSeragam > 0 ? "<span style='opacity:0.6'>(" . ($feeSeragam/1000) . "k)</span>" : "" !!}</span><span class="indicator">{!! $rp->is_uniform_paid ? '&#10003;' : '&#8722;' !!}</span>
                                        </button>
                                        <button class="admin-badge {{ $rp->is_uniform_received ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_uniform_received" title="Sudah Diambil" style="flex:1;">
                                            <span>Ambil</span><span class="indicator">{!! $rp->is_uniform_received ? '&#10003;' : '&#8722;' !!}</span>
                                        </button>
                                    </div>
                                </div>
                                @else
                                <span style="color: #cbd5e1; font-size: 0.6875rem;">—</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.375rem;">
                                    <a href="{{ route('ppdb.show', $reg) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Detail</a>
                                    
                                    @if($reg->status === 'pending')
                                    <form action="{{ route('ppdb.approve', $reg) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #059669; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Terima</button>
                                    </form>
                                    @endif

                                    @if($reg->status === 'pending' || $reg->status === 'diterima')
                                    <form action="{{ route('ppdb.reject', $reg) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Tolak</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">Belum ada pendaftar PPDB untuk tahun ajaran ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($registrations->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                {{ $registrations->links() }}
            </div>
            @endif
        </div>
    </div>

    <style>
        .admin-badge {
            cursor: pointer; font-family: 'Outfit', sans-serif; font-size: 0.65rem; font-weight: 600;
            padding: 0.375rem 0.5rem; border-radius: 0.375rem; border: 1px solid #e2e8f0;
            background: #f8fafc; color: #64748b; transition: all 0.15s ease;
            display: inline-flex; align-items: center; justify-content: space-between; width: 100%;
        }
        .admin-badge:hover { background: #f1f5f9; border-color: #cbd5e1; color: #475569; }
        .admin-badge.admin-active { 
            background: #ecfdf5; border-color: #a7f3d0; color: #059669; 
        }
        .admin-badge.admin-active:hover { background: #d1fae5; border-color: #6ee7b7; color: #047857; }
        .indicator { font-weight: 800; }
    </style>

    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.admin-badge');
            if (!btn) return;

            const paymentId = btn.dataset.id;
            const field = btn.dataset.field;
            let currentAmountStr = btn.dataset.amount || 0;
            
            // Periksa apakah sedang "dihidupkan" (dibayar)
            const isTurningOn = !btn.classList.contains('admin-active');
            const isPaymentField = field.includes('_paid');

            if (isTurningOn && isPaymentField) {
                // Tampilkan popup input nominal
                Swal.fire({
                    title: 'Berapa Nominal yang Dibayar?',
                    text: 'Sesuaikan nominal apabila murid ini mendapatkan harga berbeda.',
                    input: 'number',
                    inputValue: currentAmountStr,
                    showCancelButton: true,
                    confirmButtonText: 'Terima Kas',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        doToggle(paymentId, field, result.value);
                    }
                });
            } else if (!isTurningOn && isPaymentField) {
                 Swal.fire({
                    title: 'Batalkan Pembayaran?',
                    text: 'Pemasukan di Keuangan Umum juga akan otomatis dibatalkan.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Batalkan',
                    cancelButtonText: 'Tutup',
                }).then((result) => {
                    if (result.isConfirmed) {
                        doToggle(paymentId, field, null);
                    }
                });
            } else {
                // Eksekusi langsung jika berupa toggle barang (buku diambil/baju diambil)
                doToggle(paymentId, field, null);
            }

            function doToggle(id, fieldName, amountValue) {
                fetch('/quick-payment/' + id + '/toggle', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ field: fieldName, amount: amountValue })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        
                        if (isPaymentField) {
                            Swal.fire('Berhasil', 'Status pembayaran diperbarui.', 'success').then(() => {
                                // Refresh halaman untuk memperbarui total
                                window.location.reload();
                            });
                        } else {
                            // Cukup update tampilan lokal (baju/buku diterima)
                            btn.classList.toggle('admin-active', data.value);
                            const indicator = btn.querySelector('.indicator');
                            if (indicator) {
                                indicator.innerHTML = data.value ? '&#10003;' : '&#8722;';
                            }
                            btn.style.transform = 'scale(1.02)';
                            setTimeout(() => btn.style.transform = '', 150);
                        }
                    }
                })
                .catch(() => {
                    Swal.fire('Error', 'Gagal menyimpan perubahan.', 'error');
                });
            }
        });

        // === Fungsi Setting PPDB ===
        function togglePpdb(isOpen) {
            fetch('{{ route("ppdb.update-settings") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ ppdb_is_open: isOpen ? '1' : '0' })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Berhasil', isOpen ? 'PPDB dibuka.' : 'PPDB ditutup.', 'success').then(() => window.location.reload());
                }
            })
            .catch(() => Swal.fire('Error', 'Gagal mengubah status PPDB.', 'error'));
        }

        function savePpdbSettings() {
            const payload = {
                ppdb_registration_fee: document.getElementById('set-ppdb-fee').value,
                books_fee: document.getElementById('set-books-fee').value,
                uniform_fee: document.getElementById('set-uniform-fee').value,
            };

            fetch('{{ route("ppdb.update-settings") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload)
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Tersimpan!', 'Nominal biaya berhasil diperbarui.', 'success').then(() => window.location.reload());
                }
            })
            .catch(() => Swal.fire('Error', 'Gagal menyimpan pengaturan.', 'error'));
        }
    </script>
</x-app-layout>
