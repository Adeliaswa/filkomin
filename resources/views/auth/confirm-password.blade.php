<x-guest-layout>

    <h1 class="text-2xl font-bold text-center mb-1">
        Konfirmasi Password
    </h1>

    <p class="text-sm text-center mb-6 text-[#6B5F5F]">
        Demi keamanan, silakan masukkan kembali password Anda
        untuk melanjutkan ke sistem
        <span class="font-bold text-[#4A3E3E] tracking-wide">FILKOMIN</span>
    </p>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-4">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" value="Password" />

            <x-text-input
                id="password"
                class="block w-full mt-1 focus:ring-[#4A3E3E]"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <x-primary-button
            class="w-full bg-[#4A3E3E] hover:bg-[#3F3535] text-[#FBF9F5] justify-center">
            Konfirmasi
        </x-primary-button>
    </form>

</x-guest-layout>
