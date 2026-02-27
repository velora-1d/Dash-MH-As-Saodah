<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #1e3a8a 0%, #312e81 50%, #4f46e5 100%); border-radius: 1rem; overflow: hidden; position: relative; margin-bottom: 2rem;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.06); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.04); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0;">Catat Jurnal Kas Baru</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.8); margin-top: 0.125rem;">Masukkan data pemasukan atau pengeluaran operasional.</p>
                    </div>
                    <x-back-button href="{{ route('journal.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

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
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Rekening Kas" name="cash_account_id" :required="true">
                            <div class="fi-icon-wrap">
                                <svg class="fi-icon-left" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                <select name="cash_account_id" id="cash_account_id" required class="fi-input fi-select @error('cash_account_id') fi-error @enderror">
                                    <option value="" disabled selected>-- Pilih Rekening Kas --</option>
                                    @foreach ($cashAccounts as $cash)
                                        <option value="{{ $cash->id }}" {{ old('cash_account_id') == $cash->id ? 'selected' : '' }}>
                                            {{ $cash->name }} (Saldo: Rp {{ number_format($cash->balance, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </x-form-group>

                        <x-form-group label="Kategori Jurnal" name="category_id" :required="true">
                            <div class="fi-icon-wrap">
                                <svg class="fi-icon-left" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                <select name="category_id" id="category_id" required class="fi-input fi-select @error('category_id') fi-error @enderror">
                                    <option value="" disabled selected>-- Pilih Kategori --</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" data-type="{{ $cat->type }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </x-form-group>

                        <x-form-group label="Nominal" name="amount" :required="true">
                            <x-money-input name="amount" :value="old('amount')" placeholder="0" />
                        </x-form-group>

                        <x-form-group label="Tanggal Transaksi" name="date" :required="true">
                            <input type="date" name="date" id="date" required value="{{ old('date', date('Y-m-d')) }}"
                                class="fi-input @error('date') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Keterangan Tambahan / Deskripsi" name="description" class="fi-grid-full">
                            <textarea name="description" id="description" rows="3"
                                placeholder="Tuliskan keterangan detail jurnal ini..."
                                class="fi-input fi-textarea @error('description') fi-error @enderror">{{ old('description') }}</textarea>
                        </x-form-group>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div style="padding: 1.25rem 1.5rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('journal.index') }}" style="padding: 0.625rem 1.25rem; font-size: 0.875rem; font-weight: 600; color: #475569; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; cursor: pointer; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" id="btn_submit" style="padding: 0.625rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #fff; background: #312e81; border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);" onmouseover="this.style.background='#1e1b4b'" onmouseout="this.style.background='#312e81'">Simpan Jurnal</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function updateCategories() {
            var isOut = document.getElementById('type_out').checked;
            var isIn = document.getElementById('type_in').checked;

            var cardIn = document.getElementById('card_in');
            var cardOut = document.getElementById('card_out');
            var selectCat = document.getElementById('category_id');
            var btnSubmit = document.getElementById('btn_submit');

            selectCat.value = "";

            if (isIn) {
                cardIn.style.borderColor = '#10b981';
                cardIn.style.background = '#f0fdf4';
                cardOut.style.borderColor = '#e2e8f0';
                cardOut.style.background = '#fff';
                btnSubmit.style.background = '#059669';
                btnSubmit.innerText = "Simpan Pemasukan";
                Array.from(selectCat.options).forEach(function(opt) {
                    if (opt.value === "") return;
                    opt.style.display = opt.getAttribute('data-type') === 'in' ? 'block' : 'none';
                });
            } else if (isOut) {
                cardIn.style.borderColor = '#e2e8f0';
                cardIn.style.background = '#fff';
                cardOut.style.borderColor = '#e11d48';
                cardOut.style.background = '#fff1f2';
                btnSubmit.style.background = '#e11d48';
                btnSubmit.innerText = "Simpan Pengeluaran";
                Array.from(selectCat.options).forEach(function(opt) {
                    if (opt.value === "") return;
                    opt.style.display = opt.getAttribute('data-type') === 'out' ? 'block' : 'none';
                });
            }
        }

        document.addEventListener('DOMContentLoaded', updateCategories);
    </script>
</x-app-layout>
