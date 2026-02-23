<x-app-layout>
    <div style="max-width: 900px; margin: 0 auto; padding-bottom: 2rem;">
        
        <!-- Header -->
        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 2rem;">
            <div>
                <a href="{{ route('journal.index') }}" style="display: inline-flex; align-items: center; font-size: 0.8125rem; color: #64748b; text-decoration: none; font-weight: 600; margin-bottom: 0.5rem; transition: color 0.2s;" onmouseover="this.style.color='#312e81'" onmouseout="this.style.color='#64748b'">
                    <svg style="width: 1rem; height: 1rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    Kembali ke Riwayat Kas
                </a>
                <h2 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.75rem; color: #0f172a; margin: 0;">Kategori Transaksi (Chart of Accounts)</h2>
                <p style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">Kelola master data pengaturan tipe/kategori kas masuk dan kas keluar.</p>
            </div>
            
            <button onclick="document.getElementById('addModal').style.display='flex'" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #312e81; color: #fff; border-radius: 0.5rem; font-size: 0.875rem; font-weight: 600; text-decoration: none; border: none; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.2s ease;" onmouseover="this.style.background='#1e1b4b'" onmouseout="this.style.background='#312e81'">
                <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                Tambah Kategori
            </button>
        </div>

        @if (session('success'))
            <div style="background: #ecfdf5; border-left: 4px solid #10b981; color: #065f46; padding: 1rem 1.25rem; border-radius: 0.5rem; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                <svg style="width: 1.25rem; height: 1.25rem; color: #10b981; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <div style="font-size: 0.875rem; font-weight: 500;">{{ session('success') }}</div>
            </div>
        @endif
        @if (session('error'))
            <div style="background: #fef2f2; border-left: 4px solid #e11d48; color: #991b1b; padding: 1rem 1.25rem; border-radius: 0.5rem; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                <svg style="width: 1.25rem; height: 1.25rem; color: #e11d48; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <div style="font-size: 0.875rem; font-weight: 500;">{{ session('error') }}</div>
            </div>
        @endif

        <div style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                            <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; width: 60px;">No</th>
                            <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Nama Kategori & Deskripsi</th>
                            <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em;">Tipe</th>
                            <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: center;">Jumlah Transaksi</th>
                            <th style="padding: 1rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; text-align: right; width: 80px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $idx => $cat)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem; font-size: 0.875rem; color: #64748b; font-weight: 500;">{{ $idx + 1 }}</td>
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                                        <span style="font-size: 0.875rem; font-weight: 600; color: #0f172a;">{{ $cat->name }}</span>
                                        <span style="font-size: 0.75rem; color: #64748b;">{{ $cat->description ?? '-' }}</span>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    @if($cat->type === 'in')
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background: #ecfdf5; color: #059669; font-size: 0.6875rem; font-weight: 700; border-radius: 9999px; border: 1px solid #a7f3d0;">
                                            Pemasukan (In)
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; background: #fff1f2; color: #e11d48; font-size: 0.6875rem; font-weight: 700; border-radius: 9999px; border: 1px solid #fecdd3;">
                                            Pengeluaran (Out)
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center; font-size: 0.875rem; font-weight: 600; color: #475569;">
                                    {{ $cat->transactions_count }} Trx
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: right;">
                                    <form action="{{ route('journal.categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        @if($cat->transactions_count > 0)
                                            <button type="button" onclick="alert('Tidak dapat menghapus! Kategori ini sedang digunakan di tabel transaksi jurnal.')" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #f1f5f9; color: #94a3b8; border: 1px solid #e2e8f0; border-radius: 0.375rem; cursor: not-allowed;" title="Terpakai">
                                                <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        @else
                                            <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3; border-radius: 0.375rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ffe4e6'" onmouseout="this.style.background='#fff1f2'" title="Hapus">
                                                <svg style="width: 1rem; height: 1rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 3rem; text-align: center;">
                                    <div style="display: flex; flex-direction: column; align-items: center; gap: 0.75rem;">
                                        <div style="width: 48px; height: 48px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                            <svg style="width: 24px; height: 24px; color: #cbd5e1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                        </div>
                                        <p style="font-size: 0.875rem; color: #64748b; font-weight: 500; margin: 0;">Belum ada master kategori transaksi ditambahkan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div id="addModal" style="display: none; position: fixed; inset: 0; z-index: 50; align-items: center; justify-content: center;">
        <!-- Backdrop -->
        <div style="position: absolute; inset: 0; background: rgba(15,23,42,0.6); backdrop-filter: blur(4px);" onclick="document.getElementById('addModal').style.display='none'"></div>
        
        <!-- Center Box -->
        <div style="background: #fff; width: 100%; max-width: 480px; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); position: relative; z-index: 10; margin: 1.5rem; overflow: hidden; transform: translateY(0); transition: all 0.3s ease;">
            
            <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-family: 'Outfit', sans-serif; font-size: 1.25rem; font-weight: 700; color: #0f172a; margin: 0;">Tambah Master Kategori</h3>
                <button onclick="document.getElementById('addModal').style.display='none'" style="background: transparent; border: none; color: #94a3b8; cursor: pointer; transition: color 0.2s;" onmouseover="this.style.color='#0f172a'" onmouseout="this.style.color='#94a3b8'">
                    <svg style="width: 1.5rem; height: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <form action="{{ route('journal.categories.store') }}" method="POST">
                @csrf
                <div style="padding: 1.5rem; display: flex; flex-direction: column; gap: 1.25rem;">
                    
                    <div>
                        <label for="name" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Kategori <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="name" id="name" required placeholder="Contoh: Operasional Listrik / Dana BOS Pusat" style="width: 100%; box-sizing: border-box; padding: 0.625rem 1rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; color: #1e293b;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                    </div>

                    <div>
                        <label for="type" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Sifat Akun/Tipe <span style="color: #e11d48;">*</span></label>
                        <select name="type" id="type" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 1rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; background: #fff; color: #1e293b;">
                            <option value="" disabled selected>-- Pilih Sifat Akun --</option>
                            <option value="in">Pendapatan / Pemasukan (In)</option>
                            <option value="out">Beban / Pengeluaran (Out)</option>
                        </select>
                    </div>

                    <div>
                        <label for="description" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Keterangan Tambahan (Opsional)</label>
                        <textarea name="description" id="description" rows="2" placeholder="Catatan untuk kategori ini (jika ada)..." style="width: 100%; box-sizing: border-box; padding: 0.75rem 1rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; resize: vertical;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'"></textarea>
                    </div>
                </div>

                <div style="padding: 1.25rem 1.5rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" onclick="document.getElementById('addModal').style.display='none'" style="padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #475569; background: #fff; border: 1px solid #cbd5e1; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">Batal</button>
                    <button type="submit" style="padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: #312e81; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" onmouseover="this.style.background='#1e1b4b'" onmouseout="this.style.background='#312e81'">Simpan Kategori</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
