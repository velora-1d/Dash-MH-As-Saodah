<x-app-layout>
    <div class="space-y-6">
        <div style="background: linear-gradient(135deg, #6366f1 0%, #818cf8 50%, #a5b4fc 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <div style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3);">
                        <svg style="width: 22px; height: 22px; color: #fff;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" /></svg>
                    </div>
                    <div>
                        <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.25rem; color: #fff; margin: 0;">Mutasi & Kenaikan Kelas</h2>
                        <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.7); margin-top: 0.125rem;">Pindahkan siswa antar kelas atau ubah status kelulusan secara kolektif.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 1: Pilih Kelas -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #6366f1, #818cf8); border-radius: 50%;"></div>
                <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Pilih Kelas Asal</h4>
            </div>
            <form action="{{ route('mutations.index') }}" method="GET" style="padding: 1.5rem; display: flex; align-items: end; gap: 1rem;">
                <div style="flex: 1;">
                    <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Kelas Sumber Data</label>
                    <select name="source_classroom_id" onchange="this.form.submit()" style="width: 100%; box-sizing: border-box;">
                        <option value="">-- Pilih Kelas --</option>
                        @foreach ($classrooms as $cls)
                            <option value="{{ $cls->id }}" {{ $sourceClassroomId == $cls->id ? 'selected' : '' }}>Tingkat {{ $cls->level }} : {{ $cls->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>

        @if ($sourceClassroomId)
            <form action="{{ route('mutations.execute') }}" method="POST">
                @csrf
                <input type="hidden" name="source_classroom_id" value="{{ $sourceClassroomId }}">
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 1.5rem;">
                    <!-- Left: Student List -->
                    <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden;">
                        <div style="padding: 1rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
                            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0;">Daftar Siswa</h4>
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; font-size: 0.75rem; font-weight: 600; color: #6366f1;">
                                <input type="checkbox" id="check-all" style="width: 1rem; height: 1rem; accent-color: #6366f1; cursor: pointer;">
                                Pilih Semua
                            </label>
                        </div>
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: collapse;">
                                <thead><tr style="background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);">
                                    <th style="padding: 0.75rem 1rem; width: 40px; border-bottom: 1.5px solid #e2e8f0; text-align: center;"></th>
                                    <th style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0; width: 50px;">No</th>
                                    <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">Nama Siswa</th>
                                    <th style="padding: 0.75rem 1.5rem; text-align: left; font-size: 0.6875rem; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; border-bottom: 1.5px solid #e2e8f0;">NISN / NIS</th>
                                </tr></thead>
                                <tbody>
                                    @forelse ($students as $index => $student)
                                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                                            <td style="padding: 0.75rem 1rem; text-align: center; vertical-align: middle;">
                                                <input type="checkbox" name="student_ids[]" value="{{ $student->id }}" class="student-checkbox" style="width: 1rem; height: 1rem; accent-color: #6366f1; cursor: pointer;">
                                            </td>
                                            <td style="padding: 0.75rem 1.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8; font-weight: 600; vertical-align: middle;">
                                                {{ $index + 1 }}
                                            </td>
                                            <td style="padding: 0.75rem 1.5rem; vertical-align: middle;">
                                                <p style="font-weight: 600; font-size: 0.8125rem; color: #1e293b; margin: 0;">{{ $student->name }}</p>
                                                <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.125rem; text-transform: capitalize;">{{ $student->category }}</p>
                                            </td>
                                            <td style="padding: 0.75rem 1.5rem; font-size: 0.8125rem; color: #64748b; vertical-align: middle;">{{ $student->nisn ?: '-' }} / {{ $student->nis ?: '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" style="padding: 2.5rem; text-align: center; font-size: 0.8125rem; color: #94a3b8;">Tidak ada siswa di kelas ini.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Right: Execution Panel -->
                    <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; position: sticky; top: 1.5rem; height: fit-content;">
                        <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 0.875rem; color: #1e293b; margin: 0 0 1.5rem;">Opsi Perpindahan</h4>
                        <div>
                            <label style="display: block; font-size: 0.8125rem; font-weight: 600; color: #374151; margin-bottom: 0.5rem;">Pindah ke</label>
                            <select name="target_classroom_id" id="target_classroom_id" required style="width: 100%; box-sizing: border-box;">
                                <option value="" disabled selected>-- Pilih Tujuan --</option>
                                <optgroup label="Kelas Lain">
                                    @foreach ($classrooms as $cls)
                                        @if ($cls->id != $sourceClassroomId)
                                            <option value="{{ $cls->id }}">Tingkat {{ $cls->level }} : {{ $cls->name }}</option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="Ubah Status">
                                    <option value="lulus">Lulus / Alumni</option>
                                    <option value="pindah">Pindah / Mutasi</option>
                                    <option value="nonaktif">Non-Aktif</option>
                                </optgroup>
                            </select>
                        </div>
                        <button type="submit" id="btn-submit" disabled style="width: 100%; margin-top: 1.5rem; display: inline-flex; justify-content: center; align-items: center; padding: 0.875rem 1.5rem; font-size: 0.75rem; font-weight: 700; color: #fff; background: linear-gradient(135deg, #6366f1, #4f46e5); border: none; border-radius: 0.625rem; cursor: pointer; box-shadow: 0 1px 3px rgba(79,70,229,0.3); transition: all 0.15s ease; text-transform: uppercase; letter-spacing: 0.05em; opacity: 0.5;" onmouseover="if(!this.disabled){this.style.transform='translateY(-1px)'}" onmouseout="this.style.transform=''">
                            Eksekusi Perpindahan
                        </button>
                        <p style="font-size: 0.6875rem; color: #94a3b8; margin-top: 0.75rem; text-align: center;">Pilih minimal 1 siswa dan 1 tujuan.</p>
                    </div>
                </div>
            </form>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAll = document.getElementById('check-all');
            const checkboxes = document.querySelectorAll('.student-checkbox');
            const btnSubmit = document.getElementById('btn-submit');
            const targetSelect = document.getElementById('target_classroom_id');

            function updateBtn() {
                const checked = document.querySelectorAll('.student-checkbox:checked').length;
                const hasTarget = targetSelect && targetSelect.value !== "";
                if(btnSubmit) {
                    btnSubmit.disabled = checked === 0 || !hasTarget;
                    btnSubmit.style.opacity = btnSubmit.disabled ? '0.5' : '1';
                }
            }
            if(checkAll) checkAll.addEventListener('change', function() { checkboxes.forEach(cb => cb.checked = this.checked); updateBtn(); });
            checkboxes.forEach(cb => cb.addEventListener('change', updateBtn));
            if(targetSelect) targetSelect.addEventListener('change', updateBtn);
        });
    </script>
    @endpush
</x-app-layout>
