<x-app-layout>
    <style>
        .inv-input {
            width: 100%; padding: 0.625rem 1rem; font-size: 0.875rem; 
            border-radius: 0.5rem; outline: none; transition: border-color 0.15s ease;
        }
        .inv-input:focus { border-color: #3b82f6 !important; }
        .inv-input-normal { border: 1px solid #e2e8f0; }
        .inv-input-error { border: 1px solid #f87171; }
        .inv-input-money { padding-left: 2.5rem; }
        .inv-select { background: #ffffff; cursor: pointer; }
        .inv-textarea { resize: vertical; }
        .inv-item-code { font-family: monospace; }
    </style>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z\' fill=\'rgba(255,255,255,0.05)\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); opacity: 0.5;"></div>
            
            <div style="padding: 2.5rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.875rem; color: #ffffff; letter-spacing: -0.025em; margin: 0; line-height: 1.2;">Tambah Aset Inventaris</h2>
                            <p style="color: #e0e7ff; margin: 0.25rem 0 0 0; font-size: 0.95rem; font-weight: 500;">Pencatatan item barang masukan baru ke database</p>
                        </div>
                    </div>
                    <x-back-button href="{{ route('inventory.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="background: #ffffff; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03); border: 1px solid #f1f5f9; overflow: hidden;">
            <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.75rem; background: #faf8fd;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #6366f1); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">Formulir Informasi Aset</h4>
            </div>

            <form action="{{ route('inventory.store') }}" method="POST" style="padding: 2rem;">
                @csrf

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <!-- Nama Barang -->
                    <div>
                        <label for="name" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Nama Aset / Barang <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="inv-input {{ $errors->has('name') ? 'inv-input-error' : 'inv-input-normal' }}"
                            placeholder="Contoh: Meja Guru Kelas 1A, TV Tabung 21 Inch...">
                        @error('name')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kode Barang -->
                    <div>
                        <label for="item_code" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Nomor / Kode Barang (Opsional)</label>
                        <input type="text" name="item_code" id="item_code" value="{{ old('item_code') }}"
                            class="inv-input inv-item-code {{ $errors->has('item_code') ? 'inv-input-error' : 'inv-input-normal' }}"
                            placeholder="INV-0001...">
                        @error('item_code')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori Baru -->
                    <div>
                        <label for="category" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Kategori Aset <span style="color: #ef4444;">*</span></label>
                        <input type="text" name="category" id="category" value="{{ old('category') }}" required list="categories"
                            class="inv-input {{ $errors->has('category') ? 'inv-input-error' : 'inv-input-normal' }}"
                            placeholder="Pilih ketikan Kategori (Elektronik, ATK, Mebel, ...)">
                        <datalist id="categories">
                            <option value="Elektronik">
                            <option value="Mebel / Kayu">
                            <option value="Buku Teks">
                            <option value="Alat Olahraga">
                            <option value="Perlengkapan Kelas">
                            <option value="ATK">
                        </datalist>
                        @error('category')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Lokasi Penempatan -->
                    <div>
                        <label for="location" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Lokasi / Penempatan Ruang (Opsional)</label>
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="inv-input {{ $errors->has('location') ? 'inv-input-error' : 'inv-input-normal' }}"
                            placeholder="Gudang, Ruang TU, Kelas 3B...">
                        @error('location')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kuantitas/Jumlah -->
                    <div>
                        <label for="quantity" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Jumlah Tersedia (Stok) <span style="color: #ef4444;">*</span></label>
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required
                            class="inv-input {{ $errors->has('quantity') ? 'inv-input-error' : 'inv-input-normal' }}">
                        @error('quantity')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status Kondisi -->
                    <div>
                        <label for="condition" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Kondisi Aset Saat Ini <span style="color: #ef4444;">*</span></label>
                        <select name="condition" id="condition" required
                            class="inv-input inv-select {{ $errors->has('condition') ? 'inv-input-error' : 'inv-input-normal' }}">
                            <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik (Pristine)</option>
                            <option value="Rusak Ringan" {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Bisa Digunakan)</option>
                            <option value="Rusak Berat" {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                        @error('condition')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <hr style="margin: 2rem 0; border: 0; border-top: 1px solid #e2e8f0;" />

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <!-- Harga Satuan -->
                    <div>
                        <label for="unit_price" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Harga Penilaian per Unit (Opsional)</label>
                        <div style="position: relative;">
                            <div style="position: absolute; top: 50%; transform: translateY(-50%); left: 1rem; color: #64748b; font-size: 0.875rem; font-weight: 600;">Rp</div>
                            <input type="number" name="unit_price" id="unit_price" value="{{ old('unit_price') }}" min="0" step="1000"
                                class="inv-input inv-input-money {{ $errors->has('unit_price') ? 'inv-input-error' : 'inv-input-normal' }}">
                        </div>
                        @error('unit_price')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Pengadaan -->
                    <div>
                        <label for="acquire_date" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Tanggal Diperoleh / Pembelian</label>
                        <input type="date" name="acquire_date" id="acquire_date" value="{{ old('acquire_date') }}"
                            class="inv-input {{ $errors->has('acquire_date') ? 'inv-input-error' : 'inv-input-normal' }}">
                        @error('acquire_date')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div style="grid-column: 1 / -1;">
                        <label for="notes" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">Spesifikasi Detail atau Catatan Lain</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="inv-input inv-textarea {{ $errors->has('notes') ? 'inv-input-error' : 'inv-input-normal' }}"
                            placeholder="Merek ASUS Seri VivoBookX, Bantuan CSR Tahun 2021...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p style="color: #ef4444; font-size: 0.75rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                    <a href="{{ route('inventory.index') }}" style="padding: 0.5rem 1.25rem; font-size: 0.875rem; font-weight: 600; color: #475569; text-decoration: none; border-radius: 0.5rem; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='transparent'">Batal</a>
                    <button type="submit" style="padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #ffffff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 8px -1px rgba(59, 130, 246, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(59, 130, 246, 0.2)'">Log Transaksi & Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
