<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <a href="{{ route('cms.posts.index') }}" style="width: 36px; height: 36px; background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border-radius: 0.625rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.25); text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                        <svg style="width: 16px; height: 16px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                    </a>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">{{ isset($post) ? 'Edit Artikel' : 'Tulis Artikel Baru' }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">{{ isset($post) ? 'Ubah konten artikel.' : 'Buat konten berita atau artikel baru.' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form 2 Kolom: Konten + Meta -->
        <form action="{{ isset($post) ? route('cms.posts.update', $post) : route('cms.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($post)) @method('PUT') @endif

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.25rem; align-items: start;">
                <!-- Kolom Kiri: Konten -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Konten Artikel</h4>
                    </div>
                    <div style="padding: 1.5rem; space-y: 1.25rem;">
                        <div style="margin-bottom: 1.25rem;">
                            <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Judul Artikel <span style="color: #e11d48;">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required placeholder="Masukkan judul artikel..." style="width: 100%; padding: 0.75rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.9375rem; font-weight: 600; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">
                        </div>
                        <div style="margin-bottom: 1.25rem;">
                            <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Ringkasan (Excerpt)</label>
                            <textarea name="excerpt" rows="2" placeholder="Ringkasan singkat untuk preview..." style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; resize: vertical; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Isi Artikel <span style="color: #e11d48;">*</span></label>
                            <textarea name="content" rows="14" required placeholder="Tulis isi artikel..." style="width: 100%; padding: 0.75rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; resize: vertical; line-height: 1.7; transition: all 0.2s ease;" onfocus="this.style.borderColor='#3b82f6'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">{{ old('content', $post->content ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan: Meta & Publish -->
                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <!-- Card Publish -->
                    <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                        <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                            <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%;"></div>
                            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; color: #1e293b; margin: 0;">Publikasi</h4>
                        </div>
                        <div style="padding: 1.25rem;">
                            <div style="margin-bottom: 1rem;">
                                <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Status</label>
                                <select name="is_published" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc;">
                                    <option value="0" {{ old('is_published', $post->is_published ?? false) ? '' : 'selected' }}>Draft</option>
                                    <option value="1" {{ old('is_published', $post->is_published ?? false) ? 'selected' : '' }}>Terbitkan</option>
                                </select>
                            </div>
                            <button type="submit" style="width: 100%; padding: 0.75rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #3b82f6, #2563eb); border-radius: 0.625rem; border: none; cursor: pointer; box-shadow: 0 4px 12px rgba(59,130,246,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                                <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem; vertical-align: middle;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Simpan Artikel
                            </button>
                        </div>
                    </div>

                    <!-- Card Thumbnail -->
                    <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                        <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                            <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #8b5cf6, #6d28d9); border-radius: 50%;"></div>
                            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; color: #1e293b; margin: 0;">Thumbnail</h4>
                        </div>
                        <div style="padding: 1.25rem;">
                            @if (isset($post) && $post->thumbnail)
                                <div style="margin-bottom: 0.75rem;">
                                    <img src="{{ asset('storage/' . $post->thumbnail) }}" style="width: 100%; height: 120px; object-fit: cover; border-radius: 0.625rem; border: 1.5px solid #e2e8f0;">
                                </div>
                            @endif
                            <input type="file" name="thumbnail" accept="image/*" style="width: 100%; padding: 0.5rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.75rem; color: #64748b; background: #f8fafc; cursor: pointer;">
                        </div>
                    </div>

                    <!-- Card SEO -->
                    <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                        <div style="padding: 1rem 1.25rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                            <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; color: #1e293b; margin: 0;">SEO</h4>
                        </div>
                        <div style="padding: 1.25rem;">
                            <div style="margin-bottom: 1rem;">
                                <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Meta Judul</label>
                                <input type="text" name="meta_title" value="{{ old('meta_title', $post->meta_title ?? '') }}" style="width: 100%; padding: 0.5rem 0.75rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.75rem; color: #1e293b; background: #f8fafc;">
                            </div>
                            <div>
                                <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">Meta Deskripsi</label>
                                <textarea name="meta_description" rows="2" style="width: 100%; padding: 0.5rem 0.75rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.75rem; color: #1e293b; background: #f8fafc; resize: vertical;">{{ old('meta_description', $post->meta_description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
