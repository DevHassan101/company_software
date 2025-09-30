@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'flex items-center mt-4 mx-3 text-lg py-2 px-6 bg-blue-400 bg-opacity-25 rounded text-gray-100'
                : 'flex items-center mt-4 py-2 text-lg px-6 text-gray-100';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $icon ?? '' }}
    <span class="mx-3">{{ $slot }}</span>
</a>
