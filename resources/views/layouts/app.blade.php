<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        {{-- 
            LAYOUT FIX: Sidebar fixed w-72 (18rem = 288px).
            Content area HARUS punya margin-left = lebar sidebar di desktop.
            Pakai inline <style> karena Tailwind class baru butuh npm run build.
        --}}
        <style>
            /* Layout: sidebar fixed offset */
            @media (min-width: 1024px) {
                .content-area {
                    margin-left: 18rem;
                    width: calc(100% - 18rem);
                }
            }
            /* Hide scrollbar tapi tetap bisa scroll */
            *::-webkit-scrollbar { display: none; }
            * { -ms-overflow-style: none; scrollbar-width: none; }
            /* Form styling global - Aesthetic Modernization */
            select, input[type="text"], input[type="email"], input[type="password"],
            input[type="number"], input[type="tel"], input[type="date"], textarea {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
                border-color: #e2e8f0 !important;
                box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.02) !important;
                border-radius: 0.75rem !important; /* xl */
                background-color: #f8fafc !important;
                padding: 0.75rem 1rem !important;
                font-size: 0.95rem !important;
            }
            select:hover, input:hover, textarea:hover {
                border-color: #cbd5e1 !important;
                background-color: #ffffff !important;
            }
            select:focus, input:focus, textarea:focus {
                background-color: #ffffff !important;
                border-color: #6366f1 !important;
                box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15), inset 0 2px 4px 0 rgba(0, 0, 0, 0.01) !important;
                transform: translateY(-1px);
                outline: none !important;
            }
            /* Label Styling Update */
            label {
                letter-spacing: 0.025em;
                color: #475569;
            }
        </style>
    </head>
    <body class="font-sans antialiased text-slate-900 bg-slate-50 h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
        
        {{-- Mobile Sidebar Backdrop --}}
        <div x-show="sidebarOpen" style="display: none;" class="fixed inset-0 z-40 bg-slate-900/50 backdrop-blur-sm lg:hidden" 
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"></div>

        {{-- Sidebar (FIXED, keluar dari document flow) --}}
        @include('layouts.sidebar')

        {{-- Content Area (HARUS punya margin-left = lebar sidebar di desktop) --}}
        <div class="content-area flex flex-col h-full">
            {{-- Header --}}
            @include('layouts.header')

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto focus:outline-none p-3 lg:p-5">
                @isset($header)
                    <div class="mb-6">
                        {{ $header }}
                    </div>
                @endisset

                {{ $slot }}
            </main>
        </div>
        
        {{-- SweetAlert2 JS --}}
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        {{-- Scripts Stack --}}
        @stack('scripts')
    </body>
</html>
