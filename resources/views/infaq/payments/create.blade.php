<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Pembayaran Infaq / SPP</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Catat pembayaran untuk tagihan {{ $bill->student->name }}.</p>
                    </div>
                </div>
                <x-back-button href="{{ route('infaq.bills.index') }}" label="Kembali ke Daftar" />
                </div>
            </div>
        </div>

        <!-- Detail Tagihan -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #059669, #10b981); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Detail Tagihan</h4>
            </div>
            <div style="padding: 1.5rem; display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
                <div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em;">Nama Siswa</p>
                    <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin-top: 0.25rem;">{{ $bill->student->name }}</p>
                </div>
                <div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em;">Kelas</p>
                    <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin-top: 0.25rem;">{{ $bill->student->classroom ? $bill->student->classroom->name : '-' }}</p>
                </div>
                <div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em;">Periode</p>
                    <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin-top: 0.25rem;">{{ $months[$bill->month] ?? '-' }} · {{ $bill->academicYear->name ?? '-' }}</p>
                </div>
                <div>
                    <p style="font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em;">Sisa Tagihan</p>
                    @if ($remaining > 0)
                        <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.25rem; color: #e11d48; margin-top: 0.25rem;">Rp {{ number_format($remaining, 0, ',', '.') }}</p>
                    @else
                        <p style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.25rem; color: #059669; margin-top: 0.25rem;">Rp {{ number_format($remaining, 0, ',', '.') }}</p>
                    @endif
                </div>
            </div>
        </div>

        @if ($remaining <= 0)
            <div style="background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 1rem; padding: 3rem; text-align: center;">
                <svg style="width: 48px; height: 48px; margin: 0 auto 1rem; color: #059669;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <p style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #065f46; margin: 0;">Tagihan Sudah LUNAS</p>
                <a href="{{ route('infaq.bills.index') }}" style="display: inline-flex; align-items: center; margin-top: 1rem; padding: 0.625rem 1.25rem; background: linear-gradient(135deg, #059669, #047857); color: #fff; border-radius: 0.625rem; font-size: 0.75rem; font-weight: 600; text-decoration: none;">← Kembali</a>
            </div>
        @else
            <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                <form action="{{ route('infaq.payments.store', $bill->id) }}" method="POST">
                    @csrf
                    <div style="padding: 2rem;">
                        <!-- Metode Pembayaran -->
                        <div style="margin-bottom: 2rem;">
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.75rem;">Metode Pembayaran <span style="color: #e11d48;">*</span></label>
                            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;" id="payment-methods">
                                <div class="pay-opt selected" data-value="tunai" onclick="selectPay(this)" style="border: 2px solid #6366f1; background: #eef2ff; border-radius: 0.75rem; padding: 1.25rem; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                                    <svg style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #059669;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                    <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Tunai</p>
                                    <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">Bayar langsung</p>
                                </div>
                                <div class="pay-opt" data-value="transfer" onclick="selectPay(this)" style="border: 2px solid #e2e8f0; background: #fff; border-radius: 0.75rem; padding: 1.25rem; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                                    <svg style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #6366f1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                    <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Transfer</p>
                                    <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">Via rekening</p>
                                </div>
                                <div class="pay-opt" data-value="tabungan" onclick="selectPay(this)" style="border: 2px solid #e2e8f0; background: #fff; border-radius: 0.75rem; padding: 1.25rem; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                                    <svg style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #d97706;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Potong Tabungan</p>
                                    <p style="font-size: 0.75rem; color: #d97706; font-weight: 600; margin-top: 0.25rem;">Saldo: Rp {{ number_format($savingsBalance, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <input type="hidden" name="payment_method" id="payment_method" value="tunai">
                            @error('payment_method')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                            <div>
                                <label for="amount" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Jumlah Bayar (Rp) <span style="color: #e11d48;">*</span></label>
                                <input type="number" name="amount" id="amount" value="{{ old('amount', $remaining) }}" min="1000" max="{{ $remaining }}" step="1000" required style="width: 100%; box-sizing: border-box;">
                                @error('amount')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="date" style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Tanggal <span style="color: #e11d48;">*</span></label>
                                <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required style="width: 100%; box-sizing: border-box;">
                                @error('date')<p style="color: #e11d48; font-size: 0.75rem; margin-top: 0.5rem;">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                        <a href="{{ route('infaq.bills.index') }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.75rem; font-weight: 600; color: #64748b; background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none;">Batal</a>
                        <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(5,150,105,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform=''">
                            <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            Konfirmasi Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        @endif
    </div>

    <style>
        .pay-opt:hover { border-color: #a5b4fc !important; background: #f5f3ff !important; }
        .pay-opt.selected { border-color: #6366f1 !important; background: #eef2ff !important; box-shadow: 0 0 0 3px rgba(99,102,241,0.12); }
    </style>
    <script>
        function selectPay(el) {
            document.querySelectorAll('.pay-opt').forEach(opt => {
                opt.classList.remove('selected');
                opt.style.borderColor = '#e2e8f0';
                opt.style.background = '#fff';
            });
            el.classList.add('selected');
            el.style.borderColor = '#6366f1';
            el.style.background = '#eef2ff';
            document.getElementById('payment_method').value = el.dataset.value;
        }
    </script>
</x-app-layout>
