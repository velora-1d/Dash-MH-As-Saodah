<x-app-layout>
    <div class="space-y-6">
        <!-- Flash Messages -->
        @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.75rem; color: #047857; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
            <svg style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div style="padding: 1rem 1.25rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; color: #b91c1c; font-size: 0.875rem; font-weight: 500; display: flex; align-items: center; gap: 0.5rem;">
            <svg style="width: 18px; height: 18px; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            {{ session('error') }}
        </div>
        @endif
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
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Daftar Ulang Siswa</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Verifikasi siswa yang melanjutkan ke tahun ajaran berikutnya.</p>
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <!-- Filter Tahun Ajaran -->
                        <div style="background: rgba(255,255,255,0.08); padding: 0.375rem; border-radius: 0.625rem; border: 1px solid rgba(255,255,255,0.12);">
                            <form action="{{ route('re-registration.index') }}" method="GET" style="display: flex; align-items: center;">
                                <select name="academic_year_id" onchange="this.form.submit()" style="font-size: 0.75rem; font-weight: 600; color: #fff; border: none; background: transparent; padding: 0.5rem 2rem 0.5rem 0.75rem; cursor: pointer; outline: none; -webkit-appearance: none; appearance: none;">
                                    <option value="" style="color: #1e293b;">Semua Tahun Ajaran</option>
                                    @foreach($academicYears as $year)
                                        <option value="{{ $year->id }}" style="color: #1e293b;" {{ ($activeYear && $activeYear->id == $year->id) ? 'selected' : '' }}>
                                            {{ $year->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                        @if($activeYear)
                        <form action="{{ route('re-registration.generate') }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="academic_year_id" value="{{ $activeYear->id }}">
                            <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; color: #7c3aed; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; background: #fff; border: none; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                                <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                Generate Batch
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('success') }}</div>
        @endif

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
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">L/P</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $index => $reg)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $registrations->firstItem() + $index }}</td>
                            <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b; vertical-align: middle;">{{ $reg->student->name ?? '-' }}</td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="font-size: 0.6875rem; font-weight: 600; color: #7c3aed; background: #ede9fe; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $reg->student->classroom->name ?? '-' }}</span>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($reg->student->gender === 'L')
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #6366f1; background: #eef2ff;">PA</span>
                                @else
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #ec4899; background: #fdf2f8;">PI</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($reg->status === 'pending')
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fef3c7; border-radius: 999px;">⏳ Menunggu</span>
                                @elseif($reg->status === 'confirmed')
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">✓ Terkonfirmasi</span>
                                @else
                                    <span style="padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">✗ Tidak Daftar Ulang</span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($reg->status === 'pending')
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
                                @else
                                    <span style="font-size: 0.6875rem; color: #94a3b8;">—</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">
                                @if($activeYear)
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
            @if($registrations->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                {{ $registrations->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
