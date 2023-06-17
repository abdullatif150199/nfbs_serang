@props(['customAttributes' => []])

@php
    $columnSize = request()->is('alumni') ? 'px-2 py-1 md:px-4 md:py-2' : 'px-3 py-2 md:px-6 md:py-4';
@endphp

<td {{ $attributes->merge(['class' => "$columnSize text-sm leading-5 text-gray-900 dark:text-white"])->merge(['class' => $this->responsive ? '' : ''])->merge($customAttributes) }}>
    {{ $slot }}
</td>
