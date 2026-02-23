<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Terima Wakaf Baru</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Catat penerimaan dana wakaf dari donatur/muwakif.</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form action="{{ route('wakaf.store') }}" method="POST">
                @csrf
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <!-- Donatur -->
                    <div>
                        <label for="donor_name" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Donatur <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="donor_name" id="donor_name" required list="donor-list" placeholder="Ketik atau pilih donatur" value="{{ old('donor_name') }}" style="width: 100%; box-sizing: border-box;" autocomplete="off">
                        <datalist id="donor-list">@foreach($donors as $d)<option value="{{ $d->name }}">@endforeach</datalist>
                        @error('donor_name')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="donor_phone" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. HP Donatur <span style="color: #94a3b8; font-weight: 400;">(Opsional)</span></label>
                        <input type="text" name="donor_phone" id="donor_phone" placeholder="08xx" value="{{ old('donor_phone') }}" style="width: 100%; box-sizing: border-box;">
                        @error('donor_phone')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <!-- Nominal & Tujuan -->
                    <div>
                        <label for="amount" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nominal Wakaf (Rp) <span style="color: #e11d48;">*</span></label>
                        <input type="number" name="amount" id="amount" required min="1000" step="1000" placeholder="1000000" value="{{ old('amount') }}" style="width: 100%; box-sizing: border-box;">
                        @error('amount')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="wakaf_purpose" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tujuan Wakaf <span style="color: #e11d48;">*</span></label>
                        <div style="position: relative;">
                            <input list="purpose_names" name="wakaf_purpose" id="wakaf_purpose" required value="{{ old('wakaf_purpose') }}" placeholder="Pilih atau ketik tujuan wakaf baru..." style="width: 100%; box-sizing: border-box; padding-left: 2.25rem;">
                            <svg style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); width: 1.25rem; height: 1.25rem; color: #94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <datalist id="purpose_names">
                            @foreach($purposes as $purpose)
                                <option value="{{ $purpose->name }}"></option>
                            @endforeach
                        </datalist>
                        <p style="font-size: 0.6875rem; color: #64748b; margin-top: 0.375rem;">Dipilih dari daftar atau ketik untuk membuat tujuan baru.</p>
                        @error('wakaf_purpose')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <!-- Kas & Tanggal -->
                    <div>
                        <label for="cash_account_id" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Masuk ke Kas <span style="color: #e11d48;">*</span></label>
                        <select name="cash_account_id" id="cash_account_id" required style="width: 100%; box-sizing: border-box;">
                            <option value="" disabled selected>-- Pilih Kas --</option>
                            @foreach($cashAccounts as $ca)<option value="{{ $ca->id }}" {{ old('cash_account_id') == $ca->id ? 'selected' : '' }}>{{ $ca->name }}</option>@endforeach
                        </select>
                        @error('cash_account_id')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="category_id" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kategori Pemasukan <span style="color: #e11d48;">*</span></label>
                        <select name="category_id" id="category_id" required style="width: 100%; box-sizing: border-box;">
                            <option value="" disabled selected>-- Pilih --</option>
                            @foreach($categories as $c)<option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach
                        </select>
                        @error('category_id')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="date" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tanggal <span style="color: #e11d48;">*</span></label>
                        <input type="date" name="date" id="date" required value="{{ old('date', date('Y-m-d')) }}" style="width: 100%; box-sizing: border-box;">
                        @error('date')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="description" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Keterangan <span style="color: #94a3b8; font-weight: 400;">(Opsional)</span></label>
                        <input type="text" name="description" id="description" placeholder="Catatan tambahan" value="{{ old('description') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                </div>

                <div style="padding: 1rem; margin: 0 2rem 1rem; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.625rem; font-size: 0.8125rem; color: #065f46;">
                    ℹ️ Dana wakaf bersifat <strong>terikat</strong> dan terpisah dari operasional Infaq/SPP.
                </div>

                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('wakaf.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none;">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #059669, #10b981); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(5,150,105,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Wakaf
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
