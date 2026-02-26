<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Data Staf & Karyawan</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola direktori staf tata usaha dan karyawan secara terpusat.</p>
                        </div>
                    </div>
                    <a href="{{ route('hr.staff.create') }}" style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.75rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Tambah Data Staf
                    </a>
                </div>
            </div>
        </div>

        
        

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #6366f1); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Staf</h4>
                </div>
                
                <form action="{{ route('hr.staff.index') }}" method="GET" style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, nik, jabatan..." style="padding: 0.5rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; width: 220px; outline: none; transition: border-color 0.15s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e2e8f0'">
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
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Profil Staf</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Posisi / Jabatan</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($staffs as $index => $staff)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #94a3b8; font-weight: 600;">
                                    {{ $staffs->firstItem() + $index }}
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #e0f2fe, #bae6fd); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #0284c7;">
                                            {{ strtoupper(substr($staff->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $staff->name }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">NIK/ID: {{ $staff->nip ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <span style="font-size: 0.6875rem; font-weight: 600; color: #0284c7; background: #f0f9ff; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $staff->position }}</span>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @if ($staff->status === 'aktif')
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
                                        <a href="{{ route('hr.staff.edit', $staff->id) }}" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 0.375rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.color='#0284c7'; this.style.borderColor='#bae6fd'; this.style.background='#f0f9ff'" onmouseout="this.style.color='#64748b'; this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'" title="Edit Staf">
                                            <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                        </a>
                                        <form action="{{ route('hr.staff.destroy', $staff->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data staf ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; border-radius: 0.375rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.color='#ef4444'; this.style.borderColor='#fecaca'; this.style.background='#fef2f2'" onmouseout="this.style.color='#64748b'; this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'" title="Hapus Staf">
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
                                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #e0f2fe, #bae6fd); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                            <svg style="width: 28px; height: 28px; color: #0284c7;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        </div>
                                        <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b; margin: 0;">Belum Ada Data Staf</p>
                                        <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.375rem;">Data pegawai/staf tata usaha akan ditampilkan di sini.</p>
                                        <a href="{{ route('hr.staff.create') }}" style="margin-top: 1rem; display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 0.625rem; text-decoration: none; transition: transform 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                                            Tambah Data Baru
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if (method_exists($staffs, 'hasPages') && $staffs->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                    {{ $staffs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
