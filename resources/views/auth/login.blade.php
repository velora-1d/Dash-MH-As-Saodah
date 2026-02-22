<div class="min-h-screen flex">
    <!-- Left Side: Branding & Visual -->
    <div class="hidden lg:flex lg:w-1/2 bg-emerald-900 items-center justify-center relative overflow-hidden">
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
                <x-application-logo class="w-24 h-24 fill-current text-white" />
            </div>
            <h1 class="text-4xl font-bold text-white mb-4">MHA As-Saodah</h1>
            <p class="text-emerald-100 text-lg max-w-md mx-auto">
                Sistem Informasi Terintegrasi Pesantren dan Sekolah. Kelola administrasi dengan mudah, cepat, dan transparan.
            </p>
        </div>

        <!-- Decorative Circles -->
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-emerald-400/20 rounded-full blur-3xl"></div>
    </div>

    <!-- Right Side: Login Form -->
    <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
        <div class="w-full max-w-md space-y-8 animate-in fade-in slide-in-from-bottom-4 duration-700">
            <div class="lg:hidden text-center mb-10">
                <x-application-logo class="w-16 h-16 mx-auto fill-current text-emerald-600 mb-2" />
                <h2 class="text-2xl font-bold text-gray-900">MHA As-Saodah</h2>
            </div>

            <div>
                <h3 class="text-3xl font-extrabold text-gray-900 tracking-tight">Selamat Datang</h3>
                <p class="mt-2 text-sm text-gray-500">Silakan masuk ke akun Anda untuk melanjutkan akses dashboard.</p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div class="space-y-1">
                    <x-input-label for="email" :value="__('Email / Username')" class="text-gray-700 font-semibold" />
                    <x-text-input id="email" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-all duration-200" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" 
                        placeholder="nama@email.com" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="space-y-1">
                    <div class="flex items-center justify-between">
                        <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                        @if (Route::has('password.request'))
                            <a class="text-xs font-semibold text-emerald-600 hover:text-emerald-500 transition-colors" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        @endif
                    </div>
                    <x-text-input id="password" class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:border-emerald-500 focus:ring-emerald-500 transition-all duration-200"
                        type="password"
                        name="password"
                        required autocomplete="current-password"
                        placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-emerald-600 shadow-sm focus:ring-emerald-500 group-hover:border-emerald-400 transition-all" name="remember">
                        <span class="ms-2 text-sm text-gray-600 group-hover:text-gray-900">{{ __('Ingat saya') }}</span>
                    </label>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-3.5 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform active:scale-[0.98] transition-all duration-150">
                        {{ __('Masuk Sekarang') }}
                    </button>
                </div>
            </form>

            <p class="text-center text-xs text-gray-400 pt-8">
                &copy; {{ date('Y') }} MH As-Saodah. Seluruh hak cipta dilindungi.
            </p>
        </div>
    </div>
</div>
