<x-app-layout>
    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-8 text-gray-900 border-b border-gray-100">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Tabungan Siswa
                    </h3>
                    <p class="text-sm text-gray-500 mt-1">Kelola simpanan per siswa. Cek saldo, catat setoran, dan penarikan.</p>
                </div>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <!-- Filter Kelas -->
            <form action="{{ route('tabungan.index') }}" method="GET" class="bg-slate-50 p-4 rounded-xl border border-slate-100 flex flex-col sm:flex-row items-end gap-4">
                <div class="flex-1 w-full">
                    <label for="classroom_id" class="block text-sm font-bold text-gray-700">Filter Berdasarkan Kelas</label>
                    <select name="classroom_id" id="classroom_id" onchange="this.form.submit()" class="mt-2 block w-full">
                        <option value="">Semua Kelas</option>
                        @foreach($classrooms as $cls)
                            <option value="{{ $cls->id }}" {{ $classroomId == $cls->id ? 'selected' : '' }}>
                                Tingkat {{ $cls->level }} : {{ $cls->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <!-- Tabel Daftar Siswa & Saldo -->
            <div class="overflow-hidden rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">#</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Nama Siswa</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Kelas</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">Saldo Tabungan</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($students as $i => $student)
                            <tr class="hover:bg-emerald-50/30 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $i + 1 }}</td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $student->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $student->nisn ?: '-' }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $student->classroom ? $student->classroom->name : '-' }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-sm font-bold {{ $student->balance > 0 ? 'text-emerald-600' : 'text-gray-400' }}">
                                        Rp {{ number_format($student->balance, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('tabungan.show', $student->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-indigo-600 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                                            Mutasi
                                        </a>
                                        <a href="{{ route('tabungan.create', $student->id) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 rounded-lg hover:bg-emerald-100 transition-colors">
                                            <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                                            Transaksi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic text-sm">Belum ada data siswa yang ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
