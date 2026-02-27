<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #38bdf8 50%, #7dd3fc 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tambah Tahun Ajaran</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Definisikan periode tahun ajaran dan semester baru.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('academic-years.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form action="{{ route('academic-years.store') }}" method="POST">
                @csrf
                <div style="padding: 2rem;">
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Nama Tahun Ajaran" name="name" :required="true">
                            <input type="text" name="name" id="name" required placeholder="Misal: 2024/2025" value="{{ old('name') }}"
                                class="fi-input @error('name') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Semester" name="semester" :required="true">
                            <select id="semester" name="semester" required class="fi-input fi-select @error('semester') fi-error @enderror">
                                <option value="" disabled selected>-- Pilih --</option>
                                <option value="ganjil" {{ old('semester') == 'ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="genap" {{ old('semester') == 'genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                        </x-form-group>
                    </div>

                    <div style="margin-top: 1.5rem; padding: 1rem; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.625rem; display: flex; align-items: center; gap: 0.75rem;">
                        <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active') ? 'checked' : '' }} style="width: 1.125rem; height: 1.125rem; cursor: pointer; accent-color: #6366f1;">
                        <div>
                            <label for="is_active" style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; cursor: pointer;">Langsung Aktifkan?</label>
                            <p style="font-size: 0.6875rem; color: #64748b; margin-top: 0.125rem;">Tahun ajaran lain akan otomatis dinonaktifkan.</p>
                        </div>
                    </div>
                </div>
                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('academic-years.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
