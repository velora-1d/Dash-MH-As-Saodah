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
                                        class="mt-2 block w-full"
                                        value="{{ old('name', $student->name) }}">
                                    @error('name')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="nisn" class="block text-sm font-bold text-gray-700">NISN (Nomor Induk Siswa Nasional)</label>
                                    <input type="number" name="nisn" id="nisn"
                                        class="mt-2 block w-full"
                                        value="{{ old('nisn', $student->nisn) }}">
                                    <p class="text-xs text-gray-500 mt-1">Dapat dikosongkan jika belum turun surat keputusannya.</p>
                                    @error('nisn')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="nis" class="block text-sm font-bold text-gray-700">NIS (Nomor Induk Sekolah Lokal)</label>
                                    <input type="number" name="nis" id="nis"
                                        class="mt-2 block w-full"
                                        value="{{ old('nis', $student->nis) }}">
                                    @error('nis')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="nik" class="block text-sm font-bold text-gray-700">NIK (Nomor Induk Kependudukan)</label>
                                    <input type="number" name="nik" id="nik" placeholder="16 Digit NIK Anak"
                                        class="mt-2 block w-full"
                                        value="{{ old('nik', $student->nik) }}">
                                    @error('nik')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="no_kk" class="block text-sm font-bold text-gray-700">No. Kartu Keluarga (KK)</label>
                                    <input type="number" name="no_kk" id="no_kk" placeholder="16 Digit Nomor KK"
                                        class="mt-2 block w-full"
                                        value="{{ old('no_kk', $student->no_kk) }}">
                                    @error('no_kk')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="gender" class="block text-sm font-bold text-gray-700">Jenis Kelamin</label>
                                    <select id="gender" name="gender" required
                                        class="mt-2 block w-full">
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
                                
                                <div class="col-span-1 md:col-span-2">
                                    <label for="category" class="block text-sm font-bold text-gray-700">Kategori Siswa (Sosial)</label>
                                    <select id="category" name="category" required
                                        class="mt-2 block w-full">
                                        <option value="reguler" {{ old('category', $student->category) == 'reguler' ? 'selected' : '' }}>Reguler</option>
                                        <option value="yatim" {{ old('category', $student->category) == 'yatim' ? 'selected' : '' }}>Yatim / Piatu</option>
                                        <option value="kurang_mampu" {{ old('category', $student->category) == 'kurang_mampu' ? 'selected' : '' }}>Kurang Mampu</option>
                                    </select>
                                    @error('category')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="classroom_id" class="block text-sm font-bold text-gray-700">Penempatan Kelas</label>
                                    <select id="classroom_id" name="classroom_id"
                                        class="mt-2 block w-full">
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
                                        class="mt-2 block w-full">
                                        <option value="aktif" {{ old('status', $student->status) == 'aktif' ? 'selected' : '' }} class="font-bold text-emerald-600">Siswa Aktif</option>
                                        <option value="lulus" {{ old('status', $student->status) == 'lulus' ? 'selected' : '' }}>Lulus / Alumni</option>
                                        <option value="pindah" {{ old('status', $student->status) == 'pindah' ? 'selected' : '' }}>Pindah / Mutasi Keluar</option>
                                        <option value="nonaktif" {{ old('status', $student->status) == 'nonaktif' ? 'selected' : '' }}>Diskorsing / Cuti</option>
                                    </select>
                                    @error('status')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>
                                
                                <div class="col-span-1 md:col-span-2 mt-4 pt-4 border-t border-emerald-50">
                                    <h5 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Pengaturan SPP / Infaq Bulanan</h5>
                                    
                                    <div class="bg-sky-50 p-4 rounded-xl border border-sky-100 mb-4 flex items-start space-x-3">
                                        <svg class="w-5 h-5 text-sky-500 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <p class="text-sm text-sky-800 leading-relaxed">
                                            <strong>Sekilas Info:</strong> Secara otomatis sistem akan membaca Pilihan Kategori di atas. Jika <strong>Yatim</strong>, maka tagihannya otomatis <strong>Gratis</strong>. Jika <strong>Reguler</strong>, tagihannya otomatis <strong>Sesuai Tarif Kelas</strong>. Anda hanya perlu mengganti pilihan di bawah jika ada <strong>pengecualian</strong> aturan dari sekolah / kepala sekolah (Misal: anak itu Reguler tapi karena dia anak dari seorang guru maka SPP nya dipotong/disubsidi).
                                        </p>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-emerald-50/50 p-4 rounded-xl border border-emerald-100">
                                        <div>
                                            <label for="infaq_status" class="block text-sm font-bold text-gray-700">Skema Pembayaran Siswa Ini</label>
                                            <select id="infaq_status" name="infaq_status" required
                                                class="mt-2 block w-full">
                                                <option value="bayar" {{ old('infaq_status', $student->infaq_status) == 'bayar' ? 'selected' : '' }}>Bayar Normal (Sesuai Tarif Kelas)</option>
                                                <option value="subsidi" {{ old('infaq_status', $student->infaq_status) == 'subsidi' ? 'selected' : '' }}>Dapat Keringanan (Bayar Sebagian Saja)</option>
                                                <option value="gratis" {{ old('infaq_status', $student->infaq_status) == 'gratis' ? 'selected' : '' }}>Gratis Sepenuhnya (Rp 0)</option>
                                            </select>
                                            <p class="text-xs text-gray-500 mt-1">Ubah manual jika ada kebijakan khusus diluar standar sistem.</p>
                                            @error('infaq_status')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                        </div>

                                        <div id="infaq_nominal_container" class="{{ old('infaq_status', $student->infaq_status) == 'subsidi' ? '' : 'hidden' }}">
                                            <label for="infaq_nominal" class="block text-sm font-bold text-gray-700">Nominal yang Wajib Dibayar</label>
                                            <div class="relative mt-2">
                                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                    <span class="text-gray-500 sm:text-sm font-bold">Rp</span>
                                                </div>
                                                <input type="number" name="infaq_nominal" id="infaq_nominal" min="0" step="1000"
                                                    class="pl-10 block w-full"
                                                    placeholder="Cth: 25000" value="{{ old('infaq_nominal', $student->infaq_nominal) }}">
                                            </div>
                                            <p class="text-xs text-gray-500 mt-1">Keringanan: Misal tarif aslinya 50.000, tapi kena aturan Keringanan cukup bayar 20.000, maka isi 20000 di sini.</p>
                                            @error('infaq_nominal')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                        </div>
                                    </div>
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
                                        class="mt-2 block w-full"
                                        value="{{ old('parent_name', $student->parent_name) }}">
                                    @error('parent_name')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                    <label for="parent_phone" class="block text-sm font-bold text-gray-700">No. WhatsApp / HP Wali</label>
                                    <input type="text" name="parent_phone" id="parent_phone" placeholder="Cth: 08123456789"
                                        class="mt-2 block w-full"
                                        value="{{ old('parent_phone', $student->parent_phone) }}">
                                    <p class="text-xs text-gray-500 mt-1">Digunakan untuk notifikasi tagihan & pengumuman.</p>
                                    @error('parent_phone')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>

                                <div>
                                     <label for="address" class="block text-sm font-bold text-gray-700">Alamat Rumah</label>
                                    <textarea name="address" id="address" rows="2" placeholder="Cth: Jl. Mawar No. 10, RT 02/05, Kel. Sukamaju"
                                        class="mt-2 block w-full">{{ old('address', $student->address) }}</textarea>
                                    @error('address')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Action Buttons -->
                        <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                            <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30">
                                Terapkan Pembaruan
                            </button>
                        </div>
                    </form>

            </div>
        </div>
    </div>

    <!-- Script for Dynamic SPP Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category');
            const infaqStatusSelect = document.getElementById('infaq_status');
            const infaqNominalContainer = document.getElementById('infaq_nominal_container');
            const infaqNominalInput = document.getElementById('infaq_nominal');

            function toggleNominalInput() {
                if (infaqStatusSelect.value === 'subsidi') {
                    infaqNominalContainer.classList.remove('hidden');
                    infaqNominalInput.setAttribute('required', 'required');
                } else {
                    infaqNominalContainer.classList.add('hidden');
                    infaqNominalInput.removeAttribute('required');
                    infaqNominalInput.value = ''; // Reset value
                }
            }

            function autoAdjustStatusBasedOnCategory() {
                if (categorySelect.value === 'yatim') {
                    infaqStatusSelect.value = 'gratis';
                } else if (categorySelect.value === 'reguler') {
                    infaqStatusSelect.value = 'bayar';
                }
                toggleNominalInput();
            }

            infaqStatusSelect.addEventListener('change', toggleNominalInput);
            categorySelect.addEventListener('change', autoAdjustStatusBasedOnCategory);
        });
    </script>
</x-app-layout>
