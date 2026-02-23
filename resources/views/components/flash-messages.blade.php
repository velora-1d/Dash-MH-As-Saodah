@if(session('success') || session('error') || session('warning') || session('info') || $errors->any())
<div id="flash-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 pointer-events-none" style="max-width: 400px; width: calc(100vw - 40px);">
    
    {{-- Success Message --}}
    @if(session('success'))
    <div class="flash-item bg-white/80 backdrop-blur-md border border-emerald-100 rounded-2xl shadow-xl shadow-emerald-500/10 p-4 pointer-events-auto flex items-start gap-3 animate-slide-in" role="alert">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-500/10 flex items-center justify-center text-emerald-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-slate-900 leading-tight">Berhasil!</h4>
            <p class="text-xs text-slate-600 mt-0.5">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Error Messages (Validation or Session) --}}
    @if(session('error') || $errors->any())
    <div class="flash-item bg-white/80 backdrop-blur-md border border-rose-100 rounded-2xl shadow-xl shadow-rose-500/10 p-4 pointer-events-auto flex items-start gap-3 animate-slide-in" role="alert">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-rose-500/10 flex items-center justify-center text-rose-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="flex-1 overflow-hidden">
            <h4 class="text-sm font-bold text-slate-900 leading-tight">Opps, Ada Kendala!</h4>
            <div class="text-xs text-slate-600 mt-0.5">
                @if(session('error'))
                    {{ session('error') }}
                @elseif($errors->any())
                    <ul class="list-disc list-inside space-y-0.5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Warning Message --}}
    @if(session('warning'))
    <div class="flash-item bg-white/80 backdrop-blur-md border border-amber-100 rounded-2xl shadow-xl shadow-amber-500/10 p-4 pointer-events-auto flex items-start gap-3 animate-slide-in" role="alert">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-500/10 flex items-center justify-center text-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-slate-900 leading-tight">Peringatan</h4>
            <p class="text-xs text-slate-600 mt-0.5">{{ session('warning') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    {{-- Info Message --}}
    @if(session('info'))
    <div class="flash-item bg-white/80 backdrop-blur-md border border-indigo-100 rounded-2xl shadow-xl shadow-indigo-500/10 p-4 pointer-events-auto flex items-start gap-3 animate-slide-in" role="alert">
        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-indigo-500/10 flex items-center justify-center text-indigo-600">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-slate-900 leading-tight">Informasi</h4>
            <p class="text-xs text-slate-600 mt-0.5">{{ session('info') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-slate-400 hover:text-slate-600 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif
</div>

<style>
    @keyframes slide-in {
        from { transform: translateX(100%) scale(0.9); opacity: 0; }
        to { transform: translateX(0) scale(1); opacity: 1; }
    }
    @keyframes slide-out {
        from { transform: translateX(0) scale(1); opacity: 1; }
        to { transform: translateX(100%) scale(0.9); opacity: 0; }
    }
    .animate-slide-in {
        animation: slide-in 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }
    .animate-slide-out {
        animation: slide-out 0.3s ease-in forwards;
    }
    .flash-item {
        transition: all 0.3s ease;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.flash-item');
        items.forEach((item, index) => {
            // Auto remove after 5s + index offset
            setTimeout(() => {
                item.classList.add('animate-slide-out');
                setTimeout(() => { item.remove(); }, 300);
            }, 5000 + (index * 500));
        });
    });
</script>
@endif
