<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center bg-red-600 border border-transparent font-semibold text-xs text-white uppercase tracking-widest transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
