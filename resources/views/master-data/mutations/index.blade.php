<x-app-layout>
    <div class="bg-white shadow-sm sm:rounded-2xl border border-gray-100 overflow-hidden">
        <div class="p-8 text-gray-900 border-b border-gray-100">
            <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
                Mutasi & Kenaikan Kelas Massal
            </h3>
            <p class="text-sm text-gray-500 mt-1">Pindahkan siswa antar kelas atau ubah status kelulusan secara kolektif.</p>
        </div>

        <div class="p-8 space-y-8">
            <!-- Step 1: Pilih Kelas Asal -->
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                <form action="{{ route('mutations.index') }}" method="GET" class="flex flex-col md:flex-row items-end gap-4">
                    <div class="flex-1 w-full">
                        <label for="source_classroom_id" class="block text-sm font-bold text-gray-700">Pilih Kelas Asal (Sumber Data)</label>
                        <select name="source_classroom_id" id="source_classroom_id" required onchange="this.form.submit()"
                            class="mt-2 block w-full">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($classrooms as $cls)
                                <option value="{{ $cls->id }}" {{ $sourceClassroomId == $cls->id ? 'selected' : '' }}>
                                    Tingkat {{ $cls->level }} : {{ $cls->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="hidden md:block">
                        <button type="submit" class="px-6 py-3 bg-white border border-gray-200 rounded-xl font-bold text-xs text-gray-600 uppercase tracking-widest hover:bg-gray-50 shadow-sm transition-all">
                            Muat Data Siswa
                        </button>
                    </div>
                </form>
            </div>

            @if($sourceClassroomId)
                <form action="{{ route('mutations.execute') }}" method="POST">
                    @csrf
                    <input type="hidden" name="source_classroom_id" value="{{ $sourceClassroomId }}">

                    <!-- Step 2: Pilih Siswa & Tujuan -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- List Siswa -->
                        <div class="lg:col-span-2 space-y-4">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Daftar Siswa di Kelas</h4>
                                <label class="inline-flex items-center cursor-pointer">
                                    <input type="checkbox" id="check-all" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 mr-2">
                                    <span class="text-xs font-bold text-indigo-600 uppercase">Pilih Semua</span>
                                </label>
                            </div>
                            
                            <div class="overflow-hidden rounded-xl border border-gray-200">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-3 text-left w-10"></th>
                                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">Nama Siswa</th>
                                            <th class="px-4 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-widest">NISN / NIS</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($students as $student)
                                            <tr class="hover:bg-indigo-50/30 transition-colors">
                                                <td class="px-4 py-3">
                                                    <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="student-checkbox rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="text-sm font-bold text-gray-900">{{ $student->name }}</div>
                                                    <div class="text-xs text-gray-500 capitalize">{{ $student->category }}</div>
                                                </td>
                                                <td class="px-4 py-3 text-xs text-gray-600 font-medium">
                                                    {{ $student->nisn ?: '-' }} / {{ $student->nis ?: '-' }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="px-4 py-8 text-center text-gray-400 italic text-sm">Tidak ada siswa aktif di kelas ini.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Panel Eksekusi -->
                        <div class="lg:col-span-1">
                            <div class="bg-white p-6 rounded-2xl border border-indigo-100 shadow-lg shadow-indigo-500/5 space-y-6 sticky top-6">
                                <h4 class="text-sm font-bold text-indigo-600 uppercase tracking-wider border-b border-indigo-50 pb-2">Opsi Perpindahan</h4>
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="target_classroom_id" class="block text-sm font-bold text-gray-700">Pindah ke Kelas / Ruang</label>
                                        <select name="target_classroom_id" id="target_classroom_id" required class="mt-2 block w-full">
                                            <option value="" disabled selected>-- Pilih Tujuan --</option>
                                            <optgroup label="Daftar Kelas Aktif">
                                                @foreach($classrooms as $cls)
                                                    @if($cls->id != $sourceClassroomId)
                                                        <option value="{{ $cls->id }}">Tingkat {{ $cls->level }} : {{ $cls->name }}</option>
                                                    @endif
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Ubah Status (Massal)">
                                                <option value="lulus">Lulus / Alumni</option>
                                                <option value="pindah">Pindah / Mutasi Keluar</option>
                                                <option value="nonaktif">Diskorsing / Non-Aktif</option>
                                            </optgroup>
                                        </select>
                                    </div>

                                    <div class="pt-4">
                                        <button type="submit" id="btn-submit" disabled class="w-full inline-flex items-center justify-center px-6 py-4 bg-indigo-600 border border-transparent rounded-xl font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg shadow-indigo-500/30 disabled:opacity-50 disabled:grayscale">
                                            Eksekusi Perpindahan
                                        </button>
                                        <p class="text-[10px] text-gray-500 mt-3 text-center leading-relaxed italic">
                                            *Pilih minimal satu siswa dan satu tujuan untuk mengaktifkan tombol.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('check-all');
            const checkboxes = document.querySelectorAll('.student-checkbox');
            const btnSubmit = document.getElementById('btn-submit');
            const targetSelect = document.getElementById('target_classroom_id');

            function updateSubmitButton() {
                const checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
                const targetSelected = targetSelect.value !== "";
                btnSubmit.disabled = checkedCount === 0 || !targetSelected;
            }

            if(checkAll) {
                checkAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => {
                        cb.checked = this.checked;
                    });
                    updateSubmitButton();
                });
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateSubmitButton);
            });

            if(targetSelect) {
                targetSelect.addEventListener('change', updateSubmitButton);
            }
        });
    </script>
    @endpush
</x-app-layout>
