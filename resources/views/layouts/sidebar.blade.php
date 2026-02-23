<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" 
       class="fixed inset-y-0 left-0 z-50 w-72 h-full bg-indigo-950 shadow-2xl border-r border-indigo-900/10 flex flex-col transition-transform duration-300 ease-in-out flex-shrink-0 origin-left">
    <!-- Tombol Tutup Sidebar untuk Layar Mobile -->
    <div class="absolute top-4 right-4 lg:hidden">
        <button @click="sidebarOpen = false" class="p-2 text-indigo-300 hover:bg-indigo-900 rounded-lg hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    <!-- Header Logo (Statis / Tidak Ikut Scroll) -->
    <div class="flex items-center flex-shrink-0 px-6 py-6 group border-b border-indigo-900/40">
        <div class="p-2 bg-amber-500 rounded-xl shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform duration-300">
            <x-application-logo class="w-8 h-8 fill-current text-white" />
        </div>
        <span class="ml-3 text-xl font-bold text-white tracking-tight">MI As-Saodah</span>
    </div>

    <!-- Navigation Area (Dinamis / Bisa di-Scroll) -->
    <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-800 py-6">
        <nav class="px-4 space-y-1.5" aria-label="Sidebar">
                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('dashboard') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Dashboard Utama
                </a>

                <!-- PPDB & DAFTAR ULANG -->
                @if(in_array(auth()->user()->role, ['kepsek', 'operator', 'admin', 'superadmin', 'owner']))
                <div class="pt-4 pb-2 px-4">
                    <span class="text-[10px] font-bold text-indigo-400/70 uppercase tracking-widest">Penerimaan Siswa</span>
                </div>
                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Penerimaan PPDB
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>
                @endif

                @if(in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner']))
                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Daftar Ulang Siswa
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>
                @endif

                <!-- MASTER DATA -->
                <div class="pt-4 pb-2 px-4">
                    <span class="text-[10px] font-bold text-indigo-400/70 uppercase tracking-widest">Basis Data Utama</span>
                </div>
                <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('students.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    Data Siswa
                </a>

                <a href="{{ route('mutations.index') }}" class="{{ request()->routeIs('mutations.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('mutations.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Mutasi & Kenaikan Kelas
                </a>

                <a href="{{ route('classrooms.index') }}" class="{{ request()->routeIs('classrooms.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('classrooms.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    Daftar Kelas RI
                </a>

                <a href="{{ route('academic-years.index') }}" class="{{ request()->routeIs('academic-years.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('academic-years.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Tahun Ajaran
                </a>

                <a href="{{ route('transaction-categories.index') }}" class="{{ request()->routeIs('transaction-categories.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('transaction-categories.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                    </svg>
                    Kategori Keuangan
                </a>

                @if(in_array(auth()->user()->role, ['kepsek', 'bendahara']))
                <!-- KEUANGAN TATA USAHA -->
                <div class="pt-4 pb-2 px-4 border-t border-indigo-900 mt-4">
                    <span class="text-[10px] font-bold text-indigo-400/70 uppercase tracking-widest">Keuangan & Tagihan</span>
                </div>
                
                <a href="{{ route('infaq.bills.index') }}" class="{{ request()->routeIs('infaq.bills.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('infaq.bills.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Manajemen Infaq / SPP
                </a>

                <a href="{{ route('tabungan.index') }}" class="{{ request()->routeIs('tabungan.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('tabungan.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                    </svg>
                    Tabungan Siswa
                </a>

                <a href="{{ route('wakaf.index') }}" class="{{ request()->routeIs('wakaf.*') ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs('wakaf.*') ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    Wakaf & Donasi
                </a>

                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Kas & Jurnal Umum
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>

                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2" />
                    </svg>
                    Laporan Lengkap
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>

                <!-- PAYROLL SYSTEM -->
                <div class="pt-4 pb-2 px-4 border-t border-indigo-900 mt-4">
                    <span class="text-[10px] font-bold text-indigo-400/70 uppercase tracking-widest">Kepegawaian (HR)</span>
                </div>
                
                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    Data Guru
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>

                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    Data Staf
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>
                
                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Slip Gaji / Payroll
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>

                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                    Inventaris Aset
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>
                @endif


                @if(auth()->user()->role === 'kepsek')
                <div class="pt-4 pb-2 px-4 border-t border-indigo-900 mt-4">
                    <span class="text-[10px] font-bold text-indigo-400/70 uppercase tracking-widest">Sistem</span>
                </div>

                <!-- Settings -->
                <a href="#" class="text-indigo-200/50 border-transparent group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200 cursor-not-allowed">
                    <svg class="text-indigo-500/40 mr-3 flex-shrink-0 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Pengaturan
                    <span class="ml-auto text-[8px] font-bold bg-amber-500/20 text-amber-400 px-1.5 py-0.5 rounded-full">SOON</span>
                </a>
                @endif
            </nav>
        </div>
        
        <!-- User Section Footer Sidebar -->
        <div class="flex-shrink-0 flex p-4 border-t border-indigo-800 bg-indigo-900/50">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div class="inline-block h-10 w-10 bg-amber-500 rounded-lg flex items-center justify-center text-indigo-950 font-bold border-2 border-amber-400">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-white truncate w-40">{{ Auth::user()->name }}</p>
                        <p class="text-xs font-bold text-amber-500 truncate w-40 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
