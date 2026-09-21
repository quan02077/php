@props(['variant' => 'primary'])

@php
    $style = $variant === 'danger' 
        ? 'background-color: #DC2626; color: white; padding: 6px 16px; border: none; border-radius: 4px; cursor: pointer;' 
        : 'background-color: #2563EB; color: white; padding: 6px 16px; border: none; border-radius: 4px; cursor: pointer;';
@endphp

<button {{ $attributes->merge(['style' => $style]) }}>
    {{ $slot }}
</button>