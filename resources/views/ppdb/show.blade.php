<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 1.125rem; color: #fff; border: 1.5px solid rgba(255,255,255,0.3);">
                        {{ strtoupper(substr($ppdb->student_name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Detail Pendaftar — {{ $ppdb->student_name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">No. Reg: {{ $ppdb->registration_number }} • T.A: {{ $ppdb->academicYear->name ?? '-' }}</p>
                    </div>
                </div>
                <x-back-button href="{{ route('ppdb.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem; align-items: start;">
            <!-- Kiri: Data Lengkap -->
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                
                <!-- A. Identitas Calon Siswa -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">A. Identitas Calon Siswa</h4>
                    </div>
                    <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                        @php
                        $identitasSiswa = [
                            'Nama Lengkap' => $ppdb->student_name,
                            'Jenis Kelamin' => $ppdb->gender === 'L' ? 'Laki-laki (Putra)' : 'Perempuan (Putri)',
                            'Tempat Lahir' => $ppdb->birth_place ?? '-',
                            'Tanggal Lahir' => $ppdb->birth_date ? $ppdb->birth_date->format('d M Y') : '-',
                            'Agama' => $ppdb->religion ?? '-',
                            'NIK' => $ppdb->nik ?? '-',
                            'No. KK' => $ppdb->no_kk ?? '-',
                            'Anak Ke-' => $ppdb->child_position ?? '-',
                            'Jml. Saudara' => $ppdb->sibling_count ?? '-',
                            'Status Keluarga' => $ppdb->family_status ?? '-',
                            'Asal Sekolah' => $ppdb->previous_school ?? '-',
                            'No. HP Siswa' => $ppdb->student_phone ?? '-',
                        ];
                        @endphp
                        @foreach ($identitasSiswa as $label => $value)
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
                                'Alamat Domisili' => $ppdb->address ?? '-',
                                'Desa / Kelurahan' => $ppdb->village ?? '-',
                                'Kecamatan' => $ppdb->district ?? '-',
                                'Tempat Tinggal' => $ppdb->residence_type ?? '-',
                                'Transportasi' => $ppdb->transportation ?? '-',
                            ];
                            @endphp
                            @foreach ($domisili as $label => $value)
                            @if ($label == 'Alamat Domisili')
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
                            'Tinggi (cm)' => $ppdb->height ? $ppdb->height . ' cm' : '-',
                            'Berat (kg)' => $ppdb->weight ? $ppdb->weight . ' kg' : '-',
                            'Jarak Sekolah' => $ppdb->distance_to_school ?? '-',
                            'Waktu Tempuh' => $ppdb->travel_time ? $ppdb->travel_time . ' mnt' : '-',
                        ];
                        @endphp
                        @foreach ($periodik as $label => $value)
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
                                    'Nama' => $ppdb->father_name ?? '-',
                                    'NIK' => $ppdb->father_nik ?? '-',
                                    'Tempat Lahir' => $ppdb->father_birth_place ?? '-',
                                    'Tgl Lahir' => $ppdb->father_birth_date ? $ppdb->father_birth_date->format('d M Y') : '-',
                                    'Pendidikan' => $ppdb->father_education ?? '-',
                                    'Pekerjaan' => $ppdb->father_occupation ?? '-',
                                ];
                                @endphp
                                @foreach ($ayah as $k => $v)
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
                                    'Nama' => $ppdb->mother_name ?? '-',
                                    'NIK' => $ppdb->mother_nik ?? '-',
                                    'Tempat Lahir' => $ppdb->mother_birth_place ?? '-',
                                    'Tgl Lahir' => $ppdb->mother_birth_date ? $ppdb->mother_birth_date->format('d M Y') : '-',
                                    'Pendidikan' => $ppdb->mother_education ?? '-',
                                    'Pekerjaan' => $ppdb->mother_occupation ?? '-',
                                ];
                                @endphp
                                @foreach ($ibu as $k => $v)
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
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $ppdb->parent_name ?? '-' }} ({{ $ppdb->parent_phone ?? '-' }})</p>
                            </div>
                            <div>
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Penghasilan Gabungan</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $ppdb->parent_income ?? '-' }}</p>
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
                    @if ($ppdb->guardian_name)
                    <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                        @php
                        $wali = [
                            'Nama Wali' => $ppdb->guardian_name ?? '-',
                            'NIK Wali' => $ppdb->guardian_nik ?? '-',
                            'Tempat Lahir' => $ppdb->guardian_birth_place ?? '-',
                            'Tanggal Lahir' => $ppdb->guardian_birth_date ? $ppdb->guardian_birth_date->format('d M Y') : '-',
                            'Pendidikan' => $ppdb->guardian_education ?? '-',
                            'Pekerjaan' => $ppdb->guardian_occupation ?? '-',
                            'No. HP' => $ppdb->guardian_phone ?? '-',
                            'Alamat' => $ppdb->guardian_address ?? '-',
                        ];
                        @endphp
                        @foreach ($wali as $label => $value)
                        @if ($label == 'Alamat')
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

            <!-- Kanan: Status & Aksi -->
            <div style="display: flex; flex-direction: column; gap: 1rem; position: sticky; top: 1.5rem;">
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; padding: 1.5rem; text-align: center; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.75rem;">Status Pendaftaran</p>
                    @if ($ppdb->status === 'pending')
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #d97706; background: #fef3c7; border-radius: 999px;">⏳ Menunggu Verifikasi</span>
                    @elseif ($ppdb->status === 'diterima')
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #047857; background: #d1fae5; border-radius: 999px;">✓ Diterima</span>
                    @elseif ($ppdb->status === 'dicabut')
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #475569; background: #e2e8f0; border-radius: 999px;">Dicabut/Batal</span>
                    @else
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #be123c; background: #ffe4e6; border-radius: 999px;">✗ Ditolak</span>
                    @endif

                    @if ($ppdb->reviewer)
                    <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px dashed #e2e8f0;">
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0;">Ditinjau oleh: <strong>{{ $ppdb->reviewer->name }}</strong></p>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0.125rem 0 0;">{{ $ppdb->reviewed_at ? $ppdb->reviewed_at->format('d M Y H:i') : '' }}</p>
                    </div>
                    @endif
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    @if ($ppdb->status === 'pending')
                    <form action="{{ route('ppdb.approve', $ppdb) }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">✓ Terima Pendaftar</button>
                    </form>
                    @endif

                    @if ($ppdb->status === 'pending' || $ppdb->status === 'diterima')
                    <form action="{{ route('ppdb.reject', $ppdb) }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #e11d48; background: #fff; border: 1.5px solid #fecdd3; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">✗ Tolak Pendaftar</button>
                    </form>
                    @endif

                    @if ($ppdb->status !== 'pending')
                    <form action="{{ route('ppdb.reset', $ppdb) }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #64748b; background: #f8fafc; border: 1.5px solid #e2e8f0; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">↺ Reset ke Antrean</button>
                    </form>
                    @endif
                </div>

                @if ($ppdb->status === 'diterima')
                <form action="{{ route('ppdb.convert', $ppdb) }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(99,102,241,0.3);" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Konversi ke Siswa Aktif</button>
                </form>
                @endif

                @if ($ppdb->notes)
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.25rem;">
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; margin: 0 0 0.5rem;">Catatan Khusus</p>
                    <p style="font-size: 0.8125rem; color: #475569; margin: 0; line-height: 1.5;">{{ $ppdb->notes }}</p>
                </div>
                @endif
                
                @if ($ppdb->status === 'diterima')
                <div style="margin-top: 1rem; padding: 1rem; border-radius: 1rem; background: rgba(255, 255, 255, 0.4); border: 1px solid rgba(255, 255, 255, 0.5); font-size: 0.75rem; color: #64748b; line-height: 1.4; text-align: center;">
                    ℹ️ Konversi akan memindahkan seluruh riwayat pendaftar ini ke data internal Siswa. Pastikan kelas telah disesuaikan nantinya jika sudah berstatus Aktif.
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
