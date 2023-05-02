@props(['label' => null, 'url' => null])

<a href="{{ $url }}"
   title="{{ $label }}"
   aria-label="{{ $label }}"
   target="_blank" rel="noopener noreferrer"
   {{ $attributes->class('ml-4 transition-colors') }}
>
    <x-icon :name="strtolower($label)" />
</a>
