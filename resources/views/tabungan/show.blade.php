<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Card: Info Siswa & Saldo -->
        <div style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); border-radius: 1.25rem; overflow: hidden; position: relative; box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.3);">
            <!-- Decorative Elements -->
            <div style="position: absolute; right: -5%; top: -20%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>
            <div style="position: absolute; left: -10%; bottom: -30%; width: 250px; height: 250px; background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 70%); border-radius: 50%;"></div>
            
            <div style="padding: 2.5rem 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 2rem;">
                    <!-- Left: Student Info -->
                    <div style="display: flex; align-items: center; gap: 1.25rem;">
                        <div style="width: 70px; height: 70px; background: rgba(255,255,255,0.2); backdrop-filter: blur(12px); border-radius: 1.25rem; display: flex; align-items: center; justify-content: center; font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 2rem; color: #fff; box-shadow: inset 0 2px 4px rgba(255,255,255,0.2), 0 4px 10px rgba(0,0,0,0.1);">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <div>
                            <p style="font-size: 0.8125rem; font-weight: 600; color: rgba(255,255,255,0.8); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 0.25rem;">Profil Penabung</p>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #fff; margin: 0; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">{{ $student->name }}</h2>
                            <div style="display: flex; gap: 0.75rem; margin-top: 0.5rem;">
                                <span style="display: inline-flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: rgba(255,255,255,0.2); padding: 0.25rem 0.625rem; border-radius: 999px;">
                                    <svg style="width: 12px; height: 12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    Kelas {{ $student->classroom ? $student->classroom->name : '-' }}
                                </span>
                                <span style="display: inline-flex; align-items: center; gap: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: rgba(255,255,255,0.2); padding: 0.25rem 0.625rem; border-radius: 999px;">
                                    <svg style="width: 12px; height: 12px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                                    NISN: {{ $student->nisn ?: '-' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Balance & Action -->
                    <div style="display: flex; align-items: center; gap: 2rem; background: rgba(0,0,0,0.15); padding: 1.25rem 1.5rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.1);">
                        <div>
                            <p style="font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.8); text-transform: uppercase; letter-spacing: 0.1em; margin: 0 0 0.25rem 0;">Total Saldo Aktif</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 2rem; color: #fff; margin: 0; line-height: 1;">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('tabungan.create', $student->id) }}" style="display: flex; flex-direction: column; align-items: center; justify-content: center; width: 56px; height: 56px; background: #fff; color: #6366f1; border-radius: 1rem; text-decoration: none; transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.2s ease;" onmouseover="this.style.transform='scale(1.05) translateY(-2px)'; this.style.boxShadow='0 10px 20px rgba(0,0,0,0.2)'" onmouseout="this.style.transform='none'; this.style.boxShadow='none'" title="Tambah Transaksi Baru">
                            <svg style="width: 24px; height: 24px; stroke-width: 2.5;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        
        

        <!-- Riwayat Mutasi -->
        <div style="background: #fff; border-radius: 1.25rem; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);">
            <div style="padding: 1.5rem 2rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between; background: #fafafa;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 10px; height: 10px; background: linear-gradient(135deg, #4f46e5, #7c3aed); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">Riwayat Mutasi Tabungan</h4>
                </div>
                <a href="{{ route('tabungan.index') }}" style="font-size: 0.8125rem; font-weight: 600; color: #6366f1; text-decoration: none; display: inline-flex; align-items: center; gap: 0.375rem; transition: color 0.15s ease;" onmouseover="this.style.color='#4338ca'" onmouseout="this.style.color='#6366f1'">
                    <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali Ke Daftar
                </a>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f8fafc;">
                            <th style="padding: 1rem 2rem; text-align: left; font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #e2e8f0;">Tanggal</th>
                            <th style="padding: 1rem 2rem; text-align: left; font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #e2e8f0;">Tipe Transaksi</th>
                            <th style="padding: 1rem 2rem; text-align: right; font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #e2e8f0;">Nominal</th>
                            <th style="padding: 1rem 2rem; text-align: left; font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #e2e8f0;">Keterangan</th>
                            <th style="padding: 1rem 2rem; text-align: center; font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #e2e8f0;">Status</th>
                            <th style="padding: 1rem 2rem; text-align: center; font-size: 0.6875rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.08em; border-bottom: 2px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mutations as $m)
                            <tr @style([
                                'border-bottom: 1px solid #f1f5f9',
                                'transition: all 0.2s ease',
                                'background: #fafaf9' => $m->status === 'void',
                                'opacity: 0.6' => $m->status === 'void'
                            ]) onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='{{ $m->status === 'void' ? '#fafaf9' : 'transparent' }}'">
                                <td style="padding: 1.25rem 2rem; font-size: 0.875rem; font-weight: 500; color: #475569; white-space: nowrap;">{{ $m->date->format('d M Y') }}</td>
                                <td style="padding: 1.25rem 2rem;">
                                    @if ($m->type === 'in')
                                        <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.375rem 0.875rem; font-size: 0.75rem; font-weight: 700; color: #059669; background: #d1fae5; border-radius: 999px; border: 1px solid #a7f3d0;">
                                            <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                            Setoran
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.375rem 0.875rem; font-size: 0.75rem; font-weight: 700; color: #e11d48; background: #ffe4e6; border-radius: 999px; border: 1px solid #fecdd3;">
                                            <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                            Penarikan
                                        </span>
                                    @endif
                                </td>
                                <td @style([
                                    'padding: 1.25rem 2rem',
                                    'text-align: right',
                                    'font-size: 0.9375rem',
                                    'font-weight: 800',
                                    'white-space: nowrap',
                                    'color: #059669' => $m->type === 'in',
                                    'color: #e11d48' => $m->type !== 'in'
                                ])>
                                    {{ $m->type === 'in' ? '+' : '-' }} Rp {{ number_format($m->amount, 0, ',', '.') }}
                                </td>
                                <td style="padding: 1.25rem 2rem; font-size: 0.875rem; color: #64748b; max-width: 250px; overflow: hidden; text-overflow: ellipsis;">{{ $m->description ?: '-' }}</td>
                                <td style="padding: 1.25rem 2rem; text-align: center;">
                                    @if ($m->status === 'void')
                                        <span style="display: inline-flex; padding: 0.375rem 0.75rem; font-size: 0.75rem; font-weight: 700; color: #64748b; background: #e2e8f0; border-radius: 999px;">VOID</span>
                                    @else
                                        <span style="display: inline-flex; padding: 0.375rem 0.75rem; font-size: 0.75rem; font-weight: 700; color: #047857; background: #d1fae5; border-radius: 999px; border: 1px solid #10b981;">Aktif</span>
                                    @endif
                                </td>
                                <td style="padding: 1.25rem 2rem; text-align: center;">
                                    @if ($m->status === 'active')
                                        <form action="{{ route('tabungan.void', $m->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="button" onclick="confirmVoidTabungan(this)" style="display: inline-flex; align-items: center; padding: 0.5rem 0.875rem; font-size: 0.75rem; font-weight: 700; color: #e11d48; background: #fff1f2; border: 1.5px solid #fecdd3; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#ffe4e6';this.style.borderColor='#fda4af'" onmouseout="this.style.background='#fff1f2';this.style.borderColor='#fecdd3'">
                                                <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @else
                                        <span style="color: #cbd5e1; font-size: 1rem; font-weight: 700;">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 5rem 2rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #eef2ff, #e0e7ff); border-radius: 1.5rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem; box-shadow: inset 0 2px 4px rgba(255,255,255,0.5), 0 4px 6px rgba(99,102,241,0.1);">
                                            <svg style="width: 36px; height: 36px; color: #6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                        </div>
                                        <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.125rem; color: #1e293b; margin: 0;">Belum Ada Transaksi</p>
                                        <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.5rem; max-width: 300px;">Klik tombol "Transaksi Baru" untuk mencatat setoran atau penarikan pertama siswa ini.</p>
                                        <a href="{{ route('tabungan.create', $student->id) }}" style="margin-top: 1.5rem; display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #4f46e5, #7c3aed); color: #fff; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 6px rgba(99,102,241,0.2); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 6px 12px rgba(99,102,241,0.3)'" onmouseout="this.style.transform='none';this.style.boxShadow='0 4px 6px rgba(99,102,241,0.2)'">
                                            <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
                                            Transaksi Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmVoidTabungan(btn) {
            Swal.fire({
                title: 'Void Transaksi?',
                html: '<p style="font-size:0.875rem;color:#475569;">Transaksi ini akan dibatalkan dan saldo disesuaikan kembali.<br>Aksi ini <strong style="color:#e11d48;">tidak bisa dibatalkan</strong>.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Void',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }
    </script>
</x-app-layout>
