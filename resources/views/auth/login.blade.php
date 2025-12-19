<x-guest-layout>

    <h1 class="text-2xl font-bold text-center mb-1">
        Login
    </h1>

    <p class="text-sm text-center mb-6 text-[#6B5F5F]">
        Masuk ke sistem Undangan Digital
        <span class="font-bold text-[#4A3E3E] tracking-wide">FILKOMIN</span>
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

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
                autofocus
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

        <!-- Remember -->
        <div class="flex items-center">
            <input
                type="checkbox"
                name="remember"
                class="rounded text-[#4A3E3E] focus:ring-[#4A3E3E]"
            >
            <span class="ml-2 text-sm text-gray-600">
                Remember me
            </span>
        </div>

        <div class="space-y-3">
            <x-primary-button
                class="w-full bg-[#4A3E3E] hover:bg-[#3F3535] text-[#FBF9F5] justify-center">
                Login
            </x-primary-button>

            @if (Route::has('password.request'))
                <a
                    href="{{ route('password.request') }}"
                    class="block text-center text-sm text-[#4A3E3E] hover:underline"
                >
                    Lupa password?
                </a>
            @endif
        </div>
    </form>

    <p class="text-sm text-center mt-4 text-[#6B5F5F]">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-[#4A3E3E] font-semibold hover:underline">
            Register
        </a>
    </p>

</x-guest-layout>
