<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tujuan Wakaf</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola mapping penggunaan dana wakaf.</p>
                        </div>
                    </div>
                    <a href="{{ route('wakaf.index') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.2); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.3);">← Kembali</a>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('error') }}</div>
        @endif

        <!-- Form Tambah -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #7c3aed, #8b5cf6); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Tambah Tujuan Baru</h4>
            </div>
            <form action="{{ route('wakaf.purposes.store') }}" method="POST" style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr auto; gap: 1rem; align-items: end;">
                @csrf
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem;">Nama Tujuan <span style="color: #e11d48;">*</span></label>
                    <input type="text" name="name" required placeholder="Misal: Pembangunan Masjid" style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.375rem;">Target Dana <span style="color: #94a3b8; font-weight: 400;">(Opsional)</span></label>
                    <input type="number" name="target_amount" min="0" step="100000" placeholder="100000000" style="width: 100%; box-sizing: border-box;">
                </div>
                <button type="submit" style="padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #7c3aed, #6d28d9); border: none; border-radius: 0.5rem; cursor: pointer; white-space: nowrap; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">+ Tambah</button>
            </form>
        </div>

        <!-- Daftar Tujuan -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 1rem;">
            @forelse($purposes as $purpose)
                @php
                    $collected = $purpose->collected ?? 0;
                    $target = $purpose->target_amount;
                    $pct = ($target && $target > 0) ? min(100, round(($collected / $target) * 100, 1)) : null;
                @endphp
                <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1.25rem; position: relative; overflow: hidden;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                        <div>
                            <h5 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b; margin: 0;">{{ $purpose->name }}</h5>
                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.25rem;">{{ $purpose->transactions_count ?? 0 }} transaksi</p>
                        </div>
                        @if(($purpose->transactions_count ?? 0) === 0)
                            <form action="{{ route('wakaf.purposes.destroy', $purpose->id) }}" method="POST" onsubmit="return confirm('Hapus tujuan ini?');">@csrf @method('DELETE')
                                <button type="submit" style="font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.375rem; padding: 0.25rem 0.5rem; cursor: pointer;">Hapus</button>
                            </form>
                        @endif
                    </div>
                    <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.25rem; color: #059669; margin: 0;">Rp {{ number_format($collected, 0, ',', '.') }}</p>
                    @if($target)
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.25rem;">Target: Rp {{ number_format($target, 0, ',', '.') }}</p>
                        <div style="margin-top: 0.75rem; height: 6px; background: #e2e8f0; border-radius: 999px; overflow: hidden;">
                            <div style="height: 100%; width: {{ $pct }}%; background: linear-gradient(90deg, #059669, #10b981); border-radius: 999px; transition: width 0.3s ease;"></div>
                        </div>
                        <p style="font-size: 0.6875rem; font-weight: 600; color: #059669; margin-top: 0.375rem;">{{ $pct }}% tercapai</p>
                    @endif
                </div>
            @empty
                <div style="grid-column: span 3; padding: 3rem; text-align: center; background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                    <p style="font-size: 0.875rem; color: #94a3b8;">Belum ada tujuan wakaf. Tambahkan di form atas.</p>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
