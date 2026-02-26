<header class="bg-white border-b border-slate-200/60 sticky top-0 z-30 shadow-sm shadow-slate-100/50 backdrop-blur-md bg-white/90">
    <div class="px-4 py-4 sm:px-6 lg:px-8 flex items-center justify-between">
        <!-- Search Bar / Welcome Text -->
        <div class="flex-1 flex items-center gap-4">
            <!-- Mobile Hamburger Button -->
            <button @click="sidebarOpen = true" class="lg:hidden p-2 -ml-2 text-slate-500 hover:bg-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <h2 class="text-xl font-bold text-indigo-900 tracking-tight flex items-center">
                @if (request()->routeIs('dashboard'))
                    Ringkasan Dashboard
                    <svg class="w-5 h-5 text-amber-500 ml-2 animate-pulse hidden sm:block" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                @else
                    Menu Administrasi
                @endif
            </h2>
        </div>

        <!-- Right Side Icons & Profile -->
        <div class="ml-4 flex items-center md:ml-6 space-x-4">
            <!-- Notifications -->
            <button class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition-all">
                <span class="sr-only">Notifikasi</span>
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </button>

            <div class="h-6 w-px bg-slate-200"></div>

            <!-- Profile Dropdown (Sederhana via Form Logout) -->
            <div class="flex items-center space-x-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-2 text-sm font-bold text-rose-600 hover:bg-rose-50 rounded-xl transition-all border border-transparent hover:border-rose-100">
                        <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Keluar Akun
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
