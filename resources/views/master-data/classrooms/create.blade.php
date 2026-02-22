<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Informasi Rombongan Belajar</h3>
                        <p class="text-sm text-gray-500 mt-1">Definisikan nomor tingkat kelas (1-6) dan nama ruangannya (Opsional jika ada pengelompokan seperti A, B, C).</p>
                    </div>

                    <form action="{{ route('classrooms.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Tingkat Kelas -->
                        <div>
                            <label for="level" class="block text-sm font-bold text-gray-700">Tingkatan / Level Kelas</label>
                            <select id="level" name="level" required
                                class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150">
                                <option value="" disabled selected>-- Pilih Tingkat Kelas MI --</option>
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ old('level') == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
                                @endfor
                            </select>
                            @error('level')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Ruangan / Sub-Kelas -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700">Nama Kelas / Ruangan / Paralel</label>
                            <div class="mt-2 text-xs text-gray-500 mb-2">Label identitas unik. Misalnya Kelas Anda paralel: "Kelas 1A" atau "1 Abu Bakar"</div>
                            <input type="text" name="name" id="name" required
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                placeholder="Misal: Kelas 1A" value="{{ old('name') }}">
                            @error('name')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wali Kelas -->
                        <div>
                            <label for="wali_kelas" class="block text-sm font-bold text-gray-700">Wali Kelas</label>
                            <div class="mt-2 text-xs text-gray-500 mb-2">Nama guru yang menjadi wali kelas ini.</div>
                            <input type="text" name="wali_kelas" id="wali_kelas"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                placeholder="Misal: Ustadzah Siti Aminah" value="{{ old('wali_kelas') }}">
                            @error('wali_kelas')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-8">
                            <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm shadow-indigo-600/20">
                                Simpan Kelas
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
