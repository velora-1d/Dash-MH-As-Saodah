<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts: Inter (Modern UI Standard) + Outfit (Headings) -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* =====================================================
               MODERN UI SYSTEM — NEXT.JS LEVEL
               ===================================================== */

            /* --- BASE TYPOGRAPHY --- */
            body, html {
                font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                text-rendering: optimizeLegibility;
                letter-spacing: -0.011em;
                background: #f8fafc !important;
            }
            h1, h2, h3, h4, h5, h6, .font-bold, .font-extrabold, .font-black {
                font-family: 'Outfit', 'Inter', sans-serif !important;
                letter-spacing: -0.025em;
            }

            /* --- LAYOUT --- */
            @media (min-width: 1024px) {
                .content-area {
                    margin-left: 18rem;
                    width: calc(100% - 18rem);
                }
            }
            
            /* Smooth scrollbar */
            *::-webkit-scrollbar { width: 6px; height: 6px; }
            *::-webkit-scrollbar-track { background: transparent; }
            *::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 999px; }
            *::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

            /* --- MODERN CARD CONTAINERS --- */
            .bg-white {
                border: 1px solid rgba(226, 232, 240, 0.8) !important;
                box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.04) !important;
                transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }
            .bg-white:hover {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.06), 0 2px 4px -2px rgba(0, 0, 0, 0.04) !important;
            }

            /* --- FORM INPUTS (Premium Feel) --- */
            select, input[type="text"], input[type="email"], input[type="password"],
            input[type="number"], input[type="tel"], input[type="date"], input[type="search"], textarea {
                font-family: 'Inter', sans-serif !important;
                font-size: 0.875rem !important;
                font-weight: 400 !important;
                border: 1.5px solid #e2e8f0 !important;
                border-radius: 0.625rem !important;
                background-color: #ffffff !important;
                padding: 0.625rem 0.875rem !important;
                color: #1e293b !important;
                transition: all 0.15s ease !important;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
                outline: none !important;
            }
            select:hover, input:hover, textarea:hover {
                border-color: #94a3b8 !important;
            }
            select:focus, input:focus, textarea:focus {
                border-color: #6366f1 !important;
                box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12), 0 1px 2px 0 rgba(0, 0, 0, 0.03) !important;
            }
            select {
                cursor: pointer;
            }
            ::placeholder {
                color: #94a3b8 !important;
                font-weight: 400 !important;
            }
            label {
                font-family: 'Inter', sans-serif !important;
                font-size: 0.8125rem !important;
                font-weight: 600 !important;
                color: #374151 !important;
                letter-spacing: 0 !important;
            }

            /* --- MODERN TABLE --- */
            table {
                border-collapse: separate !important;
                border-spacing: 0 !important;
                width: 100% !important;
            }
            thead {
                background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%) !important;
            }
            thead th {
                font-family: 'Inter', sans-serif !important;
                font-size: 0.6875rem !important;
                font-weight: 600 !important;
                color: #64748b !important;
                text-transform: uppercase !important;
                letter-spacing: 0.06em !important;
                padding: 0.875rem 1.25rem !important;
                border-bottom: 1.5px solid #e2e8f0 !important;
                white-space: nowrap !important;
            }
            tbody td {
                padding: 0.875rem 1.25rem !important;
                font-size: 0.8125rem !important;
                color: #475569 !important;
                border-bottom: 1px solid #f1f5f9 !important;
                vertical-align: middle !important;
            }
            tbody tr {
                transition: all 0.1s ease !important;
            }
            tbody tr:hover {
                background-color: #f8fafc !important;
            }
            tbody tr:last-child td {
                border-bottom: none !important;
            }

            /* --- MODERN BUTTONS --- */
            a[class*="bg-indigo-600"], button[class*="bg-indigo-600"],
            a[style*="background-color: #4f46e5"], button[style*="background-color: #4f46e5"] {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
                color: #ffffff !important;
                border: none !important;
                border-radius: 0.625rem !important;
                font-family: 'Inter', sans-serif !important;
                font-weight: 600 !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.025em !important;
                padding: 0.625rem 1.25rem !important;
                box-shadow: 0 1px 3px rgba(79, 70, 229, 0.3), 0 1px 2px rgba(0, 0, 0, 0.06) !important;
                transition: all 0.15s ease !important;
                text-transform: uppercase !important;
            }
            a[class*="bg-indigo-600"]:hover, button[class*="bg-indigo-600"]:hover,
            a[style*="background-color: #4f46e5"]:hover, button[style*="background-color: #4f46e5"]:hover {
                background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%) !important;
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.35), 0 2px 4px rgba(0, 0, 0, 0.06) !important;
                transform: translateY(-1px) !important;
            }
            a[class*="bg-indigo-600"]:active, button[class*="bg-indigo-600"]:active {
                transform: translateY(0) !important;
            }

            /* Green submit buttons */
            button[style*="background-color: #059669"], a[style*="background-color: #059669"],
            a[class*="bg-emerald-600"], button[class*="bg-emerald-600"] {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
                color: #ffffff !important;
                border: none !important;
                border-radius: 0.625rem !important;
                font-family: 'Inter', sans-serif !important;
                font-weight: 600 !important;
                font-size: 0.75rem !important;
                padding: 0.625rem 1.25rem !important;
                box-shadow: 0 1px 3px rgba(5, 150, 105, 0.3), 0 1px 2px rgba(0, 0, 0, 0.06) !important;
                transition: all 0.15s ease !important;
                text-transform: uppercase !important;
            }
            button[style*="background-color: #059669"]:hover, a[style*="background-color: #059669"]:hover,
            a[class*="bg-emerald-600"]:hover, button[class*="bg-emerald-600"]:hover {
                background: linear-gradient(135deg, #059669 0%, #047857 100%) !important;
                box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35), 0 2px 4px rgba(0, 0, 0, 0.06) !important;
                transform: translateY(-1px) !important;
            }

            /* Small action buttons (Edit, Void, Bayar, etc) */
            a[class*="px-3"][class*="py-1"], button[class*="px-3"][class*="py-1"],
            a[class*="px-2.5"][class*="py-1"], button[class*="px-2.5"][class*="py-1"] {
                font-family: 'Inter', sans-serif !important;
                font-weight: 600 !important;
                font-size: 0.6875rem !important;
                border-radius: 0.5rem !important;
                transition: all 0.15s ease !important;
                letter-spacing: 0.02em !important;
            }
            a[class*="px-3"][class*="py-1"]:hover, button[class*="px-3"][class*="py-1"]:hover {
                transform: translateY(-1px) !important;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08) !important;
            }

            /* Outline / secondary buttons */
            a[class*="bg-rose-50"], button[class*="bg-rose-50"] {
                font-family: 'Inter', sans-serif !important;
                font-weight: 600 !important;
                transition: all 0.15s ease !important;
            }

            /* --- BADGES/PILLS --- */
            span[class*="rounded-full"] {
                font-family: 'Inter', sans-serif !important;
                font-weight: 600 !important;
                font-size: 0.6875rem !important;
                letter-spacing: 0.02em !important;
                transition: all 0.15s ease !important;
            }

            /* --- ALERTS / FLASH MESSAGES --- */
            div[class*="bg-emerald-50"][role="alert"],
            div[class*="bg-rose-50"][role="alert"] {
                border-radius: 0.75rem !important;
                font-family: 'Inter', sans-serif !important;
                font-size: 0.8125rem !important;
                font-weight: 500 !important;
                animation: slideInDown 0.3s ease-out !important;
            }

            /* --- PAGINATION MODERN --- */
            nav[role="navigation"] {
                font-family: 'Inter', sans-serif !important;
            }
            nav[role="navigation"] span, nav[role="navigation"] a {
                font-size: 0.8125rem !important;
                font-weight: 500 !important;
                border-radius: 0.5rem !important;
                min-width: 2.25rem !important;
                padding: 0.375rem 0.75rem !important;
                transition: all 0.15s ease !important;
            }
            nav[role="navigation"] span[aria-current="page"] span {
                background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%) !important;
                color: white !important;
                border-color: transparent !important;
                box-shadow: 0 1px 3px rgba(79, 70, 229, 0.3) !important;
            }
            nav[role="navigation"] a:hover {
                background-color: #f1f5f9 !important;
                transform: translateY(-1px) !important;
            }

            /* --- KPI CARDS ENHANCEMENT --- */
            div[class*="rounded-2xl"][class*="shadow-sm"][class*="group"] {
                transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
            }
            div[class*="rounded-2xl"][class*="shadow-sm"][class*="group"]:hover {
                transform: translateY(-3px) !important;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.08), 0 4px 6px -2px rgba(0, 0, 0, 0.04) !important;
            }

            /* --- SECTION HEADERS --- */
            h3[class*="text-lg"][class*="font-bold"] {
                font-family: 'Outfit', sans-serif !important;
                font-weight: 700 !important;
                font-size: 1.125rem !important;
                letter-spacing: -0.025em !important;
                color: #0f172a !important;
            }
            p[class*="text-sm"][class*="text-gray-500"] {
                font-family: 'Inter', sans-serif !important;
                font-size: 0.8125rem !important;
                color: #94a3b8 !important;
                line-height: 1.5 !important;
            }

            /* --- ANIMATIONS --- */
            @keyframes slideInDown {
                from { opacity: 0; transform: translateY(-8px); }
                to { opacity: 1; transform: translateY(0); }
            }
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }

            main > * {
                animation: fadeIn 0.2s ease-out;
            }

            /* --- DIVIDER LINES --- */
            [class*="border-b"][class*="border-gray-100"],
            [class*="border-t"][class*="border-gray-100"] {
                border-color: #f1f5f9 !important;
            }

            /* --- FORM SECTIONS --- */
            h4[class*="text-sm"][class*="uppercase"] {
                font-family: 'Outfit', sans-serif !important;
                font-weight: 600 !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.08em !important;
            }

            /* --- FILTER SECTIONS --- */
            div[class*="bg-gray-50"][class*="rounded-xl"] {
                background: linear-gradient(180deg, #fafbfc 0%, #f1f5f9 100%) !important;
                border: 1px solid #e2e8f0 !important;
            }

            /* --- EMPTY STATE --- */
            td[class*="py-12"] {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }

            /* --- GLOBAL TRANSITIONS --- */
            a, button, input, select, textarea, span, div {
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* --- MODAL/DIALOG OVERRIDE (SweetAlert2) --- */
            .swal2-popup {
                font-family: 'Inter', sans-serif !important;
                border-radius: 1rem !important;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15) !important;
            }
            .swal2-title {
                font-family: 'Outfit', sans-serif !important;
                font-weight: 700 !important;
                font-size: 1.25rem !important;
                color: #0f172a !important;
            }
            .swal2-html-container {
                font-family: 'Inter', sans-serif !important;
            }
            .swal2-confirm, .swal2-cancel {
                font-family: 'Inter', sans-serif !important;
                font-weight: 600 !important;
                font-size: 0.8125rem !important;
                border-radius: 0.625rem !important;
                padding: 0.625rem 1.5rem !important;
                transition: all 0.15s ease !important;
            }
            .swal2-confirm:hover, .swal2-cancel:hover {
                transform: translateY(-1px) !important;
            }

            /* --- CUSTOM SCROLLBAR FOR SIDEBAR (HIDDEN) --- */
            aside::-webkit-scrollbar { display: none; }
            aside { -ms-overflow-style: none; scrollbar-width: none; }

            /* --- RESPONSIVE MOBILE OVERRIDES --- */
            @media (max-width: 768px) {
                /* Force multi-column grids to 1 column on mobile */
                [style*="grid-template-columns: repeat("],
                [style*="grid-template-columns: 1fr 1fr"],
                [style*="grid-template-columns: 2fr 1fr"],
                [style*="grid-template-columns: 1fr 1fr 300px"] {
                    grid-template-columns: 1fr !important;
                }
                
                /* Reset span to 1 column */
                [style*="grid-column: span"] {
                    grid-column: span 1 !important;
                }
                
                /* EXCEPTIONS: keep these grids responsive natively */
                .keep-grid-mobile,
                [style*="grid-template-columns: repeat(auto-fit"],
                [style*="grid-template-columns: repeat(auto-fill"] {
                    /* Allow auto-fit/auto-fill to do their job, but override the force from above if matched */
                    grid-template-columns: inherit !important;
                }

                /* Adjust large padding for mobile screens */
                div[style*="padding: 2rem"] {
                    padding: 1.25rem !important;
                }
                div[style*="padding: 1.5rem"] {
                    padding: 1.25rem !important;
                }
                
                /* Fix header fonts on small screens */
                h2[style*="font-size: 1.875rem"] {
                    font-size: 1.5rem !important;
                }
                h2[style*="font-size: 1.25rem"] {
                    font-size: 1.125rem !important;
                }
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

        {{-- Sidebar (FIXED) --}}
        @include('layouts.sidebar')

        {{-- Content Area --}}
        <div class="content-area flex flex-col h-full">
            {{-- Header --}}
            @include('layouts.header')

            {{-- Aesthetic Notifications --}}
            @include('components.flash-messages')

            {{-- Main Content --}}
            <main class="flex-1 overflow-y-auto focus:outline-none p-4 lg:p-6">
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

        {{-- Global SweetAlert2 Interceptor --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Intercept ALL forms with onsubmit="return confirm(...)"
                document.querySelectorAll('form[onsubmit]').forEach(function(form) {
                    const onsubmit = form.getAttribute('onsubmit');
                    if (onsubmit && onsubmit.includes('confirm(')) {
                        // Extract the confirm message
                        const match = onsubmit.match(/confirm\(['"](.+?)['"]\)/s);
                        if (match) {
                            const message = match[1].replace(/\\n/g, '<br>');
                            form.removeAttribute('onsubmit');
                            
                            form.addEventListener('submit', function(e) {
                                e.preventDefault();
                                Swal.fire({
                                    title: 'Konfirmasi',
                                    html: '<p style="font-size:0.875rem;color:#475569;">' + message + '</p>',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#4f46e5',
                                    cancelButtonColor: '#64748b',
                                    confirmButtonText: 'Ya, Lanjutkan',
                                    cancelButtonText: 'Batal',
                                    reverseButtons: true,
                                    focusCancel: true,
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Temporarily remove event listener to submit
                                        const clone = form.cloneNode(true);
                                        form.parentNode.replaceChild(clone, form);
                                        clone.submit();
                                    }
                                });
                            });
                        }
                    }
                });
            });
        </script>

        {{-- Scripts Stack --}}
        @stack('scripts')
    </body>
</html>
