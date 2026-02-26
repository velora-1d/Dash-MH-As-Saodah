<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #d97706 0%, #f59e0b 50%, #fbbf24 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Edit Kelas — {{ $classroom->name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Perbarui informasi rombongan belajar.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('classrooms.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
                @csrf @method('PUT')
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div>
                        <label for="level" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tingkatan Kelas <span style="color: #e11d48;">*</span></label>
                        <select id="level" name="level" required style="width: 100%; box-sizing: border-box;">
                            <option value="" disabled>-- Pilih Tingkat --</option>
                            @for($i = 1; $i <= 6; $i++)<option value="{{ $i }}" {{ old('level', $classroom->level) == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>@endfor
                        </select>
                        @error('level')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="name" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Kelas <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="name" id="name" required placeholder="Misal: Kelas 1A" value="{{ old('name', $classroom->name) }}" style="width: 100%; box-sizing: border-box;">
                        @error('name')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="wali_kelas" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Wali Kelas <span style="color: #94a3b8; font-weight: 400;">(Opsional)</span></label>
                        <input type="text" name="wali_kelas" id="wali_kelas" placeholder="Nama guru wali kelas" value="{{ old('wali_kelas', $classroom->wali_kelas) }}" style="width: 100%; box-sizing: border-box;">
                        @error('wali_kelas')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="infaq_nominal" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tarif Infaq/SPP <span style="color: #e11d48;">*</span></label>
                        <input type="number" name="infaq_nominal" id="infaq_nominal" required min="0" step="1000" value="{{ old('infaq_nominal', $classroom->infaq_nominal) }}" style="width: 100%; box-sizing: border-box;">
                        @error('infaq_nominal')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                </div>

                @if ($classroom->students()->count() > 0)
                    <div style="margin: 0 2rem 1rem; padding: 0.875rem 1rem; background: #fef3c7; border: 1px solid #fde68a; border-radius: 0.625rem; font-size: 0.8125rem; color: #92400e; font-weight: 500;">
                        ⚠️ Kelas ini memiliki <strong>{{ $classroom->students()->count() }} siswa</strong> aktif. Perubahan akan berdampak langsung.
                    </div>
                @endif

                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('classrooms.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none;">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
