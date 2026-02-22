<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Definisikan Kategori Baru</h3>
                        <p class="text-sm text-gray-500 mt-1">Tambahkan kategori referensi untuk pencatatan pemasukan atau pengeluaran.</p>
                    </div>

                    <form action="{{ route('transaction-categories.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Nama -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700">Nama Kategori</label>
                            <input type="text" name="name" id="name" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                placeholder="Misal: Dana BOS, Listrik, Honor Guru" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipe -->
                        <div>
                            <label for="type" class="block text-sm font-bold text-gray-700">Jenis Kategori</label>
                            <select id="type" name="type" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150">
                                <option value="" disabled selected>-- Pilih Jenis --</option>
                                <option value="in" {{ old('type') == 'in' ? 'selected' : '' }}>Pemasukan (Masuk)</option>
                                <option value="out" {{ old('type') == 'out' ? 'selected' : '' }}>Pengeluaran (Keluar)</option>
                            </select>
                            @error('type')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="description" class="block text-sm font-bold text-gray-700">Keterangan (Opsional)</label>
                            <textarea name="description" id="description" rows="2"
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                placeholder="Penjelasan singkat mengenai kategori ini">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-8">
                            <a href="{{ route('transaction-categories.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition shadow-sm shadow-indigo-600/20">
                                Simpan Kategori
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
