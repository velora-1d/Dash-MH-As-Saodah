<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Terima Wakaf Baru</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Catat penerimaan dana wakaf dari donatur/muwakif.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('wakaf.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form action="{{ route('wakaf.store') }}" method="POST">
                @csrf
                <div style="padding: 2rem;">
                    {{-- Baris 1: Info Donatur --}}
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Nama Donatur" name="donor_name" :required="true">
                            <input type="text" name="donor_name" id="donor_name" required list="donor-list"
                                placeholder="Ketik atau pilih donatur" value="{{ old('donor_name') }}"
                                class="fi-input @error('donor_name') fi-error @enderror" autocomplete="off">
                            <datalist id="donor-list">@foreach ($donors as $d)<option value="{{ $d->name }}">@endforeach</datalist>
                        </x-form-group>

                        <x-form-group label="No. HP Donatur" name="donor_phone" hint="Opsional">
                            <input type="text" name="donor_phone" id="donor_phone" placeholder="08xx"
                                value="{{ old('donor_phone') }}" class="fi-input @error('donor_phone') fi-error @enderror">
                        </x-form-group>
                    </div>

                    {{-- Divider --}}
                    <div class="fi-section">
                        <div class="fi-section-title"><span class="fi-section-dot"></span> Detail Transaksi</div>
                    </div>

                    {{-- Baris 2: Nominal & Tujuan --}}
                    <div class="fi-grid fi-grid-2" style="margin-top: 1rem;">
                        <x-form-group label="Nominal Wakaf" name="amount" :required="true">
                            <x-money-input name="amount" :value="old('amount')" placeholder="1.000.000" />
                        </x-form-group>

                        <x-form-group label="Tujuan Wakaf" name="wakaf_purpose" :required="true" hint="Dipilih dari daftar atau ketik untuk membuat tujuan baru.">
                            <div class="fi-icon-wrap">
                                <svg class="fi-icon-left" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                                <input list="purpose_names" name="wakaf_purpose" id="wakaf_purpose" required
                                    value="{{ old('wakaf_purpose') }}" placeholder="Pilih atau ketik tujuan wakaf baru..."
                                    class="fi-input @error('wakaf_purpose') fi-error @enderror">
                            </div>
                            <datalist id="purpose_names">
                                @foreach ($purposes as $purpose)
                                    <option value="{{ $purpose->name }}"></option>
                                @endforeach
                            </datalist>
                        </x-form-group>

                        <x-form-group label="Masuk ke Kas" name="cash_account_id" :required="true">
                            <select name="cash_account_id" id="cash_account_id" required class="fi-input fi-select @error('cash_account_id') fi-error @enderror">
                                <option value="" disabled selected>-- Pilih Kas --</option>
                                @foreach ($cashAccounts as $ca)<option value="{{ $ca->id }}" {{ old('cash_account_id') == $ca->id ? 'selected' : '' }}>{{ $ca->name }}</option>@endforeach
                            </select>
                        </x-form-group>

                        <x-form-group label="Kategori Pemasukan" name="category_id" :required="true">
                            <select name="category_id" id="category_id" required class="fi-input fi-select @error('category_id') fi-error @enderror">
                                <option value="" disabled selected>-- Pilih --</option>
                                @foreach ($categories as $c)<option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>@endforeach
                            </select>
                        </x-form-group>

                        <x-form-group label="Tanggal" name="date" :required="true">
                            <input type="date" name="date" id="date" required value="{{ old('date', date('Y-m-d')) }}"
                                class="fi-input @error('date') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Keterangan" name="description" hint="Opsional">
                            <input type="text" name="description" id="description" placeholder="Catatan tambahan"
                                value="{{ old('description') }}" class="fi-input @error('description') fi-error @enderror">
                        </x-form-group>
                    </div>
                </div>

                <div style="padding: 1rem; margin: 0 2rem 1rem; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.625rem; font-size: 0.8125rem; color: #065f46;">
                    ℹ️ Dana wakaf bersifat <strong>terikat</strong> dan terpisah dari operasional Infaq/SPP.
                </div>

                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('wakaf.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #059669, #10b981); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(5,150,105,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Wakaf
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
