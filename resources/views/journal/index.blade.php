<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Section Jurnal Umum -->
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #312e81 50%, #4f46e5 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
            <div style="padding: 2.5rem 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: flex-start; justify-content: space-between; gap: 1.5rem;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                            <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.2);">
                                <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0;">Kas & Jurnal Umum</h2>
                        </div>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); max-width: 500px; line-height: 1.5;">Kelola arus kas masuk (BOS, Bantuan) dan keluar (Operasional, Gaji) sekolah secara terpusat.</p>
                    </div>
                    
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('journal.export') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(4px); color: #fff; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'" title="Export Jurnal ke Excel">
                            <svg style="width: 0.9rem; height: 0.9rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                            Export Excel
                        </a>
                        <a href="{{ route('journal.categories') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.15); backdrop-filter: blur(4px); color: #fff; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 600; text-decoration: none; border: 1px solid rgba(255,255,255,0.3); transition: all 0.2s ease;">
                            <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            Kategori Akun
                        </a>
                        <a href="{{ route('journal.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #312e81; border-radius: 0.5rem; font-size: 0.8125rem; font-weight: 700; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.2s ease;">
                            <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Catat Jurnal Baru
                        </a>
                    </div>
                </div>

                <!-- KPI Cards -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-top: 2rem;">
                    <!-- Total Saldo Gabungan -->
                    <div style="background: rgba(255,255,255,0.1); backdrop-filter: blur(12px); border: 1px solid rgba(255,255,255,0.2); padding: 1.25rem; border-radius: 0.75rem;">
                        <p style="font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.7); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Total Saldo Semua Kas</p>
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; font-weight: 800; color: #fff; margin: 0;">Rp {{ number_format($totalBalance, 0, ',', '.') }}</h3>
                    </div>
                    
                    <!-- Pemasukan Bulan Ini -->
                    <div style="background: rgba(16,185,129,0.15); backdrop-filter: blur(12px); border: 1px solid rgba(16,185,129,0.3); padding: 1.25rem; border-radius: 0.75rem;">
                        <p style="font-size: 0.75rem; font-weight: 600; color: #a7f3d0; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Pemasukan (Bulan Ini)</p>
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; font-weight: 800; color: #fff; margin: 0;">Rp {{ number_format($thisMonthIn, 0, ',', '.') }}</h3>
                    </div>
                    
                    <!-- Pengeluaran Bulan Ini -->
                    <div style="background: rgba(225,29,72,0.15); backdrop-filter: blur(12px); border: 1px solid rgba(225,29,72,0.3); padding: 1.25rem; border-radius: 0.75rem;">
                        <p style="font-size: 0.75rem; font-weight: 600; color: #fecdd3; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Pengeluaran (Bulan Ini)</p>
                        <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.5rem; font-weight: 800; color: #fff; margin: 0;">Rp {{ number_format($thisMonthOut, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        
        

        <!-- Filter & Transaksi -->
        <div style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <!-- Header & Filter -->
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #0f172a; margin: 0;">Riwayat Jurnal Kas</h3>
                
                <form action="{{ route('journal.index') }}" method="GET" style="display: flex; gap: 0.5rem;">
                    <select name="type" onchange="this.form.submit()" style="padding: 0.5rem 1rem; font-size: 0.8125rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; color: #475569; background: #fff; outline: none; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                        <option value="">Semua Tipe</option>
                        <option value="in" {{ request('type') == 'in' ? 'selected' : '' }}>Pemasukan (In)</option>
                        <option value="out" {{ request('type') == 'out' ? 'selected' : '' }}>Pengeluaran (Out)</option>
                    </select>
                    
                    <select name="cash_account_id" onchange="this.form.submit()" style="padding: 0.5rem 1rem; font-size: 0.8125rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; color: #475569; background: #fff; outline: none; box-shadow: inset 0 1px 2px rgba(0,0,0,0.05);">
                        <option value="">Semua Rekening Kas</option>
                        @foreach ($cashAccounts as $ca)
                            <option value="{{ $ca->id }}" {{ request('cash_account_id') == $ca->id ? 'selected' : '' }}>{{ $ca->name }}</option>
                        @endforeach
                    </select>

                    @if (request()->anyFilled(['type', 'cash_account_id']))
                        <a href="{{ route('journal.index') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: #f1f5f9; color: #64748b; font-size: 0.8125rem; font-weight: 600; border-radius: 0.5rem; text-decoration: none;">Reset</a>
                    @endif
                </form>
            </div>

            <!-- Tabel Transaksi -->
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 50px; text-align: center;">No</th>
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 120px;">Tgl</th>
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Keterangan & Kategori</th>
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Kas/Rek.</th>
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Penerimaan</th>
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right;">Pengeluaran</th>
                            <th style="padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right; width: 60px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $index => $trx)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $transactions->firstItem() + $index }}</td>
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; color: #1e293b; font-weight: 500; vertical-align: middle;">{{ $trx->date?->format('d M Y') ?? '-' }}</td>
                                <td style="padding: 0.875rem 1.5rem;">
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        @if ($trx->status == 'void')
                                            <span style="font-size: 0.875rem; font-weight: 600; color: #94a3b8; text-decoration: line-through;">{{ preg_replace('/(\s*\|\s*REF:REGPAY_\S+|\s*\[ref:\S+\])/', '', $trx->description ?? 'Tanpa Keterangan') }}</span>
                                        @else
                                            <span style="font-size: 0.875rem; font-weight: 600; color: #0f172a;">{{ preg_replace('/(\s*\|\s*REF:REGPAY_\S+|\s*\[ref:\S+\])/', '', $trx->description ?? 'Tanpa Keterangan') }}</span>
                                        @endif
                                        <span style="font-size: 0.6875rem; color: #64748b; font-weight: 500;">
                                            Tag: {{ $trx->category->name ?? '-' }}
                                        </span>
                                    </div>
                                </td>
                                <td style="padding: 0.875rem 1.5rem;">
                                    <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 999px; font-size: 0.6875rem; font-weight: 600; color: #475569;">
                                        {{ $trx->cashAccount->name ?? '-' }}
                                    </span>
                                </td>
                                <td style="padding: 0.875rem 1.5rem; text-align: right; font-family: 'Outfit', sans-serif;">
                                    @if ($trx->type === 'in')
                                        @if ($trx->status == 'void')
                                            <span style="font-weight: 700; color: #94a3b8;">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                        @else
                                            <span style="font-weight: 700; color: #059669;">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                        @endif
                                    @else
                                        <span style="color: #cbd5e1;">-</span>
                                    @endif
                                </td>
                                <td style="padding: 0.875rem 1.5rem; text-align: right; font-family: 'Outfit', sans-serif;">
                                    @if ($trx->type === 'out')
                                        @if ($trx->status == 'void')
                                            <span style="font-weight: 700; color: #94a3b8;">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                        @else
                                            <span style="font-weight: 700; color: #e11d48;">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                                        @endif
                                    @else
                                        <span style="color: #cbd5e1;">-</span>
                                    @endif
                                </td>
                                <td style="padding: 0.875rem 1.5rem; text-align: right;">
                                    @if ($trx->status === 'valid')
                                        <form action="{{ route('journal.void', $trx->id) }}" method="POST" onsubmit="return confirm('Void jurnal ini? Saldo Kas akan dikembalikan ke kondisi sebelum transaksi.');" style="display: inline;">
                                            @csrf
                                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; border-radius: 0.375rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ffe4e6'" onmouseout="this.style.background='#fff1f2'" title="Void Transaksi">
                                                <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span style="display: inline-flex; padding: 0.25rem 0.5rem; background: #f1f5f9; color: #94a3b8; font-size: 0.625rem; font-weight: 700; border-radius: 0.375rem; text-transform: uppercase;">Void</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 3rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
                                        <div style="width: 48px; height: 48px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <svg style="width: 24px; height: 24px; color: #cbd5e1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        </div>
                                        <p style="font-size: 0.875rem; color: #64748b; font-weight: 500; margin: 0;">Belum ada riwayat jurnal kas ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; background: #fcfcfd;">
                {{ $transactions->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
