<button {{ $attributes->merge(['type' => 'button', 'class' => 'bg-gray-600 text-white']) }}>
    {{ $slot }}
</button>
