<x-app-layout>
    <div class="space-y-6">
        <!-- Header Section -->
        <div style="background: linear-gradient(135deg, #0ea5e9 0%, #3b82f6 50%, #6366f1 100%); border-radius: 1rem; overflow: hidden; position: relative;">
            <div style="position: absolute; inset: 0; background: url('data:image/svg+xml,%3Csvg width=\'100\' height=\'100\' viewBox=\'0 0 100 100\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z\' fill=\'rgba(255,255,255,0.05)\' fill-rule=\'evenodd\'/%3E%3C/svg%3E'); opacity: 0.5;"></div>
            
            <div style="padding: 2.5rem; position: relative; z-index: 10;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div style="display: flex; align-items: center; gap: 1.5rem;">
                        <div style="width: 4rem; height: 4rem; background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); border-radius: 1rem; display: flex; align-items: center; justify-content: center; border: 1px solid rgba(255,255,255,0.3); box-shadow: 0 8px 32px rgba(0,0,0,0.1);">
                            <svg style="width: 2rem; height: 2rem; color: #ffffff;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div>
                            <h2 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.875rem; color: #ffffff; letter-spacing: -0.025em; margin: 0; line-height: 1.2;">Inventaris MII As-Saodah</h2>
                            <p style="color: #e0e7ff; margin: 0.25rem 0 0 0; font-size: 0.95rem; font-weight: 500;">Pencatatan & Pengelolaan Aset Barang Madrasah</p>
                        </div>
                    </div>
                    <div style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); padding: 1rem 1.5rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.2); text-align: right;">
                        <span style="display: block; color: #e0e7ff; font-size: 0.8125rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.25rem;">Total Nilai Aset</span>
                        <div style="display: flex; align-items: baseline; gap: 0.25rem; justify-content: flex-end;">
                            <span style="font-family: 'Outfit', sans-serif; font-weight: 800; font-size: 1.5rem; color: #ffffff;">Rp {{ number_format($inventories->sum(fn($q) => $q->quantity * $q->unit_price), 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        
                            </td>
                            <td style="padding: 1.25rem 1.5rem;">
                                <span style="background: #f1f5f9; color: #475569; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                    {{ $item->category }}
                                </span>
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: center; font-weight: 700; font-size: 1rem; color: #334155;">
                                {{ $item->quantity }}
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: center;">
                                @if($item->condition == 'Baik')
                                    <span style="background: rgba(34, 197, 94, 0.1); color: #166534; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center;">
                                        Pristine / Baik
                                    </span>
                                @elseif($item->condition == 'Rusak Ringan')
                                    <span style="background: rgba(245, 158, 11, 0.1); color: #b45309; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center;">
                                        Rusak Ringan
                                    </span>
                                @else
                                    <span style="background: rgba(239, 68, 68, 0.1); color: #991b1b; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-flex; align-items: center; justify-content: center;">
                                        Rusak Berat
                                    </span>
                                @endif
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: right; font-variant-numeric: tabular-nums;">
                                <div style="font-weight: 700; color: #1e293b;">@if($item->unit_price) Rp {{ number_format($item->quantity * $item->unit_price, 0, ',', '.') }} @else <span style="color:#cbd5e1">-</span> @endif</div>
                                @if($item->unit_price)
                                <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.25rem;">(Rp {{ number_format($item->unit_price, 0, ',', '.') }} / item)</div>
                                @endif
                            </td>
                            <td style="padding: 1.25rem 1.5rem; text-align: right;">
                                <div style="display: flex; gap: 0.5rem; justify-content: flex-end;">
                                    <a href="{{ route('inventory.edit', $item) }}" style="padding: 0.375rem 0.75rem; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 0.5rem; color: #3b82f6; font-size: 0.75rem; font-weight: 600; text-decoration: none; transition: all 0.2s;" onmouseover="this.style.background='#eff6ff'; this.style.borderColor='#bfdbfe';" onmouseout="this.style.background='#f8fafc'; this.style.borderColor='#e2e8f0';">Edit</a>
                                    
                                    <form action="{{ route('inventory.destroy', $item) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus / menulis-hapus (write-off) barang ini? Data akan ditarik dari sirkulasi (Soft Delete) namun terekam di Log.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 0.375rem 0.75rem; background: #fff1f2; border: 1px solid #fecdd3; border-radius: 0.5rem; color: #e11d48; font-size: 0.75rem; font-weight: 600; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.background='#ffe4e6'; this.style.borderColor='#fda4af';" onmouseout="this.style.background='#fff1f2'; this.style.borderColor='#fecdd3';">Write-off</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="padding: 4rem 1.5rem; text-align: center;">
                                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <div style="width: 4rem; height: 4rem; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                        <svg style="width: 2rem; height: 2rem; color: #94a3b8;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <h3 style="font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.125rem; color: #1e293b; margin: 0 0 0.25rem 0;">Aset Inventaris Kosong</h3>
                                    <p style="color: #64748b; font-size: 0.875rem; margin: 0; max-width: 300px;">Belum ada data barang atau aset yang teregistrasi. Silakan tambahkan aset baru.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($inventories->hasPages())
            <div style="padding: 1rem 1.5rem; background: #f8fafc; border-top: 1px solid #f1f5f9;">
                {{ $inventories->links() }}
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
