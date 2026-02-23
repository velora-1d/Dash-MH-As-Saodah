<x-app-layout>
    <div class="space-y-6">
        <!-- Info Siswa & Saldo -->
        <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-8 text-gray-900">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center justify-center w-14 h-14 rounded-2xl font-bold text-xl" style="background-color: #d1fae5; color: #059669;">
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
                        <a href="{{ route('tabungan.create', $student->id) }}" style="background-color: #4f46e5; color: #ffffff;" class="inline-flex items-center px-5 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:opacity-90 shadow-md transition-all">
                            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                            Transaksi Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Flash Messages -->
        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 px-4 py-3 rounded-xl" role="alert">
                <span class="block sm:inline font-medium">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-600 px-4 py-3 rounded-xl" role="alert">
                <span class="block sm:inline font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Riwayat Mutasi -->
        <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-100 flex items-center justify-between">
                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Riwayat Mutasi Tabungan</h4>
                <a href="{{ route('tabungan.index') }}" style="color: #4f46e5;" class="text-xs font-bold hover:underline transition-colors">← Kembali ke Daftar</a>
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
                            <tr class="{{ $m->status === 'void' ? 'bg-gray-50 opacity-50' : '' }}" style="transition: background 0.2s;">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $m->date->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($m->type === 'in')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full" style="color: #047857; background-color: #d1fae5;">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                            Setoran
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-bold rounded-full" style="color: #be123c; background-color: #ffe4e6;">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                            Penarikan
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-bold @if($m->type === 'in') text-emerald-600 @else text-rose-600 @endif">
                                    {{ $m->type === 'in' ? '+' : '-' }} Rp {{ number_format($m->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $m->description ?: '-' }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($m->status === 'void')
                                        <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-full" style="color: #6b7280; background-color: #e5e7eb;">VOID</span>
                                    @else
                                        <span class="inline-flex px-2.5 py-1 text-xs font-bold rounded-full" style="color: #047857; background-color: #d1fae5;">Aktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($m->status === 'active')
                                        <form action="{{ route('tabungan.void', $m->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="button" onclick="confirmVoidTabungan(this)" class="inline-flex items-center px-3 py-1.5 text-xs font-bold rounded-lg transition-colors border" style="color: #e11d48; background-color: #fff1f2; border-color: #fecdd3;">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
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

    <script>
        function confirmVoidTabungan(btn) {
            Swal.fire({
                title: 'Void Transaksi?',
                html: '<p class="text-sm text-gray-600">Transaksi ini akan dibatalkan dan saldo disesuaikan kembali.<br>Aksi ini <strong style="color:#e11d48;">tidak bisa dibatalkan</strong>.</p>',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e11d48',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Void',
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
