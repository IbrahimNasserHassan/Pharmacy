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
        <body class="font-sans text-gray-900 antialiased">
            <div class="min-h-screen flex items-center justify-center bg-cover bg-center" style="background-image: url('{{ asset('images/background.jpg') }}');">
                <div class="w-full sm:max-w-md bg-white p-6 rounded-lg shadow-lg">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
                <div>
                    <img src="{{ asset('image/pharmacy-logo.png') }}" class="w-20 h-auto mx-auto" alt="شعار الصيدلية">
                </div>

            <div class="w-full sm:max-w-md mt-9 px-9 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                
                {{ $slot }}
            </div>
        </div>
    </div>
    </div>
    </body>
    
</html>
