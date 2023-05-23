@props(['active'])

@php
$classes = 'text-white dark:hover:text-gray-400'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
