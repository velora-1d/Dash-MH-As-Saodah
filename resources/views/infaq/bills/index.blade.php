<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tagihan Infaq / SPP</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola tagihan bulanan dan status pembayaran siswa.</p>
                        </div>
                    </div>
                    <a href="{{ route('infaq.bills.generate.create') }}" style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.75rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                        Generate Tagihan
                    </a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('error') }}</div>
        @endif

        <!-- Filter Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Filter Data</h4>
            </div>
            <form action="{{ route('infaq.bills.index') }}" method="GET" style="padding: 1.5rem; display: grid; grid-template-columns: repeat(6, 1fr); gap: 1rem; align-items: end;">
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Cari Nama</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama..." style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Kelas</label>
                    <select name="classroom_id" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua</option>
                        @foreach($classrooms as $room)<option value="{{ $room->id }}" {{ request('classroom_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Bulan</label>
                    <select name="month" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua</option>
                        @foreach([1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Mei', 6=>'Jun', 7=>'Jul', 8=>'Agu', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Des'] as $key => $name)<option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}>{{ $name }}</option>@endforeach
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Status</label>
                    <select name="status" style="width: 100%; box-sizing: border-box;">
                        <option value="">Semua</option>
                        <option value="belum_lunas" {{ request('status') == 'belum_lunas' ? 'selected' : '' }}>Belum Lunas</option>
                        <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                        <option value="void" {{ request('status') == 'void' ? 'selected' : '' }}>Void</option>
                    </select>
                </div>
                <div>
                    <button type="submit" style="width: 100%; display: inline-flex; justify-content: center; align-items: center; padding: 0.625rem 1rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                        Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Tagihan</h4>
                </div>
                <span style="font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fef3c7; padding: 0.25rem 0.75rem; border-radius: 999px;">{{ $bills->total() }} Data</span>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Siswa</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kelas</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Periode</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $months = [1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Mei', 6=>'Jun', 7=>'Jul', 8=>'Agu', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Des']; @endphp
                        @forelse ($bills as $index => $bill)
                            <tr style="border-bottom: 1px solid #f1f5f9; {{ $bill->status == 'void' ? 'opacity: 0.45;' : '' }}transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.8125rem; color: #94a3b8; font-weight: 600;">{{ $bills->firstItem() + $index }}</td>
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #b45309;">{{ strtoupper(substr($bill->student->name, 0, 1)) }}</div>
                                        <div>
                                            <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $bill->student->name }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">{{ $bill->student->nisn ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <span style="font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $bill->student->classroom ? $bill->student->classroom->name : '-' }}</span>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $months[$bill->month] }}</p>
                                    <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">{{ $bill->academicYear->name }}</p>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: right;">
                                    @if($bill->nominal <= 0)
                                        <span style="font-weight: 700; font-size: 0.8125rem; color: #059669;">GRATIS</span>
                                    @else
                                        <span style="font-weight: 700; font-size: 0.8125rem; color: #1e293b;">Rp {{ number_format($bill->nominal, 0, ',', '.') }}</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @if($bill->status == 'lunas')
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Lunas
                                        </span>
                                    @elseif($bill->status == 'belum_lunas')
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">
                                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            Belum Lunas
                                        </span>
                                    @else
                                        <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #6b7280; background: #e5e7eb; border-radius: 999px;">Void</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 0.375rem;">
                                        @if($bill->status == 'belum_lunas')
                                            <a href="{{ route('infaq.payments.create', $bill->id) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #059669; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Bayar</a>
                                            <form action="{{ route('infaq.bills.void', $bill->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" onclick="confirmVoid(this)" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Void</button>
                                            </form>
                                        @elseif($bill->status == 'lunas')
                                            <form action="{{ route('infaq.bills.revert', $bill->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                <button type="button" onclick="confirmRevert(this)" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #d97706; background: #fef3c7; border: 1px solid #fde68a; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Buka Kembali</button>
                                            </form>
                                        @else
                                            <span style="color: #cbd5e1;">—</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 4rem 2rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center;">
                                        <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                            <svg style="width: 28px; height: 28px; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </div>
                                        <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b; margin: 0;">Belum Ada Tagihan</p>
                                        <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.375rem;">Generate tagihan terlebih dahulu untuk melihat data di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($bills->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">{{ $bills->links() }}</div>
            @endif
        </div>
    </div>

    <script>
        function confirmVoid(btn) {
            Swal.fire({
                title: 'Void Tagihan?',
                html: '<p style="font-size:0.875rem;color:#475569;">Tagihan ini akan dibatalkan secara permanen.<br>Aksi ini <strong style="color:#e11d48;">tidak bisa dibatalkan</strong>.</p>',
                icon: 'warning', showCancelButton: true, confirmButtonColor: '#e11d48', cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Void', cancelButtonText: 'Batal', reverseButtons: true, focusCancel: true,
            }).then((r) => { if (r.isConfirmed) btn.closest('form').submit(); });
        }
        function confirmRevert(btn) {
            Swal.fire({
                title: 'Buka Kembali?',
                html: '<p style="font-size:0.875rem;color:#475569;">Status tagihan akan dikembalikan ke <strong style="color:#d97706;">Belum Lunas</strong>.</p>',
                icon: 'info', showCancelButton: true, confirmButtonColor: '#d97706', cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Buka', cancelButtonText: 'Batal', reverseButtons: true, focusCancel: true,
            }).then((r) => { if (r.isConfirmed) btn.closest('form').submit(); });
        }
    </script>
</x-app-layout>
