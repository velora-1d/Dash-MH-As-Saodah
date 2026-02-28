<x-app-layout>


    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: flex-start; gap: 1rem;">
                    <a href="{{ route('hr.payroll.index') }}" style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3); color: #fff; transition: all 0.2s ease; text-decoration: none; flex-shrink: 0;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                        <svg style="width: 22px; height: 22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                    </a>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0;">
                            Edit Slip Gaji
                        </h2>
                        <p style="font-size: 0.875rem; color: rgba(255,255,255,0.85); margin-top: 0.25rem;">{{ $payroll->employee->name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Informasi Pembayaran</h4>
            </div>
            <div style="padding: 1.25rem 1.5rem; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div>
                    <span style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Pegawai</span>
                    <p style="font-size: 0.875rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">{{ $payroll->employee->name }}</p>
                </div>
                <div>
                    <span style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Periode</span>
                    <p style="font-size: 0.875rem; font-weight: 600; color: #1e293b; margin: 0.25rem 0 0;">Bulan {{ $payroll->month }} — {{ $payroll->academicYear->name }}</p>
                </div>
                <div>
                    <span style="font-size: 0.7rem; font-weight: 600; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.05em;">Status</span>
                    <p style="margin: 0.25rem 0 0;">
                        @if($payroll->status === 'paid')
                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #ecfdf5; color: #10b981;">Dibayar</span>
                        @else
                            <span style="display: inline-flex; align-items: center; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600; background: #fef3c7; color: #d97706;">Draft</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Edit Nominal -->
        <form action="{{ route('hr.payroll.update', $payroll->id) }}" method="POST" id="payrollForm">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <!-- Kolom Pendapatan -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 18px; height: 18px; color: #10b981;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #10b981; margin: 0;">Komponen Pendapatan</h4>
                    </div>
                    <div style="padding: 1.25rem 1.5rem;">
                        @php $earningComponents = $components->where('type', 'earning'); @endphp

                        @if($earningComponents->isEmpty())
                            <p style="font-size: 0.8125rem; color: #94a3b8; font-style: italic;">Tidak ada master komponen pendapatan.</p>
                        @endif

                        @foreach($earningComponents as $comp)
                            @php
                                $existingDetail = $payroll->details->where('component_name', $comp->name)->first();
                                $nominal = $existingDetail ? $existingDetail->nominal : 0;
                            @endphp
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">{{ $comp->name }}</label>
                                <div class="fi-money-wrap" style="position: relative; display: flex; align-items: center; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; overflow: hidden; background: #fff; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'">
                                    <span style="padding: 0.625rem 0.75rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #f8fafc; border-right: 1px solid #e2e8f0; flex-shrink: 0;">Rp</span>
                                    <input type="hidden" name="components[{{ $comp->id }}]" value="{{ $nominal }}">
                                    <input type="text" class="salary-nominal" data-type="earning" value="{{ number_format($nominal, 0, ',', '.') }}" style="width: 100%; padding: 0.625rem 0.75rem; font-size: 0.875rem; font-weight: 600; color: #334155; border: none; outline: none; background: transparent;" onfocus="this.parentElement.style.borderColor='#3b82f6'; this.parentElement.style.boxShadow='0 0 0 3px rgba(59,130,246,0.08)'" onblur="this.parentElement.style.borderColor='#e2e8f0'; this.parentElement.style.boxShadow='none'">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Kolom Potongan -->
                <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                    <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                        <svg style="width: 18px; height: 18px; color: #ef4444;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #ef4444; margin: 0;">Potongan</h4>
                    </div>
                    <div style="padding: 1.25rem 1.5rem;">
                        @php $deductionComponents = $components->where('type', 'deduction'); @endphp

                        @if($deductionComponents->isEmpty())
                            <p style="font-size: 0.8125rem; color: #94a3b8; font-style: italic;">Tidak ada master potongan tercatat.</p>
                        @endif

                        @foreach($deductionComponents as $comp)
                            @php
                                $existingDetail = $payroll->details->where('component_name', $comp->name)->first();
                                $nominal = $existingDetail ? $existingDetail->nominal : 0;
                            @endphp
                            <div style="margin-bottom: 1.25rem;">
                                <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem;">{{ $comp->name }}</label>
                                <div class="fi-money-wrap" style="position: relative; display: flex; align-items: center; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; overflow: hidden; background: #fff; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'">
                                    <span style="padding: 0.625rem 0.75rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; background: #f8fafc; border-right: 1px solid #e2e8f0; flex-shrink: 0;">Rp</span>
                                    <input type="hidden" name="components[{{ $comp->id }}]" value="{{ $nominal }}">
                                    <input type="text" class="salary-nominal" data-type="deduction" value="{{ number_format($nominal, 0, ',', '.') }}" style="width: 100%; padding: 0.625rem 0.75rem; font-size: 0.875rem; font-weight: 600; color: #334155; border: none; outline: none; background: transparent;" onfocus="this.parentElement.style.borderColor='#3b82f6'; this.parentElement.style.boxShadow='0 0 0 3px rgba(59,130,246,0.08)'" onblur="this.parentElement.style.borderColor='#e2e8f0'; this.parentElement.style.boxShadow='none'">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Panel Ringkasan Kalkulasi -->
            <div style="margin-top: 1.5rem; background: linear-gradient(135deg, #eff6ff 0%, #eef2ff 100%); border-radius: 1rem; border: 1.5px solid #bfdbfe; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #bfdbfe; display: flex; align-items: center; gap: 0.5rem;">
                    <svg style="width: 18px; height: 18px; color: #3b82f6;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                    <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e40af; margin: 0; text-transform: uppercase; letter-spacing: 0.05em;">Ringkasan Gaji</h4>
                </div>
                <div style="padding: 1.25rem 1.5rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span style="font-size: 0.875rem; font-weight: 500; color: #10b981;">Total Pendapatan</span>
                        <span style="font-size: 0.9375rem; font-weight: 700; color: #10b981;" id="totalEarning">Rp 0</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.75rem;">
                        <span style="font-size: 0.875rem; font-weight: 500; color: #ef4444;">Total Potongan</span>
                        <span style="font-size: 0.9375rem; font-weight: 700; color: #ef4444;" id="totalDeduction">Rp 0</span>
                    </div>
                    <div style="border-top: 2px solid #93c5fd; padding-top: 0.75rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1rem; font-weight: 800; color: #1e40af;">Gaji Bersih (THP)</span>
                        <span style="font-size: 1.25rem; font-weight: 800; color: #1e40af;" id="netSalary">Rp 0</span>
                    </div>
                </div>
            </div>

            <!-- Catatan Tambahan -->
            <div style="margin-top: 1.5rem; background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                    <label style="font-size: 0.75rem; font-weight: 600; color: #475569;">Catatan / Deskripsi Transaksi (Opsional)</label>
                </div>
                <div style="padding: 1.25rem 1.5rem;">
                    <textarea name="description" rows="3" style="width: 100%; padding: 0.75rem 1rem; font-size: 0.8125rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; outline: none; resize: vertical; transition: border-color 0.2s;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e2e8f0'">{{ old('description', $payroll->description) }}</textarea>
                </div>
            </div>

            <!-- Action Buttons -->
            <div style="margin-top: 1.5rem; display: flex; justify-content: flex-end; gap: 0.75rem;">
                <a href="{{ route('hr.payroll.index') }}" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 1.5rem; font-size: 0.8125rem; font-weight: 600; color: #475569; background: #fff; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; cursor: pointer; transition: all 0.2s ease;" onmouseover="this.style.background='#f8fafc'; this.style.borderColor='#cbd5e1'" onmouseout="this.style.background='#fff'; this.style.borderColor='#e2e8f0'">
                    Batal
                </a>
                <button type="submit" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 2rem; font-size: 0.8125rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #0ea5e9, #3b82f6); border: none; border-radius: 0.625rem; cursor: pointer; transition: all 0.2s ease; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.2);" onmouseover="this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 12px -2px rgba(59,130,246,0.3)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(59,130,246,0.2)'">
                    <svg style="width: 16px; height: 16px; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    Simpan Perubahan Gaji
                </button>
            </div>
        </form>
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
                
                var netEl = document.getElementById('netSalary');
                netEl.textContent = formatCurrency(Math.abs(netSalary));
                if (netSalary < 0) {
                    netEl.style.color = '#ef4444';
                    netEl.textContent = '- ' + netEl.textContent;
                } else {
                    netEl.style.color = '#1e40af';
                }
            }

            document.querySelectorAll('.salary-nominal').forEach(function(el) {
                var hiddenInput = el.closest('.fi-money-wrap').querySelector('input[type="hidden"]');
                el.addEventListener('input', function() {
                    var raw = el.value.replace(/\D/g, '');
                    el.value = formatRibuan(raw);
                    if (hiddenInput) hiddenInput.value = raw;
                    recalculate();
                });
            });

            recalculate();
        });
    </script>
</x-app-layout>
