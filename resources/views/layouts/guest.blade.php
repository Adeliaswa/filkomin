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
    <div class="min-h-screen flex items-center justify-center bg-[#FBF9F5] px-4">

        <!-- Card -->
        <div class="relative w-full max-w-md bg-white rounded-3xl shadow-xl p-8 overflow-hidden">

            <!-- Dekor bubble -->
            <div class="absolute -top-6 -right-6 w-20 h-20 bg-[#A7D7C5] rounded-full opacity-40"></div>
            <div class="absolute -bottom-6 -left-6 w-24 h-24 bg-[#EADBC8] rounded-full opacity-40"></div>

            <!-- Logo -->
            <div class="flex justify-center mb-4">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-[#4A3E3E]" />
                </a>
            </div>

            <!-- SLOT KONTEN -->
            {{ $slot }}

        </div>
    </div>
</body>
</html>
