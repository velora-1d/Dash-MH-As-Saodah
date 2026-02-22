<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <div class="mb-8 border-b border-gray-100 pb-4">
                        <h3 class="text-lg font-bold text-gray-900">Perbarui Parameter Kelas</h3>
                        <p class="text-sm text-gray-500 mt-1">Gunakan form ini untuk mengubah nama ruangan ataupun jenjang kelasnya.</p>
                    </div>

                    <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Tingkat Kelas -->
                        <div>
                            <label for="level" class="block text-sm font-bold text-gray-700">Tingkatan / Level Kelas</label>
                            <select id="level" name="level" required
                                class="mt-2 block w-full">
                                <option value="" disabled>-- Pilih Tingkat Kelas MI --</option>
                                @for($i = 1; $i <= 6; $i++)
                                    <option value="{{ $i }}" {{ old('level', $classroom->level) == $i ? 'selected' : '' }}>Kelas {{ $i }}</option>
                                @endfor
                            </select>
                            @error('level')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Ruangan / Sub-Kelas -->
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700">Nama Kelas / Ruangan / Paralel</label>
                            <input type="text" name="name" id="name" required
                                class="mt-2 block w-full"
                                placeholder="Misal: Kelas 1A" value="{{ old('name', $classroom->name) }}">
                            @error('name')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Wali Kelas -->
                        <div>
                            <label for="wali_kelas" class="block text-sm font-bold text-gray-700">Wali Kelas</label>
                            <div class="mt-2 text-xs text-gray-500 mb-2">Nama guru yang menjadi wali kelas ini.</div>
                            <input type="text" name="wali_kelas" id="wali_kelas"
                                class="mt-1 block w-full"
                                placeholder="Misal: Ustadzah Siti Aminah" value="{{ old('wali_kelas', $classroom->wali_kelas) }}">
                            @error('wali_kelas')
                                <p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alert if has students -->
                        @if($classroom->students()->count() > 0)
                            <div class="bg-amber-50 text-amber-700 border border-amber-200 p-4 rounded-xl text-sm flex gap-3 items-start mt-6">
                                <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                <div>
                                    <p class="font-bold">Informasi Keterkaitan Data</p>
                                    <p class="mt-1">Kelas ini saat ini menduduki <strong>{{ $classroom->students()->count() }} siswa</strong> aktif. Perubahan tingkatan maupun nama kelas akan berdampak langsung terhadap tampilan rapor & data administrasi anak tersebut.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Action Buttons -->
                        <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100 mt-8">
                            <a href="{{ route('classrooms.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm shadow-indigo-600/20">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
