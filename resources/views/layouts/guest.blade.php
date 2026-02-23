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
        
        <style>
            body { 
                font-family: 'Inter', sans-serif !important;
                -webkit-font-smoothing: antialiased;
                letter-spacing: -0.011em;
            }
            h1, h2, h3, h4, h5, h6 { 
                font-family: 'Outfit', sans-serif !important; 
                letter-spacing: -0.025em;
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-slate-50">
        {{-- Aesthetic Notifications --}}
        @include('components.flash-messages')

        <div class="min-h-screen">
            {{ $slot }}
        </div>
    </body>
</html>
