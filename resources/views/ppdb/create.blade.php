<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Formulir Pendaftaran PPDB</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Isi data calon peserta didik baru.</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 0.875rem 1.25rem; border-radius: 0.75rem; font-size: 0.8125rem; font-weight: 500;">
                <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ppdb.store') }}" method="POST">
            @csrf
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Data Calon Peserta Didik</h4>
                </div>

                <div style="padding: 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tahun Ajaran Pendaftaran <span style="color: #e11d48;">*</span></label>
                        <select name="academic_year_id" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $year->is_active ? 'selected' : '' }}>{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Nama Lengkap Calon Siswa <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="student_name" value="{{ old('student_name') }}" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Jenis Kelamin <span style="color: #e11d48;">*</span></label>
                        <select name="gender" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki (Putra)</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan (Putri)</option>
                        </select>
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">NIK</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">No. KK</label>
                        <input type="text" name="no_kk" value="{{ old('no_kk') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>

                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Asal Sekolah (TK/RA)</label>
                        <input type="text" name="previous_school" value="{{ old('previous_school') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>
                </div>

                <!-- Data Orang Tua -->
                <div style="padding: 0 2rem;">
                    <div style="border-top: 1px solid #f1f5f9; padding-top: 1.5rem; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Data Orang Tua / Wali</h4>
                    </div>
                </div>
                <div style="padding: 0 2rem 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Nama Orang Tua / Wali</label>
                        <input type="text" name="parent_name" value="{{ old('parent_name') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">No. HP / WhatsApp</label>
                        <input type="text" name="parent_phone" value="{{ old('parent_phone') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Alamat Lengkap</label>
                        <textarea name="address" rows="3" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; resize: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">{{ old('address') }}</textarea>
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Catatan Tambahan</label>
                        <textarea name="notes" rows="2" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; resize: none;" onfocus="this.style.borderColor='#0ea5e9'" onblur="this.style.borderColor='#e2e8f0'">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div style="padding: 1.25rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('ppdb.index') }}" style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-decoration: none;">← Kembali ke Daftar</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0ea5e9, #0284c7); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Data Pendaftar
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
