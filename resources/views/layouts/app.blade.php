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
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50/50">
        <div class="flex min-h-screen overflow-hidden">
            <!-- Sidebar -->
            @include('layouts.sidebar')

            <div class="flex flex-col flex-1 min-w-0 overflow-hidden">
                <!-- Header -->
                @include('layouts.header')

                <!-- Main Content Area -->
                <main class="flex-1 overflow-y-auto focus:outline-none p-4 lg:p-8">
                    @isset($header)
                        <div class="mb-8">
                            {{ $header }}
                        </div>
                    @endisset

                    <div class="animate-in fade-in slide-in-from-bottom-2 duration-500">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>
    </body>
</html>
