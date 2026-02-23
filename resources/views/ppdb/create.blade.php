<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Pendaftaran PPDB Mandiri</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Formulir pendaftaran calon peserta didik (Format Dapodik).</p>
                    </div>
                </div>
                <x-back-button href="{{ route('ppdb.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <form action="{{ route('ppdb.store') }}" method="POST">
            @csrf

            <!-- A. Identitas Calon Murid -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">A. Identitas Calon Murid</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tahun Ajaran <span style="color: #e11d48;">*</span></label>
                        <select name="academic_year_id" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $year->is_active ? 'selected' : '' }}>{{ $year->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Lengkap (Sesuai Akta) <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="student_name" required value="{{ old('student_name') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tempat Lahir</label>
                        <input type="text" name="birth_place" value="{{ old('birth_place') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIK (No. Induk Kependudukan)</label>
                        <input type="text" name="nik" value="{{ old('nik') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. KK</label>
                        <input type="text" name="no_kk" value="{{ old('no_kk') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jenis Kelamin <span style="color: #e11d48;">*</span></label>
                        <select name="gender" required style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki (Putra)</option>
                            <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan (Putri)</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Agama</label>
                        <input type="text" name="religion" value="{{ old('religion', 'Islam') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Status dalam Keluarga</label>
                        <input type="text" name="family_status" value="{{ old('family_status') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div>
                                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Anak Ke-</label>
                                <input type="number" name="child_position" min="1" value="{{ old('child_position') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jml. Saudara</label>
                                <input type="number" name="sibling_count" min="0" value="{{ old('sibling_count') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            </div>
                        </div>
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alamat Murid</label>
                        <textarea name="address" rows="2" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">{{ old('address') }}</textarea>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Desa / Kelurahan</label>
                        <input type="text" name="village" value="{{ old('village') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kecamatan</label>
                        <input type="text" name="district" value="{{ old('district') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tempat Tinggal Siswa</label>
                        <select name="residence_type" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="Orang tua" {{ old('residence_type') == 'Orang tua' ? 'selected' : '' }}>Bersama Orang Tua</option>
                            <option value="Kerabat" {{ old('residence_type') == 'Kerabat' ? 'selected' : '' }}>Bersama Kerabat/Wali</option>
                            <option value="Kos" {{ old('residence_type') == 'Kos' ? 'selected' : '' }}>Kos / Asrama</option>
                            <option value="Lainnya" {{ old('residence_type') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alat Transportasi</label>
                        <select name="transportation" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            <option value="" disabled selected>-- Pilih --</option>
                            <option value="Motor" {{ old('transportation') == 'Motor' ? 'selected' : '' }}>Motor</option>
                            <option value="Jalan kaki" {{ old('transportation') == 'Jalan kaki' ? 'selected' : '' }}>Jalan Kaki</option>
                            <option value="Jemputan Sekolah" {{ old('transportation') == 'Jemputan Sekolah' ? 'selected' : '' }}>Jemputan Sekolah</option>
                            <option value="Kendaraan Umum" {{ old('transportation') == 'Kendaraan Umum' ? 'selected' : '' }}>Angkutan Umum</option>
                            <option value="Lainnya" {{ old('transportation') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Asal Sekolah (TK/RA) Sebelumnya</label>
                        <input type="text" name="previous_school" value="{{ old('previous_school') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. HP Siswa (Jika Ada)</label>
                        <input type="text" name="student_phone" value="{{ old('student_phone') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
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
                        <input type="number" name="height" min="1" value="{{ old('height') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Berat Badan (kg)</label>
                        <input type="number" name="weight" min="1" value="{{ old('weight') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jarak ke Sekolah</label>
                        <select name="distance_to_school" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                            <option value="">-- Pilih --</option>
                            <option value="< 1 km" {{ old('distance_to_school') == '< 1 km' ? 'selected' : '' }}>Kurang dari 1 km</option>
                            <option value="1-3 km" {{ old('distance_to_school') == '1-3 km' ? 'selected' : '' }}>1 - 3 km</option>
                            <option value="3-5 km" {{ old('distance_to_school') == '3-5 km' ? 'selected' : '' }}>3 - 5 km</option>
                            <option value="> 5 km" {{ old('distance_to_school') == '> 5 km' ? 'selected' : '' }}>Lebih dari 5 km</option>
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Waktu (Mnt)</label>
                        <input type="number" name="travel_time" min="1" value="{{ old('travel_time') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
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
                                <input type="text" name="father_name" value="{{ old('father_name') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">NIK Ayah</label>
                                <input type="text" name="father_nik" value="{{ old('father_nik') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tempat Lahir</label><input type="text" name="father_birth_place" value="{{ old('father_birth_place') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;"></div>
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tgl Lahir</label><input type="date" name="father_birth_date" value="{{ old('father_birth_date') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;"></div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pendidikan</label>
                                <input type="text" name="father_education" value="{{ old('father_education') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pekerjaan</label>
                                <input type="text" name="father_occupation" value="{{ old('father_occupation') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Ibu -->
                    <div style="background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                        <h5 style="font-weight: 700; color: #475569; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.5rem; margin-bottom: 1rem;">Data Ibu Kandung</h5>
                        <div style="display: grid; gap: 1rem;">
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Nama Ibu</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">NIK Ibu</label>
                                <input type="text" name="mother_nik" value="{{ old('mother_nik') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem;">
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tempat Lahir</label><input type="text" name="mother_birth_place" value="{{ old('mother_birth_place') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;"></div>
                                <div><label style="display: block; font-size: 0.75rem; font-weight: 600; margin-bottom: 0.25rem;">Tgl Lahir</label><input type="date" name="mother_birth_date" value="{{ old('mother_birth_date') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;"></div>
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pendidikan</label>
                                <input type="text" name="mother_education" value="{{ old('mother_education') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem;">Pekerjaan</label>
                                <input type="text" name="mother_occupation" value="{{ old('mother_occupation') }}" style="width: 100%; box-sizing: border-box; padding: 0.5rem 0.75rem; border: 1px solid #e2e8f0; border-radius: 0.5rem; font-size: 0.8125rem; outline: none;">
                            </div>
                        </div>
                    </div>

                    <div style="grid-column: span 2; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Nama Orang Tua / Perwakilan <span style="color: #e11d48;">*</span></label>
                            <input type="text" name="parent_name" value="{{ old('parent_name') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. Kontak Ortu (WA/HP Aktif) <span style="color: #e11d48;">*</span></label>
                            <input type="text" name="parent_phone" value="{{ old('parent_phone') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                        </div>
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Penghasilan Rata-rata Gabungan</label>
                            <select name="parent_income" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
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
                        <input type="text" name="guardian_name" value="{{ old('guardian_name') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">NIK Wali</label>
                        <input type="text" name="guardian_nik" value="{{ old('guardian_nik') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div><label style="display: block; font-size: 0.8125rem; font-weight: 600; margin-bottom: 0.5rem;">Tempat Lahir</label><input type="text" name="guardian_birth_place" value="{{ old('guardian_birth_place') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;"></div>
                            <div><label style="display: block; font-size: 0.8125rem; font-weight: 600; margin-bottom: 0.5rem;">Tgl Lahir</label><input type="date" name="guardian_birth_date" value="{{ old('guardian_birth_date') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;"></div>
                        </div>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Pendidikan</label>
                        <input type="text" name="guardian_education" value="{{ old('guardian_education') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Pekerjaan</label>
                        <input type="text" name="guardian_occupation" value="{{ old('guardian_occupation') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">No. Kontak Wali</label>
                        <input type="text" name="guardian_phone" value="{{ old('guardian_phone') }}" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Alamat Wali</label>
                        <textarea name="guardian_address" rows="2" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none;">{{ old('guardian_address') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- E. Pendaftaran & Tambahan -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: #8b5cf6; border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">E. Tambahan & Catatan</h4>
                </div>
                <div style="padding: 2rem; display: grid; grid-template-columns: 1fr; gap: 1.5rem;">
                    <div>
                        <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Catatan Khusus (Riwayat Medis / Keadaan Tertentu)</label>
                        <textarea name="notes" rows="3" style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; resize: none;">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div style="padding: 1.25rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('ppdb.index') }}" style="font-size: 0.75rem; font-weight: 600; color: #64748b; text-decoration: none;">← Batal & Kembali</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #0ea5e9, #0284c7); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Data Pendaftaran
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
