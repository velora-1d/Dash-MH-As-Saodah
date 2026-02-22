<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <!-- Header Action -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Kelola Tahun Ajaran</h3>
                            <p class="text-sm text-gray-500 mt-1">Definisikan periode tahun ajaran aktif untuk filter dan pelaporan.</p>
                        </div>
                        <a href="{{ route('academic-years.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-indigo-500/30">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Tahun Ajaran
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-xl relative" role="alert">
                            <span class="block sm:inline font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Tahun & Semester</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Status Aktif</th>
                                    <th scope="col" class="px-6 py-5 text-left text-xs font-bold text-gray-400 uppercase tracking-widest">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($academicYears as $year)
                                    <tr class="hover:bg-gray-50/50 transition-colors group">
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600">
                                                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">{{ $year->name }}</div>
                                                    <div class="text-[10px] uppercase tracking-wider font-bold text-gray-400 mt-1">Semester {{ ucfirst($year->semester) }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap">
                                            @if($year->is_active)
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100 uppercase tracking-widest">
                                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full mr-1.5 animate-pulse"></span>
                                                    Aktif Sekarang
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold bg-gray-50 text-gray-400 border border-gray-100 uppercase tracking-widest">
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-5 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('academic-years.edit', $year->id) }}" class="text-indigo-500 hover:text-indigo-700 font-bold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-xl transition-all text-[11px] uppercase tracking-widest border border-indigo-100">Edit</a>
                                                <form action="{{ route('academic-years.destroy', $year->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Tahun Ajaran ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-500 hover:text-rose-700 font-bold bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-xl transition-all text-[11px] uppercase tracking-widest border border-rose-100">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-12 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-bold text-gray-900">Belum Ada Data</h3>
                                            <p class="mt-1 text-sm text-gray-500">Silakan tambah tahun ajaran baru.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
