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
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Manajemen Siswa</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola data siswa, kategorisasi biaya & penempatan kelas.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem; align-items: center; flex-wrap: wrap;">
                        <form action="{{ route('students.index') }}" method="GET" style="display: flex; gap: 0.5rem; align-items: center;">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/NISN..." style="padding: 0.5rem 0.75rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-size: 0.8125rem; width: 180px; outline: none;" class="placeholder-white/60">
                            <select name="classroom_id" onchange="this.form.submit()" style="padding: 0.5rem 2rem 0.5rem 0.75rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-size: 0.8125rem; cursor: pointer; outline: none;">
                                <option value="" style="color: #1e293b;">Semua Kelas</option>
                                @foreach ($classrooms as $cls)<option value="{{ $cls->id }}" {{ request('classroom_id') == $cls->id ? 'selected' : '' }} style="color: #1e293b;">{{ $cls->name }}</option>@endforeach
                            </select>
                        </form>
                        <a href="{{ route('students.export') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Export Data Siswa ke Excel">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Export
                        </a>
                        <a href="{{ route('students.template') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Download Template Import">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                            Template
                        </a>
                        <button onclick="document.getElementById('importModalSiswa').style.display='flex'" style="display: inline-flex; align-items: center; padding: 0.625rem 1rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.6875rem; border: 1.5px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Import Data Siswa dari Excel">
                            <svg style="width: 0.8rem; height: 0.8rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            Import
                        </button>
                        <a href="{{ route('students.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Tambah
                        </a>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Table -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Siswa</h4>
                </div>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kategorisasi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $students->firstItem() + $index }}</td>
                                <td style="padding: 1rem 1.5rem; vertical-align: middle;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #ede9fe, #e0e7ff); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #6366f1;">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                                        <div>
                                            <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $student->name }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">NISN: {{ $student->nisn ?: '-' }} · {{ $student->gender == 'L' ? '♂ Laki-laki' : '♀ Perempuan' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    @php $catColors = ['reguler'=>['#f1f5f9','#475569'], 'yatim'=>['#fef3c7','#92400e'], 'kurang_mampu'=>['#ede9fe','#6b21a8']]; $cc = $catColors[$student->category] ?? ['#f1f5f9','#475569']; @endphp
                                    <span @style([
                                        'display: inline-flex',
                                        'padding: 0.25rem 0.625rem',
                                        'font-size: 0.6875rem',
                                        'font-weight: 600',
                                        'border-radius: 999px',
                                        "background: {$cc[0]}",
                                        "color: {$cc[1]}"
                                    ])>{{ ucfirst(str_replace('_', ' ', $student->category)) }}</span>
                                    <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.375rem;">
                                        SPP: @if ($student->infaq_status == 'gratis')<span style="color: #d97706; font-weight: 600;">Gratis</span>@elseif ($student->infaq_status == 'subsidi')<span style="color: #059669; font-weight: 600;">Subsidi (Rp {{ number_format($student->infaq_nominal, 0, ',', '.') }})</span>@else<span style="color: #64748b;">Bayar Penuh</span>@endif
                                    </p>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    @if ($student->classroom)
                                        <span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $student->classroom->name }}</span>
                                    @else
                                        <span style="font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; padding: 0.25rem 0.625rem; border-radius: 999px;">Tanpa Kelas</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @php $statusColors = ['aktif'=>['#d1fae5','#047857'], 'lulus'=>['#cffafe','#0e7490'], 'pindah'=>['#ffedd5','#c2410c'], 'nonaktif'=>['#e5e7eb','#6b7280']]; $sc = $statusColors[$student->status] ?? ['#e5e7eb','#6b7280']; @endphp
                                    <span @style([
                                        'display: inline-flex',
                                        'padding: 0.25rem 0.625rem',
                                        'font-size: 0.6875rem',
                                        'font-weight: 600',
                                        'border-radius: 999px',
                                        'text-transform: capitalize',
                                        "background: {$sc[0]}",
                                        "color: {$sc[1]}"
                                    ])>{{ $student->status }}</span>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 0.375rem;">
                                        <a href="{{ route('students.show', $student->id) }}" style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #0284c7; background: #e0f2fe; border: 1px solid #7dd3fc; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''"><svg style="width:0.75rem;height:0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg> Detail</a>
                                        <a href="{{ route('students.edit', $student->id) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Edit</a>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin hapus data siswa ini? Semua data terkait akan ikut terhapus.');">
                                            @csrf @method('DELETE')
                                            <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 4rem 2rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #ede9fe, #e0e7ff); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                            <svg style="width: 28px; height: 28px; color: #8b5cf6;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                                        </div>
                                        <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b; margin: 0;">Belum Ada Data Siswa</p>
                                        <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.375rem;">Klik tombol "Tambah" untuk menambahkan data siswa.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($students->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">{{ $students->links() }}</div>
            @endif
        </div>
    </div>
    <style>::placeholder { color: rgba(255,255,255,0.6) !important; }</style>

    <!-- Modal Import Siswa -->
    <div id="importModalSiswa" style="display: none; position: fixed; inset: 0; z-index: 50; align-items: center; justify-content: center; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px);" onclick="if(event.target===this)this.style.display='none'">
        <div style="background: #fff; border-radius: 1rem; padding: 2rem; width: 100%; max-width: 420px; box-shadow: 0 20px 60px rgba(0,0,0,0.3);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0;">Import Data Siswa</h3>
                <button onclick="document.getElementById('importModalSiswa').style.display='none'" style="background: none; border: none; cursor: pointer; color: #94a3b8; font-size: 1.25rem;">✕</button>
            </div>
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.75rem; padding: 1rem; margin-bottom: 1.25rem;">
                <p style="font-size: 0.75rem; color: #166534; margin: 0;">💡 <strong>Tips:</strong> Download template terlebih dahulu agar format kolom sesuai.</p>
                <a href="{{ route('students.template') }}" style="display: inline-flex; align-items: center; margin-top: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #059669; text-decoration: underline;">
                    <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                    Download Template Excel
                </a>
            </div>
            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem;">Pilih File Excel (.xlsx, .xls, .csv)</label>
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required style="width: 100%; box-sizing: border-box; padding: 0.625rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.8125rem; margin-bottom: 1.25rem; background: #f8fafc;">
                <div style="display: flex; gap: 0.75rem; justify-content: flex-end;">
                    <button type="button" onclick="document.getElementById('importModalSiswa').style.display='none'" style="padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; cursor: pointer;">Batal</button>
                    <button type="submit" style="padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer;">Import Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
