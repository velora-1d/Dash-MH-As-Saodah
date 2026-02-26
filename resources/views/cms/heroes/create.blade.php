<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 50%, #6d28d9 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <a href="{{ route('cms.heroes.index') }}" style="width: 36px; height: 36px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <svg style="width: 16px; height: 16px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </a>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">{{ isset($hero) ? 'Edit Slider Hero' : 'Tambah Slider Hero' }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">{{ isset($hero) ? 'Ubah konten slider yang ada.' : 'Tambahkan slider gambar atau video baru.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Detail Slider</h4>
            </div>
            <form action="{{ isset($hero) ? route('cms.heroes.update', $hero) : route('cms.heroes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($hero)) @method('PUT') @endif
                <div style="padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Judul Slider <span style="color: #e11d48;">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $hero->title ?? '') }}" required style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#8b5cf6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Subtitle</label>
                        <input type="text" name="subtitle" value="{{ old('subtitle', $hero->subtitle ?? '') }}" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#8b5cf6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(139,92,246,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">
                    </div>
                    <div style="grid-column: span 2;">
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Media (Gambar/Video) {{ isset($hero) ? '' : '*' }}</label>
                        @if (isset($hero) && $hero->media_url)
                            <div style="margin-bottom: 0.75rem; padding: 0.75rem; background: #f8fafc; border-radius: 0.625rem; border: 1.5px solid #e2e8f0; display: inline-flex; align-items: center; gap: 0.75rem;">
                                @if ($hero->media_type === 'image')
                                    <img src="{{ asset('storage/' . $hero->media_url) }}" style="max-height: 60px; border-radius: 0.5rem;">
                                @else
                                    <span style="font-size: 0.75rem; color: #7c3aed; font-weight: 600;">🎬 {{ basename($hero->media_url) }}</span>
                                @endif
                                <span style="font-size: 0.6875rem; color: #94a3b8;">File saat ini</span>
                            </div>
                        @endif
                        <input type="file" name="media" accept="image/*,video/mp4" {{ isset($hero) ? '' : 'required' }} style="width: 100%; padding: 0.5rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.75rem; color: #64748b; background: #f8fafc; cursor: pointer;">
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.375rem;">Format: JPG, PNG, WebP, MP4. Maks 20MB.</p>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">CTA Teks</label>
                        <input type="text" name="cta_text" value="{{ old('cta_text', $hero->cta_text ?? '') }}" placeholder="Daftar Sekarang" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#8b5cf6'; this.style.background='#fff'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">CTA URL</label>
                        <input type="text" name="cta_url" value="{{ old('cta_url', $hero->cta_url ?? '') }}" placeholder="/ppdb" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#8b5cf6'; this.style.background='#fff'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'">
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 0.5rem;">
                        <input type="hidden" name="is_active" value="0">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.8125rem; font-weight: 600; color: #475569;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero->is_active ?? true) ? 'checked' : '' }} style="width: 1.1rem; height: 1.1rem; accent-color: #7c3aed;">
                            Aktifkan slider ini
                        </label>
                    </div>
                </div>
                <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <a href="{{ route('cms.heroes.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #f1f5f9; border-radius: 0.625rem; text-decoration: none; border: 1px solid #e2e8f0; transition: all 0.15s ease;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #8b5cf6, #7c3aed); border-radius: 0.625rem; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(139,92,246,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(139,92,246,0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(139,92,246,0.3)'">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
