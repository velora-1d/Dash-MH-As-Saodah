<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <!-- Header Action -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                                <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Manajemen Tagihan Infaq / SPP
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola riwayat tagihan bulanan siswa dan status pembayarannya secara mutlak.</p>
                        </div>
                        <a href="{{ route('infaq.bills.generate.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-indigo-500/30">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            Generate Tagihan Massal
                        </a>
                    </div>
                    
                    @if (session('success'))
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-xl relative" role="alert">
                            <span class="block sm:inline font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="bg-rose-50 border border-rose-200 text-rose-600 px-4 py-3 rounded-xl relative" role="alert">
                            <span class="block sm:inline font-medium">{{ session('error') }}</span>
                        </div>
                    @endif

                    <!-- Filter Section -->
                    <div class="bg-gray-50 rounded-xl border border-gray-200 p-5 mt-4">
                <form action="{{ route('infaq.bills.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-6 gap-4 items-end">
                    <div class="md:col-span-2">
                        <label for="search" class="block text-xs font-bold text-gray-500 mb-1">Cari Nama Siswa</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" id="search" value="{{ request('search') }}" class="pl-10 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm" placeholder="Ketik nama...">
                        </div>
                    </div>
                    
                    <div>
                        <label for="classroom_id" class="block text-xs font-bold text-gray-500 mb-1">Kelas</label>
                        <select name="classroom_id" id="classroom_id" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm">
                            <option value="">Semua Kelas</option>
                            @foreach($classrooms as $room)
                                <option value="{{ $room->id }}" {{ request('classroom_id') == $room->id ? 'selected' : '' }}>{{ $room->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="month" class="block text-xs font-bold text-gray-500 mb-1">Bulan</label>
                        <select name="month" id="month" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm">
                            <option value="">Semua Bulan</option>
                            @foreach([1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'] as $key => $name)
                                <option value="{{ $key }}" {{ request('month') == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="status" class="block text-xs font-bold text-gray-500 mb-1">Status</label>
                        <select name="status" id="status" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl text-sm">
                            <option value="">Semua Status</option>
                            <option value="belum_lunas" {{ request('status') == 'belum_lunas' ? 'selected' : '' }}>Menunggak / Belum Lunas</option>
                            <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas / Gratis</option>
                            <option value="void" {{ request('status') == 'void' ? 'selected' : '' }}>Dibatalkan (Void)</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-indigo-50 border border-indigo-200 rounded-xl font-bold text-sm text-indigo-700 hover:bg-indigo-100 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Table Section -->
            <div class="bg-white overflow-hidden shadow-sm rounded-3xl border border-indigo-50/50">
                <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <h3 class="font-bold text-gray-700">Daftar Tagihan Siswa</h3>
                    <span class="text-xs font-bold bg-indigo-100 text-indigo-800 py-1 px-3 rounded-full">Total: {{ $bills->total() }} Data</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Info Siswa</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kelas</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Periode</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nominal Tagihan</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php
                                $months = [1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Mei', 6=>'Jun', 7=>'Jul', 8=>'Agu', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Des'];
                            @endphp
                            @forelse ($bills as $index => $bill)
                                <tr class="hover:bg-indigo-50/30 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 font-bold">
                                        {{ $bills->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-xl bg-indigo-100 text-indigo-700 font-bold uppercase border border-indigo-200">
                                                {{ substr($bill->student->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-bold text-gray-900">{{ $bill->student->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $bill->student->nisn ?? 'NISN Tidak Ada' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-bold rounded-lg bg-indigo-50 text-indigo-700 border border-indigo-100">
                                            {{ $bill->student->classroom ? $bill->student->classroom->name : 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 font-bold">{{ $months[$bill->month] }}</div>
                                        <div class="text-xs text-gray-500">{{ $bill->academicYear->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($bill->nominal <= 0)
                                            <span class="text-sm font-bold text-emerald-600">GRATIS</span>
                                        @else
                                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($bill->nominal, 0, ',', '.') }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($bill->status == 'lunas')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                Lunas
                                            </span>
                                        @elseif($bill->status == 'belum_lunas')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                Belum Lunas
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800">
                                                Dibatalkan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <div class="flex justify-center space-x-2">
                                            @if($bill->status == 'belum_lunas')
                                                <a href="{{ route('infaq.payments.create', $bill->id) }}" title="Bayar Tagihan Ini" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors border border-emerald-200">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                    </svg>
                                                    Bayar
                                                </a>
                                                
                                                <form action="{{ route('infaq.bills.void', $bill->id) }}" method="POST" class="inline void-form">
                                                    @csrf
                                                    <button type="button" onclick="confirmVoid(this)" title="Batalkan Tagihan" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-rose-600 bg-rose-50 rounded-lg hover:bg-rose-100 transition-colors border border-rose-200">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                        </svg>
                                                        Void
                                                    </button>
                                                </form>
                                            @elseif($bill->status == 'lunas')
                                                <form action="{{ route('infaq.bills.revert', $bill->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="button" onclick="confirmRevert(this)" title="Kembalikan ke Belum Lunas" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-amber-600 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors border border-amber-200">
                                                        <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                        </svg>
                                                        Buka Kembali
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-300">—</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 whitespace-nowrap text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg class="w-12 h-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-base font-bold text-gray-900">Belum ada data tagihan</p>
                                            <p class="text-sm mt-1">Gunakan tombol "Generate Tagihan Massal" untuk membuat tagihan bulaaan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($bills->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $bills->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function confirmVoid(btn) {
            Swal.fire({
                title: 'Void Tagihan?',
                html: '<p class="text-sm text-gray-600">Tagihan ini akan dibatalkan secara permanen.<br>Aksi ini <strong class="text-rose-600">tidak bisa dibatalkan</strong>.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Void Tagihan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl font-bold text-sm px-6 py-2',
                    cancelButton: 'rounded-xl font-bold text-sm px-6 py-2',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }

        function confirmRevert(btn) {
            Swal.fire({
                title: 'Buka Kembali Tagihan?',
                html: '<p class="text-sm text-gray-600">Status tagihan akan dikembalikan ke <strong class="text-amber-600">Belum Lunas</strong>.<br>Gunakan ini jika terjadi kesalahan input.</p>',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#d97706',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Buka Kembali',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl font-bold text-sm px-6 py-2',
                    cancelButton: 'rounded-xl font-bold text-sm px-6 py-2',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }
    </script>
</x-app-layout>
