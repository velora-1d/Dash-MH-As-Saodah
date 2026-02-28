<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tambah Siswa Baru</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Formulir pendaftaran (Sesuai Format Dapodik).</p>
                    </div>
                </div>
                <x-back-button href="{{ route('students.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <form action="{{ route('students.store') }}" method="POST">
            @csrf

            <!-- A. Identitas Murid -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">A. Identitas Murid</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Lengkap <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="name" required placeholder="Sesuai Akta" value="{{ old('name') }}" style="width: 100%; box-sizing: border-box;">
                        @error('name')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tempat Lahir</label>
                        <input type="text" name="birth_place" placeholder="Cth: Banyuwangi" value="{{ old('birth_place') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIK (No. Induk Kependudukan)</label>
                        <input type="number" name="nik" placeholder="16 digit" value="{{ old('nik') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. KK</label>
                        <input type="number" name="no_kk" placeholder="16 digit" value="{{ old('no_kk') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NISN</label>
                        <input type="number" name="nisn" placeholder="Nomor Induk Siswa Nasional" value="{{ old('nisn') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIS (Lokal)</label>
                        <input type="number" name="nis" placeholder="Opsional" value="{{ old('nis') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status dalam Keluarga</label>
                        <input type="text" name="family_status" placeholder="Cth: Anak Kandung / Anak Tiri" value="{{ old('family_status') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div>
                                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Anak Ke-</label>
                                <input type="number" name="child_position" min="1" placeholder="1" value="{{ old('child_position') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jumlah Saudara</label>
                                <input type="number" name="sibling_count" min="0" placeholder="2" value="{{ old('sibling_count') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jenis Kelamin <span style="color: #e11d48;">*</span></label>
                        <select name="gender" required style="width: 100%; box-sizing: border-box;">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Agama</label>
                        <input type="text" name="religion" placeholder="Cth: Islam" value="{{ old('religion', 'Islam') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alamat Murid</label>
                        <textarea name="address" rows="2" placeholder="Nama Jalan / RT RW" style="width: 100%; box-sizing: border-box;">{{ old('address') }}</textarea>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Desa / Kelurahan</label>
                        <input type="text" name="village" placeholder="Cth: Karangsari" value="{{ old('village') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kecamatan</label>
                        <input type="text" name="district" placeholder="Cth: Sempu" value="{{ old('district') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tempat Tinggal Siswa</label>
                        <select name="residence_type" style="width: 100%; box-sizing: border-box;">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="Orang tua" {{ old('residence_type') == 'Orang tua' ? 'selected' : '' }}>Bersama Orang Tua</option>
                            <option value="Kerabat" {{ old('residence_type') == 'Kerabat' ? 'selected' : '' }}>Bersama Kerabat/Wali</option>
                            <option value="Kos" {{ old('residence_type') == 'Kos' ? 'selected' : '' }}>Kos / Asrama</option>
                            <option value="Lainnya" {{ old('residence_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alat Transportasi</label>
                        <select name="transportation" style="width: 100%; box-sizing: border-box;">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="Motor" {{ old('transportation') == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Jalan kaki" {{ old('transportation') == 'Jalan kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                            <option value="Jemputan Sekolah" {{ old('transportation') == 'Jemputan Sekolah' ? 'selected' : '' }}>Jemputan Sekolah</option>
                            <option value="Kendaraan Umum" {{ old('transportation') == 'Kendaraan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                            <option value="Lainnya" {{ old('transportation') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. HP Siswa (Jika Ada)</label>
                        <input type="text" name="student_phone" placeholder="08..." value="{{ old('student_phone') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                </div>
            </div>

            <!-- B. Data Periodik -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #0ea5e9; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">B. Data Periodik Fisik</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tinggi Badan (cm)</label>
                        <input type="number" name="height" min="1" placeholder="150" value="{{ old('height') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Berat Badan (kg)</label>
                        <input type="number" name="weight" min="1" placeholder="45" value="{{ old('weight') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jarak ke Sekolah</label>
                        <select name="distance_to_school" style="width: 100%; box-sizing: border-box;">
                            <option value="">-- Pilih Jarak --</option>
                            <option value="< 1 km" {{ old('distance_to_school') == '< 1 km' ? 'selected' : '' }}>Kurang dari 1 km</option>
                            <option value="1-3 km" {{ old('distance_to_school') == '1-3 km' ? 'selected' : '' }}>1 - 3 km</option>
                            <option value="3-5 km" {{ old('distance_to_school') == '3-5 km' ? 'selected' : '' }}>3 - 5 km</option>
                            <option value="> 5 km" {{ old('distance_to_school') == '> 5 km' ? 'selected' : '' }}>Lebih dari 5 km</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Waktu Tempuh (Menit)</label>
                        <input type="number" name="travel_time" min="1" placeholder="15" value="{{ old('travel_time') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                </div>
            </div>

            <!-- C. Data Orang Tua -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #eab308; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">C. Identitas Orang Tua</h4>
                </div>
                
                <div style="padding: 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                    <!-- Kolom Ayah -->
                    <div style="background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                        <h5 style="font-weight: 700; color: #475569; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.5rem; margin-bottom: 1rem;">Data Ayah Kandung</h5>
                        <div style="display: grid; gap: 1rem;">
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Nama Ayah</label>
                                <input type="text" name="father_name" value="{{ old('father_name') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">NIK Ayah</label>
                                <input type="number" name="father_nik" value="{{ old('father_nik') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tempat Lahir</label><input type="text" name="father_birth_place" value="{{ old('father_birth_place') }}" style="width: 100%; box-sizing: border-box;"></div>
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tgl Lahir</label><input type="date" name="father_birth_date" value="{{ old('father_birth_date') }}" style="width: 100%; box-sizing: border-box;"></div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pendidikan</label>
                                <input type="text" name="father_education" placeholder="Cth: SMA/SMK" value="{{ old('father_education') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pekerjaan</label>
                                <input type="text" name="father_occupation" placeholder="Cth: Wiraswasta" value="{{ old('father_occupation') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Ibu -->
                    <div style="background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                        <h5 style="font-weight: 700; color: #475569; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.5rem; margin-bottom: 1rem;">Data Ibu Kandung</h5>
                        <div style="display: grid; gap: 1rem;">
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Nama Ibu</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">NIK Ibu</label>
                                <input type="number" name="mother_nik" value="{{ old('mother_nik') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tempat Lahir</label><input type="text" name="mother_birth_place" value="{{ old('mother_birth_place') }}" style="width: 100%; box-sizing: border-box;"></div>
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tgl Lahir</label><input type="date" name="mother_birth_date" value="{{ old('mother_birth_date') }}" style="width: 100%; box-sizing: border-box;"></div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pendidikan</label>
                                <input type="text" name="mother_education" placeholder="Cth: SMP" value="{{ old('mother_education') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pekerjaan</label>
                                <input type="text" name="mother_occupation" placeholder="Cth: Mengurus Rumah Tangga" value="{{ old('mother_occupation') }}" style="width: 100%; box-sizing: border-box;">
                            </div>
                        </div>
                    </div>

                    <div style="grid-column: span 2; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. Kontak Ortu (WA/HP Aktif)</label>
                            <input type="text" name="parent_phone" placeholder="081xxx" value="{{ old('parent_phone') }}" style="width: 100%; box-sizing: border-box;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Penghasilan Rata-rata Gabungan</label>
                            <select name="parent_income" style="width: 100%; box-sizing: border-box;">
                                <option value="">-- Pilih Range --</option>
                                <option value="< 1 jt" {{ old('parent_income') == '< 1 jt' ? 'selected' : '' }}>Kurang dari Rp 1.000.000</option>
                                <option value="1-2 jt" {{ old('parent_income') == '1-2 jt' ? 'selected' : '' }}>Rp 1.000.000 - Rp 2.000.000</option>
                                <option value="2-3 jt" {{ old('parent_income') == '2-3 jt' ? 'selected' : '' }}>Rp 2.000.000 - Rp 3.000.000</option>
                                <option value="> 3 jt" {{ old('parent_income') == '> 3 jt' ? 'selected' : '' }}>Lebih dari Rp 3.000.000</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- D. Data Wali -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #ec4899; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">D. Wali Murid (Jika Bersama Wali)</h4>
                    <span style="font-size: 0.75rem; color:#94a3b8; margin-left: auto;">Kosongkan jika bersama orang tua kandung.</span>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Wali</label>
                        <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIK Wali</label>
                        <input type="number" name="guardian_nik" value="{{ old('guardian_nik') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div><label style="display: block; font-size: 0.8125rem; font-weight: 600; margin-bottom: 0.5rem;">Tempat Lahir</label><input type="text" name="guardian_birth_place" value="{{ old('guardian_birth_place') }}" style="width: 100%; box-sizing: border-box;"></div>
                            <div><label style="display: block; font-size: 0.8125rem; font-weight: 600; margin-bottom: 0.5rem;">Tgl Lahir</label><input type="date" name="guardian_birth_date" value="{{ old('guardian_birth_date') }}" style="width: 100%; box-sizing: border-box;"></div>
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Pendidikan</label>
                        <input type="text" name="guardian_education" value="{{ old('guardian_education') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Pekerjaan</label>
                        <input type="text" name="guardian_occupation" value="{{ old('guardian_occupation') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. Kontak Wali</label>
                        <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" style="width: 100%; box-sizing: border-box;">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alamat Wali</label>
                        <textarea name="guardian_address" rows="2" style="width: 100%; box-sizing: border-box;">{{ old('guardian_address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- E. Administrasi Server/Sekolah -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #059669; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">E. Status & Administrasi Internal</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kategori Siswa <span style="color: #e11d48;">*</span></label>
                        <select id="category" name="category" required style="width: 100%; box-sizing: border-box;">
                            <option value="reguler" {{ old('category') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                            <option value="yatim" {{ old('category') == 'yatim' ? 'selected' : '' }}>Yatim / Piatu</option>
                            <option value="kurang_mampu" {{ old('category') == 'kurang_mampu' ? 'selected' : '' }}>Kurang Mampu</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kelas (Bisa diaturoleh TU nanti)</label>
                        <select id="classroom_id" name="classroom_id" style="width: 100%; box-sizing: border-box;">
                            <option value="">-- Belum Set --</option>
                            @foreach ($classrooms as $cls)<option value="{{ $cls->id }}" {{ old('classroom_id') == $cls->id ? 'selected' : '' }}>Tingkat {{ $cls->level }} : {{ $cls->name }}</option>@endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status <span style="color: #e11d48;">*</span></label>
                        <select id="status" name="status" required style="width: 100%; box-sizing: border-box;">
                            <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="lulus" {{ old('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                            <option value="pindah" {{ old('status') == 'pindah' ? 'selected' : '' }}>Pindah</option>
                            <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                    </div>
                    <div style="grid-column: span 2;">
                        <div style="padding: 1rem; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.625rem; font-size: 0.8125rem; color: #3730a3; margin-bottom: 1rem;">
                            ℹ️ Yatim → otomatis <strong>Gratis</strong>. Reguler → otomatis <strong>Bayar Penuh</strong>. Ubah manual hanya jika ada pengecualian.
                        </div>
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                            <div>
                                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Skema SPP / Infaq <span style="color: #e11d48;">*</span></label>
                                <select id="infaq_status" name="infaq_status" required style="width: 100%; box-sizing: border-box;">
                                    <option value="bayar" {{ old('infaq_status') == 'bayar' ? 'selected' : '' }}>Bayar Normal</option>
                                    <option value="subsidi" {{ old('infaq_status') == 'subsidi' ? 'selected' : '' }}>Subsidi</option>
                                    <option value="gratis" {{ old('infaq_status') == 'gratis' ? 'selected' : '' }}>Gratis</option>
                                </select>
                            </div>
                            <div id="infaq_nominal_container" class="{{ old('infaq_status') == 'subsidi' ? '' : 'hidden' }}">
                                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nominal Subsidi (Rp)</label>
                                <x-money-input name="infaq_nominal" :value="old('infaq_nominal')" placeholder="20.000" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div style="display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem;">
                <a href="{{ route('students.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none;">Batal</a>
                <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;">
                    <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Data Siswa
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cat = document.getElementById('category');
            const infaq = document.getElementById('infaq_status');
            const nomCon = document.getElementById('infaq_nominal_container');
            const nomIn = nomCon ? nomCon.querySelector('[data-money-raw]') : null;
            const nomDisplay = nomCon ? nomCon.querySelector('[data-money-input]') : null;
            
            function toggle() { 
                if (infaq.value === 'subsidi') { 
                    nomCon.classList.remove('hidden'); 
                } else { 
                    nomCon.classList.add('hidden'); 
                    if (nomIn) nomIn.value = ''; 
                    if (nomDisplay) nomDisplay.value = ''; 
                } 
            }
            
            function autoAdjust() { 
                if (cat.value === 'yatim') infaq.value = 'gratis'; 
                else if (cat.value === 'reguler') infaq.value = 'bayar'; 
                toggle(); 
            }
            
            infaq.addEventListener('change', toggle);
            cat.addEventListener('change', autoAdjust);
        });
    </script>
</x-app-layout>
