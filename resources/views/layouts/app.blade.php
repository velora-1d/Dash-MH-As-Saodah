<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

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
            /* Form styling global */
            select, input[type="text"], input[type="email"], input[type="password"],
            input[type="number"], input[type="tel"], input[type="date"], textarea {
                transition: all 0.2s ease;
            }
            select:focus, input:focus, textarea:focus {
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15);
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
