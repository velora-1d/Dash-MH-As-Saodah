<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <a href="{{ route('hr.payroll.index') }}" style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3); color: #fff; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 22px; height: 22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        </a>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                Komponen Gaji / Parameter Pendapatan
                            </h2>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">Kelola master data tunjangan dan potongan yang berlaku untuk pegawai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 1.5rem; align-items: start;">
            
            <!-- Area Form Tambah Komponen -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Tambah Komponen Baru</h4>
                </div>

                <form action="{{ route('hr.payroll.components.store') }}" method="POST" style="padding: 1.5rem;">
                    @csrf
                    <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                        <div>
                            <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Nama Komponen</label>
                            <input type="text" name="name" placeholder="Misal: Tunjangan Transport" required style="width: 100%; padding: 0.625rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; transition: border-color 0.15s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e2e8f0'">
                        </div>
                        
                        <div>
                            <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Jenis (Sifat)</label>
                            <select name="type" required style="width: 100%; padding: 0.625rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; outline: none; background: #fff; cursor: pointer;">
                                <option value="earning">Pendapatan / Menambah (+)</option>
                                <option value="deduction">Potongan / Mengurangi (-)</option>
                            </select>
                        </div>

                        <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 6px -1px rgba(14, 165, 233, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            Simpan Parameter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Area Daftar Komponen -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Item Penggajian Bersih</h4>
                    </div>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                        <thead>
                            <tr style="background: #f8fafc;">
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase; letter-spacing: 0.05em;">Nama Komponen</th>
                                <th style="padding: 1rem 1.25rem; text-align: left; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase; letter-spacing: 0.05em;">Tipe</th>
                                <th style="padding: 1rem 1.25rem; text-align: right; font-size: 0.75rem; font-weight: 600; color: #64748b; border-bottom: 1px solid #e2e8f0; text-transform: uppercase; letter-spacing: 0.05em; width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($components as $item)
                            <tr style="transition: background-color 0.15s ease;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                                <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                    <div style="font-weight: 600; color: #334155; font-size: 0.875rem;">{{ $item->name }}</div>
                                </td>
                                <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9;">
                                    @if ($item->type === 'earning')
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #ecfdf5; color: #10b981;">Pendapatan / Plus</span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.625rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #fef2f2; color: #ef4444;">Potongan / Minus</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; text-align: right;">
                                    <form action="{{ route('hr.payroll.components.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komponen ini? Semua pengaturan gaji pegawai yang terkait komponen ini akan terdampak!');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 0.5rem; color: #ef4444; background: #fef2f2; border: 1px solid #fecaca; cursor: pointer; transition: all 0.2s ease;" title="Hapus" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='#fef2f2'">
                                            <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" style="padding: 3rem 1.5rem; text-align: center; color: #94a3b8;">
                                    <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 50%; background: #f1f5f9; margin-bottom: 1rem;">
                                        <svg style="width: 24px; height: 24px; color: #cbd5e1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" /></svg>
                                    </div>
                                    <p style="font-size: 0.875rem; margin: 0;">Belum ada Data Komponen.</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
