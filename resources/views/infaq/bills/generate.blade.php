<x-app-layout>
    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-8 text-gray-900 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Generate Tagihan Infaq / SPP Massal
            </h3>
            <p class="text-sm text-gray-500 mt-1">Sistem akan memindai seluruh siswa aktif untuk diterbitkan tagihan bulanannya.</p>
        </div>

        <div class="p-8 space-y-8">
            <div class="bg-indigo-50 border-l-4 border-indigo-500 p-4 rounded-r-2xl flex shadow-sm">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-indigo-800">Informasi Penting</h3>
                    <div class="mt-2 text-sm text-indigo-700 space-y-1">
                        <p>Fitur ini akan secara otomatis membuat tagihan SPP bulanan untuk <strong>semua siswa yang berstatus Aktif</strong> dengan parameter berikut:</p>
                        <ul class="list-disc pl-5 mt-2 mb-2">
                            <li>Jika Infaq/SPP siswa di-set <strong>Gratis</strong>, maka tagihan akan dibuat dengan nominal Rp 0 dan status otomatis <strong>LUNAS</strong>.</li>
                            <li>Jika Infaq/SPP siswa di-set <strong>Subsidi</strong>, maka tagihan akan menggunakan nominal subsidi khusus di profil siswa.</li>
                            <li>Jika Infaq/SPP siswa di-set <strong>Bayar</strong>, maka tagihan akan menggunakan nominal standar sesuai kelasnya masing-masing.</li>
                        </ul>
                        <p class="mt-2 font-bold text-rose-600 bg-rose-50 p-2 rounded-lg inline-block">Catatan: Siswa yang sudah dibuatkan (memiliki) tagihan di bulan dan tahun ajaran yang dipilih, akan dilewati oleh sistem otomatis untuk mencegah tagihan ganda.</p>
                    </div>
                </div>
            </div>

            <form id="form-generate" method="POST" action="{{ route('infaq.bills.generate.store') }}">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Tahun Ajaran -->
                    <div>
                        <label for="academic_year_id" class="block text-sm font-bold text-gray-700">Pilih Tahun Ajaran <span class="text-rose-500">*</span></label>
                        <select id="academic_year_id" name="academic_year_id" required
                            class="mt-2 block w-full">
                            @foreach($academicYears as $year)
                                <option value="{{ $year->id }}" {{ $year->is_active ? 'selected' : '' }}>{{ $year->name }}</option>
                            @endforeach
                        </select>
                        @error('academic_year_id')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>

                    <!-- Bulan -->
                    <div>
                        <label for="month" class="block text-sm font-bold text-gray-700">Pilih Bulan Tagihan <span class="text-rose-500">*</span></label>
                        <select id="month" name="month" required
                            class="mt-2 block w-full">
                            @foreach([1=>'Januari', 2=>'Februari', 3=>'Maret', 4=>'April', 5=>'Mei', 6=>'Juni', 7=>'Juli', 8=>'Agustus', 9=>'September', 10=>'Oktober', 11=>'November', 12=>'Desember'] as $key => $name)
                                <option value="{{ $key }}" {{ date('n') == $key ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                        @error('month')<p class="text-rose-500 text-xs italic mt-2">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-x-3 border-t border-gray-100 pt-6">
                    <a href="{{ route('infaq.bills.index') }}" class="inline-flex items-center px-4 py-2 bg-rose-50 border border-rose-200 rounded-xl font-bold text-xs text-rose-600 uppercase tracking-widest shadow-sm hover:bg-rose-100 active:bg-rose-200 outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="button" id="btn-generate" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md shadow-indigo-500/30">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Eksekusi Generate Tagihan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('btn-generate').addEventListener('click', function() {
            const bulan = document.getElementById('month');
            const namaBulan = bulan.options[bulan.selectedIndex].text;

            Swal.fire({
                title: 'Konfirmasi Generate Tagihan',
                html: `<div class="text-left text-sm space-y-2">
                    <p>Anda akan men-generate tagihan Infaq/SPP untuk:</p>
                    <ul class="list-disc pl-5 text-gray-600">
                        <li>Bulan: <strong>${namaBulan}</strong></li>
                        <li>Seluruh siswa aktif</li>
                    </ul>
                    <p class="text-rose-500 font-bold mt-3">Tagihan yang sudah ada tidak akan digandakan.</p>
                </div>`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#e11d48',
                confirmButtonText: '<i class="fa fa-check mr-1"></i> Ya, Generate Sekarang!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                focusCancel: true,
                customClass: {
                    popup: 'rounded-2xl',
                    confirmButton: 'rounded-xl font-bold text-sm px-6 py-2',
                    cancelButton: 'rounded-xl font-bold text-sm px-6 py-2',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('form-generate').submit();
                }
            });
        });
    </script>
</x-app-layout>
