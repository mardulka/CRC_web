@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-yellow-500 text-lg font-medium leading-5 text-yellow-500 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-white hover:text-yellow-300 hover:border-yellow-300 focus:outline-none focus:text-indigo-700 focus:border-indigo-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
