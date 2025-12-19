<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => '
            inline-flex items-center justify-center
            w-full px-4 py-3
            bg-[#4A3E3E]
            text-[#FBF9F5] text-sm font-semibold
            rounded-lg
            hover:bg-[#3F3535]
            active:bg-[#332B2B]
            focus:outline-none
            focus:ring-2 focus:ring-[#4A3E3E] focus:ring-offset-2
            transition duration-150
        '
    ]) }}
>
    {{ $slot }}
</button>
