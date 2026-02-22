<aside class="hidden lg:flex lg:flex-shrink-0">
    <div class="flex flex-col w-64 border-r border-gray-200 bg-white shadow-sm">
        <div class="flex flex-col flex-grow pt-5 pb-4 overflow-y-auto">
            <!-- Logo Section -->
            <div class="flex items-center flex-shrink-0 px-6 mb-8 group">
                <div class="p-2 bg-emerald-600 rounded-xl shadow-lg shadow-emerald-200/50 group-hover:scale-110 transition-transform duration-300">
                    <x-application-logo class="w-8 h-8 fill-current text-white" />
                </div>
                <span class="ml-3 text-lg font-bold text-gray-900 tracking-tight">MH As-Saodah</span>
            </div>

            <!-- Navigation Links -->
            <nav class="mt-2 flex-1 px-4 space-y-1.5" aria-label="Sidebar">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-emerald-50 text-emerald-700 border-emerald-600 shadow-sm' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 border-transparent transition-all duration-200">
                    <svg class="{{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-gray-500' }} mr-3 flex-shrink-0 h-5 w-5 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard
                </a>

                <div class="pt-4 pb-2 px-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Master Data</span>
                </div>

                <!-- Akademik -->
                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 border-transparent transition-all duration-200">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Data Guru & Staf
                </a>

                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 border-transparent transition-all duration-200">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Data Siswa
                </a>

                <div class="pt-4 pb-2 px-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Administrasi</span>
                </div>

                <!-- Keuangan -->
                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 border-transparent transition-all duration-200">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pembayaran SPP
                </a>

                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 border-transparent transition-all duration-200">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Laporan Keuangan
                </a>

                <div class="pt-4 pb-2 px-4 border-t border-gray-100 mt-4">
                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Sistem</span>
                </div>

                <!-- Settings -->
                <a href="#" class="text-gray-600 hover:bg-gray-50 hover:text-gray-900 group flex items-center px-4 py-3 text-sm font-semibold rounded-xl border-l-4 border-transparent transition-all duration-200">
                    <svg class="text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                </a>
            </nav>
        </div>
        
        <!-- User Section Footer Sidebar -->
        <div class="flex-shrink-0 flex p-4 border-t border-gray-100 bg-gray-50/30">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div class="inline-block h-9 w-9 bg-emerald-100 rounded-lg flex items-center justify-center text-emerald-700 font-bold border border-emerald-200">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-gray-700 truncate w-32">{{ Auth::user()->name }}</p>
                        <p class="text-xs font-medium text-gray-400 truncate w-32 uppercase tracking-tighter">Owner</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>
