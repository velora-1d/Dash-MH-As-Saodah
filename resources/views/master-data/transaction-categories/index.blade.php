<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Kategori Keuangan</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola kategori pemasukan & pengeluaran madrasah.</p>
                        </div>
                    </div>
                    <a href="{{ route('transaction-categories.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah
                    </a>
                </div>
            </div>
        </div>

        
        

        @php $inCats = $categories->where('type', 'in'); $outCats = $categories->where('type', 'out'); @endphp

        <!-- Pemasukan -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: #059669; border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Pemasukan</h4>
                <span style="font-size: 0.6875rem; font-weight: 600; color: #059669; background: #d1fae5; padding: 0.125rem 0.5rem; border-radius: 999px; margin-left: 0.25rem;">{{ $inCats->count() }}</span>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead><tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 30%;">Nama</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 45%;">Keterangan</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 15%;">Aksi</th>
                    </tr></thead>
                    <tbody>
                        @forelse ($inCats as $index => $cat)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b; vertical-align: middle;">{{ $cat->name }}</td>
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; color: #64748b;">{{ $cat->description ?: '-' }}</td>
                                <td style="padding: 0.875rem 1.5rem; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 0.375rem;">
                                        <a href="{{ route('transaction-categories.edit', $cat->id) }}" style="display: inline-flex; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Edit</a>
                                        <form id="delete-form-{{ $cat->id }}" action="{{ route('transaction-categories.destroy', $cat->id) }}" method="POST" style="display: inline;">@csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $cat->id }}','{{ addslashes($cat->name) }}')" style="display: inline-flex; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" style="padding: 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8;">Belum ada kategori pemasukan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pengeluaran -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: #e11d48; border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Pengeluaran</h4>
                <span style="font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #ffe4e6; padding: 0.125rem 0.5rem; border-radius: 999px; margin-left: 0.25rem;">{{ $outCats->count() }}</span>
            </div>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead><tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 30%;">Nama</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 45%;">Keterangan</th>
                        <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 15%;">Aksi</th>
                    </tr></thead>
                    <tbody>
                        @forelse ($outCats as $index => $cat)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">{{ $index + 1 }}</td>
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #1e293b; vertical-align: middle;">{{ $cat->name }}</td>
                                <td style="padding: 0.875rem 1.5rem; font-size: 0.8125rem; color: #64748b;">{{ $cat->description ?: '-' }}</td>
                                <td style="padding: 0.875rem 1.5rem; text-align: center;">
                                    <div style="display: flex; justify-content: center; gap: 0.375rem;">
                                        <a href="{{ route('transaction-categories.edit', $cat->id) }}" style="display: inline-flex; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Edit</a>
                                        <form id="delete-form-{{ $cat->id }}" action="{{ route('transaction-categories.destroy', $cat->id) }}" method="POST" style="display: inline;">@csrf @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $cat->id }}','{{ addslashes($cat->name) }}')" style="display: inline-flex; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" style="padding: 2rem; text-align: center; font-size: 0.8125rem; color: #94a3b8;">Belum ada kategori pengeluaran.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Kategori?',
                html: '<p style="font-size:0.875rem;color:#475569;">Kategori <strong>"' + name + '"</strong> akan dihapus permanen.</p>',
                icon: 'warning', showCancelButton: true, confirmButtonColor: '#e11d48', cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus', cancelButtonText: 'Batal', reverseButtons: true, focusCancel: true,
            }).then((r) => { if (r.isConfirmed) document.getElementById('delete-form-' + id).submit(); });
        }
    </script>
</x-app-layout>
