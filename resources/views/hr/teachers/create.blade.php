<x-app-layout>
    <div class="space-y-6">
        <!-- Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3); color: #fff;">
                        <svg style="width: 22px; height: 22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tambah Data Guru Baru</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Masukkan informasi detail profil guru ke dalam sistem kepegawaian.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('hr.teachers.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Formulir Pendaftaran</h4>
            </div>

            <form action="{{ route('hr.teachers.store') }}" method="POST" style="padding: 1.5rem;">
                @csrf
                <div class="fi-grid fi-grid-2">
                    <x-form-group label="Nomor Induk / NUPTK" name="nip" class="fi-grid-full">
                        <input type="text" name="nip" value="{{ old('nip') }}" placeholder="Contoh: 198001012010011001"
                            class="fi-input @error('nip') fi-error @enderror">
                    </x-form-group>

                    <x-form-group label="Nama Lengkap (Beserta Gelar)" name="name" :required="true">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Ahmad Dahlan, S.Pd." required
                            class="fi-input @error('name') fi-error @enderror">
                    </x-form-group>

                    <x-form-group label="Posisi / Jabatan" name="position" :required="true">
                        <input type="text" name="position" value="{{ old('position') }}" placeholder="Contoh: Wali Kelas 1A" required
                            class="fi-input @error('position') fi-error @enderror">
                    </x-form-group>

                    <x-form-group label="Status Kepegawaian" name="status" :required="true">
                        <select name="status" required class="fi-input fi-select @error('status') fi-error @enderror">
                            <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif / Cuti</option>
                        </select>
                    </x-form-group>
                </div>

                <div style="margin-top: 1.5rem; padding-top: 1.25rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <a href="{{ route('hr.teachers.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 6px -1px rgba(99, 102, 241, 0.2)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
