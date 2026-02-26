<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z\' fill=\'rgba(255,255,255,0.05)\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); opacity: 0.5;"></div>
            
            <div style="padding: 2.5rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <div style="width: 4rem; height: 4rem; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border-radius: 1rem; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                            <svg style="width: 2rem; height: 2rem; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.875rem; color: #ffffff; letter-spacing: -0.025em; margin: 0; line-height: 1.2;">Inventaris MII As-Saodah</h2>
                            <p style="color: #e0e7ff; margin: 0.25rem 0 0 0; font-size: 0.95rem; font-weight: 500;">Pencatatan & Pengelolaan Aset Barang Madrasah</p>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 1rem 1.5rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.2); text-align: right;">
                        <span style="display: block; color: #e0e7ff; font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Total Nilai Aset</span>
                        <div style="display: flex; align-items: baseline; gap: 0.25rem; justify-content: flex-end;">
                            <span style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #ffffff;">Rp {{ number_format($inventories->sum(fn($q) => $q->quantity * $q->unit_price), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

        <!-- Tabel Inventaris -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #6366f1); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Aset</h4>
                    <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.25rem 0.625rem; border-radius: 999px; color: #3b82f6; background: #eff6ff;">{{ $inventories->total() }} item</span>
                </div>
                <a href="{{ route('inventory.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 0.625rem; text-decoration: none; text-transform: uppercase; letter-spacing: 0.05em; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                    <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                    Tambah Aset
                </a>
            </div>

            <!-- Filter & Search -->
            <div style="padding: 1rem 1.5rem; background: #f8fafc; border-bottom: 1px solid #f1f5f9;">
                <form method="GET" action="{{ route('inventory.index') }}" style="display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: center;">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, kode, lokasi..."
                           style="flex: 1; min-width: 200px; padding: 0.5rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e2e8f0'">
                    <select name="category" style="padding: 0.5rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none; background: #fff;">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                    <select name="condition" style="padding: 0.5rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none; background: #fff;">
                        <option value="">Semua Kondisi</option>
                        <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ request('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    <button type="submit" style="padding: 0.5rem 1rem; background: #3b82f6; color: #fff; border: none; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; cursor: pointer;">Filter</button>
                    @if (request('search') || request('category') || request('condition'))
                        <a href="{{ route('inventory.index') }}" style="padding: 0.5rem 1rem; background: #f1f5f9; color: #64748b; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; text-decoration: none;">Reset</a>
                    @endif
                </form>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama Barang</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kategori</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Jumlah</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kondisi</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nilai Total</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: right; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($inventories as $i => $item)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1.25rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600;">{{ $inventories->firstItem() + $i }}</td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $item->name }}</p>
                                @if ($item->item_code)
                                <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">{{ $item->item_code }}</p>
                                @endif
                                @if ($item->location)
                                <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">{{ $item->location }}</p>
                                @endif
                            </td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <span style="background: #f1f5f9; color: #475569; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ $item->category }}
                                </span>
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: center; font-weight: 700; font-size: 1rem; color: #334155;">
                                {{ $item->quantity }}
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: center;">
                                @if ($item->condition == 'Baik')
                                    <span style="background: rgba(34, 197, 94, 0.1); color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center;">
                                        Pristine / Baik
                                    </span>
                                @elseif ($item->condition == 'Rusak Ringan')
                                    <span style="background: rgba(245, 158, 11, 0.1); color: #b45309; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center;">
                                        Rusak Ringan
                                    </span>
                                @else
                                    <span style="background: rgba(239, 68, 68, 0.1); color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center;">
                                        Rusak Berat
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: right; font-variant-numeric: tabular-nums;">
                                <div style="font-weight: 700; color: #1e293b;">@if ($item->unit_price) Rp {{ number_format($item->quantity * $item->unit_price, 0, ',', '.') }} @else <span style="color:#cbd5e1">-</span> @endif</div>
                                @if ($item->unit_price)
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;">(Rp {{ number_format($item->unit_price, 0, ',', '.') }} / item)</div>
                                @endif
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: right;">
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('inventory.edit', $item) }}" style="padding: 0.375rem 0.75rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; color: #3b82f6; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#eff6ff'; this.style.borderColor='#bfdbfe';" onmouseout="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0';">Edit</a>
                                    
                                    <form action="{{ route('inventory.destroy', $item) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus / menulis-hapus (write-off) barang ini? Data akan ditarik dari sirkulasi (Soft Delete) namun terekam di Log.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 0.375rem 0.75rem; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; color: #e11d48; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ffe4e6'; this.style.borderColor='#fda4af';" onmouseout="this.style.background='#fff1f2'; this.style.borderColor='#fecdd3';">Write-off</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="padding: 4rem 1.5rem; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <div style="width: 4rem; height: 4rem; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                        <svg style="width: 2rem; height: 2rem; color: #94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0 0 0.25rem 0;">Aset Inventaris Kosong</h3>
                                    <p style="color: #64748b; font-size: 0.875rem; margin: 0; max-width: 300px;">Belum ada data barang atau aset yang teregistrasi. Silakan tambahkan aset baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if ($inventories->hasPages())
            <div style="padding: 1rem 1.5rem; background: #f8fafc; border-top: 1px solid #f1f5f9;">
                {{ $inventories->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
