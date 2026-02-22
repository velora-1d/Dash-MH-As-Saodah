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
                                class="mt-2 block w-full"
                                placeholder="Misal: Dana BOS, Listrik, Honor Guru" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipe -->
                        <div>
                            <label for="type" class="block text-sm font-bold text-gray-700">Jenis Kategori</label>
                            <select id="type" name="type" required
                                class="mt-2 block w-full">
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
                                class="mt-2 block w-full"
                                placeholder="Penjelasan singkat mengenai kategori ini">{{ old('description') }}</textarea>
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
                                Simpan Kategori
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
