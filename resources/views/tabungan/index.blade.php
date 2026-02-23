<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.75rem;">
                            <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                                <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            </div>
                            <div>
                                <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tabungan Siswa</h2>
                                <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola setoran & penarikan tabungan seluruh siswa aktif.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Filter Kelas -->
                    <form action="{{ route('tabungan.index') }}" method="GET" style="display: flex; align-items: center; gap: 0.5rem;">
                        <select name="classroom_id" onchange="this.form.submit()" style="padding: 0.5rem 2rem 0.5rem 0.75rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border: 1.5px solid rgba(255,255,255,0.3); border-radius: 0.625rem; font-size: 0.8125rem; font-weight: 500; cursor: pointer; outline: none;">
                            <option value="" style="color: #1e293b;">Semua Kelas</option>
                            @foreach($classrooms as $room)
                                <option value="{{ $room->id }}" {{ $classroomId == $room->id ? 'selected' : '' }} style="color: #1e293b;">{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>

        

        <!-- Tabel Siswa -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Siswa & Saldo</h4>
                </div>
                <span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.75rem; border-radius: 999px;">{{ $students->count() }} Siswa</span>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Saldo</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $index => $student)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #94a3b8; font-weight: 600;">{{ $index + 1 }}</td>
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #ede9fe, #e0e7ff); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #6366f1;">
                                            {{ strtoupper(substr($student->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $student->name }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">NISN: {{ $student->nisn ?: '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $student->classroom ? $student->classroom->name : '-' }}</span>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: right;">
                                    @if($student->balance > 0)
                                        <span style="font-weight: 700; font-size: 0.875rem; color: #059669;">Rp {{ number_format($student->balance, 0, ',', '.') }}</span>
                                    @else
                                        <span style="font-weight: 700; font-size: 0.875rem; color: #94a3b8;">Rp {{ number_format($student->balance, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 0.375rem;">
                                        <a href="{{ route('tabungan.show', $student->id) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 2px 8px rgba(99,102,241,0.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                                            <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                            Mutasi
                                        </a>
                                        <a href="{{ route('tabungan.create', $student->id) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #059669; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 2px 8px rgba(5,150,105,0.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                                            <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                            Transaksi
                                        </a>
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
                                        <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.375rem;">Tambahkan data siswa terlebih dahulu di Master Data.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
