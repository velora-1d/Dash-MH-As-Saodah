<x-guest-layout>
<div class="min-h-screen flex">
    <!-- Left Side: Branding & Visual -->
    <div class="hidden lg:flex lg:w-1/2 bg-indigo-900 items-center justify-center relative overflow-hidden">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <defs>
                    <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100" height="100" fill="url(#grid)" />
            </svg>
        </div>
        
        <div class="relative z-10 text-center px-12">
            <div class="mb-8 inline-block p-4 bg-white/10 rounded-2xl backdrop-blur-xl border border-white/20">
                @php $schoolSetting = \App\Models\SchoolSetting::first(); @endphp
                @if ($schoolSetting && $schoolSetting->logo_path)
                    <img src="{{ asset('storage/' . $schoolSetting->logo_path) }}" alt="Logo Madrasah" class="w-24 h-24 object-contain">
                @else
                    <x-application-logo class="w-24 h-24 fill-current text-amber-500" />
                @endif
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">MI As-Saodah</h1>
            <p class="text-indigo-200 text-lg max-w-md mx-auto">
                Sistem Informasi Terintegrasi Madrasah Ibtidaiyah. Kelola administrasi dengan mudah, cepat, dan transparan.
            </p>
        </div>

        <!-- Decorative Circles -->
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-amber-500/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-slate-50">
        <div class="w-full max-w-md space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700 bg-white p-8 rounded-2xl shadow-xl border border-slate-100">
            <div class="lg:hidden text-center mb-10">
                @if ($schoolSetting && $schoolSetting->logo_path)
                    <img src="{{ asset('storage/' . $schoolSetting->logo_path) }}" alt="Logo Madrasah" class="w-16 h-16 mx-auto object-contain mb-2">
                @else
                    <x-application-logo class="w-16 h-16 mx-auto fill-current text-amber-500 mb-2" />
                @endif
                <h2 class="text-2xl font-bold text-slate-900">MI As-Saodah</h2>
            </div>

            <div>
                <h3 class="text-3xl font-extrabold text-slate-900 tracking-tight">Selamat Datang</h3>
                <p class="mt-2 text-sm text-slate-500">Silakan masuk ke akun Anda untuk melanjutkan akses dashboard.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email / Username')" class="text-slate-700 font-bold" />
                    <x-text-input id="email" class="block w-full px-4 py-3 rounded-xl border-slate-200 focus:border-indigo-600 focus:ring-indigo-600 transition-all duration-200 bg-slate-50" 
                        type="text" name="email" :value="old('email')" required autofocus autocomplete="username" 
                        placeholder="nama@email.com / username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-500" />
                </div>

                <!-- Password -->
                <div class="space-y-1" x-data="{ showPassword: false }">
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" :value="__('Password')" class="text-slate-700 font-bold" />
                        @if (Route::has('password.request'))
                            <a class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="relative">
                        <input id="password" class="block w-full px-4 py-3 pr-12 rounded-xl border-slate-200 focus:border-indigo-600 focus:ring-indigo-600 transition-all duration-200 bg-slate-50 shadow-sm"
                            x-bind:type="showPassword ? 'text' : 'password'"
                            name="password"
                            required autocomplete="current-password"
                            placeholder="••••••••" />
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-indigo-600 transition-colors focus:outline-none">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-500" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500 group-hover:border-indigo-400 transition-all" name="remember">
                        <span class="ms-2 text-sm text-slate-600 group-hover:text-slate-900 font-medium">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-200 text-sm font-bold text-white bg-indigo-900 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-900 transform active:scale-[0.98] transition-all duration-150">
                        {{ __('Masuk Sekarang') }}
                    </button>
                </div>
            </form>

            <p class="text-center text-xs text-slate-400 pt-8 font-medium">
                &copy; {{ date('Y') }} MI As-Saodah. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </div>
</div>
</x-guest-layout>
