<x-app-layout>
    <style>
        .payroll-input {
            width: 100%; padding: 0.5rem 0.75rem 0.5rem 2.25rem; font-size: 0.8125rem; 
            font-weight: 500; color: #334155; border: 1px solid #e2e8f0; 
            border-radius: 0.5rem; outline: none; transition: all 0.2s;
        }
        .payroll-input:focus {
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 2px rgba(59,130,246,0.1) !important;
        }
    </style>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: flex-start; gap: 1rem;">
                        <a href="{{ route('hr.payroll.index') }}" style="width: 44px; height: 44px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; display: flex; align-items: center; justify-content: center; border: 1.5px solid rgba(255,255,255,0.3); color: #fff; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.35)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 22px; height: 22px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                        </a>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                                Pengaturan Gaji Staf
                            </h2>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">Kelola nominal tunjangan dan potongan yang baku untuk setiap pegawai.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div style="padding: 1rem 1.25rem; background: #ecfdf5; border-left: 4px solid #10b981; border-radius: 0.5rem; display: flex; align-items: center; gap: 0.75rem;">
            <div style="width: 24px; height: 24px; background: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
            </div>
            <p style="color: #065f46; font-size: 0.875rem; font-weight: 500; margin: 0;">{{ session('success') }}</p>
        </div>
        @endif

        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; overflow: hidden; width: 100%;">
            <div style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <!-- Search -->
                <div>
                    <form action="{{ route('hr.payroll.employee_salaries') }}" method="GET" style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Nama Pegawai..." style="padding: 0.5rem 1rem; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; outline: none; width: 250px; transition: border-color 0.15s ease;" onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#e2e8f0'">
                        <button type="submit" style="padding: 0.5rem 1.25rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.625rem; font-size: 0.8125rem; font-weight: 600; color: #475569; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">Cari</button>
                    </form>
                </div>
            </div>

            <div style="padding: 1.5rem;">
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @forelse($employees as $employee)
                    <div style="border: 1px solid #e2e8f0; border-radius: 0.75rem; overflow: hidden;">
                        <div style="padding: 1rem 1.25rem; background: #f8fafc; border-bottom: 1px solid #e2e8f0; display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h5 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1rem; color: #1e293b; margin: 0;">{{ $employee->name }}</h5>
                                <p style="font-size: 0.75rem; color: #64748b; margin-top: 0.125rem;">{{ ucfirst($employee->type) }} - {{ $employee->position }}</p>
                            </div>
                        </div>
                        
                        <form action="{{ route('hr.payroll.employee_salaries.update', $employee->id) }}" method="POST" style="padding: 1.25rem;">
                            @csrf
                            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 1.25rem;">
                                @foreach($components as $comp)
                                    @php
                                        // Cari nilai tersimpan untuk komponen ini pada pegawai ini
                                        $empSalNominal = $employee->salaryComponents->where('salary_component_id', $comp->id)->first()->nominal ?? 0;
                                    @endphp
                                    <div style="display: flex; flex-direction: column; gap: 0.375rem;">
                                        <label style="font-size: 0.75rem; font-weight: 600; color: #475569; display: flex; justify-content: space-between;">
                                            {{ $comp->name }}
                                            @if($comp->type === 'earning')
                                            <span style="font-size: 0.65rem; padding: 0.125rem 0.375rem; border-radius: 0.25rem; background: #ecfdf5; color: #10b981;">
                                                +
                                            </span>
                                            @else
                                            <span style="font-size: 0.65rem; padding: 0.125rem 0.375rem; border-radius: 0.25rem; background: #fef2f2; color: #ef4444;">
                                                -
                                            </span>
                                            @endif
                                        </label>
                                        <div style="position: relative;">
                                            <span style="position: absolute; left: 0.75rem; top: 50%; transform: translateY(-50%); font-size: 0.8125rem; color: #94a3b8; font-weight: 500;">Rp</span>
                                            <input type="number" name="components[{{ $comp->id }}]" value="{{ floatval($empSalNominal) }}" min="0" step="1" class="payroll-input">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            
                            <div style="margin-top: 1.25rem; display: flex; justify-content: flex-end;">
                                <button type="submit" style="display: inline-flex; align-items: center; padding: 0.5rem 1rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: #3b82f6; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.15s ease;" onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">
                                    Perbarui Data Rekap
                                </button>
                            </div>
                        </form>
                    </div>
                    @empty
                    <div style="text-align: center; padding: 3rem 0;">
                        <div style="display: inline-flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: 50%; background: #f1f5f9; margin-bottom: 1rem;">
                            <svg style="width: 24px; height: 24px; color: #cbd5e1;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                        </div>
                        <p style="font-size: 0.875rem; color: #64748b; margin: 0;">Tidak ada pegawai aktif ditemukan.</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Pagination -->
            @if($employees->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid #f1f5f9;">
                {{ $employees->links() }}
            </div>
            @endif

        </div>
    </div>
</x-app-layout>
