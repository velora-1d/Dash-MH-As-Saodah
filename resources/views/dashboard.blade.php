<x-app-layout>


    <div class="space-y-8">
        <!-- Welcome Message -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Halo, {{ Auth::user()->name }}!</h1>
                <p class="text-sm text-gray-500 mt-1">Berikut adalah ringkasan operasional pesantren hari ini.</p>
            </div>
            <div class="flex space-x-3">
                <span class="inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-lg border border-emerald-200 uppercase tracking-widest shadow-sm">
                    Unit: SD/MI As-Saodah
                </span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <!-- Card Siswa -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <span class="text-[10px] font-bold text-blue-600 bg-blue-50 px-2 py-1 rounded-lg">+2.5%</span>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Siswa</p>
                    <h3 class="text-3xl font-black text-gray-900 mt-1">1,240</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center text-xs text-gray-400 font-medium">
                    <span class="text-blue-600 mr-1 font-bold">540</span> Laki-laki / <span class="text-pink-500 mx-1 font-bold">700</span> Perempuan
                </div>
            </div>

            <!-- Card Pemasukan -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Pemasukan Bulan Ini</p>
                    <h3 class="text-3xl font-black text-gray-900 mt-1">Rp 42.5M</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center text-xs text-gray-400 font-medium">
                    Target: <span class="ml-1 text-emerald-600 font-bold">85% Tercapai</span>
                </div>
            </div>

            <!-- Card SPP -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl group-hover:bg-amber-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Pembayaran SPP</p>
                    <h3 class="text-3xl font-black text-gray-900 mt-1">94%</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center text-xs text-gray-400 font-medium">
                    <span class="text-amber-600 font-bold mr-1">72</span> Siswa belum melunasi
                </div>
            </div>

            <!-- Card Pengeluaran -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow group">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-red-50 text-red-600 rounded-xl group-hover:bg-red-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-wider">Total Pengeluaran</p>
                    <h3 class="text-3xl font-black text-gray-900 mt-1">Rp 12.8M</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center text-xs text-gray-400 font-medium">
                    Gaji Staf: <span class="ml-1 text-red-600 font-bold">Rp 8.4M</span>
                </div>
            </div>
        </div>

        <!-- Recent Activity Section (Example) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h4 class="text-lg font-bold text-gray-900">Grafik Pemasukan SPP</h4>
                    <button class="text-sm text-emerald-600 font-bold hover:underline">Lihat Laporan</button>
                </div>
                <div class="h-64 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200 flex items-center justify-center text-gray-400 text-sm italic">
                    [ Placeholder Grafik Keuangan ]
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h4 class="text-lg font-bold text-gray-900 mb-6">Aktivitas Terakhir</h4>
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-emerald-500 mt-1.5 ring-4 ring-emerald-50"></div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-900">Pembayaran SPP Telah Diterima</p>
                            <p class="text-xs text-gray-400 mt-0.5">Siswa: Ahmad Fauzi | Unit: SMP</p>
                            <p class="text-[10px] text-emerald-600 font-bold mt-1">5 Menit yang lalu</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-2.5 h-2.5 rounded-full bg-blue-500 mt-1.5 ring-4 ring-blue-50"></div>
                        <div class="ml-4">
                            <p class="text-sm font-bold text-gray-900">Data Siswa Baru Ditambahkan</p>
                            <p class="text-xs text-gray-400 mt-0.5">Laila Ramadhani | Unit: SD</p>
                            <p class="text-[10px] text-blue-600 font-bold mt-1">1 Jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
