<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Generate Tagihan Massal</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Buat tagihan SPP/Infaq untuk seluruh siswa aktif secara otomatis.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <svg style="width: 1rem; height: 1rem; color: #6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Informasi Penting</h4>
            </div>
            <div style="padding: 1.5rem; font-size: 0.8125rem; color: #475569; line-height: 1.7;">
                <ul style="list-style-type: disc; padding-left: 1.25rem; margin: 0;">
                    <li>Siswa <strong>Gratis</strong> → Tagihan Rp 0, otomatis <strong style="color: #059669;">LUNAS</strong></li>
                    <li>Siswa <strong>Subsidi</strong> → Nominal berdasarkan profil siswa</li>
                    <li>Siswa <strong>Bayar</strong> → Nominal standar sesuai kelas</li>
                </ul>
                <div style="margin-top: 1rem; padding: 0.75rem 1rem; background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.625rem; color: #991b1b; font-weight: 500; font-size: 0.8125rem;">
                    ⚠️ Siswa yang sudah memiliki tagihan di bulan & tahun ajaran yang sama akan otomatis dilewati.
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form id="form-generate" method="POST" action="{{ route('infaq.bills.generate.store') }}">
                @csrf
                <div style="padding: 2rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div>
                        <label for="academic_year_id" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tahun Ajaran <span style="color: #e11d48;">*</span></label>
                        <select id="academic_year_id" name="academic_year_id" required style="width: 100%; box-sizing: border-box;">
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $year->is_active ? 'selected' : '' }}>{{ $year->name }}</option>
                            @endforeach
                        </select>
                        @error('academic_year_id')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="month" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Bulan Tagihan <span style="color: #e11d48;">*</span></label>
                        <select id="month" name="month" required style="width: 100%; box-sizing: border-box;">
                            @foreach([1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'] as $key => $name)
                                <option value="{{ $key }}" {{ date('n') == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('month')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('infaq.bills.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none;">Batal</a>
                    <button type="button" id="btn-generate" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        Eksekusi Generate
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('btn-generate').addEventListener('click', function() {
            const bulan = document.getElementById('month');
            const namaBulan = bulan.options[bulan.selectedIndex].text;
            Swal.fire({
                title: 'Generate Tagihan?',
                html: '<p style="font-size:0.875rem;color:#475569;">Tagihan SPP/Infaq bulan <strong>' + namaBulan + '</strong> akan dibuat untuk seluruh siswa aktif.</p>',
                icon: 'question', showCancelButton: true, confirmButtonColor: '#4f46e5', cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Generate!', cancelButtonText: 'Batal', reverseButtons: true, focusCancel: true,
            }).then((r) => { if (r.isConfirmed) document.getElementById('form-generate').submit(); });
        });
    </script>
</x-app-layout>
