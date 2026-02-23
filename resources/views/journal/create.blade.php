<x-app-layout>
    <div class="space-y-6">
        
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #312e81 50%, #4f46e5 100%); border-radius: 1rem; overflow: hidden; position: relative; margin-bottom: 2rem;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0;">Catat Jurnal Kas Baru</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.8); margin-top: 0.125rem;">Masukkan data pemasukan atau pengeluaran operasional.</p>
                        </div>
                    </div>
                    <x-back-button href="{{ route('journal.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        @if (session('error'))
            <div style="background: #fef2f2; border-left: 4px solid #e11d48; color: #991b1b; padding: 1rem 1.25rem; border-radius: 0.5rem; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: 0.75rem;">
                <svg style="width: 1.25rem; height: 1.25rem; color: #e11d48; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                <div style="font-size: 0.875rem; font-weight: 500;">{{ session('error') }}</div>
            </div>
        @endif

        <div style="background: #ffffff; border-radius: 1rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); overflow: hidden;">
            
            <form action="{{ route('journal.store') }}" method="POST">
                @csrf
                
                <!-- Type Selector (In / Out) -->
                <div style="padding: 1.5rem; border-bottom: 1px solid #f1f5f9; background: #f8fafc;">
                    <label style="display: block; font-size: 0.8125rem; font-weight: 700; color: #475569; margin-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em;">Pilih Jenis Transaksi</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <label style="cursor: pointer; position: relative;">
                            <input type="radio" name="type" value="in" id="type_in" {{ old('type') == 'in' ? 'checked' : '' }} required onchange="updateCategories()" style="position: absolute; opacity: 0; width: 0; height: 0;">
                            <div id="card_in" style="padding: 1rem; border: 2px solid #e2e8f0; border-radius: 0.75rem; background: #fff; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 36px; height: 36px; background: #ecfdf5; color: #059669; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                                </div>
                                <div>
                                    <h4 style="font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0;">Pemasukan (In)</h4>
                                    <p style="font-size: 0.75rem; color: #64748b; margin: 0;">Mencatat BOS, Donasi, dll.</p>
                                </div>
                            </div>
                        </label>
                        
                        <label style="cursor: pointer; position: relative;">
                            <input type="radio" name="type" value="out" id="type_out" {{ old('type') == 'out' ? 'checked' : '' }} required onchange="updateCategories()" style="position: absolute; opacity: 0; width: 0; height: 0;">
                            <div id="card_out" style="padding: 1rem; border: 2px solid #e2e8f0; border-radius: 0.75rem; background: #fff; transition: all 0.2s; display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 36px; height: 36px; background: #fff1f2; color: #e11d48; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                    <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                                </div>
                                <div>
                                    <h4 style="font-size: 1rem; font-weight: 700; color: #0f172a; margin: 0;">Pengeluaran (Out)</h4>
                                    <p style="font-size: 0.75rem; color: #64748b; margin: 0;">Mencatat Listrik, Gaji, dll.</p>
                                </div>
                            </div>
                        </label>
                    </div>
                    @error('type')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                </div>

                <!-- Form Inputs -->
                <div style="padding: 2rem 1.5rem;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        
                        <!-- Saldo / Rekening -->
                        <div>
                            <label for="cash_account_id" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Rekening Kas <span style="color: #e11d48;">*</span></label>
                            <div style="position: relative;">
                                <select name="cash_account_id" id="cash_account_id" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 1rem 0.625rem 2.5rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; background: #fff; color: #1e293b; appearance: none;">
                                    <option value="" disabled selected>-- Pilih Rekening Kas --</option>
                                    @foreach($cashAccounts as $cash)
                                        <option value="{{ $cash->id }}" {{ old('cash_account_id') == $cash->id ? 'selected' : '' }}>
                                            {{ $cash->name }} (Saldo: Rp {{ number_format($cash->balance, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                                <svg style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 1.125rem; height: 1.125rem; color: #94a3b8; pointer-events: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                            </div>
                            @error('cash_account_id')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                        </div>

                        <!-- Kategori Kuitansi -->
                        <div>
                            <label for="category_id" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kategori Jurnal <span style="color: #e11d48;">*</span></label>
                            <div style="position: relative;">
                                <select name="category_id" id="category_id" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 1rem 0.625rem 2.5rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; background: #fff; color: #1e293b; appearance: none;">
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" data-type="{{ $cat->type }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 1.125rem; height: 1.125rem; color: #94a3b8; pointer-events: none;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                            </div>
                            @error('category_id')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                        </div>

                        <!-- Nominal -->
                        <div>
                            <label for="amount" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nominal (Rp) <span style="color: #e11d48;">*</span></label>
                            <div style="position: relative;">
                                <span style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); font-weight: 600; color: #64748b;">Rp</span>
                                <input type="number" name="amount" id="amount" required min="100" value="{{ old('amount') }}" placeholder="0" style="width: 100%; box-sizing: border-box; padding: 0.625rem 1rem 0.625rem 2.5rem; font-size: 1rem; font-family: 'Outfit', sans-serif; font-weight: 600; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                            </div>
                            @error('amount')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="date" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tanggal Transaksi <span style="color: #e11d48;">*</span></label>
                            <input type="date" name="date" id="date" required value="{{ old('date', date('Y-m-d')) }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 1rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; color: #1e293b;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
                            @error('date')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div style="margin-top: 1.5rem;">
                        <label for="description" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Keterangan Tambahan / Deskripsi</label>
                        <textarea name="description" id="description" rows="3" placeholder="Tuliskan keterangan detail jurnal ini..." style="width: 100%; box-sizing: border-box; padding: 0.75rem 1rem; font-size: 0.875rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; outline: none; transition: all 0.2s; resize: vertical;" onfocus="this.style.borderColor='#3b82f6'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">{{ old('description') }}</textarea>
                        @error('description')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <!-- Footer Actions -->
                <div style="padding: 1.25rem 1.5rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('journal.index') }}" style="padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 600; color: #475569; background: #fff; border: 1px solid #cbd5e1; border-radius: 0.5rem; cursor: pointer; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">Batal</a>
                    <button type="submit" id="btn_submit" style="padding: 0.625rem 1.5rem; font-size: 0.875rem; font-weight: 600; color: #fff; background: #312e81; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" onmouseover="this.style.background='#1e1b4b'" onmouseout="this.style.background='#312e81'">Simpan Jurnal</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Native Sederhana untuk Logic Toggle Kategori & UI -->
    <script>
        function updateCategories() {
            const isOut = document.getElementById('type_out').checked;
            const isIn = document.getElementById('type_in').checked;
            
            const cardIn = document.getElementById('card_in');
            const cardOut = document.getElementById('card_out');
            const selectCat = document.getElementById('category_id');
            const btnSubmit = document.getElementById('btn_submit');

            // Reset selection categories
            selectCat.value = "";

            if (isIn) {
                // UI styles
                cardIn.style.borderColor = '#10b981';
                cardIn.style.background = '#f0fdf4';
                cardOut.style.borderColor = '#e2e8f0';
                cardOut.style.background = '#fff';
                // Button
                btnSubmit.style.background = '#059669';
                btnSubmit.innerText = "Simpan Pemasukan";
                
                // Filter dropdown
                Array.from(selectCat.options).forEach(opt => {
                    if (opt.value === "") return; // Abaikan option placeholder
                    opt.style.display = opt.getAttribute('data-type') === 'in' ? 'block' : 'none';
                });
            } else if (isOut) {
                cardIn.style.borderColor = '#e2e8f0';
                cardIn.style.background = '#fff';
                cardOut.style.borderColor = '#e11d48';
                cardOut.style.background = '#fff1f2';
                // Button
                btnSubmit.style.background = '#e11d48';
                btnSubmit.innerText = "Simpan Pengeluaran";
                
                // Filter dropdown
                Array.from(selectCat.options).forEach(opt => {
                    if (opt.value === "") return;
                    opt.style.display = opt.getAttribute('data-type') === 'out' ? 'block' : 'none';
                });
            }
        }

        // Jalankan saat load
        document.addEventListener('DOMContentLoaded', updateCategories);
    </script>
</x-app-layout>
