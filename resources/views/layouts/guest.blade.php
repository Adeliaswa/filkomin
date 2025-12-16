<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FILKOMIN') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased text-[#181818] 
             bg-gradient-to-br from-[#FAF9F7] via-[#FBF9F5] to-[#EEE9DF]">

<div class="min-h-screen flex items-center justify-center px-4 relative overflow-hidden">

    <!-- Decorative Shape -->
    <div class="absolute -top-32 -right-32 w-96 h-96 bg-[#4A3E3E]/10 rounded-full"></div>
    <div class="absolute -bottom-40 -left-40 w-[28rem] h-[28rem] bg-[#4A3E3E]/5 rounded-full"></div>

    <!-- CARD -->
    <div class="relative w-full max-w-md">
        <div class="bg-[#EEE9DF] rounded-[2.5rem] shadow-2xl p-10">
            {{ $slot }}
        </div>
    </div>

</div>

</body>
</html>
