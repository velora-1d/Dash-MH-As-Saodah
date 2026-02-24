<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'" 
       class="fixed inset-y-0 left-0 z-50 w-72 h-full bg-indigo-950 shadow-2xl border-r border-indigo-900/10 flex flex-col transition-transform duration-300 ease-in-out flex-shrink-0 origin-left">
    <!-- Tombol Tutup Sidebar untuk Layar Mobile -->
    <div class="absolute top-4 right-4 lg:hidden">
        <button @click="sidebarOpen = false" class="p-2 text-indigo-300 hover:bg-indigo-900 rounded-lg hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @php $schoolSetting = \App\Models\SchoolSetting::first(); @endphp
    <div class="flex items-center flex-shrink-0 px-6 py-6 group border-b border-indigo-900/40">
        @if($schoolSetting && $schoolSetting->logo_path)
            <div class="p-1 bg-white rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/' . $schoolSetting->logo_path) }}" alt="Logo Sekolah" class="w-9 h-9 object-contain rounded-lg">
            </div>
        @else
            <div class="p-2 bg-amber-500 rounded-xl shadow-lg shadow-amber-500/20 group-hover:scale-105 transition-transform duration-300">
                <span class="w-8 h-8 flex items-center justify-center text-white font-bold text-lg">MI</span>
            </div>
        @endif
        <span class="ml-3 text-xl font-bold text-white tracking-tight">{{ $schoolSetting->name ?? 'MI As-Saodah' }}</span>
    </div>

    <!-- Navigation Area (Dinamis / Bisa di-Scroll) -->
    <div class="flex-1 overflow-y-auto scrollbar-thin scrollbar-thumb-indigo-800 py-6">
        <nav class="px-4 space-y-1.5" aria-label="Sidebar">
            @php
                $userRole = auth()->user()->role;
                $menus = \App\Models\Menu::where('is_active', true)
                            ->orderBy('order_index')
                            ->get()
                            ->filter(function($menu) use ($userRole) {
                                return is_array($menu->roles) && in_array($userRole, $menu->roles);
                            });
                
                $currentGroup = null;
            @endphp

            @foreach($menus as $menu)
                @if($menu->group_name && $menu->group_name !== $currentGroup)
                    <div class="pt-4 pb-2 px-4 {{ $currentGroup ? 'border-t border-indigo-900 mt-4' : '' }}">
                        <span class="text-[10px] font-bold text-indigo-400/70 uppercase tracking-widest">{{ $menu->group_name }}</span>
                    </div>
                    @php $currentGroup = $menu->group_name; @endphp
                @endif
                
                <a href="{{ Route::has($menu->route_name) ? route($menu->route_name) : '#' }}" 
                   class="{{ request()->routeIs($menu->route_name . '*') || request()->routeIs($menu->route_name) ? 'bg-indigo-900 border-amber-500 text-amber-400' : 'text-indigo-200 border-transparent hover:bg-indigo-900 hover:text-white' }} group flex items-center px-4 py-3 text-sm font-bold rounded-xl border-l-4 transition-all duration-200">
                    <svg class="mr-3 flex-shrink-0 h-5 w-5 transition-colors {{ request()->routeIs($menu->route_name . '*') || request()->routeIs($menu->route_name) ? 'text-amber-400' : 'text-indigo-400 group-hover:text-indigo-300' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        {!! $menu->icon_svg !!}
                    </svg>
                    {{ $menu->name }}
                </a>
            @endforeach
            </nav>
        </div>
        
        <!-- User Section Footer Sidebar -->
        <div class="flex-shrink-0 flex p-4 border-t border-indigo-800 bg-indigo-900/50">
            <div class="flex-shrink-0 w-full group block">
                <div class="flex items-center">
                    <div class="inline-block h-10 w-10 bg-amber-500 rounded-lg flex items-center justify-center text-indigo-950 font-bold border-2 border-amber-400">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-white truncate w-40">{{ Auth::user()->name }}</p>
                        <p class="text-xs font-bold text-amber-500 truncate w-40 uppercase tracking-widest">{{ Auth::user()->role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </aside>
