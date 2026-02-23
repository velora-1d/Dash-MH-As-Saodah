<x-app-layout>
    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-8 text-gray-900 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Pembayaran Infaq / SPP
            </h3>
            <p class="text-sm text-gray-500 mt-1">Catat pembayaran untuk tagihan siswa.</p>
        </div>

        <div class="p-8 space-y-8">
            <!-- Info Tagihan -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-2xl p-6 space-y-3">
                <h4 class="text-sm font-bold text-indigo-800 uppercase tracking-wider">Detail Tagihan</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <p class="text-xs text-indigo-500 font-bold">Nama Siswa</p>
                        <p class="text-sm font-bold text-gray-900 mt-1">{{ $bill->student->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-indigo-500 font-bold">Kelas</p>
                        <p class="text-sm font-bold text-gray-900 mt-1">{{ $bill->student->classroom ? $bill->student->classroom->name : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-indigo-500 font-bold">Bulan / Tahun Ajaran</p>
                        <p class="text-sm font-bold text-gray-900 mt-1">{{ $months[$bill->month] ?? '-' }} · {{ $bill->academicYear->name ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-indigo-500 font-bold">Sisa Tagihan</p>
                        <p class="text-xl font-bold {{ $remaining > 0 ? 'text-rose-600' : 'text-emerald-600' }} mt-1">Rp {{ number_format($remaining, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            @if($remaining <= 0)
                <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-6 text-center">
                    <svg class="w-12 h-12 mx-auto text-emerald-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <p class="text-lg font-bold text-emerald-700">Tagihan ini sudah LUNAS</p>
                    <a href="{{ route('infaq.bills.index') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-emerald-600 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-emerald-700 transition-all">← Kembali ke Daftar Tagihan</a>
                </div>
            @else
                <form action="{{ route('infaq.payments.store', $bill->id) }}" method="POST">
                    @csrf
                    <div class="space-y-8">
                        <!-- Metode Pembayaran -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Metode Pembayaran <span class="text-rose-500">*</span></label>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="tunai" class="peer sr-only" {{ old('payment_method', 'tunai') === 'tunai' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:ring-2 peer-checked:ring-emerald-500/20 border-2 border-gray-200 rounded-xl p-4 text-center transition-all hover:border-emerald-300">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        <p class="text-sm font-bold text-gray-700">Tunai</p>
                                        <p class="text-xs text-gray-500 mt-1">Bayar langsung</p>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="transfer" class="peer sr-only" {{ old('payment_method') === 'transfer' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-indigo-500 peer-checked:bg-indigo-50 peer-checked:ring-2 peer-checked:ring-indigo-500/20 border-2 border-gray-200 rounded-xl p-4 text-center transition-all hover:border-indigo-300">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                        <p class="text-sm font-bold text-gray-700">Transfer</p>
                                        <p class="text-xs text-gray-500 mt-1">Via rekening bank</p>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="payment_method" value="tabungan" class="peer sr-only" {{ old('payment_method') === 'tabungan' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-amber-500 peer-checked:bg-amber-50 peer-checked:ring-2 peer-checked:ring-amber-500/20 border-2 border-gray-200 rounded-xl p-4 text-center transition-all hover:border-amber-300">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                        <p class="text-sm font-bold text-gray-700">Potong Tabungan</p>
                                        <p class="text-xs text-amber-600 mt-1 font-bold">Saldo: Rp {{ number_format($savingsBalance, 0, ',', '.') }}</p>
                                    </div>
                                </label>
                            </div>
                            @error('payment_method')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Nominal -->
                            <div>
                                <label for="amount" class="block text-sm font-bold text-gray-700">Jumlah Bayar (Rp) <span class="text-rose-500">*</span></label>
                                <input type="number" name="amount" id="amount" value="{{ old('amount', $remaining) }}" min="1000" max="{{ $remaining }}" step="1000" required
                                    class="mt-2 block w-full">
                                @error('amount')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                            </div>

                            <!-- Tanggal -->
                            <div>
                                <label for="date" class="block text-sm font-bold text-gray-700">Tanggal Pembayaran <span class="text-rose-500">*</span></label>
                                <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required
                                    class="mt-2 block w-full">
                                @error('date')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                        <a href="{{ route('infaq.bills.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-800 outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-emerald-500/30">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
