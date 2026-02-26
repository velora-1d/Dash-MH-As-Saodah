<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; right: 80px; bottom: -40px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                            <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Pengaturan Sistem</h2>
                            <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Konfigurasi profil madrasah dan manajemen akses pengguna.</p>
                        </div>
                    </div>
                    <div style="display: flex; gap: 0.5rem;">
                        <button onclick="switchTab('profil')" id="tab-btn-profil" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.35); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; border: 1.5px solid rgba(255,255,255,0.5); cursor: pointer; transition: all 0.2s ease;">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                            Profil
                        </button>
                        @if (in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin', 'operator']))
                        <button onclick="switchTab('users')" id="tab-btn-users" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease;">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Manajemen User
                        </button>
                        <a href="{{ route('settings.menus.index') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease; text-decoration: none;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                            Menu Layout
                        </a>
                        @endif

                        @if (Auth::user()->role === 'superadmin')
                        <button onclick="switchTab('danger')" id="tab-btn-danger" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.1); color: #fca5a5; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; border: 1px solid rgba(239,68,68,0.3); cursor: pointer; transition: all 0.2s ease;">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 15c-.77 1.333.192 3 1.732 3z" /></svg>
                            Zona Bahaya
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        

        <!-- Tab 1: Profil Madrasah -->
        <section id="tab-profil">
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                    <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Identitas Utama Madrasah</h4>
                </div>

                <form action="{{ route('settings.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="padding: 2rem; display: grid; grid-template-columns: 1fr 1fr 300px; gap: 2rem;">
                        <!-- Form Fields -->
                        <div style="grid-column: span 2; display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                            <div style="grid-column: span 2;">
                                <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Nama Lengkap Madrasah <span style="color: #e11d48;">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $setting->name) }}" required
                                       style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; transition: border-color 0.2s ease;"
                                       onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Telepon / WhatsApp Official</label>
                                <input type="text" name="phone" value="{{ old('phone', $setting->phone) }}"
                                       style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; transition: border-color 0.2s ease;"
                                       onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Email Official</label>
                                <input type="email" name="email" value="{{ old('email', $setting->email) }}"
                                       style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; transition: border-color 0.2s ease;"
                                       onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div style="grid-column: span 2;">
                                <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Alamat Lengkap Madrasah</label>
                                <textarea name="address" rows="3"
                                          style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; resize: none; transition: border-color 0.2s ease;"
                                          onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">{{ old('address', $setting->address) }}</textarea>
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">Kepala Madrasah</label>
                                <input type="text" name="headmaster_name" value="{{ old('headmaster_name', $setting->headmaster_name) }}"
                                       style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; transition: border-color 0.2s ease;"
                                       onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                            <div>
                                <label style="display: block; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 0.375rem;">NIP Kepala Madrasah</label>
                                <input type="text" name="headmaster_nip" value="{{ old('headmaster_nip', $setting->headmaster_nip) }}"
                                       style="width: 100%; box-sizing: border-box; padding: 0.625rem 0.875rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; transition: border-color 0.2s ease;"
                                       onfocus="this.style.borderColor='#6366f1'" onblur="this.style.borderColor='#e2e8f0'">
                            </div>
                        </div>

                        <!-- Logo Section -->
                        <div>
                            <div style="background: #f5f3ff; border: 2px dashed #c4b5fd; border-radius: 1rem; padding: 1.5rem; text-align: center;">
                                <p style="font-size: 0.6875rem; font-weight: 600; color: #4c1d95; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 1rem 0;">Logo Lembaga</p>
                                <div style="width: 120px; height: 120px; margin: 0 auto; background: #fff; border-radius: 0.75rem; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; padding: 0.75rem; overflow: hidden;">
                                    @if ($setting->logo_path)
                                        <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Logo" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                    @else
                                        <svg style="width: 48px; height: 48px; color: #c4b5fd;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                    @endif
                                </div>
                                <label style="display: inline-flex; align-items: center; margin-top: 1rem; padding: 0.5rem 1rem; background: #fff; border: 1px solid #c4b5fd; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #6366f1; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background='#f5f3ff'" onmouseout="this.style.background='#fff'">
                                    Ubah Logo
                                    <input type="file" name="logo" style="display: none;">
                                </label>
                                <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.5rem; font-style: italic;">PNG, JPG, WEBP (Maks: 2MB)</p>
                            </div>
                        </div>
                    </div>

                    <div style="padding: 1.25rem 2rem; background: #f8fafc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end;">
                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                            <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Simpan Perubahan Profil
                        </button>
                    </div>
                </form>
            </div>
        </section>

        <!-- Tab 2: Manajemen User -->
        @if (in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin', 'operator']))
        <section id="tab-users" style="display: none;">
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #8b5cf6); border-radius: 50%;"></div>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Akses & Manajemen Pengguna</h4>
                    </div>
                    <a href="{{ route('settings.users.create') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; color: #fff; border-radius: 0.625rem; font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; text-decoration: none; background: linear-gradient(135deg, #1e293b, #0f172a); transition: all 0.2s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem; color: #f59e0b;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah Akun Baru
                    </a>
                </div>

                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                                <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Detail Pengguna</th>
                                <th style="padding: 0.875rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Privilege</th>
                                <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Status Akun</th>
                                <th style="padding: 0.875rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Kontrol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 1rem 1.5rem;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div style="width: 40px; height: 40px; background: linear-gradient(135deg, #ede9fe, #e0e7ff); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.8125rem; color: #6366f1;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $user->name }}</p>
                                            <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem;">@ {{ $user->username }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td style="padding: 1rem 1.5rem;">
                                    <span style="display: inline-flex; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #6366f1; background: #eef2ff; border-radius: 999px; text-transform: capitalize;">{{ $user->role }}</span>
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    @if ($user->status === 'aktif')
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 999px;">
                                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                            Aktif
                                        </span>
                                    @else
                                        <span style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.625rem; font-size: 0.6875rem; font-weight: 600; color: #be123c; background: #ffe4e6; border-radius: 999px;">
                                            <svg style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 1rem 1.5rem; text-align: center;">
                                    <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                        <a href="{{ route('settings.users.edit', $user) }}" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #4f46e5; background: #e0e7ff; border: 1px solid #c7d2fe; border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Edit</a>
                                        @if ($user->id !== Auth::id())
                                        <form action="{{ route('settings.users.toggle', $user) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @if ($user->status === 'aktif')
                                                <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #e11d48; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Nonaktifkan</button>
                                            @else
                                                <button type="submit" style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #059669; background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">Akses Kembali</button>
                                            @endif
                                        </form>
                                        @else
                                            <span style="display: inline-flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.6875rem; font-weight: 600; color: #cbd5e1; font-style: italic;">(Akun Anda)</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        @endif

        <!-- Tab 3: Zona Bahaya (Super Admin Only) -->
        @if (Auth::user()->role === 'superadmin')
        <section id="tab-danger" style="display: none;">
            <div style="background: #18181b; border-radius: 1rem; border: 2px solid #ef4444; overflow: hidden; box-shadow: 0 0 20px rgba(239, 68, 68, 0.2);">
                <div style="padding: 1.5rem; border-bottom: 1px solid #3f3f46; background: linear-gradient(135deg, #450a0a, #7f1d1d); display: flex; align-items: center; gap: 0.75rem;">
                    <div style="padding: 0.5rem; background: rgba(239,68,68,0.2); border-radius: 0.5rem; border: 1px solid rgba(239,68,68,0.4);">
                        <svg style="width: 1.5rem; height: 1.5rem; color: #fca5a5;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 15c-.77 1.333.192 3 1.732 3z" /></svg>
                    </div>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.25rem; color: #fecaca; margin: 0; text-transform: uppercase; letter-spacing: 0.05em;">Zona Berbahaya: Pemusnahan Data</h4>
                </div>

                <div style="padding: 2.5rem; background: #27272a;">
                    <div style="background: #450a0a; border: 1px dashed #ef4444; border-radius: 1rem; padding: 2rem; display: flex; gap: 1.5rem; align-items: flex-start; box-shadow: inset 0 0 15px rgba(0,0,0,0.5);">
                        <div style="width: 50px; height: 50px; background: #7f1d1d; border: 2px solid #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 0 15px rgba(239,68,68,0.5);">
                            <svg style="width: 24px; height: 24px; color: #fecaca;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </div>
                        <div>
                            <h5 style="font-size: 1.125rem; font-weight: 800; color: #fca5a5; margin: 0; text-transform: uppercase;">WIPE SYSTEM (Hapus Total Data Operasional)</h5>
                            <p style="font-size: 0.9375rem; color: #f8bdc0; margin-top: 0.75rem; line-height: 1.6;">
                                Peringatan! Mengeklik tombol ini akan menghapus <span style="font-weight: 800; color: #ef4444;">SELURUH DATA</span> operasional institusi (Siswa, Kelas, Transaksi Infaq/Spp, Gaji Pegawai, Inventaris, dan Konten Website).
                                Pengguna sistem (User Administrator) tetap dipertahankan.
                            </p>
                            <div style="margin-top: 1rem; padding: 0.75rem; background: rgba(0,0,0,0.3); border-left: 4px solid #ef4444; border-radius: 0 0.5rem 0.5rem 0;">
                                <p style="font-size: 0.8125rem; color: #fecaca; font-weight: 600; margin: 0;">
                                    <span style="color: #ef4444; font-weight: 800;">PERHATIAN MUTLAK:</span> Tindakan ini bersifat PERMANEN, TIDAK BISA DIKEMBALIKAN, dan akan mengosongkan SELURUH DATABASE transaksi Anda!
                                </p>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; display: flex; flex-direction: column; align-items: center; gap: 1.5rem;">
                        
                        <!-- Tombol Backup Pre-Wipe -->
                        <div style="width: 100%; max-width: 600px; padding: 1.25rem; background: #fffbeb; border: 1px dashed #f59e0b; border-radius: 0.75rem; text-align: center;">
                            <p style="font-size: 0.8125rem; color: #b45309; margin-bottom: 1rem; font-weight: 600;">Sangat disarankan untuk mendownload cadangan data sebelum melanjutkan penghapusan.</p>
                            <a href="{{ route('settings.backup.download') }}" target="_blank" 
                               style="display: inline-flex; align-items: center; padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: #ea580c; border-radius: 0.5rem; text-decoration: none; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(234, 88, 12, 0.2);"
                               onmouseover="this.style.background='#c2410c'; this.style.transform='translateY(-1px)'" 
                               onmouseout="this.style.background='#ea580c'; this.style.transform=''">
                                <svg style="width: 1.125rem; height: 1.125rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
                                Download Backup Database (.sql)
                            </a>
                        </div>

                        <!-- Checkbox Verifikasi Manual -->
                        <div style="display: flex; align-items: center; gap: 0.75rem; user-select: none;">
                            <input type="checkbox" id="backup-confirm-checkbox" onclick="toggleWipeButton()" style="width: 1.25rem; height: 1.25rem; border-radius: 0.25rem; border: 2px solid #ef4444; cursor: pointer;">
                            <label for="backup-confirm-checkbox" style="font-size: 0.875rem; color: #fca5a5; cursor: pointer;">Saya menyatakan telah menyimpan Backup Database sebelum melanjutkan.</label>
                        </div>

                        <!-- Tombol Eksekusi -->
                        <button type="button" id="btn-wipe-data" onclick="confirmWipeData()" disabled
                                style="display: inline-flex; align-items: center; justify-content: center; padding: 1rem 3rem; font-size: 1rem; font-weight: 800; color: #fff; background: #3f3f46; border: 2px solid #52525b; border-radius: 0.75rem; cursor: not-allowed; transition: all 0.3s ease; text-transform: uppercase; letter-spacing: 0.1em; outline: none; opacity: 0.5;">
                            <span style="display: flex; align-items: center; justify-content: center;">
                                <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                                YA, HANGUSKAN SEMUA DATA SEKARANG!
                            </span>
                        </button>
                    </div>

                    <form id="wipe-data-form" action="{{ route('settings.wipe-data') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="confirmation" id="wipe-confirmation-input">
                    </form>

                    <!-- Pembatas Horizontal -->
                    <div style="width: 100%; height: 1px; background: #3f3f46; margin: 3rem 0;"></div>

                    <!-- RESTORE DATABASE SECTION -->
                    <div style="background: #27272a; border: 1px dashed #ca8a04; border-radius: 1rem; padding: 2rem; display: flex; gap: 1.5rem; align-items: flex-start; box-shadow: inset 0 0 15px rgba(0,0,0,0.5);">
                        <div style="width: 50px; height: 50px; background: #ca8a04; border: 2px solid #facc15; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 0 15px rgba(202,138,4,0.5);">
                            <svg style="width: 24px; height: 24px; color: #fef08a;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                        </div>
                        <div style="width: 100%;">
                            <h5 style="font-size: 1.125rem; font-weight: 800; color: #fde047; margin: 0; text-transform: uppercase;">RESTORE DATABASE (PEMULIHAN DATA)</h5>
                            <p style="font-size: 0.9375rem; color: #fef08a; margin-top: 0.75rem; line-height: 1.6;">
                                Jika Anda memiliki file cadangan berformat <span style="font-weight: 800; color: #eab308;">.sql</span>, Anda dapat mengunggahnya di sini.
                                <br><span style="color: #ef4444; font-weight: 800;">PERINGATAN:</span> Tindakan ini akan menghapus dan menimpa transaksi saat ini dengan isi dari file backup. Pastikan file valid!
                            </p>
                            
                            <form id="restore-data-form" class="ignore-size-validation" action="{{ route('settings.backup.restore') }}" method="POST" enctype="multipart/form-data" style="margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                                @csrf
                                <input type="hidden" name="confirmation" id="restore-confirmation-input">
                                
                                <label style="display: flex; align-items: center; justify-content: center; width: 100%; padding: 1rem; background: rgba(0,0,0,0.3); border: 2px dashed #ca8a04; border-radius: 0.5rem; cursor: pointer; color: #fde047; font-weight: 600; font-size: 0.875rem; transition: all 0.2s;" onmouseover="this.style.background='rgba(202,138,4,0.2)'" onmouseout="this.style.background='rgba(0,0,0,0.3)'">
                                    <svg style="width: 1.25rem; height: 1.25rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" /></svg>
                                    Klik untuk Memilih File .sql
                                    <input type="file" name="sql_file" id="sql_file_input" accept=".sql" style="display: none;" onchange="document.getElementById('file-name-display').innerText = this.files[0]?.name || 'Tidak ada file dipilih'">
                                </label>
                                <div style="text-align: center;">
                                    <span id="file-name-display" style="font-size: 0.75rem; color: #facc15; font-style: italic;">Tidak ada file dipilih</span>
                                </div>

                                <div style="text-align: center; margin-top: 0.5rem;">
                                    <button type="button" onclick="confirmRestoreData()" 
                                            style="display: inline-flex; align-items: center; padding: 0.75rem 2rem; font-size: 0.875rem; font-weight: 800; color: #fff; background: #ca8a04; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(202, 138, 4, 0.3);"
                                            onmouseover="this.style.background='#a16207'; this.style.transform='translateY(-1px)'" 
                                            onmouseout="this.style.background='#ca8a04'; this.style.transform=''">
                                        <svg style="width: 1.125rem; height: 1.125rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" /></svg>
                                        JALANKAN RESTORE SEKARANG
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </div>

    <style>
        html { scroll-behavior: smooth; }
    </style>

    <script>
        function switchTab(tab) {
            var profil = document.getElementById('tab-profil');
            var users = document.getElementById('tab-users');
            var danger = document.getElementById('tab-danger');
            
            var btnProfil = document.getElementById('tab-btn-profil');
            var btnUsers = document.getElementById('tab-btn-users');
            var btnDanger = document.getElementById('tab-btn-danger');
 
            var activeStyle = 'display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.35); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; border: 1.5px solid rgba(255,255,255,0.5); cursor: pointer; transition: all 0.2s ease;';
            var inactiveStyle = 'display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease;';
            var dangerActiveStyle = 'display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: #ef4444; color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; border: 1.5px solid #dc2626; cursor: pointer; transition: all 0.2s ease;';
            var dangerInactiveStyle = 'display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.1); color: #fca5a5; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 700; border: 1px solid rgba(239,68,68,0.3); cursor: pointer; transition: all 0.2s ease;';

            // Reset semua
            profil.style.display = 'none';
            if (users) users.style.display = 'none';
            if (danger) danger.style.display = 'none';
            
            btnProfil.style.cssText = inactiveStyle;
            if (btnUsers) btnUsers.style.cssText = inactiveStyle;
            if (btnDanger) btnDanger.style.cssText = dangerInactiveStyle;

            if (tab === 'profil') {
                profil.style.display = 'block';
                btnProfil.style.cssText = activeStyle;
            } else if (tab === 'users') {
                if (users) users.style.display = 'block';
                if (btnUsers) btnUsers.style.cssText = activeStyle;
            } else if (tab === 'danger') {
                if (danger) danger.style.display = 'block';
                if (btnDanger) btnDanger.style.cssText = dangerActiveStyle;
            }
        }

        function toggleWipeButton() {
            var checkbox = document.getElementById('backup-confirm-checkbox');
            var btn = document.getElementById('btn-wipe-data');
            
            if (checkbox.checked) {
                btn.disabled = false;
                btn.style.cursor = 'pointer';
                btn.style.opacity = '1';
                btn.style.background = 'linear-gradient(135deg, #b91c1c, #7f1d1d)';
                btn.style.borderColor = '#ef4444';
                btn.style.boxShadow = '0 0 20px rgba(220, 38, 38, 0.4)';
                
                // Add hover events dynamically
                btn.onmouseover = function() {
                    this.style.background = 'linear-gradient(135deg, #dc2626, #b91c1c)';
                    this.style.transform = 'scale(1.02)';
                    this.style.boxShadow = '0 0 30px rgba(239, 68, 68, 0.6)';
                };
                btn.onmouseout = function() {
                    this.style.background = 'linear-gradient(135deg, #b91c1c, #7f1d1d)';
                    this.style.transform = 'scale(1)';
                    this.style.boxShadow = '0 0 20px rgba(220, 38, 38, 0.4)';
                };
            } else {
                btn.disabled = true;
                btn.style.cursor = 'not-allowed';
                btn.style.opacity = '0.5';
                btn.style.background = '#3f3f46';
                btn.style.borderColor = '#52525b';
                btn.style.boxShadow = 'none';
                btn.onmouseover = null;
                btn.onmouseout = null;
                btn.style.transform = 'scale(1)';
            }
        }

        async function confirmWipeData() {
            if (!document.getElementById('backup-confirm-checkbox').checked) return;
            const { value: text } = await Swal.fire({
                title: 'TINDAKAN SANGAT BERBAHAYA!!',
                text: 'Apakah Anda benar-benar ingin menghapus SELURUH data sistem? Ketik "KONFIRMASI HAPUS SEMUA DATA" di bawah untuk melanjutkan.',
                input: 'text',
                inputPlaceholder: 'Ketik kalimat konfirmasi...',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'YA, HAPUS PERMANEN!',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value || value !== 'KONFIRMASI HAPUS SEMUA DATA') {
                        return 'Teks konfirmasi salah!';
                    }
                }
            });

            if (text === 'KONFIRMASI HAPUS SEMUA DATA') {
                document.getElementById('wipe-confirmation-input').value = text;
                document.getElementById('wipe-data-form').submit();
                
                Swal.fire({
                    title: 'Memproses...',
                    text: 'Sedang membersihkan database, mohon tunggu.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        }

        async function confirmRestoreData() {
            var fileInput = document.getElementById('sql_file_input');
            if (!fileInput.files || fileInput.files.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'File Kosong',
                    text: 'Harap pilih file backup berformat .sql terlebih dahulu!'
                });
                return;
            }

            const { value: text } = await Swal.fire({
                title: 'PERINGATAN RESTORE!',
                text: 'Proses ini akan MENIMPA SEMUA DATA transaksi saat ini dengan isi file backup. Ketik "KONFIRMASI RESTORE DATA" untuk melanjutkan.',
                input: 'text',
                inputPlaceholder: 'Ketik kalimat konfirmasi...',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ca8a04',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Restore Sekarang!',
                cancelButtonText: 'Batal',
                inputValidator: (value) => {
                    if (!value || value !== 'KONFIRMASI RESTORE DATA') {
                        return 'Teks konfirmasi salah!';
                    }
                }
            });

            if (text === 'KONFIRMASI RESTORE DATA') {
                document.getElementById('restore-confirmation-input').value = text;
                document.getElementById('restore-data-form').submit();
                
                Swal.fire({
                    title: 'Memproses Restore...',
                    text: 'Sedang mengeksekusi file backup ke Server Database, mohon tunggu.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            }
        }
    </script>
</x-app-layout>
