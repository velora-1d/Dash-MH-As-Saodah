<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #ec4899 0%, #db2777 50%, #be185d 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <a href="{{ route('cms.achievements.index') }}" style="width: 36px; height: 36px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <svg style="width: 16px; height: 16px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </a>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">{{ isset($achievement) ? 'Edit Prestasi' : 'Tambah Prestasi' }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Masukkan data prestasi santri.</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #ec4899, #be185d); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Detail Prestasi</h4>
            </div>
            <form id="prestasiForm" action="{{ isset($achievement) ? route('cms.achievements.update', $achievement) : route('cms.achievements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($achievement)) @method('PUT') @endif
                <div style="padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Judul Prestasi <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $achievement->title ?? '') }}" required placeholder="Juara 1 Lomba Tahfidz" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#ec4899'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Nama Kompetisi</label>
                        <input type="text" name="competition_name" value="{{ old('competition_name', $achievement->competition_name ?? '') }}" placeholder="Olimpiade Sains Nasional" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#ec4899'; this.style.background='#fff'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Level <span style="color: #e11d48;">*</span></label>
                        <select name="level" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#ec4899'; this.style.background='#fff'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                            @foreach (['internasional', 'nasional', 'provinsi', 'kabupaten', 'kecamatan', 'lainnya'] as $level)
                                <option value="{{ $level }}" {{ old('level', $achievement->level ?? 'kabupaten') === $level ? 'selected' : '' }}>{{ ucfirst($level) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Nama Siswa</label>
                        <input type="text" name="student_name" value="{{ old('student_name', $achievement->student_name ?? '') }}" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#ec4899'; this.style.background='#fff'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Tahun <span style="color: #e11d48;">*</span></label>
                        <input type="number" name="year" value="{{ old('year', $achievement->year ?? date('Y')) }}" required min="2000" max="2099" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#ec4899'; this.style.background='#fff'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Foto Dokumentasi</label>
                        @if (isset($achievement) && $achievement->image_url)
                            <div style="margin-bottom: 0.5rem;"><img src="{{ asset('storage/' . $achievement->image_url) }}" style="max-height: 60px; border-radius: 0.5rem; border: 1.5px solid #e2e8f0;"></div>
                        @endif
                        <input type="file" name="image" id="image_upload" accept="image/*" style="width: 100%; padding: 0.5rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.75rem; color: #64748b; background: #f8fafc; cursor: pointer;">
                        <script>
                            document.getElementById('image_upload').addEventListener('change', function(e) {
                                const file = e.target.files[0];
                                if (file && file.size > 2 * 1024 * 1024) { // 2MB
                                    alert('Maaf, ukuran file terlalu besar (maksimal 2MB)! Silakan kompres gambar terlebih dahulu.');
                                    e.target.value = ''; // Reset input
                                }
                            });
                        </script>
                    </div>
                    <div style="display: flex; align-items: flex-end; gap: 0.5rem;">
                        <input type="hidden" name="is_active" value="0">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.8125rem; font-weight: 600; color: #475569;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $achievement->is_active ?? true) ? 'checked' : '' }} style="width: 1.1rem; height: 1.1rem; accent-color: #db2777;">
                            Tampilkan di website
                        </label>
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <a href="{{ route('cms.achievements.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #f1f5f9; border-radius: 0.625rem; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.15s ease;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #ec4899, #db2777); border-radius: 0.625rem; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(236,72,153,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan
                    </button>
                </div>
            </form>
            <script>
                document.getElementById('prestasiForm').addEventListener('submit', function(e) {
                    const fileInput = document.getElementById('image_upload');
                    if (fileInput && fileInput.files.length > 0) {
                        const file = fileInput.files[0];
                        if (file.size > 2 * 1024 * 1024) { // 2MB
                            e.preventDefault(); // Block submission
                            alert('TIDAK BISA DISIMPAN: Ukuran gambar/foto melebihi maksimal 2MB! Silakan kompres gambar Anda dan pilih ulang file yang lebih kecil.');
                            // Optional: Highlight the input
                            fileInput.style.borderColor = '#e11d48';
                            fileInput.style.backgroundColor = '#fff1f2';
                            
                            // Scroll to top or file input 
                            window.scrollTo({ top: fileInput.offsetTop - 100, behavior: 'smooth' });
                            return false;
                        }
                    }
                });
            </script>
        </div>
    </div>
</x-app-layout>
