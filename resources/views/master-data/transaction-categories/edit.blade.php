<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #7c3aed 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Edit Kategori — {{ $transactionCategory->name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Perbarui informasi kategori keuangan.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('transaction-categories.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form action="{{ route('transaction-categories.update', $transactionCategory->id) }}" method="POST">
                @csrf @method('PUT')
                <div style="padding: 2rem;">
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Nama Kategori" name="name" :required="true">
                            <input type="text" name="name" id="name" required value="{{ old('name', $transactionCategory->name) }}"
                                class="fi-input @error('name') fi-error @enderror">
                        </x-form-group>
                        <x-form-group label="Jenis" name="type" :required="true">
                            <select id="type" name="type" required class="fi-input fi-select @error('type') fi-error @enderror">
                                <option value="in" {{ old('type', $transactionCategory->type) == 'in' ? 'selected' : '' }}>Pemasukan</option>
                                <option value="out" {{ old('type', $transactionCategory->type) == 'out' ? 'selected' : '' }}>Pengeluaran</option>
                            </select>
                        </x-form-group>
                        <x-form-group label="Keterangan" name="description" hint="Opsional" class="fi-grid-full">
                            <textarea name="description" id="description" rows="2"
                                class="fi-input fi-textarea @error('description') fi-error @enderror">{{ old('description', $transactionCategory->description) }}</textarea>
                        </x-form-group>
                    </div>
                </div>
                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('transaction-categories.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
