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
                        <div class="grid grid-cols-2 gap-4" id="type-selector">
                            <div class="type-option selected" data-value="in" onclick="selectType(this)">
                                <svg class="w-8 h-8 mx-auto mb-2 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                <p class="text-sm font-bold text-gray-700">Setoran</p>
                                <p class="text-xs text-gray-500 mt-1">Tambah saldo</p>
                            </div>
                            <div class="type-option" data-value="out" onclick="selectType(this)">
                                <svg class="w-8 h-8 mx-auto mb-2 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                <p class="text-sm font-bold text-gray-700">Penarikan</p>
                                <p class="text-xs text-gray-500 mt-1">Kurangi saldo</p>
                            </div>
                        </div>
                        <input type="hidden" name="type" id="type_input" value="{{ old('type', 'in') }}">
                        @error('type')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Nominal -->
                        <div>
                            <label for="amount" class="block text-sm font-bold text-gray-700">Nominal (Rp) <span class="text-rose-500">*</span></label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" min="1000" step="1000" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" placeholder="Contoh: 50000">
                            @error('amount')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="date" class="block text-sm font-bold text-gray-700">Tanggal Transaksi <span class="text-rose-500">*</span></label>
                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm">
                            @error('date')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <!-- Keterangan -->
                    <div>
                        <label for="description" class="block text-sm font-bold text-gray-700">Keterangan <span class="text-gray-400 font-normal">(Opsional)</span></label>
                        <textarea name="description" id="description" rows="3" maxlength="500"
                            class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm" placeholder="Contoh: Setoran rutin minggu ke-2">{{ old('description') }}</textarea>
                        @error('description')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                    <a href="{{ route('tabungan.show', $student->id) }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" style="background-color: #059669; color: #ffffff;" class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl font-bold text-sm uppercase tracking-widest hover:opacity-90 shadow-md transition ease-in-out duration-150">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .type-option {
            border: 2px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .type-option:hover {
            border-color: #a5b4fc;
            background-color: #f5f3ff;
        }
        .type-option.selected {
            border-color: #4f46e5;
            background-color: #eef2ff;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
        }
    </style>

    <script>
        function selectType(el) {
            document.querySelectorAll('.type-option').forEach(opt => opt.classList.remove('selected'));
            el.classList.add('selected');
            document.getElementById('type_input').value = el.dataset.value;
        }
    </script>
</x-app-layout>
