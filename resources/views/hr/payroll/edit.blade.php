<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Slip Gaji : ') }} {{ $payroll->employee->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Basic Payroll Info -->
                    <div class="mb-6 pb-4 border-b">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Informasi Pembayaran</h3>
                        <p class="text-sm text-gray-600"><strong>Pegawai:</strong> {{ $payroll->employee->name }}</p>
                        <p class="text-sm text-gray-600"><strong>Periode:</strong> Bulan {{ $payroll->month }} - {{ $payroll->academicYear->name }}</p>
                        <p class="text-sm text-gray-600"><strong>Status Saat Ini:</strong> 
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $payroll->status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($payroll->status) }}
                            </span>
                        </p>
                    </div>

                    <form action="{{ route('hr.payroll.update', $payroll->id) }}" method="POST" id="payrollForm">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Pendapatan (Earnings) -->
                            <div>
                                <h3 class="text-lg font-medium text-green-700 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                    Komponen Pendapatan
                                </h3>
                                @php
                                    $earningComponents = $components->where('type', 'earning');
                                @endphp

                                @if($earningComponents->isEmpty())
                                    <p class="text-sm text-gray-500 italic">Tidak ada master komponen pendapatan.</p>
                                @endif

                                @foreach($earningComponents as $comp)
                                    @php
                                        $existingDetail = $payroll->details->where('component_name', $comp->name)->first();
                                        $nominal = $existingDetail ? $existingDetail->nominal : 0;
                                    @endphp
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">{{ $comp->name }}</label>
                                        <div class="mt-1 relative rounded-md shadow-sm fi-money-wrap">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="hidden" name="components[{{ $comp->id }}]" value="{{ $nominal }}">
                                            <input type="text" class="salary-nominal focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" data-type="earning" value="{{ number_format($nominal, 0, ',', '.') }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Potongan (Deductions) -->
                            <div>
                                <h3 class="text-lg font-medium text-red-700 mb-4 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                    Potongan
                                </h3>
                                @php
                                    $deductionComponents = $components->where('type', 'deduction');
                                @endphp

                                @if($deductionComponents->isEmpty())
                                    <p class="text-sm text-gray-500 italic">Tidak ada master potongan tercatat.</p>
                                @endif

                                @foreach($deductionComponents as $comp)
                                    @php
                                        $existingDetail = $payroll->details->where('component_name', $comp->name)->first();
                                        $nominal = $existingDetail ? $existingDetail->nominal : 0;
                                    @endphp
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700">{{ $comp->name }}</label>
                                        <div class="mt-1 relative rounded-md shadow-sm fi-money-wrap">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <span class="text-gray-500 sm:text-sm">Rp</span>
                                            </div>
                                            <input type="hidden" name="components[{{ $comp->id }}]" value="{{ $nominal }}">
                                            <input type="text" class="salary-nominal focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-md" data-type="deduction" value="{{ number_format($nominal, 0, ',', '.') }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Panel Ringkasan Kalkulasi Otomatis -->
                        <div class="mt-6 p-5 rounded-xl border-2 border-blue-200 bg-blue-50" id="summaryPanel">
                            <h4 class="text-sm font-bold text-blue-800 mb-3 uppercase tracking-wide">Ringkasan Gaji</h4>
                            <div class="space-y-2">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-green-700 font-medium">Total Pendapatan</span>
                                    <span class="font-bold text-green-700" id="totalEarning">Rp 0</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-red-600 font-medium">Total Potongan</span>
                                    <span class="font-bold text-red-600" id="totalDeduction">Rp 0</span>
                                </div>
                                <hr class="border-blue-300">
                                <div class="flex justify-between items-center text-base pt-1">
                                    <span class="text-blue-900 font-bold">Gaji Bersih (THP)</span>
                                    <span class="font-extrabold text-blue-900 text-lg" id="netSalary">Rp 0</span>
                                </div>
                            </div>
                        </div>

                        <!-- Catatan Tambahan -->
                        <div class="mt-6 border-t pt-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Catatan / Deskripsi Transaksi (Opsional)</label>
                            <div class="mt-1">
                                <textarea id="description" name="description" rows="3" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $payroll->description) }}</textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8 flex justify-end gap-3 border-t pt-4">
                            <a href="{{ route('hr.payroll.index') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Batal
                            </a>
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Perubahan Gaji
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function formatRibuan(val) {
                var num = String(val).replace(/\D/g, '');
                return num.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }

            function formatCurrency(val) {
                return 'Rp ' + formatRibuan(val);
            }

            function recalculate() {
                var totalEarning = 0;
                var totalDeduction = 0;

                document.querySelectorAll('.salary-nominal').forEach(function(el) {
                    var hiddenInput = el.closest('.fi-money-wrap').querySelector('input[type="hidden"]');
                    var raw = parseInt(hiddenInput ? hiddenInput.value : 0) || 0;
                    var type = el.getAttribute('data-type');

                    if (type === 'earning') {
                        totalEarning += raw;
                    } else if (type === 'deduction') {
                        totalDeduction += raw;
                    }
                });

                var netSalary = totalEarning - totalDeduction;

                document.getElementById('totalEarning').textContent = formatCurrency(totalEarning);
                document.getElementById('totalDeduction').textContent = formatCurrency(totalDeduction);
                document.getElementById('netSalary').textContent = formatCurrency(netSalary);

                // Warna net salary: merah jika minus, biru jika positif
                var netEl = document.getElementById('netSalary');
                if (netSalary < 0) {
                    netEl.className = 'font-extrabold text-red-600 text-lg';
                } else {
                    netEl.className = 'font-extrabold text-blue-900 text-lg';
                }
            }

            // Setup event listener untuk setiap input nominal
            document.querySelectorAll('.salary-nominal').forEach(function(el) {
                var hiddenInput = el.closest('.fi-money-wrap').querySelector('input[type="hidden"]');
                el.addEventListener('input', function() {
                    var raw = el.value.replace(/\D/g, '');
                    el.value = formatRibuan(raw);
                    if (hiddenInput) hiddenInput.value = raw;
                    recalculate();
                });
            });

            // Hitung total awal saat halaman dimuat
            recalculate();
        });
    </script>
</x-app-layout>
