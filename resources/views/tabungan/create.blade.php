<x-app-layout>
    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-8 text-gray-900 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Transaksi Tabungan — {{ $student->name }}
            </h3>
            <p class="text-sm text-gray-500 mt-1">Saldo saat ini: <strong class="{{ $balance > 0 ? 'text-emerald-600' : 'text-gray-400' }}">Rp {{ number_format($balance, 0, ',', '.') }}</strong></p>
        </div>

        <div class="p-8">
            <form action="{{ route('tabungan.store', $student->id) }}" method="POST">
                @csrf

                <div class="space-y-8">
                    <!-- Tipe Transaksi -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-3">Jenis Transaksi <span class="text-rose-500">*</span></label>
                        <div class="flex gap-4">
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="type" value="in" class="peer sr-only" {{ old('type', 'in') === 'in' ? 'checked' : '' }}>
                                <div class="peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:ring-2 peer-checked:ring-emerald-500/20 border-2 border-gray-200 rounded-xl p-4 text-center transition-all hover:border-emerald-300">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                    <p class="text-sm font-bold text-gray-700">Setoran</p>
                                    <p class="text-xs text-gray-500 mt-1">Tambah saldo</p>
                                </div>
                            </label>
                            <label class="flex-1 cursor-pointer">
                                <input type="radio" name="type" value="out" class="peer sr-only" {{ old('type') === 'out' ? 'checked' : '' }}>
                                <div class="peer-checked:border-rose-500 peer-checked:bg-rose-50 peer-checked:ring-2 peer-checked:ring-rose-500/20 border-2 border-gray-200 rounded-xl p-4 text-center transition-all hover:border-rose-300">
                                    <svg class="w-8 h-8 mx-auto mb-2 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                    <p class="text-sm font-bold text-gray-700">Penarikan</p>
                                    <p class="text-xs text-gray-500 mt-1">Kurangi saldo</p>
                                </div>
                            </label>
                        </div>
                        @error('type')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Nominal -->
                        <div>
                            <label for="amount" class="block text-sm font-bold text-gray-700">Nominal (Rp) <span class="text-rose-500">*</span></label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="1000" step="1000" required
                                class="mt-2 block w-full" placeholder="Contoh: 50000">
                            @error('amount')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="date" class="block text-sm font-bold text-gray-700">Tanggal Transaksi <span class="text-rose-500">*</span></label>
                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required
                                class="mt-2 block w-full">
                            @error('date')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700">Keterangan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="description" id="description" rows="3" maxlength="500"
                            class="mt-2 block w-full" placeholder="Contoh: Setoran rutin minggu ke-2">{{ old('description') }}</textarea>
                        @error('description')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                    <a href="{{ route('tabungan.show', $student->id) }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-emerald-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-800 outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-emerald-500/30">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
