<x-app-layout>
    <div class="space-y-8">
        <!-- Welcome Message -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-indigo-950 tracking-tight">Halo, {{ Auth::user()->name }}!</h1>
                <p class="text-sm text-slate-500 mt-1">Selamat datang di Panel Administrasi MI As-Saodah.</p>
            </div>
            <div class="flex items-center space-x-3 bg-white p-1.5 rounded-xl border border-slate-200 shadow-sm">
                <form action="{{ route('dashboard') }}" method="GET" class="flex items-center gap-2">
                    <select name="academic_year_id" onchange="this.form.submit()" class="text-xs font-bold text-indigo-800 border-none bg-indigo-50 rounded-lg py-2 pl-3 pr-8 focus:ring-0 cursor-pointer">
                        <option value="">Semua Tahun Ajaran</option>
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}" {{ (request('academic_year_id') == $year->id) || ($year->is_active && !request()->has('academic_year_id')) ? 'selected' : '' }}>
                                {{ $year->name }} {{ $year->semester ? '('.ucfirst($year->semester).')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <!-- 1. Daftar KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">
            
            <!-- KPI 1: Total Siswa Aktif (All Roles) -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 bg-indigo-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-indigo-100 text-indigo-600 rounded-xl group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Total Siswa<br/>Aktif</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $totalSiswa }}</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-500 font-medium relative z-10">
                    <div>Putra: <span class="text-indigo-600 font-bold ml-1">{{ $totalSiswaPa }}</span></div>
                    <div>Putri: <span class="text-amber-500 font-bold ml-1">{{ $totalSiswaPi }}</span></div>
                </div>
            </div>

            <!-- KPI 5: Pendaftar PPDB (Kepsek, Operator) -->
            @if(in_array(auth()->user()->role, ['kepsek', 'operator', 'admin', 'superadmin', 'owner']))
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow group relative overflow-hidden">
                <div class="absolute -right-4 -bottom-4 bg-sky-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-sky-100 text-sky-600 rounded-xl group-hover:bg-sky-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Pendaftar<br/>PPDB</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $ppdbPending + $ppdbDiterima }}</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-500 font-medium relative z-10">
                    <div>Pending: <span class="text-sky-600 font-bold ml-1">{{ $ppdbPending }}</span></div>
                    <div>Diterima: <span class="text-emerald-500 font-bold ml-1">{{ $ppdbDiterima }}</span></div>
                </div>
            </div>
            @endif

            <!-- KEUANGAN (Kepsek, Bendahara) -->
            @if(in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner']))
            <!-- KPI 2: Pemasukan Bulan Ini -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow group relative overflow-hidden xl:col-span-1">
                <div class="absolute -right-4 -bottom-4 bg-emerald-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-emerald-100 text-emerald-600 rounded-xl group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Pemasukan<br/>Bulan Ini</p>
                    <h3 class="text-2xl font-black text-slate-800 mt-1 text-ellipsis overflow-hidden">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-500 font-medium relative z-10">
                    <div>Data Real</div>
                    <div class="text-emerald-600 font-bold">Bulan Ini</div>
                </div>
            </div>

            <!-- KPI 3: Kepatuhan Infaq -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow group relative overflow-hidden xl:col-span-1">
                <div class="absolute -right-4 -bottom-4 bg-amber-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-amber-100 text-amber-600 rounded-xl group-hover:bg-amber-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Kepatuhan Lunas<br/>Infaq</p>
                    <h3 class="text-3xl font-black text-slate-800 mt-1">{{ $kepatuhanPa + $kepatuhanPi }}</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-500 font-medium relative z-10">
                    <div>PA: <span class="text-emerald-600 font-bold ml-1">{{ $kepatuhanPa }}</span></div>
                    <div>PI: <span class="text-amber-500 font-bold ml-1">{{ $kepatuhanPi }}</span></div>
                </div>
            </div>

            <!-- KPI 4: Tunggakan Infaq -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow group relative overflow-hidden xl:col-span-1">
                <div class="absolute -right-4 -bottom-4 bg-rose-50 w-24 h-24 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                <div class="flex items-center justify-between mb-4 relative z-10">
                    <div class="p-3 bg-rose-100 text-rose-600 rounded-xl group-hover:bg-rose-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest leading-tight">Siswa Menunggak<br/>Infaq</p>
                    <h3 class="text-3xl font-black text-rose-600 mt-1">{{ $tunggakanPa + $tunggakanPi }}</h3>
                </div>
                <div class="mt-4 pt-4 border-t border-slate-50 flex items-center justify-between text-[11px] text-slate-500 font-medium relative z-10">
                    <div class="pr-2 border-r border-slate-200 w-1/2">PA: <span class="text-rose-600 font-bold ml-1">{{ $tunggakanPa }} <br>(Rp{{ number_format($tunggakanPaRp, 0, ',', '.') }})</span></div>
                    <div class="pl-2 w-1/2">PI: <span class="text-rose-600 font-bold ml-1">{{ $tunggakanPi }} <br>(Rp{{ number_format($tunggakanPiRp, 0, ',', '.') }})</span></div>
                </div>
            </div>
            @endif
        </div>

        
        @if(in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner']))
        <!-- 2. Tables & Grids (Tunggakan Aktif) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Grid A: Daftar Siswa Menunggak (Putra/PA) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-lg font-bold text-indigo-950">Siswa Menunggak (PA)</h4>
                        <p class="text-[11px] text-slate-400 mt-1">Perhatian khusus untuk putra</p>
                    </div>
                    <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 border-slate-100 text-slate-400 font-bold bg-slate-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 rounded-tl-xl text-[10px]">Nama</th>
                                <th scope="col" class="px-4 py-3 text-[10px]">Kelas</th>
                                <th scope="col" class="px-4 py-3 text-[10px]">Bln</th>
                                <th scope="col" class="px-4 py-3 rounded-tr-xl text-[10px] text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($siswaMenunggakPa as $siswa)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3">
                                    <div class="font-bold text-slate-800 text-xs text-wrap max-w-[120px]">{{ $siswa->name }}</div>
                                </td>
                                <td class="px-4 py-3 text-xs"><span class="bg-indigo-50 text-indigo-700 px-2 py-0.5 rounded font-bold">{{ $siswa->kelas }}</span></td>
                                <td class="px-4 py-3 text-xs font-bold text-slate-600">{{ $siswa->bulan }} Bulan</td>
                                <td class="px-4 py-3 text-xs text-right font-bold text-rose-600">Rp{{ number_format($siswa->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-xs text-slate-400 font-medium italic">Tidak ada antrean tunggakan putra saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Grid B: Daftar Siswi Menunggak (Putri/PI) -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-lg font-bold text-indigo-950">Siswi Menunggak (PI)</h4>
                        <p class="text-[11px] text-slate-400 mt-1">Perhatian khusus untuk putri</p>
                    </div>
                    <a href="#" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">Lihat Semua →</a>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="uppercase tracking-wider border-b-2 border-slate-100 text-slate-400 font-bold bg-slate-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 rounded-tl-xl text-[10px]">Nama</th>
                                <th scope="col" class="px-4 py-3 text-[10px]">Kelas</th>
                                <th scope="col" class="px-4 py-3 text-[10px]">Bln</th>
                                <th scope="col" class="px-4 py-3 rounded-tr-xl text-[10px] text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @forelse($siswaMenunggakPi as $siswi)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-4 py-3">
                                    <div class="font-bold text-slate-800 text-xs text-wrap max-w-[120px]">{{ $siswi->name }}</div>
                                </td>
                                <td class="px-4 py-3 text-xs"><span class="bg-amber-50 text-amber-700 px-2 py-0.5 rounded font-bold">{{ $siswi->kelas }}</span></td>
                                <td class="px-4 py-3 text-xs font-bold text-slate-600">{{ $siswi->bulan }} Bulan</td>
                                <td class="px-4 py-3 text-xs text-right font-bold text-rose-600">Rp{{ number_format($siswi->nominal, 0, ',', '.') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-xs text-slate-400 font-medium italic">Tidak ada antrean tunggakan putri saat ini.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        <!-- 3. Daftar Visualisasi Grafik (Charts) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            @if(in_array(auth()->user()->role, ['kepsek', 'bendahara', 'admin', 'superadmin', 'owner']))
            <!-- Chart 1: Tren Arus Kas Tahunan -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h4 class="text-lg font-bold text-indigo-950">Tren Arus Kas Tahunan</h4>
                        <p class="text-[11px] text-slate-400 mt-1">Perbandingan Pendapatan vs Pengeluaran dalam Setahun</p>
                    </div>
                </div>
                <div class="flex-1 w-full min-h-[300px] relative">
                    <canvas id="cashflowChart"></canvas>
                </div>
            </div>

            <!-- Chart 3: Komposisi Pemasukan -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col">
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-indigo-950">Sumber Pemasukan</h4>
                    <p class="text-[11px] text-slate-400 mt-1">Proporsi sumber dana operasional utama</p>
                </div>
                <div class="flex-1 w-full min-h-[250px] relative flex justify-center items-center">
                    <canvas id="sourceChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Kepatuhan Infaq per Kelas -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col">
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-indigo-950">Kepatuhan Infaq per Kelas</h4>
                    <p class="text-[11px] text-slate-400 mt-1">Persentase Lunas dari Kelas 1 s/d Kelas 6</p>
                </div>
                <div class="flex-1 w-full min-h-[300px] relative mt-4">
                    <canvas id="complianceChart"></canvas>
                </div>
            </div>
            @endif

            @if(in_array(auth()->user()->role, ['kepsek', 'operator', 'admin', 'superadmin', 'owner']))
            <!-- Chart 4: Tren Pendaftaran PPDB -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 flex flex-col {{ auth()->user()->role === 'operator' ? 'lg:col-span-3' : 'lg:col-span-1' }}">
                <div class="mb-6">
                    <h4 class="text-lg font-bold text-indigo-950">Pendaftar PPDB</h4>
                    <p class="text-[11px] text-slate-400 mt-1">Rekap per status persetujuan</p>
                </div>
                <div class="flex-1 w-full min-h-[250px] relative flex justify-center items-center">
                    <canvas id="ppdbChart"></canvas>
                </div>
            </div>
            @endif

        </div>

    </div>
    
    <?php
    $dashboardStore = json_encode([
        'cashflow' => $chartCashflow ?? [],
        'source' => $chartSource ?? [],
        'compliance' => $chartCompliance ?? [],
        'ppdbDiterima' => $ppdbDiterima ?? 0,
        'ppdbPending' => $ppdbPending ?? 0
    ]);
    ?>
    <script id="dashboard-store" type="application/json">
        {!! $dashboardStore !!}
    </script>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const storeEl = document.getElementById('dashboard-store');
            if (!storeEl) return;
            const store = JSON.parse(storeEl.textContent);

            const cashflowData = store.cashflow;
            const sourceData = store.source;
            const complianceData = store.compliance;

            // 1. Arus Kas
            const ctxCashflow = document.getElementById('cashflowChart');
            if (ctxCashflow && cashflowData.labels) {
                new Chart(ctxCashflow, {
                    type: 'bar',
                    data: {
                        labels: cashflowData.labels,
                        datasets: [
                            {
                                label: 'Pemasukan (Rp)',
                                data: cashflowData.in,
                                backgroundColor: '#10b981', // emerald-500
                                borderRadius: 4,
                            },
                            {
                                label: 'Pengeluaran (Rp)',
                                data: cashflowData.out,
                                backgroundColor: '#f43f5e', // rose-500
                                borderRadius: 4,
                            },
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            }

            // 2. Sumber Pemasukan
            const ctxSource = document.getElementById('sourceChart');
            if (ctxSource && sourceData.labels) {
                new Chart(ctxSource, {
                    type: 'doughnut',
                    data: {
                        labels: sourceData.labels,
                        datasets: [{
                            data: sourceData.data,
                            backgroundColor: sourceData.colors,
                            borderWidth: 0,
                            cutout: '65%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } }
                    }
                });
            }

            // 3. Kepatuhan per Kelas (Horizontal Bar)
            const ctxComp = document.getElementById('complianceChart');
            if (ctxComp && complianceData.labels) {
                new Chart(ctxComp, {
                    type: 'bar',
                    data: {
                        labels: complianceData.labels,
                        datasets: [
                            {
                                label: 'Lunas',
                                data: complianceData.lunas,
                                backgroundColor: '#10b981'
                            },
                            {
                                label: 'Menunggak',
                                data: complianceData.nunggak,
                                backgroundColor: '#f43f5e'
                            }
                        ]
                    },
                    options: {
                        indexAxis: 'y', // Mode Horizontal
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'bottom' }
                        },
                        scales: { x: { stacked: true }, y: { stacked: true } }
                    }
                });
            }

            // 4. PPDB Status
            const ctxPpdb = document.getElementById('ppdbChart');
            if (ctxPpdb) {
                new Chart(ctxPpdb, {
                    type: 'pie',
                    data: {
                        labels: ['Diterima', 'Menunggu', 'Ditolak'],
                        datasets: [{
                            data: [store.ppdbDiterima, store.ppdbPending, 0],
                            backgroundColor: ['#10b981', '#0ea5e9', '#f43f5e'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { position: 'bottom' } }
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
