<x-app-layout>
    <div class="space-y-6">
        <!-- Flash Messages -->
        
        

        <!-- Statistik Ringkas -->
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

        <!-- Tabel Pendaftar -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Pendaftar PPDB</h4>
            </div>
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
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.375rem;">
                                    <a href="{{ route('ppdb.show', $reg) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Detail</a>
                                    @if($reg->status === 'pending')
                                    <form action="{{ route('ppdb.approve', $reg) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #059669; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Terima</button>
                                    </form>
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
                            <td colspan="6" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">Belum ada pendaftar PPDB untuk tahun ajaran ini.</td>
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
