<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <!-- Header Action -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Master Data Ruang Kelas</h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola data kelas tingkat 1 sampai 6 beserta perombakannya.</p>
                        </div>
                        <a href="{{ route('classrooms.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm shadow-indigo-600/20">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Kelas
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

                    <!-- Table -->
                    <div class="overflow-x-auto rounded-xl border border-gray-200">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Tingkat Kelas</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Ruangan</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Wali Kelas</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Jumlah Anak Didik</th>
                                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi Manajerial</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                @forelse($classrooms as $cls)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10 bg-amber-50 rounded-lg flex items-center justify-center text-amber-600 font-black text-xl border border-amber-200">
                                                    {{ $cls->level }}
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-bold text-gray-900">Tingkat {{ $cls->level }}</div>
                                                    <div class="text-xs font-medium text-gray-500 mt-0.5">Madrasah Ibtidaiyah</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="font-bold text-indigo-700 bg-indigo-50 px-3 py-1 rounded-full border border-indigo-100">
                                                {{ $cls->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                                            @if($cls->wali_kelas)
                                                <span class="font-medium">{{ $cls->wali_kelas }}</span>
                                            @else
                                                <span class="text-gray-400 italic text-xs">Belum ditentukan</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 font-medium">
                                            {{ $cls->students()->count() }} Siswa
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center gap-3">
                                                <a href="{{ route('classrooms.edit', $cls->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">Edit Parameter</a>
                                                <form action="{{ route('classrooms.destroy', $cls->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Unit Kelas ini? Siswa yang terikat wajib dipindahkan terlebih dahulu.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-rose-600 hover:text-rose-900 font-semibold bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors">Hapus Kelas</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-12 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            <h3 class="mt-2 text-sm font-bold text-gray-900">Sistem Kelas Masih Kosong</h3>
                                            <p class="mt-1 text-sm text-gray-500">Silakan definsikan rombongan belajar kelas 1-6.</p>
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
