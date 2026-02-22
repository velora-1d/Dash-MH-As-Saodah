<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6 text-gray-900 space-y-6">
                    
                    <!-- Header Action -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">Kategori Pemasukan & Pengeluaran</h3>
                            <p class="text-sm text-gray-500 mt-1">Kelola kategori referensi untuk setiap transaksi keuangan madrasah.</p>
                        </div>
                        <a href="{{ route('transaction-categories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm shadow-indigo-600/20">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah Kategori
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

                    <!-- Tabel Kategori Pemasukan -->
                    <div>
                        <h4 class="text-sm font-bold text-emerald-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span> Kategori Pemasukan
                        </h4>
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <!-- Menggunakan pixel baku (w-80, w-40) di TH untuk jaminan sejajar 100% -->
                                <thead class="bg-emerald-50">
                                    <tr>
                                        <th scope="col" style="width: 35%;" class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Nama Kategori</th>
                                        <th scope="col" style="width: 45%;" class="px-6 py-3 text-left text-xs font-bold text-emerald-700 uppercase tracking-wider">Keterangan</th>
                                        <th scope="col" style="width: 20%;" class="px-6 py-3 text-center text-xs font-bold text-emerald-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                    @php $inCategories = $categories->where('type', 'in'); @endphp
                                    @forelse($inCategories as $cat)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 truncate">{{ $cat->name }}</td>
                                            <td class="px-6 py-4 text-left text-gray-500 truncate">{{ $cat->description ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex justify-center items-center gap-3">
                                                    <a href="{{ route('transaction-categories.edit', $cat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">Edit</a>
                                                    <form id="delete-form-{{ $cat->id }}" action="{{ route('transaction-categories.destroy', $cat->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete('{{ $cat->id }}', '{{ addslashes($cat->name) }}')" class="text-rose-600 hover:text-rose-900 font-semibold bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">Belum ada kategori pemasukan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tabel Kategori Pengeluaran -->
                    <div>
                        <h4 class="text-sm font-bold text-rose-600 uppercase tracking-wider mb-3 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-rose-500"></span> Kategori Pengeluaran
                        </h4>
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                <!-- Menggunakan pixel baku (w-80, w-40) di TH untuk jaminan sejajar 100% -->
                                <thead class="bg-rose-50">
                                    <tr>
                                        <th scope="col" style="width: 35%;" class="px-6 py-3 text-left text-xs font-bold text-rose-700 uppercase tracking-wider">Nama Kategori</th>
                                        <th scope="col" style="width: 45%;" class="px-6 py-3 text-left text-xs font-bold text-rose-900 uppercase tracking-wider">Keterangan</th>
                                        <th scope="col" style="width: 20%;" class="px-6 py-3 text-center text-xs font-bold text-rose-700 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                    @php $outCategories = $categories->where('type', 'out'); @endphp
                                    @forelse($outCategories as $cat)
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900 truncate">{{ $cat->name }}</td>
                                            <td class="px-6 py-4 text-left text-gray-500 truncate">{{ $cat->description ?: '-' }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <div class="flex justify-center items-center gap-3">
                                                    <a href="{{ route('transaction-categories.edit', $cat->id) }}" class="text-indigo-600 hover:text-indigo-900 font-semibold bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg transition-colors">Edit</a>
                                                    <form id="delete-form-{{ $cat->id }}" action="{{ route('transaction-categories.destroy', $cat->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete('{{ $cat->id }}', '{{ addslashes($cat->name) }}')" class="text-rose-600 hover:text-rose-900 font-semibold bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors">Hapus</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-6 py-8 text-center text-gray-400 italic">Belum ada kategori pengeluaran.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Hapus Kategori?',
                text: `Yakin ingin menghapus kategori "${name}"? Data yang terhubung mungkin akan ikut terpengaruh.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444', // text-rose-500
                cancelButtonColor: '#6b7280', // text-gray-500
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl',
                    cancelButton: 'rounded-xl',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
    @endpush
</x-app-layout>
