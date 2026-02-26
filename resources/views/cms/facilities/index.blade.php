<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Fasilitas Madrasah</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola daftar fasilitas yang ditampilkan di website.</p>
                        </div>
                    </div>
                    <a href="{{ route('cms.facilities.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah Fasilitas
                    </a>
                </div>
            </div>
        </div>

        <!-- Grid Fasilitas -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.25rem;">
            @forelse ($facilities as $facility)
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; transition: all 0.2s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow=''; this.style.transform=''">
                @if ($facility->image_url)
                    <img src="{{ asset('storage/' . $facility->image_url) }}" alt="{{ $facility->name }}" style="width: 100%; height: 160px; object-fit: cover;">
                @else
                    <div style="width: 100%; height: 160px; background: linear-gradient(135deg, #fffbeb, #fef3c7); display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 40px; height: 40px; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                @endif
                <div style="padding: 1.25rem;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.5rem;">
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">{{ $facility->name }}</h4>
                        @if ($facility->is_active)
                            <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.125rem 0.5rem; border-radius: 999px; color: #047857; background: #d1fae5;">Aktif</span>
                        @else
                            <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.125rem 0.5rem; border-radius: 999px; color: #64748b; background: #f1f5f9;">Nonaktif</span>
                        @endif
                    </div>
                    <p style="font-size: 0.75rem; color: #94a3b8; margin: 0; line-height: 1.5;">{{ Str::limit($facility->description, 80) }}</p>
                    <div style="display: flex; gap: 0.375rem; margin-top: 1rem;">
                        <a href="{{ route('cms.facilities.edit', $facility) }}" style="flex: 1; text-align: center; padding: 0.5rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Edit</a>
                        <form action="{{ route('cms.facilities.destroy', $facility) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Hapus fasilitas ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="width: 100%; padding: 0.5rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 3rem; text-align: center;">
                <svg style="width: 48px; height: 48px; color: #cbd5e1; margin: 0 auto;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.75rem; font-style: italic;">Belum ada fasilitas. Tambahkan yang pertama!</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
