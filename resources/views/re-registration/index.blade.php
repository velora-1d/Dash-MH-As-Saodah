<x-app-layout>
    <div class="space-y-6">
        <!-- Flash Messages -->
        
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Pendaftaran Ulang Siswa</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola konfirmasi daftar ulang siswa untuk tahun ajaran baru.</p>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <form action="{{ route('re-registration.index') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                            <select name="academic_year_id" onchange="this.form.submit()" style="padding: 0.5rem 2rem 0.5rem 0.75rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-size: 0.8125rem; cursor: pointer; outline: none;">
                                <option value="" style="color: #1e293b;">Pilih Tahun Ajaran</option>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ ($activeYear && $activeYear->id == $year->id) ? 'selected' : '' }} style="color: #1e293b;">{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </form>
                        
                        @if ($activeYear)
                        <form action="{{ route('re-registration.generate') }}" method="POST" style="margin: 0;" onsubmit="return confirm('Generate data daftar ulang untuk tahun ajaran aktif?');">
                            @csrf
                            <input type="hidden" name="academic_year_id" value="{{ $activeYear->id }}">
                            <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease; cursor: pointer;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                                <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                Generate Batch
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kontrol Daftar Ulang -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
            <div onclick="document.getElementById('rereg-settings-body').style.display = document.getElementById('rereg-settings-body').style.display === 'none' ? 'block' : 'none'; this.querySelector('.chevron').style.transform = document.getElementById('rereg-settings-body').style.display === 'none' ? '' : 'rotate(180deg)'" style="padding: 1.25rem 1.5rem; display: flex; align-items: center; justify-content: space-between; cursor: pointer; background: linear-gradient(135deg, #f5f3ff 0%, #f8fafc 100%); border-bottom: 1.5px solid #e2e8f0; transition: background 0.2s;" onmouseover="this.style.background='linear-gradient(135deg, #ede9fe 0%, #f1f5f9 100%)'" onmouseout="this.style.background='linear-gradient(135deg, #f5f3ff 0%, #f8fafc 100%)'">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 6px rgba(139,92,246,0.3);">
                        <svg style="width: 18px; height: 18px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Pengaturan & Rekap Daftar Ulang</h4>
                        <p style="font-size: 0.75rem; color: #64748b; margin: 0.125rem 0 0;">Atur biaya daftar ulang, buku, seragam &amp; lihat rekap penerimaan kas</p>
                    </div>
                </div>
                <div style="width: 28px; height: 28px; background: #f1f5f9; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0;">
                    <svg class="chevron" style="width: 14px; height: 14px; color: #64748b; transition: transform 0.25s ease;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
            <div id="rereg-settings-body" style="display: none; padding: 1.75rem;">
                <!-- Nominal -->
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <!-- Biaya Daftar Ulang -->
                    <div style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); border: 1.5px solid #e2e8f0; border-radius: 0.75rem; padding: 1.25rem; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#8b5cf6'" onmouseout="this.style.borderColor='#e2e8f0'">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #ede9fe, #c4b5fd); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width:14px;height:14px;color:#7c3aed;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p style="font-size: 0.75rem; font-weight: 700; color: #334155; margin: 0;">Biaya Daftar Ulang</p>
                        </div>
                        <div class="fi-money-wrap">
                            <span class="fi-money-prefix">Rp</span>
                            <input type="text" inputmode="numeric" class="fi-input fi-money-input rereg-nominal" data-target="set-rereg-fee" value="{{ number_format($reRegSettings['re_registration_fee'], 0, ',', '.') }}" autocomplete="off">
                            <input type="hidden" id="set-rereg-fee" value="{{ $reRegSettings['re_registration_fee'] }}">
                        </div>
                    </div>
                    <!-- Biaya Buku -->
                    <div style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); border: 1.5px solid #e2e8f0; border-radius: 0.75rem; padding: 1.25rem; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#f59e0b'" onmouseout="this.style.borderColor='#e2e8f0'">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width:14px;height:14px;color:#d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <p style="font-size: 0.75rem; font-weight: 700; color: #334155; margin: 0;">Biaya Buku / LKS</p>
                        </div>
                        <div class="fi-money-wrap">
                            <span class="fi-money-prefix">Rp</span>
                            <input type="text" inputmode="numeric" class="fi-input fi-money-input rereg-nominal" data-target="set-rereg-books" value="{{ number_format($reRegSettings['books_fee'], 0, ',', '.') }}" autocomplete="off">
                            <input type="hidden" id="set-rereg-books" value="{{ $reRegSettings['books_fee'] }}">
                        </div>
                    </div>
                    <!-- Biaya Seragam -->
                    <div style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%); border: 1.5px solid #e2e8f0; border-radius: 0.75rem; padding: 1.25rem; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#ec4899'" onmouseout="this.style.borderColor='#e2e8f0'">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #fce7f3, #fbcfe8); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center;">
                                <svg style="width:14px;height:14px;color:#db2777;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            </div>
                            <p style="font-size: 0.75rem; font-weight: 700; color: #334155; margin: 0;">Biaya Seragam</p>
                        </div>
                        <div class="fi-money-wrap">
                            <span class="fi-money-prefix">Rp</span>
                            <input type="text" inputmode="numeric" class="fi-input fi-money-input rereg-nominal" data-target="set-rereg-uniform" value="{{ number_format($reRegSettings['uniform_fee'], 0, ',', '.') }}" autocomplete="off">
                            <input type="hidden" id="set-rereg-uniform" value="{{ $reRegSettings['uniform_fee'] }}">
                        </div>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <div style="display: flex; justify-content: flex-end; margin-bottom: 1.5rem;">
                    <button onclick="saveReRegSettings()" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.625rem 1.5rem; background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: #fff; border: none; border-radius: 0.625rem; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; cursor: pointer; box-shadow: 0 2px 8px rgba(139,92,246,0.3); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 4px 12px rgba(139,92,246,0.4)'" onmouseout="this.style.transform='';this.style.boxShadow='0 2px 8px rgba(139,92,246,0.3)'">
                        <svg style="width: 15px; height: 15px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Pengaturan
                    </button>
                </div>

                <!-- Rekap Keuangan -->
                <div style="border-top: 1.5px solid #e2e8f0; padding-top: 1.5rem;">
                    <p style="font-size: 0.75rem; font-weight: 700; color: #475569; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 0.875rem; display: flex; align-items: center; gap: 0.375rem;">
                        <svg style="width:15px;height:15px;color:#8b5cf6;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        Rekap Penerimaan Kas Daftar Ulang
                    </p>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.875rem;">
                        <div style="background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%); border: 1.5px solid #a78bfa; padding: 1rem; border-radius: 0.75rem; text-align: center;">
                            <div style="width: 28px; height: 28px; background: #8b5cf6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                <svg style="width:14px;height:14px;color:#fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #7c3aed; margin: 0;">Daftar Ulang</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.0625rem; color: #5b21b6; margin: 0.375rem 0 0;">Rp {{ number_format($paymentStats['total_fee'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.6875rem; color: #64748b; margin: 0.25rem 0 0;">{{ $paymentStats['count_fee'] }} siswa lunas</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #fefce8 0%, #fef9c3 100%); border: 1.5px solid #fcd34d; padding: 1rem; border-radius: 0.75rem; text-align: center;">
                            <div style="width: 28px; height: 28px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                <svg style="width:14px;height:14px;color:#fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            </div>
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #d97706; margin: 0;">Buku / LKS</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.0625rem; color: #92400e; margin: 0.375rem 0 0;">Rp {{ number_format($paymentStats['total_books'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.6875rem; color: #64748b; margin: 0.25rem 0 0;">{{ $paymentStats['count_books'] }} siswa lunas</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%); border: 1.5px solid #f9a8d4; padding: 1rem; border-radius: 0.75rem; text-align: center;">
                            <div style="width: 28px; height: 28px; background: #ec4899; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                <svg style="width:14px;height:14px;color:#fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/></svg>
                            </div>
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #db2777; margin: 0;">Seragam</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.0625rem; color: #9d174d; margin: 0.375rem 0 0;">Rp {{ number_format($paymentStats['total_uniform'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.6875rem; color: #64748b; margin: 0.25rem 0 0;">{{ $paymentStats['count_uniform'] }} siswa lunas</p>
                        </div>
                        <div style="background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); border: 1.5px solid #6ee7b7; padding: 1rem; border-radius: 0.75rem; text-align: center;">
                            <div style="width: 28px; height: 28px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.5rem;">
                                <svg style="width:14px;height:14px;color:#fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #059669; margin: 0;">Total Penerimaan</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.125rem; color: #047857; margin: 0.375rem 0 0;">Rp {{ number_format($paymentStats['grand_total'], 0, ',', '.') }}</p>
                            <p style="font-size: 0.6875rem; color: #64748b; margin: 0.25rem 0 0;">Masuk ke Kas Umum</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistik -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Total Siswa</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #1e293b; margin: 0.25rem 0 0;">{{ $stats['total'] }}</p>
            </div>
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Terkonfirmasi</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #10b981; margin: 0.25rem 0 0;">{{ $stats['confirmed'] }}</p>
            </div>
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Menunggu</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #f59e0b; margin: 0.25rem 0 0;">{{ $stats['pending'] }}</p>
            </div>
            <div style="background: #fff; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; text-align: center;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Tidak Daftar Ulang</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #f43f5e; margin: 0.25rem 0 0;">{{ $stats['not_registered'] }}</p>
            </div>
        </div>

        <!-- Tabel Daftar Ulang -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Siswa</h4>
            </div>

            @php
                $feeDaftarUlang = (int) \App\Models\WebSetting::getValue('re_registration_fee', 0);
                $feeBuku = (int) \App\Models\WebSetting::getValue('books_fee', 0);
                $feeSeragam = (int) \App\Models\WebSetting::getValue('uniform_fee', 0);
            @endphp
            
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">L/P</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Sumber</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Administrasi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($registrations as $index => $reg)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $registrations->firstItem() + $index }}</td>
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b; vertical-align: middle;">{{ $reg->student->name ?? '-' }}</td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="font-size: 0.6875rem; font-weight: 600; color: #7c3aed; background: #ede9fe; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $reg->student->classroom->name ?? '-' }}</span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if ($reg->student->gender === 'L')
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #6366f1; background: #eef2ff;">PA</span>
                                @else
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #ec4899; background: #fdf2f8;">PI</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if ($reg->registration_source === 'online')
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #0ea5e9; background: #f0f9ff; border: 1px solid #bae6fd;">Website</span>
                                @else
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #64748b; background: #f8fafc; border: 1px solid #e2e8f0;">Manual</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if ($reg->status === 'pending')
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fef3c7; border-radius: 999px;">⏳ Menunggu</span>
                                @elseif ($reg->status === 'confirmed')
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">✓ Terkonfirmasi</span>
                                @else
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">✗ Tidak Daftar Ulang</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: left; vertical-align: top;">
                                @if ($reg->registrationPayment)
                                <div style="display: flex; flex-direction: column; gap: 0.375rem; min-width: 140px;">
                                    @php $rp = $reg->registrationPayment; @endphp
                                    <button class="admin-badge {{ $rp->is_fee_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_fee_paid" data-amount="{{ $rp->is_fee_paid ? (int)$rp->fee_amount : $feeDaftarUlang }}" title="{{ $rp->is_fee_paid ? 'Lunas: Rp ' . number_format($rp->fee_amount, 0, ',', '.') : 'Harga Rekomendasi: Rp ' . number_format($feeDaftarUlang, 0, ',', '.') }}">
                                        <span>Herreg {!! $feeDaftarUlang > 0 ? "<span style='opacity:0.6'>(" . ($feeDaftarUlang/1000) . "k)</span>" : "" !!}</span>
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
                                @if ($reg->status === 'pending')
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.375rem;">
                                    <form action="{{ route('re-registration.confirm', $reg) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #059669; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Konfirmasi</button>
                                    </form>
                                    <form action="{{ route('re-registration.not-registered', $reg) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Tidak Daftar</button>
                                    </form>
                                </div>
                                @elseif (in_array($reg->status, ['confirmed', 'not_registered']))
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.375rem;">
                                    <form action="{{ route('re-registration.cancel-confirmation', $reg) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin membatalkan? Status akan dikembalikan ke Pending.')">
                                        @csrf
                                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fffbeb; border: 1px solid #fde68a; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                                            <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                                            Batalkan
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">
                                @if ($activeYear)
                                    Belum ada data daftar ulang. Klik "Generate Batch" untuk membuat data.
                                @else
                                    Pilih tahun ajaran terlebih dahulu.
                                @endif
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($registrations->hasPages())
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

            const isTurningOn = !btn.classList.contains('admin-active');
            const isPaymentField = field.includes('_paid');

            if (isTurningOn && isPaymentField) {
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
                                window.location.reload();
                            });
                        } else {
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

        // === Input Nominal Format Ribuan ===
        document.querySelectorAll('.rereg-nominal').forEach(function(el) {
            el.addEventListener('input', function() {
                var raw = el.value.replace(/\D/g, '');
                el.value = raw.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                var hiddenId = el.dataset.target;
                if (hiddenId) document.getElementById(hiddenId).value = raw;
            });
        });

        // === Fungsi Setting Daftar Ulang ===
        function saveReRegSettings() {
            const payload = {
                re_registration_fee: document.getElementById('set-rereg-fee').value,
                books_fee: document.getElementById('set-rereg-books').value,
                uniform_fee: document.getElementById('set-rereg-uniform').value,
            };

            fetch('{{ route("re-registration.update-settings") }}', {
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
