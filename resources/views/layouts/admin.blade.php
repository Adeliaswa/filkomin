<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin | Filkomin')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#FAF9F7] text-[#181818] font-sans">

<div class="flex min-h-screen">

<aside class="w-64 bg-gradient-to-b from-[#4A3E3E] to-[#2F2626] text-[#FAF9F7] flex flex-col">

    <!-- BRAND -->
    <div class="px-6 py-6 border-b border-white/15">
        <h1 class="text-xl font-bold tracking-wide">FILKOMIN</h1>
        <p class="text-xs mt-1 opacity-70 uppercase tracking-wider">
            Admin Panel
        </p>
    </div>

    <!-- MENU -->
    <nav class="flex-1 px-4 py-6 space-y-6 text-sm">

        <!-- MAIN -->
        <div>
            <p class="px-4 mb-2 text-xs uppercase tracking-wider opacity-60">Main</p>

            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg font-medium
               {{ request()->routeIs('admin.dashboard') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                Dashboard
            </a>
        </div>

        <!-- PAGES -->
        <div>
            <p class="px-4 mb-2 text-xs uppercase tracking-wider opacity-60">Pages</p>

<!-- EVENT APPROVAL -->
<div 
    x-data="{ open: {{ request()->routeIs('admin.events.approval') ? 'true' : 'false' }} }"
    class="space-y-1"
>
    <button 
        @click="open = !open"
        class="w-full flex justify-between items-center px-4 py-2 rounded-lg font-medium
        transition-all duration-300 ease-in-out
        {{ request()->routeIs('admin.events.approval') ? 'bg-white/15' : 'hover:bg-white/10' }}"
    >
        <span>Event Approval</span>

        <span 
            class="transition-transform duration-300 ease-in-out"
            :class="open ? 'rotate-90' : ''"
        >
            ›
        </span>
    </button>

    <div
        x-show="open"
        x-collapse.duration.300ms
        class="ml-6 space-y-1 text-xs overflow-hidden"
    >
        @php $status = request('status'); @endphp

        <a href="{{ route('admin.events.approval', 'pending') }}"
           class="block px-4 py-1.5 rounded transition-all duration-200
           {{ $status === 'pending' ? 'bg-white/20 font-semibold' : 'hover:bg-white/10 hover:translate-x-1' }}">
            Pending Approval
        </a>

        <a href="{{ route('admin.events.approval', 'approved') }}"
           class="block px-4 py-1.5 rounded transition-all duration-200
           {{ $status === 'approved' ? 'bg-white/20 font-semibold' : 'hover:bg-white/10 hover:translate-x-1' }}">
            Approved Events
        </a>

        <a href="{{ route('admin.events.approval', 'rejected') }}"
           class="block px-4 py-1.5 rounded transition-all duration-200
           {{ $status === 'rejected' ? 'bg-white/20 font-semibold' : 'hover:bg-white/10 hover:translate-x-1' }}">
            Rejected Events
        </a>
    </div>
</div>


            <!-- TEMPLATES -->
            <a href="{{ route('admin.templates.index') }}"
               class="block px-4 py-2 mt-2 rounded-lg font-medium
               {{ request()->is('admin/templates*') ? 'bg-white/15' : 'hover:bg-white/10' }}">
                Templates
            </a>
        </div>

        <!-- DATA -->
        <div>
            <p class="px-4 mb-2 text-xs uppercase tracking-wider opacity-60">Data</p>

            <div 
                x-data="{ open: {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} }"
                class="space-y-1"
            >
                <button 
                    @click="open = !open"
                    class="w-full flex justify-between items-center px-4 py-2 rounded-lg font-medium
                    transition-all duration-300 ease-in-out
                    {{ request()->routeIs('admin.users.*') ? 'bg-white/15' : 'hover:bg-white/10' }}"
                >
                    <span>Users</span>

                    <span 
                        class="transition-transform duration-300 ease-in-out"
                        :class="open ? 'rotate-90' : ''"
                    >
                        ›
                    </span>
                </button>

                <div
                    x-show="open"
                    x-collapse.duration.300ms
                    class="ml-6 space-y-1 text-xs overflow-hidden"
                >
                    <a href="{{ route('admin.users.admins') }}"
                       class="block px-4 py-1.5 rounded transition-all duration-200
                       {{ request()->routeIs('admin.users.admins') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10 hover:translate-x-1' }}">
                        Admins
                    </a>

                    <a href="{{ route('admin.users.eos') }}"
                       class="block px-4 py-1.5 rounded transition-all duration-200
                       {{ request()->routeIs('admin.users.eos') ? 'bg-white/20 font-semibold' : 'hover:bg-white/10 hover:translate-x-1' }}">
                        Event Organizers
                    </a>
                </div>
            </div>
        </div>

        <!-- REPORT -->
        <div class="mt-6">
            <p class="px-4 mb-2 text-xs uppercase tracking-wider opacity-60">
                Report
            </p>

            <a href="{{ route('admin.reports.dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-white/10 font-medium">
                Reports
            </a>
        </div>

    </nav>
</aside>

<!-- MAIN -->
<div class="flex-1 flex flex-col">

    <!-- TOP BAR -->
    <header class="bg-[#EEE9DF] px-6 py-4 flex justify-between items-center shadow-sm">
        <h2 class="text-sm font-semibold tracking-wide">
            @yield('page-title', 'Dashboard')
        </h2>

        <div class="flex items-center gap-4 text-sm">
            <span class="text-[#6B5F5F]">
                {{ auth()->user()->name }}
            </span>

            <span class="px-2 py-1 text-xs rounded bg-[#4A3E3E] text-white">
                Admin
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-[#4A3E3E] hover:underline">
                    Logout
                </button>
            </form>
        </div>
    </header>

    <!-- CONTENT -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>

</div>
</div>

</body>
</html>
