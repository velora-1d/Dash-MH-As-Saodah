<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #0369a1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Detail Pendaftar — {{ $ppdb->student_name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">{{ $ppdb->registration_number }} • {{ $ppdb->academicYear->name ?? '-' }}</p>
                    </div>
                </div>
                <x-back-button href="{{ route('ppdb.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        
        

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1rem;">
            <!-- Data Siswa -->
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #0284c7); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Data Calon Siswa</h4>
                </div>
                <div style="padding: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1.25rem;">
                    @php
                    $fields = [
                        'Nama Lengkap' => $ppdb->student_name,
                        'Jenis Kelamin' => $ppdb->gender === 'L' ? 'Laki-laki (Putra)' : 'Perempuan (Putri)',
                        'Tempat Lahir' => $ppdb->birth_place ?? '-',
                        'Tanggal Lahir' => $ppdb->birth_date ? $ppdb->birth_date->format('d M Y') : '-',
                        'NIK' => $ppdb->nik ?? '-',
                        'No. KK' => $ppdb->no_kk ?? '-',
                        'Asal Sekolah' => $ppdb->previous_school ?? '-',
                    ];
                    @endphp
                    @foreach($fields as $label => $value)
                    <div>
                        <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">{{ $label }}</p>
                        <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $value }}</p>
                    </div>
                    @endforeach
                </div>

                <div style="padding: 0 1.5rem 1.5rem;">
                    <div style="border-top: 1px solid #f1f5f9; padding-top: 1.25rem;">
                        <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0;">Data Orang Tua / Wali</p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 0.75rem;">
                            <div>
                                <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0;">Nama</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.125rem 0 0;">{{ $ppdb->parent_name ?? '-' }}</p>
                            </div>
                            <div>
                                <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0;">No. HP</p>
                                <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.125rem 0 0;">{{ $ppdb->parent_phone ?? '-' }}</p>
                            </div>
                        </div>
                        <div style="margin-top: 0.75rem;">
                            <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0;">Alamat</p>
                            <p style="font-size: 0.8125rem; font-weight: 600; color: #1e293b; margin: 0.125rem 0 0;">{{ $ppdb->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status & Aksi -->
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; padding: 1.5rem; text-align: center;">
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em; margin: 0 0 0.75rem;">Status Pendaftaran</p>
                    @if($ppdb->status === 'pending')
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #d97706; background: #fef3c7; border-radius: 999px;">⏳ Menunggu Verifikasi</span>
                    @elseif($ppdb->status === 'diterima')
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #047857; background: #d1fae5; border-radius: 999px;">✓ Diterima</span>
                    @else
                        <span style="display: inline-flex; padding: 0.5rem 1.5rem; font-size: 0.875rem; font-weight: 700; color: #be123c; background: #ffe4e6; border-radius: 999px;">✗ Ditolak</span>
                    @endif

                    @if($ppdb->reviewer)
                    <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.75rem;">Ditinjau oleh: <strong>{{ $ppdb->reviewer->name }}</strong></p>
                    <p style="font-size: 0.6875rem; color: #94a3b8;">{{ $ppdb->reviewed_at ? $ppdb->reviewed_at->format('d M Y H:i') : '' }}</p>
                    @endif
                </div>

                @if($ppdb->status === 'pending')
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <form action="{{ route('ppdb.approve', $ppdb) }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">✓ Terima Pendaftar</button>
                    </form>
                    <form action="{{ route('ppdb.reject', $ppdb) }}" method="POST">
                        @csrf
                        <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #e11d48; background: #fff; border: 1.5px solid #fecdd3; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">✗ Tolak Pendaftar</button>
                    </form>
                </div>
                @endif

                @if($ppdb->status === 'diterima')
                <form action="{{ route('ppdb.convert', $ppdb) }}" method="POST">
                    @csrf
                    <button type="submit" style="width: 100%; display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">🎓 Konversi ke Siswa Aktif</button>
                </form>
                @endif

                @if($ppdb->notes)
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.25rem;">
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; margin: 0 0 0.5rem;">Catatan</p>
                    <p style="font-size: 0.8125rem; color: #475569; margin: 0;">{{ $ppdb->notes }}</p>
                </div>
                @endif

                <a href="{{ route('ppdb.index') }}" style="display: block; text-align: center; padding: 0.75rem; font-size: 0.75rem; font-weight: 600; color: #64748b; text-decoration: none; border: 1px solid #e2e8f0; border-radius: 0.75rem; transition: all 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">← Kembali ke Daftar</a>
            </div>
        </div>
    </div>
</x-app-layout>
