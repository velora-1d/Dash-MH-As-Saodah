<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 50%, #0f766e 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Profil Guru & Tenaga Pendidik</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola profil guru yang ditampilkan di halaman website.</p>
                        </div>
                    </div>
                    <a href="{{ route('cms.teachers.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border: 1.5px solid rgba(255,255,255,0.3); text-decoration: none; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah Guru
                    </a>
                </div>
            </div>
        </div>

        <!-- Grid Profil Guru -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 1.25rem;">
            @forelse($teachers as $teacher)
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; transition: all 0.2s ease;" onmouseover="this.style.boxShadow='0 8px 24px rgba(0,0,0,0.08)'; this.style.transform='translateY(-2px)'" onmouseout="this.style.boxShadow=''; this.style.transform=''">
                <div style="position: relative; text-align: center; padding: 1.5rem 1.25rem 0;">
                    @if($teacher->photo_url)
                        <img src="{{ asset('storage/' . $teacher->photo_url) }}" alt="{{ $teacher->name }}" style="width: 96px; height: 96px; object-fit: cover; border-radius: 50%; border: 3px solid #e2e8f0; margin: 0 auto; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                    @else
                        <div style="width: 96px; height: 96px; border-radius: 50%; background: linear-gradient(135deg, #99f6e4, #5eead4); margin: 0 auto; display: flex; align-items: center; justify-content: center; border: 3px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.08);">
                            <span style="font-family: 'Outfit', sans-serif; font-size: 1.75rem; font-weight: 800; color: #0f766e;">{{ strtoupper(substr($teacher->name, 0, 1)) }}</span>
                        </div>
                    @endif
                    @if($teacher->is_active)
                        <span style="position: absolute; top: 1rem; right: 1rem; font-size: 0.6rem; font-weight: 600; padding: 0.125rem 0.375rem; border-radius: 999px; color: #047857; background: #d1fae5;">Aktif</span>
                    @else
                        <span style="position: absolute; top: 1rem; right: 1rem; font-size: 0.6rem; font-weight: 600; padding: 0.125rem 0.375rem; border-radius: 999px; color: #64748b; background: #f1f5f9;">Nonaktif</span>
                    @endif
                </div>
                <div style="padding: 1rem 1.25rem 0; text-align: center;">
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">{{ $teacher->name }}</h4>
                    <p style="font-size: 0.75rem; font-weight: 600; color: #0d9488; margin-top: 0.25rem;">{{ $teacher->position ?? 'Guru' }}</p>
                    @if($teacher->bio)
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.5rem; line-height: 1.5;">{{ Str::limit($teacher->bio, 70) }}</p>
                    @endif
                </div>
                <div style="display: flex; gap: 0.375rem; padding: 1rem 1.25rem 1.25rem;">
                    <a href="{{ route('cms.teachers.edit', $teacher) }}" style="flex: 1; text-align: center; padding: 0.5rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Edit</a>
                    <form action="{{ route('cms.teachers.destroy', $teacher) }}" method="POST" style="flex: 1;" onsubmit="return confirm('Hapus data guru ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" style="width: 100%; padding: 0.5rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Hapus</button>
                    </form>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 3rem; text-align: center;">
                <svg style="width: 48px; height: 48px; color: #cbd5e1; margin: 0 auto;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                <p style="font-size: 0.8125rem; color: #94a3b8; margin-top: 0.75rem; font-style: italic;">Belum ada profil guru. Tambahkan yang pertama!</p>
            </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
