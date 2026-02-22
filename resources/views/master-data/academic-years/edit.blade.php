<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Perbarui Data Tahun Ajaran</h3>
                        <p class="text-sm text-gray-500 mt-1">Ubah atau nonaktifkan status tahun ajaran ini jika sudah berganti periode.</p>
                    </div>

                    <form action="{{ route('academic-years.update', $academicYear->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Tahun Ajaran -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700">Nama Tahun Ajaran</label>
                            <input type="text" name="name" id="name" required
                                class="mt-2 block w-full"
                                placeholder="Misal: 2024/2025" value="{{ old('name', $academicYear->name) }}">
                            @error('name')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div>
                            <label for="semester" class="block text-sm font-bold text-gray-700">Semester Berjalan</label>
                            <select id="semester" name="semester" required
                                class="mt-2 block w-full">
                                <option value="" disabled>-- Pilih Semester --</option>
                                <option value="ganjil" {{ old('semester', $academicYear->semester) == 'ganjil' ? 'selected' : '' }}>Semester Ganjil</option>
                                <option value="genap" {{ old('semester', $academicYear->semester) == 'genap' ? 'selected' : '' }}>Semester Genap</option>
                            </select>
                            @error('semester')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status Aktif -->
                        <div class="flex items-start bg-amber-50/50 p-4 rounded-xl border border-amber-100 mt-6">
                            <div class="flex items-center h-5">
                                <input id="is_active" name="is_active" type="checkbox" value="1" {{ old('is_active', $academicYear->is_active) ? 'checked' : '' }}
                                    class="focus:ring-amber-500 h-5 w-5 text-amber-600 border-gray-300 rounded cursor-pointer transition duration-150">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="is_active" class="font-bold text-gray-900 cursor-pointer">Set Tahun Ajaran Ini Sebagai "Aktif"</label>
                                <p class="text-gray-500 text-xs mt-1">Hanya 1 Tahun Ajaran yang boleh berstatus aktif di satu waktu. Jika ini dicentang, maka otomatis Tahun Ajaran lain yang sedang aktif akan tergantikan (Dinonaktifkan).</p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                            <a href="{{ route('academic-years.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
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
