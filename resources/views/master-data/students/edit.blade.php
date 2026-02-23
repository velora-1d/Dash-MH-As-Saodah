<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.125rem; color: #fff; border: 1.5px solid rgba(255,255,255,0.3);">{{ strtoupper(substr($student->name, 0, 1)) }}</div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Edit — {{ $student->name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Koreksi data identitas, kelas, dan skema pembayaran.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('students.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <form action="{{ route('students.update', $student->id) }}" method="POST">
            @csrf @method('PUT')
            <!-- Biodata -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Biodata Siswa</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label for="name" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Lengkap <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="name" id="name" required value="{{ old('name', $student->name) }}" style="width: 100%; box-sizing: border-box;">
                        @error('name')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="nisn" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NISN</label>
                        <input type="number" name="nisn" id="nisn" value="{{ old('nisn', $student->nisn) }}" style="width: 100%; box-sizing: border-box;">
                        @error('nisn')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="nis" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIS</label>
                        <input type="number" name="nis" id="nis" value="{{ old('nis', $student->nis) }}" style="width: 100%; box-sizing: border-box;">
                        @error('nis')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="nik" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIK</label>
                        <input type="number" name="nik" id="nik" value="{{ old('nik', $student->nik) }}" style="width: 100%; box-sizing: border-box;">
                        @error('nik')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="no_kk" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. KK</label>
                        <input type="number" name="no_kk" id="no_kk" value="{{ old('no_kk', $student->no_kk) }}" style="width: 100%; box-sizing: border-box;">
                        @error('no_kk')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="gender" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jenis Kelamin <span style="color: #e11d48;">*</span></label>
                        <select id="gender" name="gender" required style="width: 100%; box-sizing: border-box;">
                            <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Administrasi -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #059669; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Status & Administrasi</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label for="category" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kategori Siswa <span style="color: #e11d48;">*</span></label>
                        <select id="category" name="category" required style="width: 100%; box-sizing: border-box;">
                            <option value="reguler" {{ old('category', $student->category) == 'reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="yatim" {{ old('category', $student->category) == 'yatim' ? 'selected' : '' }}>Yatim / Piatu</option>
                            <option value="kurang_mampu" {{ old('category', $student->category) == 'kurang_mampu' ? 'selected' : '' }}>Kurang Mampu</option>
                        </select>
                        @error('category')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="classroom_id" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kelas</label>
                        <select id="classroom_id" name="classroom_id" style="width: 100%; box-sizing: border-box;">
                            <option value="">-- Belum Set --</option>
                            @foreach($classrooms as $cls)<option value="{{ $cls->id }}" {{ old('classroom_id', $student->classroom_id) == $cls->id ? 'selected' : '' }}>Tingkat {{ $cls->level }} : {{ $cls->name }}</option>@endforeach
                        </select>
                        @error('classroom_id')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="status" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status <span style="color: #e11d48;">*</span></label>
                        <select id="status" name="status" required style="width: 100%; box-sizing: border-box;">
                            <option value="aktif" {{ old('status', $student->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="lulus" {{ old('status', $student->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="pindah" {{ old('status', $student->status) == 'pindah' ? 'selected' : '' }}>Pindah</option>
                            <option value="nonaktif" {{ old('status', $student->status) == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        @error('status')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div style="grid-column: span 2;">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                            <div>
                                <label for="infaq_status" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Skema SPP <span style="color: #e11d48;">*</span></label>
                                <select id="infaq_status" name="infaq_status" required style="width: 100%; box-sizing: border-box;">
                                    <option value="bayar" {{ old('infaq_status', $student->infaq_status) == 'bayar' ? 'selected' : '' }}>Bayar Normal</option>
                                    <option value="subsidi" {{ old('infaq_status', $student->infaq_status) == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                    <option value="gratis" {{ old('infaq_status', $student->infaq_status) == 'gratis' ? 'selected' : '' }}>Gratis</option>
                                </select>
                                @error('infaq_status')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                            </div>
                            <div id="infaq_nominal_container" class="{{ old('infaq_status', $student->infaq_status) == 'subsidi' ? '' : 'hidden' }}">
                                <label for="infaq_nominal" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nominal Subsidi (Rp)</label>
                                <input type="number" name="infaq_nominal" id="infaq_nominal" min="0" step="1000" value="{{ old('infaq_nominal', $student->infaq_nominal) }}" style="width: 100%; box-sizing: border-box;">
                                @error('infaq_nominal')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data Wali -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #d97706; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Data Orang Tua / Wali</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label for="parent_name" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Wali</label>
                        <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name', $student->parent_name) }}" style="width: 100%; box-sizing: border-box;">
                        @error('parent_name')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="parent_phone" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. WA / HP</label>
                        <input type="text" name="parent_phone" id="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}" style="width: 100%; box-sizing: border-box;">
                        @error('parent_phone')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="address" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alamat</label>
                        <textarea name="address" id="address" rows="2" style="width: 100%; box-sizing: border-box;">{{ old('address', $student->address) }}</textarea>
                        @error('address')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem;">
                <a href="{{ route('students.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none;">Batal</a>
                <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                    <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cat = document.getElementById('category'), infaq = document.getElementById('infaq_status'), nomCon = document.getElementById('infaq_nominal_container'), nomIn = document.getElementById('infaq_nominal');
            function toggle() { if (infaq.value === 'subsidi') { nomCon.classList.remove('hidden'); nomIn.setAttribute('required','required'); } else { nomCon.classList.add('hidden'); nomIn.removeAttribute('required'); } }
            function autoAdjust() { if (cat.value === 'yatim') infaq.value = 'gratis'; else if (cat.value === 'reguler') infaq.value = 'bayar'; toggle(); }
            infaq.addEventListener('change', toggle);
            cat.addEventListener('change', autoAdjust);
        });
    </script>
</x-app-layout>
