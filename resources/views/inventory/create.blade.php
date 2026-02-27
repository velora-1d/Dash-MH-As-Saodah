<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z\' fill=\'rgba(255,255,255,0.05)\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); opacity: 0.5;"></div>
            <div style="padding: 2.5rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.875rem; color: #ffffff; letter-spacing: -0.025em; margin: 0; line-height: 1.2;">Tambah Aset Inventaris</h2>
                        <p style="color: #e0e7ff; margin: 0.25rem 0 0 0; font-size: 0.95rem; font-weight: 500;">Pencatatan item barang masukan baru ke database</p>
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

                {{-- Baris 1: Identitas Barang --}}
                <div class="fi-grid fi-grid-2">
                    <x-form-group label="Nama Aset / Barang" name="name" :required="true">
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                            class="fi-input @error('name') fi-error @enderror"
                            placeholder="Contoh: Meja Guru Kelas 1A, TV Tabung 21 Inch...">
                    </x-form-group>

                    <x-form-group label="Nomor / Kode Barang" name="item_code" hint="Opsional, untuk identifikasi internal">
                        <input type="text" name="item_code" id="item_code" value="{{ old('item_code') }}"
                            class="fi-input @error('item_code') fi-error @enderror"
                            placeholder="INV-0001..." style="font-family: monospace;">
                    </x-form-group>

                    <x-form-group label="Kategori Aset" name="category" :required="true">
                        <input type="text" name="category" id="category" value="{{ old('category') }}" required list="categories"
                            class="fi-input @error('category') fi-error @enderror"
                            placeholder="Ketik atau pilih kategori...">
                        <datalist id="categories">
                            <option value="Elektronik">
                            <option value="Mebel / Kayu">
                            <option value="Buku Teks">
                            <option value="Alat Olahraga">
                            <option value="Perlengkapan Kelas">
                            <option value="ATK">
                        </datalist>
                    </x-form-group>

                    <x-form-group label="Lokasi / Penempatan Ruang" name="location" hint="Opsional">
                        <input type="text" name="location" id="location" value="{{ old('location') }}"
                            class="fi-input @error('location') fi-error @enderror"
                            placeholder="Gudang, Ruang TU, Kelas 3B...">
                    </x-form-group>

                    <x-form-group label="Jumlah Tersedia (Stok)" name="quantity" :required="true">
                        <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required
                            class="fi-input @error('quantity') fi-error @enderror">
                    </x-form-group>

                    <x-form-group label="Kondisi Aset Saat Ini" name="condition" :required="true">
                        <select name="condition" id="condition" required class="fi-input fi-select @error('condition') fi-error @enderror">
                            <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik (Pristine)</option>
                            <option value="Rusak Ringan" {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Bisa Digunakan)</option>
                            <option value="Rusak Berat" {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                    </x-form-group>
                </div>

                {{-- Divider --}}
                <div class="fi-section">
                    <div class="fi-section-title"><span class="fi-section-dot"></span> Informasi Tambahan</div>
                </div>

                {{-- Baris 2: Keuangan & Detail --}}
                <div class="fi-grid fi-grid-2" style="margin-top: 1rem;">
                    <x-form-group label="Harga Penilaian per Unit" name="unit_price" hint="Opsional">
                        <x-money-input name="unit_price" :value="old('unit_price')" placeholder="0" />
                    </x-form-group>

                    <x-form-group label="Tanggal Diperoleh / Pembelian" name="acquire_date">
                        <input type="date" name="acquire_date" id="acquire_date" value="{{ old('acquire_date') }}"
                            class="fi-input @error('acquire_date') fi-error @enderror">
                    </x-form-group>

                    <x-form-group label="Spesifikasi Detail atau Catatan Lain" name="notes" class="fi-grid-full">
                        <textarea name="notes" id="notes" rows="3"
                            class="fi-input fi-textarea @error('notes') fi-error @enderror"
                            placeholder="Merek ASUS Seri VivoBookX, Bantuan CSR Tahun 2021...">{{ old('notes') }}</textarea>
                    </x-form-group>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
                    <a href="{{ route('inventory.index') }}" style="padding: 0.625rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #475569; text-decoration: none; border-radius: 0.625rem; border: 1.5px solid #e2e8f0; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#f1f5f9'" onmouseout="this.style.backgroundColor='transparent'">Batal</a>
                    <button type="submit" style="padding: 0.625rem 1.75rem; font-size: 0.875rem; font-weight: 700; color: #ffffff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 8px -1px rgba(59, 130, 246, 0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(59, 130, 246, 0.2)'">Log Transaksi & Simpan</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
