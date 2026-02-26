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
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Kelola profil madrasah, kontak, sosial media, dan tampilan website.</p>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
        <div style="padding: 0.875rem 1.25rem; background: #ecfdf5; border: 1.5px solid #a7f3d0; border-radius: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
            <svg style="width: 18px; height: 18px; color: #059669; flex-shrink: 0;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p style="font-size: 0.8125rem; font-weight: 600; color: #047857; margin: 0;">{{ session('success') }}</p>
        </div>
        @endif

        @php
            // Mapping nama group teknis ke judul Bahasa Indonesia + deskripsi + ikon
            $groupMeta = [
                'general' => [
                    'title' => 'Profil Madrasah',
                    'desc' => 'Informasi dasar, visi misi, dan sambutan kepala madrasah',
                    'color' => '#3b82f6',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',
                ],
                'contact' => [
                    'title' => 'Kontak & Alamat',
                    'desc' => 'Nomor telepon, WhatsApp, email, dan alamat lengkap',
                    'color' => '#10b981',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>',
                ],
                'social' => [
                    'title' => 'Sosial Media',
                    'desc' => 'Link akun sosial media resmi madrasah',
                    'color' => '#8b5cf6',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/></svg>',
                ],
                'ppdb' => [
                    'title' => 'Pengaturan PPDB',
                    'desc' => 'Konfigurasi pendaftaran siswa baru di website',
                    'color' => '#f59e0b',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>',
                ],
                'seo' => [
                    'title' => 'Tampilan di Mesin Pencari',
                    'desc' => 'Pengaturan agar website mudah ditemukan di Google',
                    'color' => '#ef4444',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>',
                ],
                'stats' => [
                    'title' => 'Statistik Beranda',
                    'desc' => 'Angka-angka yang ditampilkan di halaman utama website',
                    'color' => '#06b6d4',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>',
                ],
            ];
        @endphp

        <!-- Form Pengaturan -->
        <form action="{{ route('cms.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @foreach ($settings as $group => $items)
            @php
                $meta = $groupMeta[$group] ?? [
                    'title' => ucfirst(str_replace('_', ' ', $group)),
                    'desc' => '',
                    'color' => '#64748b',
                    'icon' => '<svg style="width:16px;height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>',
                ];
            @endphp
            @php
                $iconBg = 'width:32px;height:32px;background:' . $meta['color'] . '15;border-radius:0.5rem;display:flex;align-items:center;justify-content:center;color:' . $meta['color'] . ';';
                $badgeStyle = 'font-size:0.6875rem;font-weight:600;padding:0.125rem 0.5rem;border-radius:999px;color:' . $meta['color'] . ';background:' . $meta['color'] . '10;';
                $focusColor = $meta['color'];
            @endphp
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; margin-bottom: 1.5rem;">
                <!-- Header Group -->
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.625rem;">
                        <div {!! 'style="' . $iconBg . '"' !!}>
                            {!! $meta['icon'] !!}
                        </div>
                        <div>
                            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">{{ $meta['title'] }}</h4>
                            @if ($meta['desc'])
                            <p style="font-size: 0.6875rem; color: #94a3b8; margin: 0.125rem 0 0;">{{ $meta['desc'] }}</p>
                            @endif
                        </div>
                    </div>
                    <span {!! 'style="' . $badgeStyle . '"' !!}>{{ $items->count() }} pengaturan</span>
                </div>
                <!-- Isi Setting -->
                <div style="padding: 1.5rem; display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.25rem;">
                    @foreach ($items as $setting)
                    <div {!! in_array($setting->type, ['textarea']) ? 'style="grid-column: span 2;"' : '' !!}>
                        <label style="display: block; margin-bottom: 0.375rem; font-size: 0.75rem; font-weight: 600; color: #475569;">
                            {{ $setting->label ?? ucfirst(str_replace('_', ' ', $setting->key)) }}
                        </label>

                        @if ($setting->type === 'textarea')
                            @php
                                $focusTa = 'this.style.borderColor=\'' . $focusColor . '\';this.style.background=\'#fff\';this.style.boxShadow=\'0 0 0 3px ' . $focusColor . '18\'';
                                $blurTa = 'this.style.borderColor=\'#e2e8f0\';this.style.background=\'#f8fafc\';this.style.boxShadow=\'none\'';
                            @endphp
                            <textarea name="{{ $setting->key }}" rows="3" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease; resize: vertical; font-family: inherit;" {!! 'onfocus="' . $focusTa . '" onblur="' . $blurTa . '"' !!}>{{ old($setting->key, $setting->value) }}</textarea>
                        @elseif ($setting->type === 'image')
                            @if ($setting->value)
                                <div style="margin-bottom: 0.5rem; display: inline-block; position: relative;">
                                    <img src="{{ asset('storage/' . $setting->value) }}" alt="{{ $setting->label }}" style="max-height: 80px; border-radius: 0.625rem; border: 1.5px solid #e2e8f0; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
                                </div>
                            @endif
                            <div style="position: relative;">
                                <input type="file" name="{{ $setting->key }}" accept="image/*,.pdf" style="width: 100%; padding: 0.5rem; border: 1.5px dashed #cbd5e1; border-radius: 0.625rem; font-size: 0.75rem; color: #64748b; background: #f8fafc; cursor: pointer;">
                                <p style="font-size: 0.625rem; color: #94a3b8; margin: 0.25rem 0 0;">Format: JPG, PNG, atau PDF. Maks 2MB.</p>
                            </div>
                        @else
                            @php
                                $focusIn = 'this.style.borderColor=\'' . $focusColor . '\';this.style.background=\'#fff\';this.style.boxShadow=\'0 0 0 3px ' . $focusColor . '18\'';
                                $blurIn = 'this.style.borderColor=\'#e2e8f0\';this.style.background=\'#f8fafc\';this.style.boxShadow=\'none\'';
                            @endphp
                            <input type="text" name="{{ $setting->key }}" value="{{ old($setting->key, $setting->value) }}" placeholder="Belum diisi" style="width: 100%; padding: 0.625rem 0.875rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; color: #1e293b; background: #f8fafc; transition: all 0.2s ease; font-family: inherit;" {!! 'onfocus="' . $focusIn . '" onblur="' . $blurIn . '"' !!}>
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
