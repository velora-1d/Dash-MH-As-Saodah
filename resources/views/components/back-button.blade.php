@props(['href', 'label' => 'Kembali'])

<a href="{{ $href }}" style="display: inline-flex; align-items: center; gap: 0.375rem; padding: 0.5rem 0.875rem; font-size: 0.75rem; font-weight: 600; color: rgba(255,255,255,0.9); background: rgba(255,255,255,0.15); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2); border-radius: 0.5rem; text-decoration: none; transition: all 0.15s ease;" onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.15)'">
    <svg style="width: 14px; height: 14px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
    {{ $label }}
</a>
