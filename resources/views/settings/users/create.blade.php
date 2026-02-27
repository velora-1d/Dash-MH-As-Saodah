<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 50%, #a78bfa 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Tambah Akun Tim Baru</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Berikan akses khusus untuk Bendahara atau Operator Madrasah.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('settings.index') }}" label="Kembali ke Pengaturan" />
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div class="fi-section-dot"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Informasi Akun</h4>
            </div>

            <form action="{{ route('settings.users.store') }}" method="POST">
                @csrf
                <div style="padding: 2rem;">
                    <div class="fi-grid fi-grid-2">
                        <x-form-group label="Nama Lengkap" name="name" :required="true" class="fi-grid-full">
                            <input type="text" name="name" value="{{ old('name') }}" required placeholder="Cth: Ahmad Subardjo"
                                class="fi-input @error('name') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Username (ID Login)" name="username" :required="true">
                            <input type="text" name="username" value="{{ old('username') }}" required placeholder="ahmad_saodah"
                                class="fi-input @error('username') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Email" name="email" :required="true">
                            <input type="email" name="email" value="{{ old('email') }}" required placeholder="ahmad@gmail.com"
                                class="fi-input @error('email') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Role Otoritas" name="role" :required="true">
                            <select name="role" required class="fi-input fi-select @error('role') fi-error @enderror">
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Penuh)</option>
                                <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator (Input & Verifikasi)</option>
                                <option value="bendahara" {{ old('role') == 'bendahara' ? 'selected' : '' }}>Bendahara (Keuangan)</option>
                                <option value="kepsek" {{ old('role') == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                            </select>
                        </x-form-group>

                        <div></div> <!-- Spacer -->

                        <x-form-group label="Password" name="password" :required="true">
                            <div style="position: relative;">
                                <input type="password" id="password" name="password" required
                                    class="fi-input @error('password') fi-error @enderror" style="padding-right: 2.5rem;">
                                <span onclick="togglePasswordVisibility('password', 'eye-icon-pw')" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af; display: flex; align-items: center; justify-content: center; width: 1.5rem; height: 1.5rem;">
                                    <svg id="eye-icon-pw" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </span>
                            </div>
                        </x-form-group>

                        <x-form-group label="Konfirmasi Password" name="password_confirmation" :required="true">
                            <div style="position: relative;">
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="fi-input" style="padding-right: 2.5rem;">
                                <span onclick="togglePasswordVisibility('password_confirmation', 'eye-icon-confirm')" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af; display: flex; align-items: center; justify-content: center; width: 1.5rem; height: 1.5rem;">
                                    <svg id="eye-icon-confirm" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </span>
                            </div>
                        </x-form-group>
                    </div>
                </div>

                <script>
                    function togglePasswordVisibility(inputId, iconId) {
                        const input = document.getElementById(inputId);
                        const icon = document.getElementById(iconId);
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />';
                        } else {
                            input.type = 'password';
                            icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                        }
                    }
                </script>

                <div style="padding: 1.25rem 2rem; background: #fafbfc; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <a href="{{ route('settings.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.15s;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Buat Akun Tim
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Note -->
        <div style="padding: 1.25rem; background: #fffbeb; border: 1px solid #fef3c7; border-radius: 1rem; display: flex; gap: 1rem;">
            <div style="color: #d97706;">
                <svg style="width: 1.5rem; height: 1.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
            </div>
            <div>
                <h5 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.8125rem; color: #92400e; margin: 0 0 0.25rem 0;">Catatan Keamanan</h5>
                <p style="font-size: 0.75rem; color: #b45309; margin: 0; line-height: 1.5;">Berikan kata sandi sementara yang aman. Staf disarankan segera mengubah kata sandi setelah login pertama kali.</p>
            </div>
        </div>
    </div>
</x-app-layout>
