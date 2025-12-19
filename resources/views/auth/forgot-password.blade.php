<x-guest-layout>

    <h1 class="text-2xl font-bold text-center mb-1">
        Lupa Password
    </h1>

    <p class="text-sm text-center mb-6 text-[#6B5F5F]">
        Masukkan email yang terdaftar untuk menerima
        link reset password akun
        <span class="font-bold text-[#4A3E3E] tracking-wide">FILKOMIN</span>
    </p>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
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

        <x-primary-button
            class="w-full bg-[#4A3E3E] hover:bg-[#3F3535] text-[#FBF9F5] justify-center">
            Kirim Link Reset Password
        </x-primary-button>
    </form>

    <p class="text-sm text-center mt-4 text-[#6B5F5F]">
        Ingat password?
        <a href="{{ route('login') }}" class="text-[#4A3E3E] font-semibold hover:underline">
            Login
        </a>
    </p>

</x-guest-layout>
