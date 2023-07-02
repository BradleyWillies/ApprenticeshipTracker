@props(['active'])

@php
$classes = 'underline text-blue-400 hover:text-blue-600'
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
