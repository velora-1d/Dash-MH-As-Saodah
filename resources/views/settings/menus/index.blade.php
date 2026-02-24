<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('settings.index') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; color: #fff; transition: all 0.2s ease; text-decoration: none;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        </a>
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Manajemen Menu Aplikasi</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Atur tata letak, icon, dan hak akses menu sidebar.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <a href="{{ route('settings.menus.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; background: #fff; color: #4f46e5; border-radius: 0.625rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; text-decoration: none; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1)'">
                            <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                            Tambah Menu Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.75rem; padding: 1rem 1.5rem; display: flex; align-items: center; gap: 0.75rem; margin-bottom: 1.5rem;">
            <div style="width: 24px; height: 24px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <svg style="width: 14px; height: 14px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <p style="font-size: 0.8125rem; font-weight: 600; color: #065f46; margin: 0;">{{ session('success') }}</p>
        </div>
        @endif

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 60px;">Urutan</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama Menu & Info</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Roles Akses</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status</th>
                            <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $menu)
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #e0e7ff; color: #4f46e5; border-radius: 0.5rem; font-weight: 700; font-size: 0.75rem;">
                                    {{ $menu->order_index }}
                                </span>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
                                    <div style="width: 36px; height: 36px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0; color: #64748b;">
                                        <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            {!! $menu->icon_svg !!}
                                        </svg>
                                    </div>
                                    <div>
                                        <p style="font-weight: 700; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $menu->name }}</p>
                                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.25rem;">
                                            <span style="font-size: 0.6875rem; color: #64748b; background: #f1f5f9; padding: 0.125rem 0.375rem; border-radius: 0.25rem; font-family: monospace;">{{ $menu->route_name }}</span>
                                            @if($menu->group_name)
                                            <span style="font-size: 0.625rem; font-weight: 600; color: #8b5cf6; text-transform: uppercase;">• {{ $menu->group_name }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem;">
                                <div style="display: flex; flex-wrap: wrap; gap: 0.25rem;">
                                    @foreach($menu->roles ?? [] as $role)
                                        <span style="font-size: 0.625rem; font-weight: 600; color: #4338ca; background: #e0e7ff; padding: 0.125rem 0.5rem; border-radius: 999px; text-transform: capitalize;">{{ $role }}</span>
                                    @endforeach
                                </div>
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                @if($menu->is_active)
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                        <span style="width: 6px; height: 6px; background: #10b981; border-radius: 50%;"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #94a3b8; background: #f1f5f9; border-radius: 999px;">
                                        <span style="width: 6px; height: 6px; background: #cbd5e1; border-radius: 50%;"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1rem 1.5rem; text-align: center;">
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.375rem;">
                                    <a href="{{ route('settings.menus.edit', $menu) }}" title="Edit Menu" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #e0e7ff; color: #4f46e5; border-radius: 0.375rem; transition: all 0.2s ease;" onmouseover="this.style.background='#c7d2fe'" onmouseout="this.style.background='#e0e7ff'">
                                        <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                                    </a>
                                    <form action="{{ route('settings.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus menu ini?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus Menu" style="display: inline-flex; align-items: center; justify-content: center; width: 28px; height: 28px; background: #ffe4e6; color: #e11d48; border: none; border-radius: 0.375rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#fecdd3'" onmouseout="this.style.background='#ffe4e6'">
                                            <svg style="width: 0.875rem; height: 0.875rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="padding: 3rem 1.5rem; text-align: center;">
                                <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; background: #f1f5f9; border-radius: 50%; color: #94a3b8; margin-bottom: 1rem;">
                                    <svg style="width: 1.5rem; height: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                                </div>
                                <p style="font-weight: 600; font-size: 0.875rem; color: #475569; margin: 0;">Belum ada menu yang dikonfigurasi</p>
                                <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">Klik "Tambah Menu Baru" untuk mulai membuat tata letak sidebar.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
