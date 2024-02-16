@props(['active'])

@php
    $classes = $active ?? false ? 'bg-gray-200' : '';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
