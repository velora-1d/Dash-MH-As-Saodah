<x-app-layout>
    <div class="space-y-6">
        <!-- Hero Header -->
        <div style="background: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="position: absolute; left: 30%; bottom: -30px; width: 120px; height: 120px; background: rgba(255,255,255,0.05); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 0.75rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Transaksi Tabungan — {{ $student->name }}</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Saldo saat ini: <strong style="color: #fff;">Rp {{ number_format($balance, 0, ',', '.') }}</strong></p>
                    </div>
                </div>
                <x-back-button href="{{ route('tabungan.show', $student->id) }}" label="Kembali ke Detail" />
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <form action="{{ route('tabungan.store', $student->id) }}" method="POST">
                @csrf
                <div style="padding: 2rem;">
                    {{-- Jenis Transaksi --}}
                    <x-form-group label="Jenis Transaksi" name="type" :required="true">
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;" id="type-selector">
                            <div class="type-option selected" data-value="in" onclick="selectType(this)" style="border: 2px solid #6366f1; background: #eef2ff; border-radius: 0.75rem; padding: 1.25rem; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                                <svg style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #059669;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" /></svg>
                                <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Setoran</p>
                                <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">Tambah saldo</p>
                            </div>
                            <div class="type-option" data-value="out" onclick="selectType(this)" style="border: 2px solid #e2e8f0; background: #fff; border-radius: 0.75rem; padding: 1.25rem; text-align: center; cursor: pointer; transition: all 0.2s ease;">
                                <svg style="width: 2rem; height: 2rem; margin: 0 auto 0.5rem; color: #e11d48;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6" /></svg>
                                <p style="font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Penarikan</p>
                                <p style="font-size: 0.75rem; color: #94a3b8; margin-top: 0.25rem;">Kurangi saldo</p>
                            </div>
                        </div>
                        <input type="hidden" name="type" id="type_input" value="{{ old('type', 'in') }}">
                    </x-form-group>

                    {{-- Divider --}}
                    <div class="fi-section">
                        <div class="fi-section-title"><span class="fi-section-dot"></span> Detail Transaksi</div>
                    </div>

                    {{-- Fields --}}
                    <div class="fi-grid fi-grid-2" style="margin-top: 1rem;">
                        <x-form-group label="Nominal" name="amount" :required="true">
                            <x-money-input name="amount" :value="old('amount')" placeholder="50.000" />
                        </x-form-group>

                        <x-form-group label="Tanggal" name="date" :required="true">
                            <input type="date" name="date" id="date" value="{{ old('date', date('Y-m-d')) }}" required
                                class="fi-input @error('date') fi-error @enderror">
                        </x-form-group>

                        <x-form-group label="Keterangan" name="description" hint="Opsional" class="fi-grid-full">
                            <textarea name="description" id="description" rows="3" maxlength="500"
                                placeholder="Contoh: Setoran rutin minggu ke-2"
                                class="fi-input fi-textarea @error('description') fi-error @enderror">{{ old('description') }}</textarea>
                        </x-form-group>
                    </div>
                </div>

                <div style="padding: 1.25rem 2rem; border-top: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: flex-end; gap: 0.75rem; background: #fafbfc;">
                    <a href="{{ route('tabungan.show', $student->id) }}" style="display: inline-flex; align-items: center; padding: 0.625rem 1.25rem; font-size: 0.8125rem; font-weight: 600; color: #64748b; border: 1.5px solid #e2e8f0; border-radius: 0.625rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='transparent'">Batal</a>
                    <button type="submit" style="display: inline-flex; align-items: center; padding: 0.625rem 1.5rem; font-size: 0.8125rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #10b981, #059669); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(5,150,105,0.3); transition: all 0.15s ease;" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 4px 12px rgba(5,150,105,0.35)'" onmouseout="this.style.transform='';this.style.boxShadow='0 1px 3px rgba(5,150,105,0.3)'">
                        <svg style="width: 1rem; height: 1rem; margin-right: 0.375rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .type-option:hover { border-color: #a5b4fc !important; background: #f5f3ff !important; }
        .type-option.selected { border-color: #6366f1 !important; background: #eef2ff !important; box-shadow: 0 0 0 3px rgba(99,102,241,0.12); }
    </style>
    <script>
        function selectType(el) {
            document.querySelectorAll('.type-option').forEach(opt => {
                opt.classList.remove('selected');
                opt.style.borderColor = '#e2e8f0';
                opt.style.background = '#fff';
            });
            el.classList.add('selected');
            el.style.borderColor = '#6366f1';
            el.style.background = '#eef2ff';
            document.getElementById('type_input').value = el.dataset.value;
        }

        // Validasi overdraft sisi klien
        document.querySelector('form').addEventListener('submit', function(e) {
            var type = document.getElementById('type_input').value;
            var rawInput = document.querySelector('[data-money-raw][name="amount"]');
            var amount = rawInput ? parseFloat(rawInput.value) : 0;
            var balance = Number("{{ $balance }}") || 0;

            if (type === 'out' && amount > balance) {
                e.preventDefault();
                var formatted = balance.toLocaleString('id-ID');
                alert('Saldo tidak mencukupi! Saldo saat ini: Rp ' + formatted);
            }
        });
    </script>
</x-app-layout>
