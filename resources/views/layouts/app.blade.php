<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'FILKOMIN'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="font-sans antialiased bg-[#f6f1e9]">

    {{-- NAVBAR GLOBAL (JANGAN MUNCUL DI LANDING) --}}
    @unless (request()->routeIs('landing'))
        @include('layouts.navigation')
    @endunless

    {{-- MAIN --}}
    <main class="min-h-screen flex justify-center py-12">
        @yield('content')
    </main>

</body>
</html>
