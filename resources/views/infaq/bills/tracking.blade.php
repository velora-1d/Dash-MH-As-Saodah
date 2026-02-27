<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 50%, #b45309 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; right: -20px; top: -20px; width: 200px; height: 200px; background: rgba(255,255,255,0.08); border-radius: 50%;"></div>
            <div style="padding: 2rem; position: relative; z-index: 10;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <a href="{{ route('infaq.bills.index') }}" style="display: flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border-radius: 0.75rem; color: #fff; transition: all 0.2s ease;" onmouseover="this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.background='rgba(255,255,255,0.2)'">
                            <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </a>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem; color: #fff; margin: 0;">
                                Tracking SPP Siswa
                            </h2>
                            <p style="font-size: 0.875rem; color: rgba(255,255,255,0.8); margin-top: 0.25rem;">Tahun Ajaran: {{ $activeAcademicYear->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Info Card -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem; display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
            <div style="width: 64px; height: 64px; background: linear-gradient(135deg, #fef3c7, #fde68a); border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 1.5rem; color: #b45309;">
                {{ strtoupper(substr($student->name, 0, 1)) }}
            </div>
            <div>
                <h3 style="font-size: 1.25rem; font-weight: 700; color: #1e293b; margin: 0;">{{ $student->name }}</h3>
                <div style="display: flex; gap: 1rem; margin-top: 0.5rem;">
                    <span style="font-size: 0.8125rem; color: #64748b; display: flex; align-items: center; gap: 0.375rem;">
                        <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" /></svg>
                        NISN: {{ $student->nisn ?? '-' }}
                    </span>
                    <span style="font-size: 0.8125rem; color: #64748b; display: flex; align-items: center; gap: 0.375rem;">
                        <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                        Kelas: {{ $student->classroom->name ?? '-' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- 12 Months Grid -->
        <div style="background: #fff; border-radius: 1rem; border: 1px solid #e2e8f0; padding: 1.5rem;">
            <h4 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                <div style="width: 8px; height: 8px; background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%;"></div>
                Status Pembayaran 12 Bulan (Juli - Juni)
            </h4>

            @php 
                $monthsOrder = [7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6]; 
                $monthNames = [1=>'Jan', 2=>'Feb', 3=>'Mar', 4=>'Apr', 5=>'Mei', 6=>'Jun', 7=>'Jul', 8=>'Agu', 9=>'Sep', 10=>'Okt', 11=>'Nov', 12=>'Des'];
            @endphp

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                @foreach($monthsOrder as $monthNum)
                    @php 
                        $bill = $trackedBills[$monthNum] ?? null; 
                        $borderColor = $bill ? ($bill->status == 'lunas' ? '#a7f3d0' : ($bill->status == 'void' ? '#e2e8f0' : '#fecdd3')) : '#e2e8f0';
                        $bgColor = $bill ? ($bill->status == 'lunas' ? '#f0fdf4' : ($bill->status == 'void' ? '#f8fafc' : '#fff1f2')) : '#f8fafc';
                        $textColor = $bill ? ($bill->status == 'lunas' ? '#065f46' : ($bill->status == 'void' ? '#64748b' : '#9f1239')) : '#64748b';
                        $cardStyle = "border: 1px solid {$borderColor}; border-radius: 0.75rem; padding: 1.25rem; position: relative; overflow: hidden; background: {$bgColor};";
                        $headingStyle = "font-weight: 700; font-size: 1rem; color: {$textColor}; margin: 0;";
                    @endphp
                    
                    <div style="{!! $cardStyle !!}">
                        
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                            <div>
                                <h5 style="{!! $headingStyle !!}">{{ $monthNames[$monthNum] }}</h5>
                                <p style="font-size: 0.6875rem; color: #64748b; margin-top: 0.125rem;">
                                    {{ $bill ? 'Rp ' . number_format($bill->nominal, 0, ',', '.') : 'Belum Generate' }}
                                </p>
                            </div>
                            
                            @if($bill)
                                @if($bill->status == 'lunas')
                                    <div style="width: 28px; height: 28px; background: #d1fae5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #047857;">
                                        <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </div>
                                @elseif($bill->status == 'void')
                                    <div style="width: 28px; height: 28px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #64748b;">
                                        <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg>
                                    </div>
                                @else
                                    <div style="width: 28px; height: 28px; background: #ffe4e6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #be123c;">
                                        <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                @endif
                            @else
                                <div style="width: 28px; height: 28px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #94a3b8;">
                                    <svg style="width: 16px; height: 16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                </div>
                            @endif
                        </div>

                        <div style="margin-top: 1rem;">
                            @if($bill && $bill->status == 'belum_lunas')
                                <a href="{{ route('infaq.payments.create', $bill->id) }}" style="display: block; text-align: center; width: 100%; padding: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #fff; background: #e11d48; border-radius: 0.5rem; text-decoration: none; transition: background 0.15s ease;" onmouseover="this.style.background='#be123c'" onmouseout="this.style.background='#e11d48'">
                                    Bayar Sekarang
                                </a>
                            @elseif($bill && $bill->status == 'lunas')
                                <span style="display: block; text-align: center; width: 100%; padding: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #047857; background: #d1fae5; border-radius: 0.5rem;">
                                    Sudah Lunas
                                </span>
                            @elseif($bill && $bill->status == 'void')
                                <span style="display: block; text-align: center; width: 100%; padding: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #475569; background: #e2e8f0; border-radius: 0.5rem;">
                                    VOID
                                </span>
                            @else
                                <span style="display: block; text-align: center; width: 100%; padding: 0.5rem; font-size: 0.75rem; font-weight: 600; color: #94a3b8; background: #f1f5f9; border-radius: 0.5rem;">
                                    Belum Ada Tagihan
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
