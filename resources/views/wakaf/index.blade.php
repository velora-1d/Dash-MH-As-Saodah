<x-app-layout>
    <div class="space-y-6">
        <!-- Hero -->
        <div style="background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Wakaf & Donasi</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola penerimaan wakaf dari para muwakif.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('wakaf.donors') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.25); transition: all 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Donatur
                        </a>
                        <a href="{{ route('wakaf.purposes') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.25); transition: all 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                            Tujuan
                        </a>
                        <a href="{{ route('wakaf.create') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.25); backdrop-filter: blur(10px); color: #fff; border-radius: 0.5rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.4); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.4)'" onmouseout="this.style.background='rgba(255,255,255,0.25)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Terima Wakaf
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
            <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1.25rem;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Total Wakaf</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #059669; margin-top: 0.25rem;">Rp {{ number_format($totalWakaf, 0, ',', '.') }}</p>
            </div>
            <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1.25rem;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Bulan Ini</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #0ea5e9; margin-top: 0.25rem;">Rp {{ number_format($thisMonth, 0, ',', '.') }}</p>
            </div>
            <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1.25rem;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Total Donatur</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #6366f1; margin-top: 0.25rem;">{{ $totalDonors }}</p>
            </div>
            <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1.25rem;">
                <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Tujuan Wakaf</p>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #d97706; margin-top: 0.25rem;">{{ $totalPurposes }}</p>
            </div>
        </div>

        @if (session('success'))
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; color: #065f46; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">{{ session('error') }}</div>
        @endif

        <!-- Filter -->
        <div style="background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; padding: 1rem 1.5rem;">
            <form action="{{ route('wakaf.index') }}" method="GET" style="display: flex; align-items: center; gap: 0.75rem;">
                <label style="font-size: 0.8125rem; font-weight: 600; color: #374151; white-space: nowrap;">Filter Tujuan:</label>
                <select name="purpose_id" onchange="this.form.submit()" style="flex: 1; max-width: 300px; box-sizing: border-box;">
                    <option value="">Semua Tujuan</option>
                    @foreach($purposes as $p)<option value="{{ $p->id }}" {{ request('purpose_id') == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>@endforeach
                </select>
            </form>
        </div>

        <!-- Tabel Transaksi -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #059669, #10b981); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Riwayat Penerimaan Wakaf</h4>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead><tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tanggal</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Donatur</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Tujuan</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nominal</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                    </tr></thead>
                    <tbody>
                        @forelse($transactions as $trx)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; color: #1e293b; font-weight: 500;">{{ $trx->transaction_date?->format('d M Y') ?? '-' }}</td>
                                <td style="padding: 0.875rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                                        <div style="width: 32px; height: 32px; background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.75rem; color: #059669;">{{ strtoupper(substr($trx->wakafDonor->name ?? '?', 0, 1)) }}</div>
                                        <div>
                                            <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0;">{{ $trx->wakafDonor->name ?? '-' }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.0625rem;">{{ $trx->wakafDonor->phone ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 0.875rem 1.5rem;"><span style="font-size: 0.75rem; font-weight: 600; color: #0f766e; background: #ccfbf1; padding: 0.25rem 0.625rem; border-radius: 999px;">{{ $trx->wakafPurpose->name ?? '-' }}</span></td>
                                <td style="padding: 0.875rem 1.5rem; text-align: right; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #059669;">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                                <td style="padding: 0.875rem 1.5rem; text-align: center;">
                                    @if($trx->status === 'valid')
                                        <span style="font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; padding: 0.25rem 0.5rem; border-radius: 999px;">Valid</span>
                                    @else
                                        <span style="font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #ffe4e6; padding: 0.25rem 0.5rem; border-radius: 999px;">Void</span>
                                    @endif
                                </td>
                                <td style="padding: 0.875rem 1.5rem; text-align: center;">
                                    @if($trx->status === 'valid')
                                        <form action="{{ route('wakaf.void', $trx->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin void transaksi ini?');">
                                            @csrf
                                            <button type="submit" style="font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; padding: 0.375rem 0.75rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Void</button>
                                        </form>
                                    @else
                                        <span style="font-size: 0.6875rem; color: #94a3b8;">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" style="padding: 4rem 2rem; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center;">
                                    <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #d1fae5, #a7f3d0); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                        <svg style="width: 28px; height: 28px; color: #059669;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>
                                    </div>
                                    <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.9375rem; color: #1e293b;">Belum Ada Transaksi</p>
                                    <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.25rem;">Catat penerimaan wakaf pertama.</p>
                                    <a href="{{ route('wakaf.create') }}" style="margin-top: 1rem; display: inline-flex; align-items: center; padding: 0.5rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #059669, #10b981); border-radius: 0.5rem; text-decoration: none;">+ Terima Wakaf</a>
                                </div>
                            </td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transactions->hasPages())
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">{{ $transactions->withQueryString()->links() }}</div>
            @endif
        </div>
    </div>
</x-app-layout>
