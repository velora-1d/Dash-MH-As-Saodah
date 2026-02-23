<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.125rem; color: #fff; border: 1.5px solid rgba(255,255,255,0.3);">
                        {{ strtoupper(substr($student->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Detail Siswa — {{ $student->name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">NIS: {{ $student->nis ?? '-' }} • NISN: {{ $student->nisn ?? '-' }}</p>
                    </div>
                </div>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <a href="{{ route('students.edit', $student) }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: #f59e0b; color: #fff; border-radius: 0.625rem; font-weight: 600; font-size: 0.75rem; transition: all 0.2s ease;">
                        Edit Data
                    </a>
                    <x-back-button href="{{ route('students.index') }}" label="Kembali ke Daftar" />
                </div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; align-items: start;">
            <!-- Kiri: Data Lengkap -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                
                <!-- A. Identitas Murid -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">A. Identitas Murid</h4>
                    </div>
                    <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                        @php
                        $identitasSiswa = [
                            'Nama Lengkap' => $student->name,
                            'Jenis Kelamin' => $student->gender === 'L' ? 'Laki-laki (Putra)' : 'Perempuan (Putri)',
                            'Tempat Lahir' => $student->birth_place ?? '-',
                            'Tanggal Lahir' => $student->birth_date ? \Carbon\Carbon::parse($student->birth_date)->format('d M Y') : '-',
                            'Agama' => $student->religion ?? '-',
                            'NIK' => $student->nik ?? '-',
                            'No. KK' => $student->no_kk ?? '-',
                            'Anak Ke-' => $student->child_position ?? '-',
                            'Jml. Saudara' => $student->sibling_count ?? '-',
                            'Status Keluarga' => $student->family_status ?? '-',
                            'Asal Kelas' => $student->classroom->name ?? '-',
                            'No. HP Siswa' => $student->student_phone ?? '-',
                        ];
                        @endphp
                        @foreach($identitasSiswa as $label => $value)
                        <div>
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $label }}</p>
                            <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $value }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div style="padding: 0 1.5rem 1.5rem; border-top: 1px dashed #e2e8f0; margin-top: 0.5rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem; padding-top: 1.5rem;">
                            @php
                            $domisili = [
                                'Alamat Domisili' => $student->address ?? '-',
                                'Desa / Kelurahan' => $student->village ?? '-',
                                'Kecamatan' => $student->district ?? '-',
                                'Tempat Tinggal' => $student->residence_type ?? '-',
                                'Transportasi' => $student->transportation ?? '-',
                            ];
                            @endphp
                            @foreach($domisili as $label => $value)
                            @if($label == 'Alamat Domisili')
                            <div class="col-span-2" style="grid-column: span 2;">
                            @else
                            <div>
                            @endif
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $label }}</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $value }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- B. Data Periodik -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: #0ea5e9; border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">B. Data Periodik</h4>
                    </div>
                    <div style="padding: 1.5rem; display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem;">
                        @php
                        $periodik = [
                            'Tinggi (cm)' => $student->height ? $student->height . ' cm' : '-',
                            'Berat (kg)' => $student->weight ? $student->weight . ' kg' : '-',
                            'Jarak Sekolah' => $student->distance_to_school ?? '-',
                            'Waktu Tempuh' => $student->travel_time ? $student->travel_time . ' mnt' : '-',
                        ];
                        @endphp
                        @foreach($periodik as $label => $value)
                        <div>
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $label }}</p>
                            <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $value }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- C. Data Orang Tua -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: #eab308; border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">C. Data Orang Tua</h4>
                    </div>
                    <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <!-- Ayah -->
                        <div style="background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                            <h5 style="font-weight: 700; font-size: 0.8125rem; color: #475569; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.5rem; margin: 0 0 1rem;">Ayah Kandung</h5>
                            <div style="display: grid; gap: 0.75rem;">
                                @php
                                $ayah = [
                                    'Nama' => $student->father_name ?? '-',
                                    'NIK' => $student->father_nik ?? '-',
                                    'Tempat Lahir' => $student->father_birth_place ?? '-',
                                    'Tgl Lahir' => $student->father_birth_date ? \Carbon\Carbon::parse($student->father_birth_date)->format('d M Y') : '-',
                                    'Pendidikan' => $student->father_education ?? '-',
                                    'Pekerjaan' => $student->father_occupation ?? '-',
                                ];
                                @endphp
                                @foreach($ayah as $k => $v)
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="font-size: 0.75rem; color: #64748b;">{{ $k }}</span>
                                    <span style="font-size: 0.75rem; font-weight: 600; color: #1e293b; text-align: right;">{{ $v }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        <!-- Ibu -->
                        <div style="background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0;">
                            <h5 style="font-weight: 700; font-size: 0.8125rem; color: #475569; border-bottom: 1px dashed #cbd5e1; padding-bottom: 0.5rem; margin: 0 0 1rem;">Ibu Kandung</h5>
                            <div style="display: grid; gap: 0.75rem;">
                                @php
                                $ibu = [
                                    'Nama' => $student->mother_name ?? '-',
                                    'NIK' => $student->mother_nik ?? '-',
                                    'Tempat Lahir' => $student->mother_birth_place ?? '-',
                                    'Tgl Lahir' => $student->mother_birth_date ? \Carbon\Carbon::parse($student->mother_birth_date)->format('d M Y') : '-',
                                    'Pendidikan' => $student->mother_education ?? '-',
                                    'Pekerjaan' => $student->mother_occupation ?? '-',
                                ];
                                @endphp
                                @foreach($ibu as $k => $v)
                                <div style="display: flex; justify-content: space-between;">
                                    <span style="font-size: 0.75rem; color: #64748b;">{{ $k }}</span>
                                    <span style="font-size: 0.75rem; font-weight: 600; color: #1e293b; text-align: right;">{{ $v }}</span>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div style="grid-column: span 2; display: flex; gap: 2rem; padding-top: 0.5rem; border-top: 1px dashed #e2e8f0;">
                            <div>
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Kontak Perwakilan Utama</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $student->parent_name ?? '-' }} ({{ $student->parent_phone ?? '-' }})</p>
                            </div>
                            <div>
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Penghasilan Gabungan</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $student->parent_income ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- D. Data Wali -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: #ec4899; border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">D. Data Wali (Jika Ada)</h4>
                    </div>
                    @if($student->guardian_name)
                    <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                        @php
                        $wali = [
                            'Nama Wali' => $student->guardian_name ?? '-',
                            'NIK Wali' => $student->guardian_nik ?? '-',
                            'Tempat Lahir' => $student->guardian_birth_place ?? '-',
                            'Tanggal Lahir' => $student->guardian_birth_date ? \Carbon\Carbon::parse($student->guardian_birth_date)->format('d M Y') : '-',
                            'Pendidikan' => $student->guardian_education ?? '-',
                            'Pekerjaan' => $student->guardian_occupation ?? '-',
                            'No. HP' => $student->guardian_phone ?? '-',
                            'Alamat' => $student->guardian_address ?? '-',
                        ];
                        @endphp
                        @foreach($wali as $label => $value)
                        @if($label == 'Alamat')
                        <div class="col-span-2" style="grid-column: span 2;">
                        @else
                        <div>
                        @endif
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $label }}</p>
                            <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $value }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div style="padding: 1.5rem; text-align: center; color: #94a3b8; font-size: 0.8125rem; font-style: italic;">
                        Tidak ada data wali yang diisi (Bersama orang tua kandung).
                    </div>
                    @endif
                </div>

            </div>

            <!-- Kanan: Status & Administrasi Internal -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <!-- Status Box -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: #059669; border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">E. Status & Administrasi</h4>
                    </div>
                    <div style="padding: 1.5rem;">
                        <div style="margin-bottom: 1.25rem;">
                            <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Status Siswa</p>
                            <div style="margin-top: 0.5rem;">
                                @if($student->status === 'aktif')
                                    <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">Aktif</span>
                                @elseif($student->status === 'lulus')
                                    <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 600; color: #1d4ed8; background: #dbeafe; border-radius: 999px;">Lulus</span>
                                @elseif($student->status === 'pindah')
                                    <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 600; color: #b45309; background: #fef3c7; border-radius: 999px;">Pindah</span>
                                @else
                                    <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.75rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">Nonaktif</span>
                                @endif
                            </div>
                        </div>

                        <div style="display: grid; gap: 1rem;">
                            <div>
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Kategori Biaya</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ ucfirst(str_replace('_', ' ', $student->category)) }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Status SPP/Infaq</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ ucfirst($student->infaq_status) }}</p>
                            </div>
                            @if($student->infaq_status == 'bayar' || $student->infaq_status == 'subsidi')
                            <div>
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Nominal Kewajiban</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #10b981; margin: 0.25rem 0 0;">Rp {{ number_format($student->infaq_nominal ?? ($student->classroom->infaq_nominal ?? 0), 0, ',', '.') }} <span style="font-size: 0.6875rem; color: #94a3b8;">/ bulan</span></p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Timestamp -->
                <div style="padding: 1rem; border-radius: 0.75rem; border: 1px dashed #cbd5e1; background: rgba(248, 250, 252, 0.5); text-align: center;">
                    <p style="font-size: 0.6875rem; color: #64748b; margin: 0;">Mulai Masuk: <strong>{{ $student->entry_date ? \Carbon\Carbon::parse($student->entry_date)->format('d F Y') : '-' }}</strong></p>
                    <p style="font-size: 0.6875rem; color: #64748b; margin: 0.25rem 0 0;">Data diperbarui: <strong>{{ $student->updated_at->diffForHumans() }}</strong></p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
