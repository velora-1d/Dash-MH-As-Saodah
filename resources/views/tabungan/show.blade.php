<x-app-layout>
    <div class="space-y-6">
        <!-- Info Siswa & Saldo -->
        <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-8 text-gray-900">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-14 h-14 bg-emerald-100 rounded-2xl text-emerald-600 font-bold text-xl">
                            {{ substr($student->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900">{{ $student->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $student->classroom ? $student->classroom->name : 'Tanpa Kelas' }} · NISN: {{ $student->nisn ?: '-' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Saldo Tabungan</p>
                            <p class="text-2xl font-bold {{ $balance > 0 ? 'text-emerald-600' : 'text-gray-400' }}">Rp {{ number_format($balance, 0, ',', '.') }}</p>
                        </div>
                        <a href="{{ route('tabungan.create', $student->id) }}" class="inline-flex items-center px-4 py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-emerald-700 shadow-md shadow-emerald-500/30 transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Transaksi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Mutasi -->
        <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex items-center justify-between">
                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Riwayat Mutasi Tabungan</h4>
                <a href="{{ route('tabungan.index') }}" class="text-xs font-bold text-indigo-600 hover:text-indigo-800 transition-colors">← Kembali ke Daftar</a>
            </div>
            <div class="overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Tipe</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-widest">Nominal</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Keterangan</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-widest">Status</th>
                            <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-widest">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($mutations as $m)
                            <tr class="{{ $m->status === 'void' ? 'bg-gray-50 opacity-50' : 'hover:bg-emerald-50/30' }} transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $m->date->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($m->type === 'in')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold text-emerald-700 bg-emerald-100 rounded-full">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                            Setoran
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold text-rose-700 bg-rose-100 rounded-full">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                            Penarikan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-bold {{ $m->type === 'in' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $m->type === 'in' ? '+' : '-' }} Rp {{ number_format($m->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $m->description ?: '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($m->status === 'void')
                                        <span class="inline-flex px-2.5 py-1 text-xs font-bold text-gray-500 bg-gray-200 rounded-full">VOID</span>
                                    @else
                                        <span class="inline-flex px-2.5 py-1 text-xs font-bold text-emerald-700 bg-emerald-100 rounded-full">Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($m->status === 'active')
                                        <form action="{{ route('tabungan.void', $m->id) }}" method="POST" onsubmit="return confirm('Yakin ingin void transaksi ini? Saldo akan disesuaikan kembali.');">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center px-2.5 py-1 text-xs font-bold text-rose-600 bg-rose-50 rounded-lg hover:bg-rose-100 transition-colors">
                                                Void
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic text-sm">Belum ada riwayat mutasi tabungan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
