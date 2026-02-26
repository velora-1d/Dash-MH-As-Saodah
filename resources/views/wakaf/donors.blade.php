<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #0891b2 0%, #06b6d4 50%, #22d3ee 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Database Muwakif</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Data donatur yang pernah berwakaf.</p>
                        </div>
                    </div>
                    <a href="{{ route('wakaf.index') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.2); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.3);">← Kembali</a>
                </div>
            </div>
        </div>

        <!-- Search -->
        <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1rem 1.5rem;">
            <form action="{{ route('wakaf.donors') }}" method="GET" style="display: flex; gap: 0.75rem;">
                <input type="text" name="search" placeholder="Cari nama donatur..." value="{{ request('search') }}" style="flex: 1; box-sizing: border-box;">
                <button type="submit" style="padding: 0.5rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0891b2, #06b6d4); border: none; border-radius: 0.5rem; cursor: pointer;">Cari</button>
            </form>
        </div>

        <!-- Tabel Donatur -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead><tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Donatur</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kontak</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Transaksi</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Total Donasi</th>
                    </tr></thead>
                    <tbody>
                        @forelse ($donors as $donor)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.875rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                                        <div style="width: 36px; height: 36px; background: linear-gradient(135deg, #cffafe, #a5f3fc); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #0891b2;">{{ strtoupper(substr($donor->name, 0, 1)) }}</div>
                                        <p style="font-weight: 600; font-size: 0.875rem; color: #1e293b; margin: 0;">{{ $donor->name }}</p>
                                    </div>
                                </td>
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; color: #64748b;">{{ $donor->phone ?: '-' }}</td>
                                <td style="padding: 0.875rem 1.5rem; text-align: center;"><span style="font-size: 0.75rem; font-weight: 600; color: #0891b2; background: #cffafe; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $donor->transactions_count }}x</span></td>
                                <td style="padding: 0.875rem 1.5rem; text-align: right; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #059669;">Rp {{ number_format($donor->total_donated ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" style="padding: 3rem; text-align: center; font-size: 0.8125rem; color: #94a3b8;">Belum ada donatur tercatat.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($donors->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">{{ $donors->withQueryString()->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
