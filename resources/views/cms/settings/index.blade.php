<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #10b981 0%, #059669 50%, #047857 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Pengaturan Website</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola informasi umum, kontak, sosial media, PPDB, dan SEO website.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Pengaturan -->
        <form action="{{ route('cms.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach($settings as $group => $items)
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #10b981, #059669); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0; text-transform: capitalize;">{{ str_replace('_', ' ', $group) }}</h4>
                    <span style="font-size: 0.6875rem; font-weight: 600; padding: 0.125rem 0.5rem; border-radius: 999px; color: #059669; background: #ecfdf5; margin-left: 0.5rem;">{{ $items->count() }} item</span>
                </div>
                <div style="padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem;">
                    @foreach($items as $setting)
                    <div style="{{ $setting->type === 'textarea' ? 'grid-column: span 2;' : '' }}">
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569; text-transform: capitalize;">{{ str_replace('_', ' ', str_replace(['site_', 'ppdb_', 'seo_', 'social_', 'contact_', 'stats_'], '', $setting->key)) }}</label>

                        @if($setting->type === 'textarea')
                            <textarea name="{{ $setting->key }}" rows="3" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease; resize: vertical;" onfocus="this.style.borderColor='#10b981'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">{{ old($setting->key, $setting->value) }}</textarea>
                        @elseif($setting->type === 'image')
                            @if($setting->value)
                                <div style="margin-bottom: 0.5rem; display: inline-block; position: relative;">
                                    <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->label }}" style="max-height: 80px; border-radius: 0.625rem; border: 1.5px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                                </div>
                            @endif
                            <input type="file" name="{{ $setting->key }}" accept="image/*,.pdf" style="width: 100%; padding: 0.5rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.75rem; color: #64748b; background: #f8fafc; cursor: pointer;">
                        @else
                            <input type="text" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease;" onfocus="this.style.borderColor='#10b981'; this.style.background='#fff'; this.style.boxShadow='0 0 0 3px rgba(16,185,129,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.background='#f8fafc'; this.style.boxShadow='none'">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div style="display: flex; justify-content: flex-end; padding-bottom: 2rem;">
                <button type="submit" style="display: inline-flex; align-items: center; padding: 0.75rem 2rem; background: linear-gradient(135deg, #10b981, #059669); border-radius: 0.625rem; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; color: #fff; cursor: pointer; border: none; box-shadow: 0 4px 12px rgba(16,185,129,0.3); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 16px rgba(16,185,129,0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 12px rgba(16,185,129,0.3)'">
                    <svg style="width: 1rem; height: 1rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Semua Pengaturan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
