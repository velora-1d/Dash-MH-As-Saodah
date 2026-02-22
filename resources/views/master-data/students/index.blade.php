<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <!-- Header Action & Search -->
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Manajemen Siswa</h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola data seluruh siswa beserta kategorisasi biaya & penempatan kelasnya.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <!-- Search & Filter Area -->
                            <form action="{{ route('students.index') }}" method="GET" class="flex flex-col sm:flex-row gap-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                        </svg>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari by Nama/NISN..." 
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-xl text-sm focus:ring-indigo-500 focus:border-indigo-500 w-full sm:w-64 transition-all">
                                </div>
                                <select name="classroom_id" onchange="this.form.submit()" class="py-2 pl-3 pr-8 border border-gray-300 text-sm rounded-xl focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Semua Kelas</option>
                                    @foreach($classrooms as $cls)
                                        <option value="{{ $cls->id }}" {{ request('classroom_id') == $cls->id ? 'selected' : '' }}>Tingkat {{ $cls->level }} - {{ $cls->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="hidden sm:inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-xl font-bold text-xs text-gray-700 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                                    Terapkan Filter
                                </button>
                                @if(request('search') || request('classroom_id'))
                                    <a href="{{ route('students.index') }}" class="items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-700 hover:bg-rose-100 justify-center flex transition-colors">
                                        Reset
                                    </a>
                                @endif
                            </form>
                            
                            <!-- Add Button -->
                            <a href="{{ route('students.create') }}" class="inline-flex justify-center items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition shadow-sm shadow-indigo-600/20">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                Tambah Data
                            </a>
                        </div>
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
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Identitas Siswa</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Kategorisasi</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Penempatan Kelas</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($students as $student)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-200 flex items-center justify-center text-indigo-700 font-bold">
                                                        {{ strtoupper(substr($student->name, 0, 1)) }}
                                                    </div>
                                                </div>
                                                <div class="ml-4 focus-within:ring-2 focus-within:ring-indigo-500 rounded px-1">
                                                    <div class="font-bold text-gray-900">{{ $student->name }}</div>
                                                    <div class="text-xs text-gray-500 mt-0.5">
                                                        NISN: {{ $student->nisn ?: '-' }} &bull; NIS: {{ $student->nis ?: '-' }}
                                                    </div>
                                                    <div class="text-xs text-gray-500 mt-0.5 font-medium">JK: {{ $student->gender == 'L' ? 'Laki-Laki' : 'Perempuan' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($student->category == 'reguler')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">Reguler</span>
                                            @elseif($student->category == 'yatim')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800 border border-amber-200">Yatim / Piatu</span>
                                            @elseif($student->category == 'kurang_mampu')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">Kurang Mampu</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($student->classroom)
                                                <div class="text-sm font-bold text-gray-900">Tingkat {{ $student->classroom->level }}</div>
                                                <div class="text-xs text-indigo-600 bg-indigo-50 px-2 flex justify-center py-0.5 rounded-full font-bold border border-indigo-100 inline-block mt-1">Ruang: {{ $student->classroom->name }}</div>
                                            @else
                                                <span class="text-xs font-medium text-rose-500 italic bg-rose-50 px-2 py-1 rounded border border-rose-100">Belum mendapat kelas</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($student->status == 'aktif')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">Siswa Aktif</span>
                                            @elseif($student->status == 'lulus')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-cyan-100 text-cyan-800">Lulus / Alumni</span>
                                            @elseif($student->status == 'pindah')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-800">Pindah / Mutasi</span>
                                            @elseif($student->status == 'nonaktif')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 text-gray-800">Diberhentikan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('students.edit', $student->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">Edit</a>
                                                <form action="{{ route('students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('PENGHAPUSAN DATA SISWA! \n\nHati-hati: Segala rekam jejak Infaq, Daftar Ulang, dan PPDB yang bertautan dengan anak ini akan ikut terhapus. Yakin mau dilanjutkan?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-bold text-gray-900">Siswa Tidak Ditemukan</h3>
                                            <p class="mt-1 text-sm text-gray-500">Tabel siswa masih kosong atau filter pencarian tidak membuahkan hasil.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($students->hasPages())
                        <div class="mt-6 border-t border-gray-100 pt-4">
                            {{ $students->links() }}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
