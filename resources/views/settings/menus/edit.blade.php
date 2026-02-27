<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <a href="{{ route('settings.menus.index') }}" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; color: #fff; transition: all 0.2s ease; text-decoration: none;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        </a>
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Edit Data Menu</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Perbarui tata letak, icon, atau hak akses sidebar.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
        <div style="background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.75rem; padding: 1rem 1.5rem;">
            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                <div style="width: 24px; height: 24px; background: #e11d48; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg style="width: 14px; height: 14px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <p style="font-size: 0.8125rem; font-weight: 700; color: #9f1239; margin: 0;">Terdapat kesalahan pada input Anda:</p>
            </div>
            <ul style="margin: 0; padding-left: 2.5rem; font-size: 0.8125rem; color: #be123c;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div class="fi-section-dot"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Form Ubah Data</h4>
            </div>

            <form action="{{ route('settings.menus.update', $menu) }}" method="POST">
                @csrf @method('PUT')
                <div style="padding: 2rem;">
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Nama Menu" name="name" :required="true">
                            <input type="text" name="name" value="{{ old('name', $menu->name) }}" required placeholder="Contoh: Dashboard Utama"
                                class="fi-input @error('name') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Route Name" name="route_name" :required="true">
                            <input type="text" name="route_name" value="{{ old('route_name', $menu->route_name) }}" required placeholder="Contoh: dashboard / reports.index"
                                class="fi-input @error('route_name') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Group / Kategori (Header)" name="group_name">
                            <input type="text" name="group_name" value="{{ old('group_name', $menu->group_name) }}" placeholder="Contoh: Basis Data Utama"
                                class="fi-input @error('group_name') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Urutan Tampil (Order)" name="order_index" :required="true">
                            <input type="number" name="order_index" value="{{ old('order_index', $menu->order_index) }}" required
                                class="fi-input @error('order_index') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Kode Icon SVG (hanya elemen path)" name="icon_svg" :required="true" class="fi-grid-full">
                            <textarea name="icon_svg" rows="3" required
                                class="fi-input fi-textarea @error('icon_svg') fi-error @enderror" style="font-family: monospace;">{{ old('icon_svg', $menu->icon_svg) }}</textarea>
                        </x-form-group>

                        <!-- Hak Akses (Roles) -->
                        <div style="grid-column: span 2;">
                            <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.75rem;">Hak Akses (Role) <span style="color: #e11d48;">*</span></label>
                            @php
                                $availableRoles = ['kepsek' => 'Kepala Sekolah', 'admin' => 'Admin Sistem', 'operator' => 'Operator', 'bendahara' => 'Bendahara', 'guru' => 'Guru', 'siswa' => 'Siswa'];
                                $selectedRoles = old('roles', is_array($menu->roles) ? $menu->roles : []);
                            @endphp
                            <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                                @foreach ($availableRoles as $roleValue => $roleLabel)
                                <label style="display: inline-flex; align-items: center; cursor: pointer; padding: 0.5rem 0.75rem; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; background: #f8fafc; transition: all 0.2s ease;">
                                    <input type="checkbox" name="roles[]" value="{{ $roleValue }}" {{ in_array($roleValue, $selectedRoles) ? 'checked' : '' }}
                                           style="width: 1rem; height: 1rem; margin-right: 0.5rem; accent-color: #6366f1;">
                                    <span style="font-size: 0.8125rem; font-weight: 600; color: #334155;">{{ $roleLabel }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Status Aktif -->
                        <div style="grid-column: span 2;">
                            <label style="display: inline-flex; align-items: center; cursor: pointer;">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $menu->is_active) ? 'checked' : '' }}
                                       style="width: 1.125rem; height: 1.125rem; accent-color: #6366f1;">
                                <span style="margin-left: 0.75rem; font-size: 0.875rem; font-weight: 600; color: #1e293b;">Menu Aktif / Ditampilkan</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div style="padding: 1.25rem 2rem; background: #fafbfc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('settings.menus.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #fff; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#fff'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
