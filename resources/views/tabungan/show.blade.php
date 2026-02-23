<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Card: Info Siswa & Saldo -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <!-- Decorative Elements -->
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="position: absolute; left: 50%; top: 0; width: 1px; height: 100%; background: rgba(255,255,255,0.08);"></div>
            
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1.5rem;">
                    <!-- Left: Student Info -->
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.25rem; color: #fff; border: 2px solid rgba(255,255,255,0.3);">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">{{ $student->name }}</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.25rem;">{{ $student->classroom ? $student->classroom->name : 'Tanpa Kelas' }} · NISN: {{ $student->nisn ?: '-' }}</p>
                        </div>
                    </div>

                    <!-- Right: Balance & Action -->
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <div style="text-align: right;">
                            <p style="font-size: 0.6875rem; font-weight: 600; color: rgba(255,255,255,0.6); text-transform: uppercase; letter-spacing: 0.08em;">Saldo Tabungan</p>
                            <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.75rem; color: #fff; margin-top: 0.125rem;">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('tabungan.create', $student->id) }}" style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.75rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Transaksi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">
                {{ session('error') }}
            </div>
        @endif

        <!-- Riwayat Mutasi -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Riwayat Mutasi Tabungan</h4>
                </div>
                <a href="{{ route('tabungan.index') }}" style="font-size: 0.75rem; font-weight: 600; color: #6366f1; text-decoration: none; display: inline-flex; align-items: center; gap: 0.25rem;" onmouseover="this.style.color='#4338ca'" onmouseout="this.style.color='#6366f1'">
                    <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali
                </a>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tanggal</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tipe</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Keterangan</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mutations as $m)
                            <tr style="border-bottom: 1px solid #f1f5f9; {{ $m->status === 'void' ? 'opacity: 0.45;' : '' }}transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #475569; white-space: nowrap;">{{ $m->date->format('d M Y') }}</td>
                                <td style="padding: 1rem 1.5rem;">
                                    @if($m->type === 'in')
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                            Setoran
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">
                                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                            Penarikan
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: right; font-size: 0.875rem; font-weight: 700; color: {{ $m->type === 'in' ? '#059669' : '#e11d48' }}; white-space: nowrap;">
                                    {{ $m->type === 'in' ? '+' : '-' }} Rp {{ number_format($m->amount, 0, ',', '.') }}
                                </td>
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #64748b; max-width: 200px; overflow: hidden; text-overflow: ellipsis;">{{ $m->description ?: '-' }}</td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @if($m->status === 'void')
                                        <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #6b7280; background: #e5e7eb; border-radius: 999px;">VOID</span>
                                    @else
                                        <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">Aktif</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @if($m->status === 'active')
                                        <form action="{{ route('tabungan.void', $m->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="button" onclick="confirmVoidTabungan(this)" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 2px 8px rgba(225,29,72,0.15)'" onmouseout="this.style.transform='';this.style.boxShadow=''">
                                                <svg style="width: 0.75rem; height: 0.75rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                                Void
                                            </button>
                                        </form>
                                    @else
                                        <span style="color: #cbd5e1; font-size: 0.75rem;">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 4rem 2rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #ede9fe, #e0e7ff); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                            <svg style="width: 28px; height: 28px; color: #8b5cf6;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                        </div>
                                        <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b; margin: 0;">Belum Ada Transaksi</p>
                                        <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.375rem;">Klik tombol "Transaksi Baru" untuk mencatat setoran atau penarikan pertama.</p>
                                        <a href="{{ route('tabungan.create', $student->id) }}" style="margin-top: 1rem; display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                            Catat Transaksi Pertama
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
