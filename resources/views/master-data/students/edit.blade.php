<x-app-layout>

    <div>
        <div class="">
            <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Formulir Mutasi & Koreksi Data</h3>
                    <p class="text-sm text-gray-500 mt-1">Gunakan formulir ini untuk memperbaiki NIK/NISN atau merubah jenjang kelas tanggungan anak saat ini.</p>
                </div>

                <form action="{{ route('students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="p-8 space-y-8">
                        
                        <!-- Block 1: Identitas Pribadi -->
                        <div>
                            <h4 class="text-sm font-bold text-indigo-600 uppercase tracking-wider mb-4 border-b border-indigo-100 pb-2">Informasi Biodata</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-1 md:col-span-2">
                                    <label for="name" class="block text-sm font-bold text-gray-700">Nama Lengkap Siswa</label>
                                    <input type="text" name="name" id="name" required
                                        class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('name', $student->name) }}">
                                    @error('name')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="nisn" class="block text-sm font-bold text-gray-700">NISN (Nomor Induk Siswa Nasional)</label>
                                    <input type="number" name="nisn" id="nisn"
                                        class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('nisn', $student->nisn) }}">
                                    <p class="text-xs text-gray-500 mt-1">Dapat dikosongkan jika belum turun surat keputusannya.</p>
                                    @error('nisn')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="nis" class="block text-sm font-bold text-gray-700">NIS (Nomor Induk Sekolah Lokal)</label>
                                    <input type="number" name="nis" id="nis"
                                        class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('nis', $student->nis) }}">
                                    @error('nis')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="nik" class="block text-sm font-bold text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="number" name="nik" id="nik" placeholder="16 Digit NIK Anak"
                                        class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('nik', $student->nik) }}">
                                    @error('nik')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="no_kk" class="block text-sm font-bold text-gray-700">No. Kartu Keluarga (KK)</label>
                                    <input type="number" name="no_kk" id="no_kk" placeholder="16 Digit Nomor KK"
                                        class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('no_kk', $student->no_kk) }}">
                                    @error('no_kk')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-bold text-gray-700">Jenis Kelamin</label>
                                    <select id="gender" name="gender" required
                                        class="mt-2 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm transition duration-150">
                                        <option value="" disabled>-- Tentukan --</option>
                                        <option value="L" {{ old('gender', $student->gender) == 'L' ? 'selected' : '' }}>Laki - Laki</option>
                                        <option value="P" {{ old('gender', $student->gender) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('gender')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>

                        <!-- Block 2: Skema Administrasi -->
                        <div>
                            <h4 class="text-sm font-bold text-emerald-600 uppercase tracking-wider mb-4 border-b border-emerald-100 pb-2">Status Penempatan & Administrasi</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <div>
                                    <label for="category" class="block text-sm font-bold text-gray-700">Kategori Basis Biaya Pendanaan (SPP/Infaq)</label>
                                    <select id="category" name="category" required
                                        class="mt-2 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm transition duration-150">
                                        <option value="reguler" {{ old('category', $student->category) == 'reguler' ? 'selected' : '' }}>Reguler (Normal)</option>
                                        <option value="yatim" {{ old('category', $student->category) == 'yatim' ? 'selected' : '' }}>Yatim/Piatu (Gratis 100%)</option>
                                        <option value="kurang_mampu" {{ old('category', $student->category) == 'kurang_mampu' ? 'selected' : '' }}>Kurang Mampu (Diskon Manual)</option>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Sangat menentukan generator tagihan sistem ke depannya.</p>
                                    @error('category')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="classroom_id" class="block text-sm font-bold text-gray-700">Penempatan Kelas</label>
                                    <select id="classroom_id" name="classroom_id"
                                        class="mt-2 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm transition duration-150">
                                        <option value="">-- Biarkan Mengambang (Belum Set) --</option>
                                        @foreach($classrooms as $cls)
                                            <option value="{{ $cls->id }}" {{ old('classroom_id', $student->classroom_id) == $cls->id ? 'selected' : '' }}>
                                                Tingkat {{ $cls->level }} : Ruang {{ $cls->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="text-xs text-indigo-500 mt-1">Ubah ini jika anak tersebut naik kelas.</p>
                                    @error('classroom_id')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="status" class="block text-sm font-bold text-gray-700">Status Kenegaraan Siswa</label>
                                    <select id="status" name="status" required
                                        class="mt-2 block w-full border-gray-300 focus:border-emerald-500 focus:ring-emerald-500 rounded-xl shadow-sm transition duration-150">
                                        <option value="aktif" {{ old('status', $student->status) == 'aktif' ? 'selected' : '' }} class="font-bold text-emerald-600">Siswa Aktif</option>
                                        <option value="lulus" {{ old('status', $student->status) == 'lulus' ? 'selected' : '' }}>Lulus / Alumni</option>
                                        <option value="pindah" {{ old('status', $student->status) == 'pindah' ? 'selected' : '' }}>Pindah / Mutasi Keluar</option>
                                        <option value="nonaktif" {{ old('status', $student->status) == 'nonaktif' ? 'selected' : '' }}>Diskorsing / Cuti</option>
                                    </select>
                                    @error('status')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>
                                
                            </div>
                        </div>

                        <!-- Block 3: Data Orang Tua / Wali -->
                        <div>
                            <h4 class="text-sm font-bold text-amber-600 uppercase tracking-wider mb-4 border-b border-amber-100 pb-2">Data Orang Tua / Wali</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="col-span-1 md:col-span-2">
                                    <label for="parent_name" class="block text-sm font-bold text-gray-700">Nama Orang Tua / Wali</label>
                                    <input type="text" name="parent_name" id="parent_name" placeholder="Cth: Bpk. Ahmad Fauzi"
                                        class="mt-2 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('parent_name', $student->parent_name) }}">
                                    @error('parent_name')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="parent_phone" class="block text-sm font-bold text-gray-700">No. WhatsApp / HP Wali</label>
                                    <input type="text" name="parent_phone" id="parent_phone" placeholder="Cth: 08123456789"
                                        class="mt-2 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-xl shadow-sm transition duration-150"
                                        value="{{ old('parent_phone', $student->parent_phone) }}">
                                    <p class="text-xs text-gray-500 mt-1">Digunakan untuk notifikasi tagihan & pengumuman.</p>
                                    @error('parent_phone')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="address" class="block text-sm font-bold text-gray-700">Alamat Rumah</label>
                                    <textarea name="address" id="address" rows="2" placeholder="Cth: Jl. Mawar No. 10, RT 02/05, Kel. Sukamaju"
                                        class="mt-2 block w-full border-gray-300 focus:border-amber-500 focus:ring-amber-500 rounded-xl shadow-sm transition duration-150">{{ old('address', $student->address) }}</textarea>
                                    @error('address')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                    <div class="p-8 bg-gray-50 border-t border-gray-100 flex items-center justify-end gap-3 rounded-b-2xl">
                        <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-xl font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition shadow-sm shadow-indigo-600/20">
                            Terapkan Pembaruan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
