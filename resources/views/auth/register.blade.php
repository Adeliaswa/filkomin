<x-guest-layout>

    <h1 class="text-2xl font-bold text-center mb-1">
        Register
    </h1>

    <p class="text-sm text-center mb-6 text-[#6B5F5F]">
        Buat akun untuk mengakses sistem Undangan Digital
        <span class="font-bold text-[#4A3E3E] tracking-wide">FILKOMIN</span>
    </p>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" value="Nama Lengkap" />
            <x-text-input
                id="name"
                class="block w-full mt-1 focus:ring-[#4A3E3E]"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input
                id="email"
                class="block w-full mt-1 focus:ring-[#4A3E3E]"
                type="email"
                name="email"
                :value="old('email')"
                required
            />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />
            <x-text-input
                id="password"
                class="block w-full mt-1 focus:ring-[#4A3E3E]"
                type="password"
                name="password"
                required
            />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
            <x-text-input
                id="password_confirmation"
                class="block w-full mt-1 focus:ring-[#4A3E3E]"
                type="password"
                name="password_confirmation"
                required
            />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <x-primary-button
            class="w-full bg-[#4A3E3E] hover:bg-[#3F3535] text-[#FBF9F5] justify-center">
            Register
        </x-primary-button>
    </form>

    <p class="text-sm text-center mt-4 text-[#6B5F5F]">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-[#4A3E3E] font-semibold hover:underline">
            Login
        </a>
    </p>

</x-guest-layout>
