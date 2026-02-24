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
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ ($activeYear && $activeYear->id == $year->id) ? 'selected' : '' }} style="color: #1e293b;">{{ $year->name }}</option>
                                @endforeach
                            </select>
                        </form>
                        
                        @if($activeYear)
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
                                @if($reg->registration_source === 'online')
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #0ea5e9; background: #f0f9ff; border: 1px solid #bae6fd;">Website</span>
                                @else
                                <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #64748b; background: #f8fafc; border: 1px solid #e2e8f0;">Manual</span>
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
                            <td style="padding: 1rem 1.5rem; text-align: left; vertical-align: top;">
                                @if($reg->registrationPayment)
                                <div style="display: flex; flex-direction: column; gap: 0.375rem; min-width: 140px;">
                                    @php $rp = $reg->registrationPayment; @endphp
                                    <button class="admin-badge {{ $rp->is_fee_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_fee_paid">
                                        <span>Daftar Ulang</span>
                                        <span class="indicator">{!! $rp->is_fee_paid ? '&#10003;' : '&#8722;' !!}</span>
                                    </button>
                                    <div style="display: flex; gap: 0.25rem;">
                                        <button class="admin-badge {{ $rp->is_books_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_books_paid" title="Bayar Lunas" style="flex:1;">
                                            <span>Buku (Rp)</span><span class="indicator">{!! $rp->is_books_paid ? '&#10003;' : '&#8722;' !!}</span>
                                        </button>
                                        <button class="admin-badge {{ $rp->is_books_received ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_books_received" title="Sudah Diambil" style="flex:1;">
                                            <span>Ambil</span><span class="indicator">{!! $rp->is_books_received ? '&#10003;' : '&#8722;' !!}</span>
                                        </button>
                                    </div>
                                    <div style="display: flex; gap: 0.25rem;">
                                        <button class="admin-badge {{ $rp->is_uniform_paid ? 'admin-active' : '' }}" data-id="{{ $rp->id }}" data-field="is_uniform_paid" title="Bayar Lunas" style="flex:1;">
                                            <span>Baju (Rp)</span><span class="indicator">{!! $rp->is_uniform_paid ? '&#10003;' : '&#8722;' !!}</span>
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
                            <td colspan="8" style="padding: 3rem 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-style: italic;">
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

            fetch('/quick-payment/' + paymentId + '/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ field: field })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    btn.classList.toggle('admin-active', data.value);
                    const indicator = btn.querySelector('.indicator');
                    if (indicator) {
                        indicator.innerHTML = data.value ? '&#10003;' : '&#8722;';
                    }
                    btn.style.transform = 'scale(1.02)';
                    setTimeout(() => btn.style.transform = '', 150);
                }
            })
            .catch(() => {
                Swal.fire('Error', 'Gagal menyimpan perubahan.', 'error');
            });
        });
    </script>
</x-app-layout>
