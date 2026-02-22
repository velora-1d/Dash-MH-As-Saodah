<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Perbarui Informasi Kategori</h3>
                        <p class="text-sm text-gray-500 mt-1">Ubah nama, jenis, atau keterangan kategori keuangan ini.</p>
                    </div>

                    <form action="{{ route('transaction-categories.update', $transactionCategory->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700">Nama Kategori</label>
                            <input type="text" name="name" id="name" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                value="{{ old('name', $transactionCategory->name) }}">
                            @error('name')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipe -->
                        <div>
                            <label for="type" class="block text-sm font-bold text-gray-700">Jenis Kategori</label>
                            <select id="type" name="type" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150">
                                <option value="in" {{ old('type', $transactionCategory->type) == 'in' ? 'selected' : '' }}>Pemasukan (Masuk)</option>
                                <option value="out" {{ old('type', $transactionCategory->type) == 'out' ? 'selected' : '' }}>Pengeluaran (Keluar)</option>
                            </select>
                            @error('type')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700">Keterangan (Opsional)</label>
                            <textarea name="description" id="description" rows="2"
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150">{{ old('description', $transactionCategory->description) }}</textarea>
                            @error('description')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                            <a href="{{ route('transaction-categories.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
