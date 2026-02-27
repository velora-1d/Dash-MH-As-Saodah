<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #ffffff; margin: 0;">Update Kondisi Aset</h2>
                            <p style="color: rgba(255,255,255,0.7); margin: 0.25rem 0 0 0; font-size: 0.8125rem;">Ubah rincian aset: <strong style="color:white">{{ $inventory->name }}</strong></p>
                        </div>
                    </div>
                    <x-back-button href="{{ route('inventory.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div class="fi-section-dot"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Form Spesifikasi Aset</h4>
            </div>

            <form action="{{ route('inventory.update', $inventory->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Info Sistem -->
                <div style="margin: 1.5rem 2rem 0; background: #eff6ff; border-left: 4px solid #3b82f6; padding: 1rem; border-radius: 0 0.5rem 0.5rem 0;">
                    <p style="margin: 0; color: #1e3a8a; font-size: 0.8125rem; font-weight: 500;"><strong>Catatan Sistem:</strong> Perubahan pada <strong>Jumlah Stok</strong> atau <strong>Kondisi</strong> akan dicatat otomatis ke Log Rekam Jejak Inventaris.</p>
                </div>

                <div style="padding: 2rem;">
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Nama Aset / Barang" name="name" :required="true">
                            <input type="text" name="name" id="name" value="{{ old('name', $inventory->name) }}" required
                                placeholder="Contoh: Meja Guru Kelas 1A..."
                                class="fi-input @error('name') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Nomor / Kode Barang" name="item_code" hint="Opsional">
                            <input type="text" name="item_code" id="item_code" value="{{ old('item_code', $inventory->item_code) }}"
                                placeholder="INV-0001..." style="font-family: monospace;"
                                class="fi-input @error('item_code') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Kategori Aset" name="category" :required="true">
                            <input type="text" name="category" id="category" value="{{ old('category', $inventory->category) }}" required list="categories"
                                placeholder="Pilih atau ketik (Elektronik, ATK, Mebel...)"
                                class="fi-input @error('category') fi-error @enderror">
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
                            <input type="text" name="location" id="location" value="{{ old('location', $inventory->location) }}"
                                placeholder="Gudang, Ruang TU, Kelas 3B..."
                                class="fi-input @error('location') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Jumlah Tersedia (Stok)" name="quantity" :required="true">
                            <div style="position: relative;">
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity', $inventory->quantity) }}" min="0" required
                                    class="fi-input @error('quantity') fi-error @enderror">
                                <span style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); font-size: 0.75rem; color: #64748b;">(Saat ini: {{ $inventory->quantity }})</span>
                            </div>
                        </x-form-group>

                        <x-form-group label="Kondisi Aset Saat Ini" name="condition" :required="true">
                            <select name="condition" id="condition" required class="fi-input fi-select @error('condition') fi-error @enderror">
                                <option value="Baik" {{ old('condition', $inventory->condition) == 'Baik' ? 'selected' : '' }}>Baik (Pristine)</option>
                                <option value="Rusak Ringan" {{ old('condition', $inventory->condition) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Bisa Digunakan)</option>
                                <option value="Rusak Berat" {{ old('condition', $inventory->condition) == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                            </select>
                        </x-form-group>
                    </div>

                    <hr style="margin: 1.5rem 0; border: 0; border-top: 1px solid #e2e8f0;" />

                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Harga Penilaian per Unit" name="unit_price" hint="Opsional">
                            <x-money-input name="unit_price" :value="old('unit_price', $inventory->unit_price ? round($inventory->unit_price) : '')" placeholder="0" />
                        </x-form-group>

                        <x-form-group label="Tanggal Diperoleh / Pembelian" name="acquire_date">
                            <input type="date" name="acquire_date" id="acquire_date" value="{{ old('acquire_date', $inventory->acquire_date) }}"
                                class="fi-input @error('acquire_date') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Spesifikasi Detail atau Catatan Lain" name="notes" class="fi-grid-full">
                            <textarea name="notes" id="notes" rows="3"
                                class="fi-input fi-textarea @error('notes') fi-error @enderror">{{ old('notes', $inventory->notes) }}</textarea>
                        </x-form-group>
                    </div>
                </div>

                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('inventory.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Update Aset
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
