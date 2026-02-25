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
                        @if(in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin', 'operator']))
                        <button onclick="switchTab('users')" id="tab-btn-users" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease;">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                            Manajemen User
                        </button>
                        <a href="{{ route('settings.menus.index') }}" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: rgba(255,255,255,0.15); color: #fff; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.25); cursor: pointer; transition: all 0.2s ease; text-decoration: none;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
                            <svg style="width: 0.875rem; height: 0.875rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /></svg>
                            Menu Layout
                        </a>
                        @endif

                        @if(Auth::user()->role === 'superadmin')
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
                                    @if($setting->logo_path)
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
        @if(in_array(Auth::user()->role, ['kepsek', 'admin', 'superadmin', 'operator']))
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
                            @foreach($users as $user)
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
                                    @if($user->status === 'aktif')
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
                                        @if($user->id !== Auth::id())
                                        <form action="{{ route('settings.users.toggle', $user) }}" method="POST" style="margin: 0;">
                                            @csrf
                                            @if($user->status === 'aktif')
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
        @if(Auth::user()->role === 'superadmin')
        <section id="tab-danger" style="display: none;">
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #fee2e2; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #fee2e2; background: #fffaf0; display: flex; align-items: center; gap: 0.5rem;">
                    <svg style="width: 1.25rem; height: 1.25rem; color: #ef4444;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 15c-.77 1.333.192 3 1.732 3z" /></svg>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #b91c1c; margin: 0;">Danger Zone: Wipe System</h4>
                </div>

                <div style="padding: 2rem;">
                    <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.75rem; padding: 1.5rem; display: flex; gap: 1rem; align-items: flex-start;">
                        <div style="width: 40px; height: 40px; background: #fee2e2; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                            <svg style="width: 20px; height: 20px; color: #ef4444;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                        </div>
                        <div>
                            <h5 style="font-size: 0.9375rem; font-weight: 700; color: #991b1b; margin: 0;">Hapus Seluruh Data Operasional</h5>
                            <p style="font-size: 0.8125rem; color: #b91c1c; margin-top: 0.5rem; line-height: 1.5;">
                                Tindakan ini akan menghapus **SELURUH DATA** (Siswa, Kelas, Transaksi, Infaq, Gaji, Inventaris, dan Konten Website).
                                Pengguna sistem (User Accounts) tidak akan dihapus agar Anda tetap bisa login.
                            </p>
                            <p style="font-size: 0.75rem; color: #ef4444; margin-top: 0.75rem; font-weight: 600; font-style: italic;">
                                * Perhatian: Tindakan ini bersifat PERMANEN dan tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>

                    <div style="margin-top: 2rem; text-align: center;">
                        <button type="button" onclick="confirmWipeData()" 
                                style="display: inline-flex; align-items: center; padding: 0.75rem 2rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: #ef4444; border: none; border-radius: 0.75rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.2);"
                                onmouseover="this.style.background='#dc2626'; this.style.transform='translateY(-1px)'" 
                                onmouseout="this.style.background='#ef4444'; this.style.transform=''">
                            <svg style="width: 1.125rem; height: 1.125rem; margin-right: 0.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                            YA, HAPUS SEMUA DATA SEKARANG
                        </button>
                    </div>

                    <form id="wipe-data-form" action="{{ route('settings.wipe-data') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="confirmation" id="wipe-confirmation-input">
                    </form>
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

        async function confirmWipeData() {
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
    </script>
</x-app-layout>
