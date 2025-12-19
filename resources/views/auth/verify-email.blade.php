<x-guest-layout>

    <h1 class="text-2xl font-bold text-center mb-1">
        Verifikasi Email
    </h1>

    <p class="text-sm text-center mb-6 text-[#6B5F5F]">
        Terima kasih telah mendaftar di
        <span class="font-bold text-[#4A3E3E] tracking-wide">FILKOMIN</span>.
        Silakan cek email Anda dan klik link verifikasi
        untuk melanjutkan.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm text-green-600 text-center">
            Link verifikasi baru telah dikirim ke alamat email Anda.
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <x-primary-button
                class="w-full bg-[#4A3E3E] hover:bg-[#3F3535] text-[#FBF9F5] justify-center">
                Kirim Ulang Email Verifikasi
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-full text-center text-sm text-[#4A3E3E] hover:underline">
                Logout
            </button>
        </form>
    </div>

</x-guest-layout>
