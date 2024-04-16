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
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{-- Mensaje de Session Flash --}}
                {{-- @if (session('success'))
                    <div class="mx-auto mt-2 mb-0 max-w-7xl sm:px-6 lg:px-8">
                        <div class="relative px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded" role="alert">
                            <strong class="font-bold">¡Éxito!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                @if (session('error'))
                <div class="mx-auto mt-2 mb-0 max-w-7xl sm:px-6 lg:px-8">
                    <div class="relative px-4 py-3 border rounded text-cyan-700 bg-cyan-100 border-cyan-400" role="alert">
                        <strong class="font-bold">¡Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
                @endif --}}

                {{-- ======================================================= --}}

                {{-- @if (session('success')) --}}
                @if (session()->has('success'))
                    <x-flash-messages :sessionType="'success'" :color="'green'" :title="'¡¡Éxito!!'" />
                @endif

                {{-- @if (session('error')) --}}
                @if (session()->has('error'))
                    <x-flash-messages :sessionType="'error'" :color="'red'" :title="'¡¡Error!!'" />
                @endif

                {{ $slot }}
            </main>
        </div>
    </body>
</html>
