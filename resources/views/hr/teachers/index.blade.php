<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Data Guru & Tenaga Pendidik</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola direktori tenaga pengajar secara terpusat.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                        <a href="{{ route('hr.teachers.export') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Export Data Guru">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Export
                        </a>
                        <a href="{{ route('hr.teachers.template') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Download Template Import">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Template
                        </a>
                        <button onclick="document.getElementById('importModalGuru').style.display='flex'" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Import Data Guru dari Excel">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            Import
                        </button>
                        <a href="{{ route('hr.teachers.create') }}" style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.75rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Tambah Data Guru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Guru</h4>
                </div>
                
                <form action="{{ route('hr.teachers.index') }}" method="GET" style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, nip, posisi..." style="padding: 0.5rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; width: 220px; outline: none; transition: border-color 0.15s ease;" onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                    <select name="status" onchange="this.form.submit()" style="padding: 0.5rem 2rem 0.5rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; outline: none; background: #f8fafc; cursor: pointer;">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                    </select>
                </form>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Profil Guru</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tugas Pokok & Fungsi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status Kepegawaian</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teachers as $index => $teacher)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #94a3b8; font-weight: 600;">
                                    {{ $teachers->firstItem() + $index }}
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #eef2ff, #c7d2fe); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #4f46e5;">
                                            {{ strtoupper(substr($teacher->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $teacher->name }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">NIP/NUPTK: {{ $teacher->nip ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $teacher->position }}</span>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @if ($teacher->status === 'aktif')
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                            <div style="width: 6px; height: 6px; border-radius: 50%; background: #059669;"></div>
                                            Aktif
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #64748b; background: #f1f5f9; border-radius: 999px;">
                                            <div style="width: 6px; height: 6px; border-radius: 50%; background: #94a3b8;"></div>
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: right;">
                                    <div style="display: flex; justify-content: flex-end; gap: 0.375rem;">
                                        <a href="{{ route('hr.teachers.edit', $teacher->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 0.375rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.color='#6366f1'; this.style.borderColor='#c7d2fe'; this.style.background='#eef2ff'" onmouseout="this.style.color='#64748b'; this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'" title="Edit Guru">
                                            <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </a>
                                        <form action="{{ route('hr.teachers.destroy', $teacher->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data guru ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 0.375rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.color='#ef4444'; this.style.borderColor='#fecaca'; this.style.background='#fef2f2'" onmouseout="this.style.color='#64748b'; this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'" title="Hapus Guru">
                                                <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 4rem 2rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #eef2ff, #c7d2fe); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                            <svg style="width: 28px; height: 28px; color: #4f46e5;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        </div>
                                        <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b; margin: 0;">Belum Ada Data Guru</p>
                                        <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.375rem;">Semua rekapitulasi kepegawaian akan ditampilkan di sini.</p>
                                        <a href="{{ route('hr.teachers.create') }}" style="margin-top: 1rem; display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border-radius: 0.625rem; text-decoration: none; transition: transform 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                                            Tambah Data Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if (method_exists($teachers, 'hasPages') && $teachers->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                    {{ $teachers->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Import Guru -->
    <div id="importModalGuru" style="display: none; position: fixed; inset: 0; z-index: 50; align-items: center; justify-content: center; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="if(event.target===this)this.style.display='none'">
        <div style="background: #fff; border-radius: 1rem; padding: 2rem; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0;">Import Data Guru</h3>
                <button onclick="document.getElementById('importModalGuru').style.display='none'" style="background: none; border: none; cursor: pointer; color: #94a3b8; font-size: 1.25rem;">✕</button>
            </div>
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.25rem;">
                <p style="font-size: 0.75rem; color: #166534; margin: 0;">💡 <strong>Tips:</strong> Download template terlebih dahulu agar format kolom sesuai.</p>
                <a href="{{ route('hr.teachers.template') }}" style="display: inline-flex; align-items: center; margin-top: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #059669; text-decoration: underline;">
                    <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    Download Template Excel
                </a>
            </div>
            <form action="{{ route('hr.teachers.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Pilih File Excel (.xlsx, .xls, .csv)</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required style="width: 100%; box-sizing: border-box; padding: 0.625rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.8125rem; margin-bottom: 1.25rem; background: #f8fafc;">
                <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button type="button" onclick="document.getElementById('importModalGuru').style.display='none'" style="padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer;">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
